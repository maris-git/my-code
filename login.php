<?
    require "inc/init.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $conn = require "inc/db.php";
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(User::authenticate($conn, $username, $password)){
            Auth::login();
            header("Location: index.php");
        } else{
            Dialog::show('Invalid username or password');
        }
    }
?>

<? require "inc/header.php";?>
<!-- Tao form dang nhap -->
<div class="content">
    <form method="post" id="frmLOGIN">
        <fieldset>
            <legend>Login System</legend>
            <div class="row">
                <label for="username">User name:</label>
                <span class='error'>*</span>
                <input type="text" id="username" name="username" placeholder="User name">
            </div>
            <div class="row">
                <label for="password">Passsword:</label>
                <span class='error'>*</span>
                <input type="password" id="password" name="password" placeholder="Passsword">
            </div>
            <div class="row">
                <input type="submit" class="btn" value="Login">
                <input type="reset" class="btn" id="Cancel">
            </div>
        </fieldset>
    </form>
</div>
<? require "inc/footer.php"?>