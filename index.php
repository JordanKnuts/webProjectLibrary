
<?php
require_once 'functions.php';
$password = '';
$username = '';


if (isset($_POST["username"]) && isset($_POST["password"])) {

    $username = sanitize($_POST['username']);
    $password = sanitize($_POST['password']);


    $member = get_user($username);
    if ($member) {
        if (check_password($password, $member['password'])) {
            log_user($username);
        } else {
            $error = "Wrong password. Try Again!";
        }
    } else {
        $error = "Username do not exists.";
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
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" >
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
            display: flex;
            flex-direction: column;
            
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
        .login-signup{
            border: 1px solid white;
            background: transparent;
            color: white;
            text-decoration:none ;
            padding: .25rem;
            margin: 1rem auto;
            
            
            
        }




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

    </style>
    <body>
        
        
        <form class="login-form" action="index.php" method="post">
                 
            <p class="login-text"> <i class='fas fa-book-open' style='font-size:65px;color:white'></i></p>
            <p class="login-text"> WELCOME </p>
            
            <br>
            <br>
            <br>
          

            <input id="username"  name="username" type="text" class="login-username" autofocus="true" required="true" placeholder="Username" />
            <input id="password" name="password" type="password" class="login-password" required="true" placeholder="Password" />




            <form class="login-form">
                <input type="submit" name="Login" value="Login" class="login-submit" />
                <a href="signup.php" name="Signup" value="Sign Up" class="login-signup" >Sign Up</a>
                <?php
                if (isset($error)) {
                    echo "<div class='errors'><br><br>$error</div>";
                }
                ?>
            </form>  

        </form>




        <div class="underlay-photo"></div>
        <div class="underlay-black"></div> 
    </body>


</html>

