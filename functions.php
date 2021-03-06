                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

session_start();

function connect() {
    $dbhost = "localhost";
    $dbname = "prwb_1819_c16";
    $dbuser = "root";
    $dbpassword = "root";

    try {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", "$dbuser", "$dbpassword");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (Exception $exc) {
        abort("Erreur lors de l'accès à la base de données.");
    }
}

function sanitize($var) {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlspecialchars($var);
    return $var;
}

function my_hash($password) {
    $prefix_salt = "vJedc34";
    $suffix_salt = "QUa46df";
    return sha1($prefix_salt . $password . $suffix_salt);
}

function delete_user($id) {
    $pdo = connect();

    try {
        $query = $pdo->prepare("DELETE FROM user WHERE id=:id");

        $query->execute(array("id" => $id));
    } catch (Exception $exc) {
        echo $exc;
    }
    redirect('members.php');
}

function add_user($username, $password, $fullname, $email, $birthdate, $role) {
    $pdo = connect();
    try {
        $query = $pdo->prepare("INSERT INTO user(username,password,fullname,email,birthdate,role)
                                        VALUES(:username,:password,:fullname,:email,:birthdate,:role)");
        $query->execute(array("username" => $username, "password" => $password, "fullname" => $fullname, "email" => $email, "birthdate" => $birthdate, "role" => $role));
    } catch (Exception $exc) {
        echo $exc;
    }
}

function uptdate_user($id, $username, $fullname, $email, $birthdate, $role) {
    $pdo = connect();

    try {
        $query = $pdo->prepare("UPDATE user
        SET username=:username,fullname=:fullname,email=:email,birthdate=:birthdate,role=:role WHERE id=:id");
        $query->execute(array(
            "id"=> $id,
            "username" => $username,
            "fullname" => $fullname,
            "email" => $email,
            "birthdate" => $birthdate,
            "role" => $role));
        return true;
    } catch (Exception $exc) {
        /*abort("Error while accessing database. Please contact your administrator.");*/
        return false;
    }
}

function get_user($username) {
    $pdo = connect($username);

    try {
        $query = $pdo->prepare("SELECT * FROM user where username = :username");
        $query->execute(array("username" => $username));

        $profil = $query->fetch();
    } catch (Exception $exc) {
        //abort("erreur get_user");
        echo $exc;
    }
    if ($query->rowCount() == 0) {
        return false;
    } else {
        return $profil;
    }
}

function get_id($username) {
    $pdo = connect($username);
    $id = '';
    try {
        $query = $pdo->prepare("SELECT * FROM user where id = :id");
        $query->execute(array("id" => $id));
    } catch (Exception $exc) {
        //abort("erreur get_user");
        echo $exc;
    }
    if ($query->rowCount() == 0) {
        return false;
    } else {
        return $id;
    }
}

function count_admin() {
    $pdo = connect();
    try {
        $query = $pdo->prepare("SELECT * FROM user where role = 'admin' ");
        $query->execute();
        return $query->rowCount();
    } catch (Exception $exc) {
        abort($exc );
    }
    
}

function check_unique_username($username){
    $pdo = connect();
    try{
        $query = $pdo->prepare("SELECT * FROM user where username = :username");
        $query->execute(array("username"=>$username));
        $result = $query->fetchAll();
        return count($result) === 0;
    } catch (Exception $exec){
        abort("Error while accessing database.Please contact your administrator.");
    
    }
}

function check_unique_mail($email){
    $pdo = connect();
    try{
        $query = $pdo->prepare("SELECT * FROM user where  email = :email");
        $query->execute(array("email"=>$email));
        $result = $query->fetchAll();
        return count($result) === 0;
    } catch (Exception $exec){
        abort("Error while accessing database. Please contact your administrator.");
    
    }
}

function get_all_users() {
    $pdo = connect();
    try {
        $query = $pdo->prepare("SELECT * FROM user");
        $query->execute();
        $members = $query->fetchAll();
        return $members;
    } catch (Exception $exc) {
        abort("Erreur lors de l'accès à la base de données.");
    }
}

function redirect($url, $statusCode = 303) {
    header('Location: ' . $url, true, $statusCode);
    die();
}

function check_login() {
    global $user;

    if (!isset($_SESSION['user'])) {
        redirect('index.php');
    } else {
        $user = $_SESSION['user'];
    }
}

function check_password($password, $hash) {
    return $hash === my_hash($password);
}

function abort($err) {
    global $error;
    $error = $err;
    include 'error.php';
    die;
}

function log_user($username) {
    $_SESSION["user"] = $username;
    redirect("profil.php");
}

?>
