<? require "inc/init.php";
    // Auth::requireLogin();
    $usernameError = "";
    $passwordError = "";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $user_pattern = "/^[A-Za-z]*$/";
        if (!preg_match($user_pattern, $username)) {
            $usernameError = "Only characters are allowed";
        }
        //validate password
        $password = $_POST['password'];
        $pass_pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
        if (!preg_match($pass_pattern, $password)){
            $passwordError = "Has minimum 8 characters in length, At least hihi characters";
        }
        if ($usernameError == "" && $passwordError == "");{
            $conn = require "inc/db.php";
            $user = new User($username, $password);
            try {
                if ($user->addUser($conn)) {
                    Dialog::show("Added user successfully");
                } else{
                    Dialog::show("Cannot Add User!");
                }
            }
            catch(PDOExpection $e) {
                Dialog::show($e->getMessage());
                // xu li trang 404 tai day
            }
        } else {
            Dialog::show('Error !!!');
            // xu li trang 404 tai day
        }
    }
?>

<? require "inc/header.php";?>
<!-- tao form nhap user -->
    <div class="content">
        <form name="frmADDUSER" method="post" id="frmADDUSER">
            <fieldset>
            <div class="row">
                <label for="username">User name:</label>
                <span class='error'>*</span>
                <input type="text" id="username" name="username" placeholder="User name">
                <? echo "<span class='error'> $usernameError </span>"?>
            </div>
            <div class="row">
                <label for="password">Passsword:</label>
                <span class='error'>*</span>
                <input type="password" id="password" name="password" placeholder="Passsword">
                <? echo "<span class='error'> $passwordError </span>"?>
            </div>
            <div class="row">
                <input type="submit" class="btn" value="Login">
                <input type="reset" class="btn" value="Cancel">
            </div>
            </fieldset>
        </form>
    </div>

<? require "inc/footer.php";?>