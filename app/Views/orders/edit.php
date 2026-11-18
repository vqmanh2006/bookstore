<?php include dirname(__DIR__, 3) . '/header.php';?>
<main class="single-product-area customer-orders-page">
    <div class="container">
        <h2 class="store-page-title">Sửa đơn hàng <?=htmlspecialchars($order['OrderID'])?></h2>
        <form method="POST" class="edit-order-card">
            <input type="hidden" name="order_id" value="<?=htmlspecialchars($order['OrderID'])?>">
            <?php foreach ($details as $detail) {?>
            <div class="edit-order-row">
                <div><strong><?=htmlspecialchars($detail['BookTitle'])?></strong><span><?=Helper::Currency($detail['Price'])?></span></div>
                <input type="number" name="amount[<?=htmlspecialchars($detail['ISBN'])?>]" min="1" value="<?=$detail['Amount']?>">
            </div>
            <?php }?>
            <button class="detail-buy-button" type="submit" name="save_order">Lưu thay đổi</button>
            <a class="order-action-button" href="<?=BASE_URL?>/my-orders.php">Quay lại</a>
        </form>
    </div>
</main>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
