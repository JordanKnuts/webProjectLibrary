<?php
require_once "functions.php";
$pdoc = connect();
check_login();
$members = get_all_users();


if (isset($_POST['delete'])) {
    $id = ($_POST['id']);
    delete_user($id);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>MEMBERS</title>
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
            border-collapse: collapse;
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
        h2{
            text-align: center;
            background-color: #ffffff;

            opacity: 0.5;
        }


    </style>
    <body class="table">
        <?php include('menu_admin.php'); ?>
        
            
        
        <div >
            
            <form action="members.php" method="POST" class="">
                <h2>Members</h2>
                <table class="">
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
                        $id = $member['id'];
                        $name = $member['username'];
                        $fullname = $member['fullname'];
                        $email = $member['email'];
                        $birthdate = $member['birthdate'];
                        $role = $member['role'];


                        $profil = get_user($user);
                        echo "
                   <tr>
                    
                    <td><a href=profil.php?username=$name>$name</a>  </td>
                    <td>$fullname</td>                          
                    <td>$email</td>
                    <td>$birthdate</td>
                    <td>$role</td>
    
                ";
                        echo"<td>";
                        if (isset($profil['role']) AND $profil['role'] == 'admin' AND $member['role'] != 'admin') {
                            echo "<a href=edit.php?username=$name class='btn btn-primary'>Edit</a>
                         <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#ConfirmModal'>
                Delete
            </button>";
                        } else {
                            echo"<a href=edit.php?username=$name class='btn btn-primary'>Edit</a></td>";
                        }
                    }
                    ?>



                    <?php
                    echo"</td>";
                    echo "</tr>";
                    ?>

                </table>



            </form>
            <a href=add.php class='btn btn-success'>Add</a>
        </div>

        <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ConfirmModalLabel">CONFIRMATION</h5>
                        <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ARE YOU SURE YOU WANT TO DELETE ?
                    </div>
                    <div class="modal-footer">

                        <input type="hidden" name="id" value="<?= $id ?>">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel"> CANCEL</button>

                        <button type="input" class="btn btn-danger "  name="delete" id="delete" value="">DELETE</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="underlay-photo"></div>
        <div class="underlay-black"></div> 
    </body>


</html>
