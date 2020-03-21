<?php
// Declare UserAccount_AdminPanel class

class UserAccount_AdminPanel {
    public function LoginUser($username, $password, $Database) {
        $login_db = $Database->prepare("SELECT username, password FROM users WHERE username=:username");
        $login_db->execute(['username' => $username]);
        // Okay, time to check if the username is an admin
        $check_if_admin = $Database->prepare("SELECT role FROM user_roles WHERE username=:username");
        $check_if_admin->execute(['username' => $username]);
        if (password_verify($password, $login_db->fetch()['password']) && $check_if_admin->fetch()["role"] == "admin") {
            return true;
        } else {
            return false;
        }
    }
    public function GetUserInfo($username, $Database) {
        $userinfo = $Database->prepare("SELECT * FROM users WHERE username=:username");
        $userinfo->execute(["username" => $username]);
        while ($user = $userinfo->fetchObject()) {
            $user_data[] = $user;
        }
        return $user_data;
    }

    public function UpdateUserRole($username, $user_role, $Database) {
        $update_user = $Database->prepare("UPDATE user_roles SET role=:role WHERE username=:username");
        $update_user->execute(['username' => $username, "role" => $user_role]);
        return true;
    }

    public function UserExists($username, $Database) {
        $user_exists = $Database->prepare("SELECT id FROM users WHERE username=:username");
        $user_exists->execute(['username' => $username]);
        if($user_exists->fetch(PDO::FETCH_ASSOC)) {
            return true;
        } else {
            return false;
        }
    }

}