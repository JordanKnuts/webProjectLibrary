<?php
require_once "functions.php";
$pdo = connect();
$username = '';
$email = '';
$fullname = '';
$password = '';
$password_confirm = '';
$birthdate='';
$role='';

if (isset($_POST['validate'])) {
    if(isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['role'])  ){
         
        $password = sanitize($_POST['password']);
        $fullname = sanitize($_POST['fullname']);
        $birthdate=sanitize($_POST['birthdate']);
        $password_confirm = sanitize($_POST['password_confirm']);
        $email = sanitize($_POST['email']);
        $username = sanitize($_POST['username']);
        $role = sanitize($_POST['role']);


        
        if (trim($username) == '') {
            $errors[] = "Le username est obligatoire";
        }
        if (trim($email) == '') {
            $errors[] = "Le mail est obligatoire";
        }
        if (strlen(trim($username)) < 3) {
            $errors[] = "Le username doit contenir 3 caractères au minimum";
        }
        if ($password != $password_confirm) {
            $errors[] = "Les mots de passe doivent être identiques";
        }

        if (!isset($errors)) {
            
            add_user($username, $password, $fullname, $email, $birthdate,$role);
            echo"YESaii";
            echo my_hash('THEO');
            
            /*log_user($username);*/
        }
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Sign Up</div>
        <div class="menu">
            <a href="index.php">Home</a>
        </div>
        <div class="main">
            Please enter your details to sign up :
            <br><br>
            <form action="signup.php" method="post">
                <table>
                    <tr>
                        <td>User Name:</td>
                        <td><input id="username" name="username" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>Full Name:</td>
                        <td><input id="fullname" name="fullname" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input id="email" name="email" type="email" value=""></td>
                    </tr>
                    <td>Birthdate:</td>
                    <td> <input id="birthdate" name="birthdate" type="date" value=""> </td>
                    <tr>
                        <td>Role:</td>
                        <td><select id="role" name="role">
                                <option value="member">Member</option>
                                <option value="admin">Admin</option>
                                <option value="manager">Manager</option>
                                
                            </select></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value=""></td>
                    </tr>
                    
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input id="password_confirm" name="password_confirm" type="password" value=""></td>
                    </tr>
                </table>
                <input type="submit" name="validate" value="Sign Up" >
            </form>
            <?php
            if (isset($errors)) {
                echo "<div class='errors'>
                          <br><br><p>Veuillez corriger les erreurs suivantes :</p>
                          <ul>";
                foreach ($errors as $error) {
                    echo "<li>" . $error . "</li>";
                }
                echo '</ul> </div>';
            }
            ?>
        </div>
    </body>
</html>
