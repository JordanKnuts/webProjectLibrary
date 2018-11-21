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

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $username; ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" >
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
    </head>
    <style>

        @import url(https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700);
        @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);


        [class*=underlay] {
            left: 0;
            min-height: 100%;
            min-width: 100%;
            position: fixed;
            top: 0;
        }
        .underlay-photo {
            /*            animation: hue-rotate 6s infinite;*/
            background-image: url(imgs/books.jpg);
            background-size: cover;
            -webkit-filter: grayscale(20%);
            z-index: -1;
        }
        .underlay-black {
            background: rgba(0,0,0,0.7);
            z-index: -1;
        }

        @keyframes hue-rotate {
            from {
                -webkit-filter: grayscale(30%) hue-rotate(0deg);
            }
            to {
                -webkit-filter: grayscale(30%) hue-rotate(360deg);
            }
        }
        table {
            font-family: arial, sans-serif;
            font-weight: 1000;
            border:30px;
            width: 100%;
            height: 100%;
            -webkit-filter: grayscale(30%);
            z-index: -1;
            background-color: #ffffff;

            opacity: 0.5;

        }

        tr,td,th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;

        }
        th{
            margin: 30px;
            background-color: #ffffff;
            border: 1px solid #dddddd;


        }
        h2,h4{
            text-align: center;
            color:white;
            text-decoration:white;
            opacity: 0.5;
        }


    </style>
    <body class="table">
        <form class="login-form" >
            <h4 style="text-align:center"><?php echo $username; ?> profile</h4>
            <div class="cardprofile">
                <img src="imgs/profile.png" alt="<?php echo $username; ?>"  style="width:90%">
                <h2> <?php echo $username; ?> </h2>
                <p class="title"><i class="fa fa-id-badge">&nbsp</i><?php echo $role; ?></p>
                <h2>Brussels University</h2>
            </div>
        
<!--                <p                          >  <button class="buttonprofil">Contact &#9993 </button></p>-->
            
        </form>
        <div class="underlay-photo"></div>
        <div class="underlay-black"></div> 
    </body>
    <footer>
        
    </footer>


</html>
