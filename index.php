<?
    // session_start();
    // require "config.php";
    // require "classes/database.php";
    // require "classes/user.php";

    require "inc/init.php";
    $conn = require "inc/db.php";

    if ($conn) {
        // echo "Success connection";

        $username = "abcdef";
        $password = "abc123";
        //chung thuc user
        $rs = User::authenticate($conn, $username, $password);
        if ($rs) {
            echo "Login success !";
            //Tao session
            $_SESSION['id'] = "???";
            $_SESSION['user'] = $username;
            // Thay doi session id ??
        } else {
            echo "Invalid Username or Password";
        }
    }
?>
