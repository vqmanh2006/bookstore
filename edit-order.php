<?php
    include_once 'config/config.php';
    include_once 'config/database.php';
    include_once 'config/Helper.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['Username'])) {
        header('Location: ' . BASE_URL . '/sign.php');
        exit;
    }

    $orderID = $_GET['order-id'] ?? $_POST['order_id'] ?? '';
    $sql = "SELECT * FROM orders WHERE OrderID = '$orderID' AND Username = '" . $_SESSION['Username'] . "'";
    $order = Database::GetData($sql, ['row' => 0]);

    if (!$order || $order['Status'] != 0) {
        header('Location: ' . BASE_URL . '/my-orders.php');
        exit;
    }

    if (isset($_POST['save_order'])) {
        foreach ($_POST['amount'] ?? [] as $isbn => $amount) {
            $amount = max(1, (int) $amount);
            $sql = "UPDATE order_details SET Amount = $amount WHERE OrderID = '$orderID' AND ISBN = '$isbn'";
            Database::NonQuery($sql);
        }

        $sql = "SELECT SUM(order_details.Amount * books.Price) FROM order_details, books WHERE order_details.ISBN = books.ISBN AND OrderID = '$orderID'";
        $total = Database::GetData($sql, ['row' => 0, 'cell' => 0]);
        $sql = "UPDATE orders SET TotalMoney = '$total', TotalRevenue = '$total' WHERE OrderID = '$orderID' AND Username = '" . $_SESSION['Username'] . "' AND Status = 0";
        Database::NonQuery($sql);
        header('Location: ' . BASE_URL . '/my-orders.php');
        exit;
    }

    $sql = "SELECT order_details.*, books.BookTitle, books.Price FROM order_details, books WHERE order_details.ISBN = books.ISBN AND OrderID = '$orderID'";
    $details = Database::GetData($sql);
?>
<?php include 'header.php'?>

<main class="single-product-area customer-orders-page">
    <div class="container">
        <h2 class="store-page-title">Sửa đơn hàng <?=htmlspecialchars($orderID)?></h2>
        <form method="POST" class="edit-order-card">
            <input type="hidden" name="order_id" value="<?=htmlspecialchars($orderID)?>">
            <?php foreach ($details as $detail) {?>
            <div class="edit-order-row">
                <div>
                    <strong><?=htmlspecialchars($detail['BookTitle'])?></strong>
                    <span><?=Helper::Currency($detail['Price'])?></span>
                </div>
                <input type="number" name="amount[<?=htmlspecialchars($detail['ISBN'])?>]" min="1" value="<?=$detail['Amount']?>">
            </div>
            <?php }?>
            <button class="detail-buy-button" type="submit" name="save_order">Lưu thay đổi</button>
            <a class="order-action-button" href="<?=BASE_URL?>/my-orders.php">Quay lại</a>
        </form>
    </div>
</main>

<?php include 'footer.php'?>
