<!DOCTYPE html>
<html>
    <head>
        <title> Menu</title>
    <link href="styles.css" rel="stylesheet" type="text/css"/>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css'>
        <style>
            body {margin:0;}

            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
                background: transparent;
                position: center;
                top: 0;
                width: 100%;
            }

            li {
                float: left;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover:not(.active) {
                background-color: #111;
            }

            .active {
                background-color: #4CAF50;
            }
            </style>
    </head>
    <body>
        <ul class="menuhtml">
    
    <li><a href="profil.php"><i class='fas fa-home' style='font-size:20px;color:white'></i> &nbsp Home </a></li>
    <li><a href="logout.php"><i class="fa fa-sign-out" style="font-size:20px;color:white"></i> &nbsp Log Out</a></li>

</ul>

    </body>
</html>



