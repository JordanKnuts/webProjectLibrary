<?php
require_once 'functions.php';
$password='';
$username='';


if(isset($_POST["username"]) && isset($_POST["password"]) ){
    
    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);
    
    
    $member = get_user($username);
    if($member){
        if(check_password($password, $member['password'])){
            log_user($username);
        }
        else{
            $error="Wrong password. Try Again!";
        }
    }else {
            $error="Username do not exists.";
    }
    
    
}



?>



<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
    </head>
    <body>
        <div class="title">Log In</div>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="signup.php">Sign Up</a>
        </div>
        <div class="main">
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>Username:</td>
                        <td><input id="username"  name="username" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value=""></td>
                    </tr>
                </table>
                <input type="submit" value="Log In">
            </form>
            <?php
            if (isset($error)) {
                echo "<div class='errors'><br><br>$error</div>";
            }
            ?>
        </div>
    </body>
</html>



