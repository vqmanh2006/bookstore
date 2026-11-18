<?php include dirname(__DIR__, 3) . '/header.php';?>
<div class="product-big-title-area"><div class="container"><div class="row"><div class="col-md-12"><div class="product-bit-title text-center"><h2>Giỏ hàng của bạn</h2></div></div></div></div></div>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <?php if ($createdOrderID) {?>
        <div class="order-success-message"><i class="fas fa-check-circle"></i> Tạo đơn hàng thành công! Mã đơn hàng: <strong><?=htmlspecialchars($createdOrderID)?></strong></div>
        <?php }?>
        <div class="product-content-right"><div class="woocommerce">
            <form method="post" action="#">
                <table cellspacing="0" class="shop_table cart">
                    <thead><tr><th>ISBN</th><th>Tên sách</th><th>Ảnh</th><th>Giá</th><th width="125">Số lượng</th><th>Thành tiền</th><th>Xoá</th></tr></thead>
                    <tbody>
                        <?php foreach ($carts ?: [] as $cart) {?>
                        <tr class="cart_item">
                            <td class="product-name"><?=$cart['ISBN']?></td>
                            <td class="product-name"><?=htmlspecialchars($cart['BookTitle'])?></td>
                            <td class="product-thumbnail"><img class="shop_thumbnail" src="<?=AppUrl($cart['Thumbnail'])?>" alt=""></td>
                            <td class="product-name"><?=Helper::Currency($cart['Price'])?></td>
                            <td class="product-quantity">
                                <form method="POST">
                                    <input name="isbn" value="<?=$cart['ISBN']?>" hidden>
                                    <input name="amount" type="number" min="1" value="<?=$cart['Amount']?>">
                                    <button name="update_amount" class="btn btn-primary"><i class="fas fa-save"></i></button>
                                </form>
                            </td>
                            <td class="product-name"><?=Helper::Currency($cart['Price'] * $cart['Amount'])?></td>
                            <td class="product-remove"><a title="Xoá sản phẩm" class="remove" href="?del-cart-id=<?=$cart['ISBN']?>">×</a></td>
                        </tr>
                        <?php }?>
                        <tr><td class="actions" colspan="7">
                            <?php if (isset($_SESSION['Username'])) {?>
                            <a href="?type=payment&method=online" class="btn btn-lg btn-primary mr-2"><i class="fas fa-credit-card"></i> Thanh toán online</a>
                            <a href="?type=payment&method=offline" class="btn btn-lg btn-success">Đặt hàng, thanh toán sau</a>
                            <?php }?>
                        </td></tr>
                    </tbody>
                </table>
            </form>
            <div class="cart-collaterals"><div class="cart_totals"><h2>Tổng tiền giỏ hàng</h2>
                <table cellspacing="0"><tbody>
                    <tr><th>Tổng đơn hàng:</th><td><?=number_format($totalMoney ?: 0)?> đ</td></tr>
                    <tr><th>Vận chuyển:</th><td>Miễn phí vận chuyển</td></tr>
                    <tr><th>Tổng tiền:</th><td><strong><?=number_format($totalMoney ?: 0)?> đ</strong></td></tr>
                </tbody></table>
            </div></div>
        </div></div>
    </div>
</div>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
