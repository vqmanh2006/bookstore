<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Đổi mật khẩu</title><link rel="stylesheet" href="<?=BASE_URL?>/assets/css/style.css"></head>
<body class="profile__bg d-flex-center">
    <img class="profile__avatar" src="<?=AppUrl($_SESSION['Avatar'])?>" alt="Avatar">
    <div class="profile__form">
        <div class="profile__form--header"><h3>Đổi mật khẩu</h3></div>
        <form class="profile__form--body" method="POST">
            <div class="profile__group"><b>Mật khẩu cũ:</b><input type="password" name="old_password" required></div>
            <div class="profile__group"><b>Mật khẩu mới:</b><input type="password" name="new_password" required></div>
            <div class="profile__group d-flex-center"><input class="btn" name="submit" type="submit" value="Đổi mật khẩu"><a class="btn" href="<?=BASE_URL?>/profile.php">Thông tin cá nhân</a></div>
        </form>
        <?php if ($message) {?><div class="profile__form--footer"><?=$message?></div><?php }?>
    </div>
</body>
</html>
