<?php
namespace App\Models;

class CartModel
{
    public function add($username, $isbn)
    {
        $safeUsername = addslashes($username);
        $safeIsbn = addslashes($isbn);
        return \Database::NonQuery(
            "INSERT INTO carts (ISBN, Username, Amount, UpdatedAt)
             VALUES ('$safeIsbn', '$safeUsername', 1, NOW(3))
             ON DUPLICATE KEY UPDATE Amount = Amount + 1, UpdatedAt = NOW(3)"
        );
    }

    public function updateAmount($username, $isbn, $amount)
    {
        $safeUsername = addslashes($username);
        $safeIsbn = addslashes($isbn);
        $amount = max(1, (int) $amount);
        return \Database::NonQuery("UPDATE carts SET Amount = $amount WHERE ISBN = '$safeIsbn' AND Username = '$safeUsername'");
    }

    public function remove($username, $isbn)
    {
        $safeUsername = addslashes($username);
        $safeIsbn = addslashes($isbn);
        return \Database::NonQuery("DELETE FROM carts WHERE ISBN = '$safeIsbn' AND Username = '$safeUsername'");
    }

    public function clear($username)
    {
        $safeUsername = addslashes($username);
        return \Database::NonQuery("DELETE FROM carts WHERE Username = '$safeUsername'");
    }

    public function items($username)
    {
        $safeUsername = addslashes($username);
        return \Database::GetData(
            "SELECT * FROM carts, books
             WHERE books.ISBN = carts.ISBN AND Username = '$safeUsername'
             ORDER BY carts.UpdatedAt DESC"
        );
    }

    public function rawItems($username)
    {
        $safeUsername = addslashes($username);
        return \Database::GetData("SELECT * FROM carts WHERE Username = '$safeUsername'");
    }

    public function total($username)
    {
        $safeUsername = addslashes($username);
        return \Database::GetData(
            "SELECT SUM(Amount * Price) FROM carts, books
             WHERE carts.ISBN = books.ISBN AND Username = '$safeUsername'",
            ['row' => 0, 'cell' => 0]
        );
    }

    public function countItems($username)
    {
        $safeUsername = addslashes($username);
        return \Database::GetData("SELECT COUNT(*) FROM carts WHERE Username = '$safeUsername'", ['row' => 0, 'cell' => 0]);
    }
}
