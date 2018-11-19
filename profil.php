<?php
require_once "functions.php";
check_login();



if (isset($_GET["username"])) {
    $username = sanitize($_GET["username"]);
} else {
    $username = $user;
}


$profil = get_user($username);
$role = $profil['role'];


if (!$profil) {
    abort("Can't find '$username' .");
}
// else {
//     $description=$profil["profil"];
//
//}

if (isset($profil['role']) AND $profil['role'] == "admin" || $profil['role'] == "manager") {
    include('menu_admin.php');
} else {
    include('menu_users.php');
}
?>



<html>
    <head>
      
        <title>  <?php echo $username; ?> </title>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>

    </head>
    <body>
              <h4 style="text-align:center"><?php echo $username; ?> profile</h4>
            <div class="cardprofile">
                <img src="imgs/profile.png" alt="<?php echo $username; ?>"  style="width:100%">
                <h1> <?php echo $username; ?> </h1>
                <p class="title"><?php echo $role; ?></p>
                <p>Brussels University</p>

<!--                <p>  <button class="buttonprofil">Contact &#9993 </button></p>-->
            </div>

        

       
    </body>
</html>
