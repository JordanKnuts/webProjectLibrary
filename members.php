<?php
require_once "functions.php";
$pdoc = connect();
check_login();
$members = get_all_users();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Members</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>
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
        <?php include('menu_admin.php'); ?>
        
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
                    $fullname = $member['fullname'];
                    $email = $member['email'];
                    $birthdate = $member['birthdate'];
                    $role = $member['role'];
                   
                    
                    $profil = get_user($user);
                    echo "
                   <tr>
                    
                    <td><a href=profile.php?username=$name>$name</a>  </td>
                    <td>$fullname</td>                          
                    <td>$email</td>
                    <td>$birthdate</td>
                    <td>$role</td>
                    
                    
                    
                    
                ";
                  echo"<td>";
                  if(isset($profil['role']) AND $profil['role'] == 'admin') {
                         echo "<a href=delete.php class='btn btn-danger'>Delete</a>
                         <a href=edit.php class='btn btn-primary'>Edit</a></td>";
                        }
                         else{
                         echo"<a href=edit.php class='btn btn-primary'>Edit</a></td>";
                            }
                        
                  echo"</td>";
                      echo '</tr>';
                }
                ?>


            </table>
        <div>
            <a href=edit.php class='btn btn-success'>Add</a>
        </div>
      </body>
      
</html>


