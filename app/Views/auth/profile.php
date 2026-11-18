<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin cá nhân</title>
    <link rel="icon" href="<?=BASE_URL?>/assets/img/favicon.png">
    <link rel="stylesheet" href="<?=BASE_URL?>/assets/css/style.css">
</head>
<body class="profile__bg d-flex-center">
    <img class="profile__avatar" src="<?=AppUrl($_SESSION['Avatar'])?>" alt="Avatar">
    <div class="profile__form">
        <div class="profile__form--header"><h3>Thông tin cá nhân</h3></div>
        <form class="profile__form--body" method="POST" enctype="multipart/form-data">
            <div class="profile__group"><b>Tên đăng nhập:</b><input type="text" value="<?=$user['Username']?>" disabled></div>
            <div class="profile__group"><b>Họ tên:</b><input type="text" name="fullname" value="<?=htmlspecialchars($user['Fullname'])?>"></div>
            <div class="profile__group"><b>Số điện thoại:</b><input type="text" name="phone" value="<?=htmlspecialchars($user['Phone'])?>"></div>
            <div class="profile__group"><b>Email:</b><input type="email" name="email" value="<?=htmlspecialchars($user['Email'])?>"></div>
            <div class="profile__group"><b>Ảnh đại diện:</b><input type="file" name="avatar"></div>
            <div class="profile__group d-flex-center"><input class="btn" name="submit" type="submit" value="Cập nhật"><a class="btn" href="<?=BASE_URL?>/change-password.php">Đổi mật khẩu</a><a class="btn" href="<?=BASE_URL?>/">Trang chủ</a></div>
        </form>
        <?php if ($message) {?><div class="profile__form--footer"><?=$message?></div><?php }?>
    </div>
</body>
</html>
