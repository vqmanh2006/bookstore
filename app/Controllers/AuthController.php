<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\UserModel;

class AuthController extends Controller
{
    public function sign()
    {
        $message = null;
        $model = new UserModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['SignIn'])) {
                $user = $model->authenticate($_POST['username'] ?? '', $_POST['password'] ?? '');
                if ($user) {
                    $_SESSION['Username'] = $user['Username'];
                    $_SESSION['DisplayName'] = $user['Fullname'] == '' ? $user['Username'] : $user['Fullname'];
                    $_SESSION['Avatar'] = !empty($user['Avatar']) ? AppUrl($user['Avatar']) : BASE_URL . '/assets/img/user.png';
                    $_SESSION['Role'] = $user['AccountTypeID'];
                    $this->redirect('admin/index.php');
                }
                $message = "<p style='color:#dc3545'>Tên đăng nhập hoặc mật khẩu không hợp lệ!</p>";
            }

            if (isset($_POST['SignUp'])) {
                if (($_POST['password1'] ?? '') === ($_POST['password2'] ?? '')) {
                    $ok = $model->register($_POST['username'] ?? '', $_POST['password1'] ?? '', $_POST['email'] ?? '');
                    $message = $ok
                        ? "<p style='color:#0d6efd'>Đăng ký thành công</p>"
                        : "<p style='color:#dc3545'>Đăng ký thất bại</p>";
                } else {
                    $message = "<p style='color:#dc3545'>Mật khẩu không khớp!</p>";
                }
            }
        }

        $this->view('auth/sign', ['message' => $message]);
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('sign.php');
    }
}
