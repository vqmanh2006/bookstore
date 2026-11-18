<?php include dirname(__DIR__, 3) . '/header.php';?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <h2 class="store-page-title">Mua hàng</h2>
        <div class="row">
            <?php foreach ($books as $book) {?>
            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img src="<?=AppUrl($book['Thumbnail'])?>" style="height: 320px" alt="<?=htmlspecialchars($book['BookTitle'])?>">
                    </div>
                    <h2><a href="<?=BASE_URL . '/book-details.php?id=' . urlencode($book['ISBN'])?>"><?=htmlspecialchars($book['BookTitle'])?></a></h2>
                    <div class="product-carousel-price"><ins><?=Helper::Currency($book['Price'])?></ins></div>
                    <div class="product-option-shop">
                        <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == 3) {?>
                        <a class="add_to_cart_button" href="<?=BASE_URL . '/cart.php?id=' . urlencode($book['ISBN'])?>"><i class="fas fa-cart-plus"></i></a>
                        <?php }?>
                        <a class="add_to_cart_button" href="<?=BASE_URL . '/book-details.php?id=' . urlencode($book['ISBN'])?>">Chi tiết</a>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
