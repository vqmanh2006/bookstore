<?php
namespace App\Models;

class UserModel
{
    public function authenticate($login, $password)
    {
        $login = addslashes($login);
        $password = addslashes($password);
        $users = \Database::GetData(
            "SELECT * FROM users
             WHERE (Username = '$login' OR Phone = '$login' OR Email = '$login')
               AND Password = sha1('$password') AND Status = 1"
        );
        return $users ? $users[0] : null;
    }

    public function register($username, $password, $email)
    {
        $username = addslashes($username);
        $password = addslashes($password);
        $email = addslashes($email);
        return \Database::NonQuery(
            "INSERT INTO users
             VALUES ('$username', sha1('$password'), '', '', '$email', '', 0, 1, NOW(3), 3)"
        );
    }

    public function profile($username)
    {
        $username = addslashes($username);
        return \Database::GetData(
            "SELECT * FROM users, account_types
             WHERE users.AccountTypeID = account_types.AccountTypeID
               AND Username = '$username'",
            ['row' => 0]
        );
    }

    public function updateProfile($username, $fullname, $phone, $email)
    {
        $username = addslashes($username);
        $fullname = addslashes($fullname);
        $phone = addslashes($phone);
        $email = addslashes($email);
        return \Database::NonQuery(
            "UPDATE users SET Fullname = '$fullname', Phone = '$phone', Email = '$email'
             WHERE Username = '$username'"
        );
    }
}
