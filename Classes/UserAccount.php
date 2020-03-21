<?php
// Declare UserAccount class

class UserAccount {
    public function LoginUser($username, $password, $Database) {
        $login_db = $Database->prepare("SELECT username, password FROM users WHERE username=:username");
        $login_db->execute(['username' => $username]);
        if (password_verify($password, $login_db->fetch()['password'])) {
            return true;
        } else {
            return false;
        }
    }
    public function ChangeUserPassword($username, $newpassword, $Database) {
        $password = password_hash($newpassword, PASSWORD_DEFAULT);
        $change_password = $Database->prepare("UPDATE users SET password=:password WHERE username=:username");
        $change_password->execute(["username" => $username, "password" => $password]);
        return true;
    }
    public function RegisterUser($username, $email, $password, $realname, $user_role, $Database) {
        // Set date
        $date = date("Y-m-d");
        // Check existing user
        $checkexistinguser = $Database->prepare('SELECT username FROM users WHERE username=:username');
        $checkexistinguser->execute(["username" => $username]);
        if ($checkexistinguser->fetch(PDO::FETCH_ASSOC)) {
            return false;
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $register = $Database->prepare("INSERT INTO users (username, email, password, realname, date_registered) VALUES (:username, :email, :password, :realname, :date_registered)");
            $register->execute(["username" => $username, "email" => $email, "password" => $hashed_password, "realname" => $realname, "date_registered" => $date]);
            // Add user role to table
            $set_user_role = $Database->prepare("INSERT INTO user_roles (username, role) VALUES (:username, :role)");
            $set_user_role->execute(["username" => $username, "role" => $user_role]);
            return true;
        }
    }

    public function GetUserRole($username, $Database) {
        // Get user role from user_roles table
        $getuserrole = $Database->prepare('SELECT role FROM user_roles WHERE username=:username');
        $getuserrole->execute(["username" => $username]);
        return $getuserrole->fetch()["role"];
    }
    // Get user subscription from DB
    public function GetUserSubscription($username, $Database) {
        $getuserrole = $Database->prepare('SELECT name FROM user_roles WHERE username=:username');
        $getuserrole->execute(["username" => $username]);
        return $getuserrole->fetch()["role"];
    }

    public function AddUserBadge($username, $badge_name, $stream_id, $filename, $Database) {
        $add_badge = $Database->prepare("INSERT INTO user_badges (username, badge_name, stream_id, filename) VALUES (:username, :badge_name, :stream_id, :filename)");
        $add_badge->execute(["username" => $username, "badge_name" => $badge_name, "filename" => $filename, "stream_id" => $stream_id]);
        return true;
    }

    public function GetUserBadges($username, $stream_id, $Database) {
        $badges = $Database->prepare("SELECT * FROM user_badges WHERE stream_id=:stream_id");
        $badges->execute(["stream_id" => $stream_id]);
        while ($Badge_Data = $badges->fetchObject()) {
            $badge_data[] = $Badge_Data;
        }
        return $badge_data;
    }

}