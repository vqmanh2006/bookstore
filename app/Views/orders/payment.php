<?php include dirname(__DIR__, 3) . '/header.php';?>
<main class="single-product-area online-payment-page">
    <div class="container">
        <?php if (!$order) {?>
        <div class="order-payment-card"><h2>Không tìm thấy đơn hàng</h2><p>Đơn hàng không tồn tại hoặc không thuộc tài khoản của bạn.</p></div>
        <?php } elseif ($paymentCompleted) {?>
        <div class="order-payment-card payment-complete"><i class="fas fa-check-circle"></i><h2>Thanh toán thành công</h2><p>Đơn hàng <strong><?=htmlspecialchars($orderID)?></strong> đã được xác nhận.</p></div>
        <?php } else {?>
        <div class="order-payment-card">
            <h2>Thanh toán online</h2>
            <p class="payment-demo-note"><i class="fas fa-info-circle"></i> Đây là cổng thanh toán mô phỏng để kiểm thử website.</p>
            <div class="payment-order-summary"><span>Mã đơn hàng</span><strong><?=htmlspecialchars($order['OrderID'])?></strong><span>Tổng tiền</span><strong><?=Helper::Currency($order['TotalMoney'])?></strong></div>
            <form method="POST">
                <input type="hidden" name="order-id" value="<?=htmlspecialchars($orderID)?>">
                <label class="payment-option"><input type="radio" name="payment_channel" value="wallet" checked> <span><i class="fas fa-wallet"></i> Ví điện tử mô phỏng</span></label>
                <label class="payment-option"><input type="radio" name="payment_channel" value="card"> <span><i class="fas fa-credit-card"></i> Thẻ ngân hàng mô phỏng</span></label>
                <button class="detail-buy-button" type="submit" name="confirm_payment">Xác nhận thanh toán</button>
            </form>
        </div>
        <?php }?>
    </div>
</main>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
