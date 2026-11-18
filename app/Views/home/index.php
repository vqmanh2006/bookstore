<?php include dirname(__DIR__, 3) . '/header.php';?>
<main class="home-page">
    <div class="container">
        <div class="home-notice">
            <strong>Thông báo:</strong> Nhà sách trí tuệ đã cập nhật nhiều đầu sách mới. Chúc bạn có trải nghiệm mua sắm vui vẻ!
        </div>
        <div class="home-community">
            <span><i class="fas fa-bookmark"></i> Đọc sách mỗi ngày</span>
            <div>
                <a href="#"><i class="fab fa-facebook"></i> Facebook</a>
                <a href="#"><i class="fab fa-facebook-messenger"></i> Cộng đồng</a>
                <a href="#"><i class="fab fa-telegram"></i> Telegram</a>
            </div>
        </div>
        <section class="book-section">
            <h2 class="section-title"><i class="fas fa-star"></i> Sách nổi bật</h2>
            <div class="book-shelf">
                <?php foreach ($books as $book) {?>
                <article class="book-card">
                    <div class="book-cover">
                        <span class="book-badge">Mới</span>
                        <a href="<?=BASE_URL . '/book-details.php?id=' . urlencode($book['ISBN'])?>">
                            <img src="<?=AppUrl($book['Thumbnail'])?>" alt="<?=htmlspecialchars($book['BookTitle'])?>">
                        </a>
                    </div>
                    <h3><a href="<?=BASE_URL . '/book-details.php?id=' . urlencode($book['ISBN'])?>"><?=htmlspecialchars($book['BookTitle'])?></a></h3>
                    <p><?=Helper::Currency($book['Price'])?></p>
                </article>
                <?php }?>
            </div>
        </section>
    </div>
</main>
<?php include dirname(__DIR__, 3) . '/footer.php';?>
