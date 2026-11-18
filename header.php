<?php if (session_status() === PHP_SESSION_NONE) session_start()?>
<?php include_once __DIR__ . '/config/config.php'?>
<?php include_once __DIR__ . '/config/database.php'?>
<?php include_once __DIR__ . '/config/Helper.php'?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nhà sách trí tuệ</title>
    <link rel="icon" href="<?=BASE_URL?>/assets/img/favicon.png" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,100" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?=HOME_TEMPLATE_URL?>/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?=ADMIN_TEMPLATE_URL?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=HOME_TEMPLATE_URL?>/css/owl.carousel.css">
    <link rel="stylesheet" href="<?=HOME_TEMPLATE_URL?>/css/ustora-style.css">
    <link rel="stylesheet" href="<?=HOME_TEMPLATE_URL?>/css/responsive.css">

    <style>
    .form-search {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .form-search input,
    .form-search .btn {
        font-size: inherit;
        font-family: inherit;
        padding: 8px;
        border: 1px solid #ccc;
    }

    .form-search input {
        width: 100%;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        outline: none;
    }

    .form-search .btn {
        background-color: #428bca;
        color: white;
        padding: 8px 16px;
        border-radius: 0;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .form-search .btn:hover {
        opacity: 0.7;
    }
    </style>
</head>

<body>
    <div class="header-area">
        <div class="container site-header">
            <div class="logo">
                <h1><a href="<?=BASE_URL?>/"><img src="<?=BASE_URL?>/assets/img/nha-sach-tri-tue-logo.svg" alt="Nhà sách trí tuệ"></a></h1>
            </div>

            <form class="form-search" action="<?=BASE_URL?>/shop.php">
                <input name="keyword" placeholder="Bạn muốn tìm sách gì?">
                <button class="btn" aria-label="Tìm kiếm"><i class="fas fa-search"></i></button>
            </form>

            <?php
                $totalMoney = 0;
                $countItem = 0;
                if (isset($_SESSION['Username'])) {
                    $sql = "SELECT SUM(Amount * Price) FROM carts, books WHERE carts.ISBN = books.ISBN AND Username = '" . $_SESSION['Username'] . "'";
                    $totalMoney = Database::GetData($sql, ['row' => 0, 'cell' => 0]);
                    $sql = "SELECT count(*) FROM carts WHERE Username = '" . $_SESSION['Username'] . "'";
                    $countItem = Database::GetData($sql, ['row' => 0, 'cell' => 0]);
                }
            ?>
            <div class="header-actions">
                <?php if (isset($_SESSION['Role']) && $_SESSION['Role'] == '1') {?>
                <a class="header-action-link" href="<?=BASE_URL?>/admin/dashboard/index.php"><i class="fas fa-user-shield"></i></a>
                <?php }?>
                <?php if (isset($_SESSION['Role'])) {?>
                <a class="header-button" href="<?=BASE_URL?>/profile.php"><?=$_SESSION['DisplayName']?></a>
                <a class="header-button" href="<?=BASE_URL?>/logout.php">Đăng xuất</a>
                <?php } else {?>
                <a class="header-button" href="<?=BASE_URL?>/sign.php">Đăng ký</a>
                <a class="header-button" href="<?=BASE_URL?>/sign.php">Đăng nhập</a>
                <?php }?>
                <a class="shopping-item" href="<?=BASE_URL?>/cart.php">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="product-count"><?=$countItem?></span>
                </a>
            </div>
        </div>
    </div>

    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="<?=BASE_URL?>/">Trang chủ</a></li>
                        <li><a href="<?=BASE_URL?>/shop.php">Mua hàng</a></li>
                        <li><a href="<?=BASE_URL?>/category-book.php">Danh mục</a></li>
                        <li><a href="<?=BASE_URL?>/shop.php">Sách mới</a></li>
                        <li><a href="<?=BASE_URL?>/cart.php">Giỏ hàng</a></li>
                        <?php if (isset($_SESSION['Username'])) {?>
                        <li><a href="<?=BASE_URL?>/my-orders.php">Đơn hàng của tôi</a></li>
                        <?php }?>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- End mainmenu area -->
