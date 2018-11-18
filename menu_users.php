<!DOCTYPE html>
<html>
    <head>
        <title> Menu</title>
    <link href="styles.css" rel="stylesheet" type="text/css"/>
        <style>
            body {margin:0;}

            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
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
    
    <li><a href="profile.php">Home </a></li>
    <li><a href="index.php">Log Out</a></li>

</ul>

    </body>
</html>



