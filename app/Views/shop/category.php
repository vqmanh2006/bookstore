<?php include dirname(__DIR__, 3) . '/header.php';?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="category-filter">
            <strong>Thể loại:</strong>
            <?php foreach ($categories as $category) {?>
            <a class="<?=isset($_GET['CategoryID']) && $_GET['CategoryID'] == $category['CategoryID'] ? 'active' : ''?>" href="<?=BASE_URL . '/category-book.php?CategoryID=' . (int) $category['CategoryID']?>"><?=htmlspecialchars($category['CategoryName'])?></a>
            <?php }?>
        </div>
        <h1 class="text-primary text-center"><?=htmlspecialchars($categoryName ?: 'Thể loại')?></h1>
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
