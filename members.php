<?php
require_once "functions.php";
$pdoc = connect();
check_login();
$members = get_all_users();
?>

<html>
    <head>
        <title>Members</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>
        <div class="title"> Members</div>
        <?php include('menu.php'); ?>
        <div class ="main">
            <table>
                <tr>
                    <th>User Name</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Birth Date</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>   

                <?php
                foreach ($members as $member) {
                    $name = $member['username'];
                    $fullname=$member['fullname'];
                    $email=$member['email'];
                    $birthdate=$member['birthdate'];
                    $role=$member['role'];
                    echo "<tr>
                    <td><a href=profile.php?username=$name>$name</a></td>
                    <td>$fullname</td>                          
                    <td>$email</td>
                    <td>$birthdate</td>
                    <td>$role</td>
                        </tr>";
                }
                ?>


            </table>

        </div>
    </body>

</html>