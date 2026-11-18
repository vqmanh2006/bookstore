<?php include dirname(__DIR__, 3) . '/header.php';?>
<main class="single-product-area customer-orders-page">
    <div class="container">
        <h2 class="store-page-title">Đơn hàng của tôi</h2>
        <?php if ($orders) {?>
            <?php foreach ($orders as $order) {?>
            <section class="customer-order-card">
                <div class="customer-order-header">
                    <div><strong>Mã đơn: <?=htmlspecialchars($order['OrderID'])?></strong><span><?=Helper::DateTime($order['CreatedAt'])?></span></div>
                    <?=Helper::PaymentBadge($order['Status'])?>
                </div>
                <div class="customer-order-items">
                    <?php foreach ((new \App\Models\OrderModel())->details($order['OrderID']) as $detail) {?>
                    <div><span><?=htmlspecialchars($detail['BookTitle'])?> × <?=$detail['Amount']?></span><strong><?=Helper::Currency($detail['Price'] * $detail['Amount'])?></strong></div>
                    <?php }?>
                </div>
                <div class="customer-order-footer">
                    <strong>Tổng tiền: <?=Helper::Currency($order['TotalRevenue'])?></strong>
                    <?php if ($order['Status'] == 0) {?>
                    <div>
                        <a class="order-action-button" href="<?=BASE_URL . '/edit-order.php?order-id=' . urlencode($order['OrderID'])?>">Sửa đơn</a>
                        <form method="POST" class="inline-order-form">
                            <input type="hidden" name="order_id" value="<?=htmlspecialchars($order['OrderID'])?>">
                            <button class="order-cancel-button" type="submit" name="cancel_order" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">Hủy đơn</button>
                        </form>
                    </div>
                    <?php }?>
                </div>
            </section>
            <?php }?>
        <?php } else {?>
            <div class="order-payment-card"><h3>Bạn chưa có đơn hàng nào</h3><a class="detail-buy-button" href="<?=BASE_URL?>/shop.php">Bắt đầu mua hàng</a></div>
        <?php }?>
    </div>
</main>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
