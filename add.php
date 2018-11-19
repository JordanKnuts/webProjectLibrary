<?php
require_once "functions.php";
$pdo = connect();
check_login();
$username = '';
$email = '';
$fullname = '';
$birthdate='';
$role='';
$profil = get_user($user);

if (isset($_POST['validate'])) {
    if(isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['role'])  ){
         
        $password = '123';
        $fullname = sanitize($_POST['fullname']);
        $birthdate=sanitize($_POST['birthdate']);
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
        /*if (my_hash($password) != my_hash($password_confirm)) {
            $errors[] = "Les mots de passe doivent être identiques";
        }*/

        if (!isset($errors)) {
             
            add_user($username, my_hash($password), $fullname, $email, $birthdate,$role);
            //var_dump(add_user($username, my_hash($password), $fullname, $email, $birthdate,$role));
            redirect('members.php');
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
            Please enter details to add a new user :
            <br><br>
            <form action="add.php" method="post" >
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
                        <?php if (isset($profil['role']) AND $profil['role'] == 'admin') { ?>
                            <td>Role:</td>
                            <td><select id="role" name="role">
                                    <option value="member">Member</option>
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>

                                </select>
                            </td>
                        <?php } else {  ?>
                            <input type="hidden" name="role" value="Member">
                        <?php } ?>   

                    </tr>
                   
                    
                </table>
                <input type="submit" name="validate" value="ADD" >
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
