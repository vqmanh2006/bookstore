<?php include dirname(__DIR__, 3) . '/header.php';?>
<?php if (!$book) {?>
<div class="single-product-area"><div class="container"><h2>Không tìm thấy sách</h2></div></div>
<?php } else {?>
<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div style="display:flex">
            <div style="width:300px;padding:0 16px"><img style="height:320px" src="<?=AppUrl($book['Thumbnail'])?>" alt="<?=htmlspecialchars($book['BookTitle'])?>"></div>
            <div style="padding:0 16px">
                <h3>Thông tin sản phẩm</h3>
                <p><b>ISBN:</b> <?=$book['ISBN']?></p>
                <p><b>Tên sách:</b> <?=htmlspecialchars($book['BookTitle'])?></p>
                <p><b>Năm xuất bản:</b> <?=$book['PublishYear']?></p>
                <p><b>Trọng lượng:</b> <?=$book['Weight']?> gam</p>
                <p><b>Kích thước:</b> <?=$book['Size']?> mm</p>
                <p><b>Số trang:</b> <?=$book['PageNumber']?></p>
                <p><b>Giá:</b> <?=number_format($book['Price'])?> ₫</p>
                <div class="product-detail-actions">
                    <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == 3) {?>
                    <a class="detail-buy-button" href="<?=BASE_URL . '/cart.php?id=' . urlencode($book['ISBN'])?>"><i class="fas fa-shopping-cart"></i> Mua hàng</a>
                    <?php } else {?>
                    <a class="detail-buy-button" href="<?=BASE_URL?>/sign.php"><i class="fas fa-sign-in-alt"></i> Đăng nhập để mua</a>
                    <?php }?>
                </div>
                <p><b>Ngôn ngữ:</b> <?=$book['LanguageName']?></p>
                <p><b>Danh mục:</b> <?=$book['CategoryName']?></p>
                <p><b>Nhà xuất bản:</b> <?=$book['PublishName']?></p>
                <p><b>Mô tả:</b> <?=htmlspecialchars($book['Description'])?></p>
            </div>
        </div>
    </div>
</div>
<?php }?>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
