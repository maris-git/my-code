<?
    class Auth {
    // Kiem tra dang nhap
        public static function isLoggedIn() {
            return isset($_SESSION['logged_in']) && $_SESSION['logged_in'];
        }
    // Bat buoc phai dang nhap
    public static function requireLogin() {
        if(!static::isLoggedIn()) {
            die('Please login to continue!')
        }
    }

    // Tao session sau khi dang nhap
    public static function login() {
        session_regenerate_id(true);
        $_SESSION['logged_in'] = true;
    }
    // Xoa session, cookie sau khi dang xuat
    public static function logout() {
        if (ini_get("session.use_cookies")){
            $parems = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $parems["path"],
                $parems["domain"],
                $parems["secure"],
                $parems["httponly"]
            );
        }
        session_destroy();
    }
    }
?>