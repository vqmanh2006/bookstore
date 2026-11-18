<?php include dirname(__DIR__, 3) . '/header.php';?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <h1 class="text-primary text-center"><?=htmlspecialchars($categoryName ?: 'Danh mục')?></h1>
        <div class="row">
            <?php foreach ($books as $book) {?>
            <div class="col-md-3 col-sm-6">
                <div class="single-shop-product">
                    <div class="product-upper">
                        <img src="<?=AppUrl($book['Thumbnail'])?>" alt="" style="height: 320px">
                    </div>
                    <h2><a href="<?=BASE_URL . '/book-details.php?id=' . urlencode($book['ISBN'])?>"><?=htmlspecialchars($book['BookTitle'])?></a></h2>
                    <div class="product-carousel-price"><ins><?=Helper::Currency($book['Price'])?></ins></div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</div>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
