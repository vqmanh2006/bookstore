<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class ProfileController extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $model = new UserModel();
        $message = null;

        if (isset($_POST['submit'])) {
            if (!empty($_FILES['avatar']['name'])) {
                $imagePath = '/uploads/' . basename($_FILES['avatar']['name']);
                $uploadDir = dirname(__DIR__, 2) . '/uploads';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                move_uploaded_file($_FILES['avatar']['tmp_name'], dirname(__DIR__, 2) . $imagePath);
                \Database::NonQuery("UPDATE users SET Avatar = '$imagePath' WHERE Username = '" . addslashes($_SESSION['Username']) . "'");
                $_SESSION['Avatar'] = AppUrl($imagePath);
            }

            $model->updateProfile(
                $_SESSION['Username'],
                $_POST['fullname'] ?? '',
                $_POST['phone'] ?? '',
                $_POST['email'] ?? ''
            );
            $message = '<p style="color:#48CFAD">Cập nhật thông tin cá nhân thành công</p>';
        }

        $this->view('auth/profile', [
            'user' => $model->profile($_SESSION['Username']),
            'message' => $message,
        ]);
    }

    public function changePassword()
    {
        $this->requireLogin();
        $message = null;
        if (isset($_POST['submit'])) {
            $oldPassword = sha1($_POST['old_password'] ?? '');
            $newPassword = sha1($_POST['new_password'] ?? '');
            $username = addslashes($_SESSION['Username']);
            $check = \Database::GetData("SELECT Username FROM users WHERE Username = '$username' AND Password = '$oldPassword'", ['row' => 0]);
            if ($check) {
                \Database::NonQuery("UPDATE users SET Password = '$newPassword' WHERE Username = '$username'");
                $message = '<p style="color:#48CFAD">Đổi mật khẩu thành công</p>';
            } else {
                $message = '<p style="color:#dc3545">Mật khẩu cũ không đúng</p>';
            }
        }
        $this->view('auth/change-password', ['message' => $message]);
    }
}
