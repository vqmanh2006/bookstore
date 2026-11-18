<?php
namespace App\Models;

class OrderModel
{
    public function createId()
    {
        $id = 'BHT';
        for ($i = 0; $i < 7; $i++) {
            $id .= random_int(0, 9);
        }
        return $id;
    }

    public function create($username, $total, $method)
    {
        $cart = new CartModel();
        $items = $cart->rawItems($username);
        if (!$items) {
            return null;
        }

        $orderID = $this->createId();
        $safeUsername = addslashes($username);
        $total = (int) $total;

        \Database::NonQuery(
            "INSERT INTO orders VALUES ('$orderID', $total, $total, 0, NULL, NOW(3), '$safeUsername')"
        );

        foreach ($items as $item) {
            $isbn = addslashes($item['ISBN']);
            $amount = max(1, (int) $item['Amount']);
            \Database::NonQuery(
                "INSERT INTO order_details (ISBN, OrderID, Amount) VALUES ('$isbn', '$orderID', $amount)"
            );
        }

        $cart->clear($username);
        return $orderID;
    }

    public function forUser($username)
    {
        $safeUsername = addslashes($username);
        return \Database::GetData("SELECT * FROM orders WHERE Username = '$safeUsername' ORDER BY CreatedAt DESC");
    }

    public function findForUser($orderID, $username)
    {
        $orderID = addslashes($orderID);
        $safeUsername = addslashes($username);
        return \Database::GetData(
            "SELECT * FROM orders WHERE OrderID = '$orderID' AND Username = '$safeUsername'",
            ['row' => 0]
        );
    }

    public function details($orderID)
    {
        $orderID = addslashes($orderID);
        return \Database::GetData(
            "SELECT order_details.*, books.BookTitle, books.Price
             FROM order_details, books
             WHERE order_details.ISBN = books.ISBN AND OrderID = '$orderID'"
        );
    }

    public function cancel($orderID, $username)
    {
        $orderID = addslashes($orderID);
        $safeUsername = addslashes($username);
        return \Database::NonQuery(
            "UPDATE orders SET Status = 2
             WHERE OrderID = '$orderID' AND Username = '$safeUsername' AND Status = 0"
        );
    }

    public function updateDetails($orderID, $username, $amounts)
    {
        $order = $this->findForUser($orderID, $username);
        if (!$order || $order['Status'] != 0) {
            return false;
        }

        foreach ($amounts as $isbn => $amount) {
            $safeIsbn = addslashes($isbn);
            $amount = max(1, (int) $amount);
            \Database::NonQuery(
                "UPDATE order_details SET Amount = $amount WHERE OrderID = '$orderID' AND ISBN = '$safeIsbn'"
            );
        }

        $total = \Database::GetData(
            "SELECT SUM(order_details.Amount * books.Price)
             FROM order_details, books
             WHERE order_details.ISBN = books.ISBN AND OrderID = '$orderID'",
            ['row' => 0, 'cell' => 0]
        );

        $safeUsername = addslashes($username);
        $total = (int) $total;
        \Database::NonQuery(
            "UPDATE orders SET TotalMoney = $total, TotalRevenue = $total
             WHERE OrderID = '$orderID' AND Username = '$safeUsername' AND Status = 0"
        );
        return true;
    }

    public function markPaid($orderID, $username)
    {
        $orderID = addslashes($orderID);
        $safeUsername = addslashes($username);
        return \Database::NonQuery(
            "UPDATE orders SET Status = 1, PaymentDate = NOW(3)
             WHERE OrderID = '$orderID' AND Username = '$safeUsername' AND Status = 0"
        );
    }
}
