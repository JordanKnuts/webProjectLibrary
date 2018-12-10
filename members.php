<?php
require_once "functions.php";

$pdo = connect();
check_login();
$members = get_all_users();


if (isset($_POST['delete'])) {
//   var_dump($_POST);
   
//  var_dump(count_admin());
   $idDel = ($_POST['delete']);
//   var_dump ($id);
    

    if (count_admin() == '1' && $member['role']=='admin') {
        abort('Il doit rester un administrateur au minimum');
    } else if (($_POST['delete']) == $id) {
        abort('On ne peut delete son propre compte');
    } else {
        delete_user($idDel);
        redirect('members.php');
    }
}

if (isset($_GET["username"])) {
    $username = sanitize($_GET["username"]);
} else {
    $username = $user;
}
$profil = get_user($username);
if($profil['role'] === 'member'){
    redirect('profil.php');
}
$idUser=$profil["id"];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>MEMBERS</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" >
        <!--        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        <!--        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" ></script>




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
            /*        table {
                        font-family: arial, sans-serif;
                        font-weight: 50 px;
                        border-collapse: collapse;
                        width: 100%;
                        height: 100%;
                        -webkit-filter: grayscale(30%);
                        z-index: -1;
                        background-color: #ffffff;
                        
                        opacity: 0.8;
            }
            */

            tr,th,td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
                background-color: white;
                opacity: 0.7;
                

               

            }
            th{
                margin: 30px;
                background-color: #ffffff;
                border: 1px solid #dddddd;



                .colname{
                    border: 10px solid #dddddd;
                    text-align: left;
                    padding: 8px;
                }
                form * {
                    font-family: inherit;
                    font-size: inherit;
                    background-color: transparent;
                }
                


            </style>
        </head>
        

        <body class="table">
            
            <div>
                <?php include('menu_admin.php'); ?>
            </div>
        <?php if($profil['role'] === 'member'); ?>
            <form action="members.php" method="POST" class="">
                <div style="">
                    <table style= "width: 1300px ; padding-left: 11em" class=" table-responsive " >
                            
                          <caption  class="caption" style="caption-side : top;text-align: center;font-size: 40px;font-weight: bold; ">Members </caption>
                        <tr class="colname">

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
                            echo"<td> ";
                            if (isset($profil['role']) AND $profil['role'] == 'admin' ) {
                                echo "<a href=edit.php?username=$name class='btn btn-primary'>Edit</a>
                                    
                                    
                         <input type='checkbox' name='delete' class='btn btn-danger' value=$id data-toggle='modal' data-target='#ConfirmModal'>
                             <input type='hidden' name='idUser' value= $idUser>
                Delete
            ";
                            } else {
                                echo"<a href=edit.php?username=$name class='btn btn-primary'>Edit</a></td>";
                            }
                        }
                        ?>
                        <?php
                        echo"</td>";
                        echo "</tr>";
                        ?>
                       
                        </tbody>
                         
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
                                <div method="POST" class="modal-footer">

                                    <input type="hidden" name="id" value="<?= $member['id'] ?>">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel"> CANCEL</button>

                                    <button type="submit" class="btn btn-danger" name="delete"  id="delete" valeur="<?php $idDel ?>" >DELETE</button>

            
                                </div>
                            </div>
                        </div>
                    </div>
                    </table>
                    <a  href=add.php class='btn btn-success' style=" position:relative; margin-top: 15px; margin-left: 1030px">Add</a>
                    </div>
                </form>
                    
                    <div class="underlay-photo"></div>
                    <div class="underlay-black"></div> 
        </body>


        </html>
a