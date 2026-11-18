<?php include dirname(__DIR__, 3) . '/header.php';?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <h2 class="store-page-title">Thể loại sách</h2>
        <div class="category-grid">
            <?php foreach ($categories as $category) {?>
            <a class="category-card" href="<?=BASE_URL . '/category-book.php?CategoryID=' . (int) $category['CategoryID']?>">
                <i class="fas fa-book-open"></i>
                <span><?=htmlspecialchars($category['CategoryName'])?></span>
            </a>
            <?php }?>
        </div>
    </div>
</div>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
