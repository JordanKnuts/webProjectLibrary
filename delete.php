<?php
require_once "functions.php";
$pdoc = connect();
check_login();
$members = get_all_users();
delete_user($id);
redirect('members.php');
?>
