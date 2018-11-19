<?php
require_once "functions.php";
check_login();
$name = '';
$email = '';
$fullname = '';
$birthdate = '';
$role = '';

if (isset($_GET['username'])) {
    $profil = get_user($_GET['username']);
    $id = $profil['id'];
    $name = $profil['username'];
    $fullname = $profil['fullname'];
    $email = $profil['email'];
    $birthdate = $profil['birthdate'];
    $role = $profil['role'];
}

$profil = get_user($user);





if (isset($_POST['validate'])) {
    if (isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['birthdate'])) {


        $fullname = sanitize($_POST['fullname']);
        $birthdate = sanitize($_POST['birthdate']);
        $email = sanitize($_POST['email']);
        $username = sanitize($_POST['username']);
        $id = sanitize($_POST['id']);
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


        if (!isset($errors)) {




            uptdate_user($id, $username, $fullname, $email, $birthdate, $role);
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
        <?php include('menu_admin.php'); ?>
        <div class="title">Edit</div>
        <div class="menu">
            
        </div>
        <div class="main">

            <br><br>
            <form action="edit.php" method="post">
                <table>
                    <tr>
                        <td>User Name:</td>
                        <td><input id="username" name="username" type="text" value="<?php echo $name; ?>"></td>
                    </tr>
                    <tr>
                        <td>Full Name:</td>
                        <td><input id="fullname" name="fullname" type="text" value="<?php echo $fullname; ?>"></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input id="email" name="email" type="email" value="<?php echo $email; ?>"</td>
                    </tr>
                    <tr>
                        <td>Birthdate:</td>
                        <td> <input id="birthdate" name="birthdate" type="date" value="<?php echo $birthdate; ?>"> </td>
                    </tr>
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
                            <input type="hidden" name="role" value="<?php echo $role; ?>">
                        <?php } ?>   

                    </tr>






                </table>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                

                <input type="submit" name="validate" value="Validate" >
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
