<?php
require_once "functions.php";
$pdo = connect();
$username = '';
$email = '';
$fullname = '';
$password = '';
$password_confirm = '';
$birthdate = '';
$role = '';

if (isset($_POST['validate'])) {
    if (isset($_POST['username']) && isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['role'])) {

        $password = sanitize($_POST['password']);
        $fullname = sanitize($_POST['fullname']);
        $birthdate = sanitize($_POST['birthdate']);
        $password_confim = sanitize($_POST['password_confirm']);
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
        if (my_hash($password) != my_hash($password_confirm)) {
          $errors[] = "Les mots de passe doivent être identiques";
          } 

        if (!isset($errors)) {

            add_user($username, my_hash($password), $fullname, $email, $birthdate, $role);
            //var_dump(add_user($username, my_hash($password), $fullname, $email, $birthdate,$role));
            log_user($username);
        }
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
    <style>

        @import url(https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700);
        @import url(//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css);

        body, html {
            height: 100%;
        }
        body {
            font-family: 'Open Sans';
            font-weight: 100;
            display: flex;
            overflow: hidden;
        }
        input {
            ::-webkit-input-placeholder {
                color: rgba(255,255,255,0.7);
            }
            ::-moz-placeholder {
                color: rgba(255,255,255,0.7);  
            }
            :-ms-input-placeholder {  
                color: rgba(255,255,255,0.7);  
            }
            &:focus {
                outline: 0 transparent solid;
                ::-webkit-input-placeholder {
                    color: rgba(0,0,0,0.7);
                }
                ::-moz-placeholder {
                    color: rgba(0,0,0,0.7);  
                }
                :-ms-input-placeholder {  
                    color: rgba(0,0,0,0.7);  
                }
            }
        }

        .login-form {
            /*            //background: #222;
                        //box-shadow: 0 0 1rem rgba(0,0,0,0.3);*/
            min-height: 10rem;
            margin: auto;
            max-width: 50%;
            padding: .5rem;
        }
        .login-text {
            /*            //background: hsl(40,30,60);
                        //border-bottom: .5rem solid white;*/
            color: white;
            font-size: 1.5rem;
            margin: 0 auto;
            max-width: 50%;
            padding: .5rem;
            text-align: center;
            /*            //text-shadow: 1px -1px 0 rgba(0,0,0,0.3);*/
            .fa-stack-1x {
                color: black;
            }
        }

        .login-username, .login-password {
            background: transparent;
            border: 0 solid;
            border-bottom: 1px solid rgba(white, .5);
            color: white;
            display: block;
            margin: 1rem;
            padding: .5rem;
            transition: 250ms background ease-in;
            width: calc(100% - 3rem);
            &:focus {
                background: white;
                color: black;
                transition: 250ms background ease-in;
            }
        }

        .login-forgot-pass {
            /*            //border-bottom: 1px solid white;*/
            bottom: 0;
            color: white;
            cursor: pointer;
            display: block;
            font-size: 75%;
            left: 0;
            opacity: 0.6;
            padding: .5rem;
            position: absolute;
            text-align: center;
            /*            //text-decoration: none;*/
            width: 100%;
            &:hover {
                opacity: 1;
            }
        }
        .login-submit {
            border: 1px solid white;
            background: transparent;
            color: white;
            display: block;
            margin: 1rem auto;
            min-width: 1px;
            padding: .25rem;
            transition: 250ms background ease-in;
            &:hover, &:focus {
                background: white;
                color: black;
                transition: 250ms background ease-in;
            }
        }

        [class*=underlay] {
            left: 0;
            min-height: 100%;
            min-width: 100%;
            position: fixed;
            top: 0;
        }
        .underlay-photo {
            /*animation: hue-rotate 6s infinite;*/
            background-image: url(imgs/books.jpg);
            background-size: cover;
            -webkit-filter: grayscale(20%);
            z-index: -1;
        }
        .underlay-black {
            background: rgba(0,0,0,0.7);
            z-index: -1;
        }

        td{
            color: white;
            

        }

        @keyframes hue-rotate {
            from {
                -webkit-filter: grayscale(30%) hue-rotate(0deg);
            }
            to {
                -webkit-filter: grayscale(30%) hue-rotate(360deg);
            }
        }

    </style>
    <body>
        &nbsp &nbsp<a href="index.php" ><i class="fa fa-arrow-left" style="font-size:45px;color:white"></i></a>
        <form class="login-form" action="signup.php" method="post">


            <table>
                <tr>
                    <td>User Name:</td>
                    <td><input id="username" name="username" type="text" class="login-username" placeholder="ENTER USERNAME"></td>
                </tr>
                <tr>
                    <td>Full Name:</td>
                    <td><input id="fullname" name="fullname" type="text" class="login-username"  placeholder="ENTER FULLNAME"></td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><input id="email" name="email" type="email" class="login-username"  placeholder="ENTER EMAIL"></td>
                </tr>
                <td>Birthdate:</td>
                <td> <input id="birthdate" name="birthdate" type="date" class="login-username"  > </td>
                <tr>
                    <td>Role:</td>
                    <td><select id="role" name="role" class="login-username">
                            <option value="member">Member</option>


                        </select></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input id="password" name="password" type="password" class="login-username" placeholder="ENTER PASSWORD"></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td><input id="password_confirm" name="password_confirm" type="password" class="login-username" placeholder="CONFIRM PASSWORD"></td>
                </tr>
                <form class="login-form">
                    
                </form>
            </table>
            <input type="submit" name="validate" value="Signup" class="login-submit" />

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

        

        <div class="underlay-photo"></div>
        <div class="underlay-black"></div> 
    </body>


</html>

