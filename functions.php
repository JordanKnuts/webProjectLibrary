                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     <?php

session_start();


function connect(){
    $dbhost = "localhost";
    $dbname = "prwb_1819_c16";
    $dbuser = "root";
    $dbpassword = "root";

    try
    {
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8", "$dbuser", "$dbpassword");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch (Exception $exc)
    {
        abort("Erreur lors de l'accès à la base de données.");
    }
}

function sanitize($var)
{
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlspecialchars($var);
    return $var;
    
}

function my_hash($password)
{
    $prefix_salt = "vJedc34";
    $suffix_salt = "QUa46df";
    return sha1($prefix_salt.$password.$suffix_salt);   
    
}

function add_user($username, $password, $fullname, $email, $birthdate,$role){
    $pdo = connect();
    try{
        $query = $pdo->prepare("INSERT INTO user(username,password,fullname,email,birthdate,role)
                                        VALUES(:username,:password,:fullname,:email,:birthdate,:role)");
        $query->execute(array("username"=>$username, "password"=>$password,"fullname"=>$fullname,"email"=>$email,"birthdate"=>$birthdate,"role"=>$role));
        return true;
    } catch (Exception $exc) {
        echo $exc;
        return false;
        
    }
}
function get_user($username){
    $pdo = connect();
    try
    {
        $query = $pdo->prepare("SELECT * FROM user where username = :username");
        $query->execute(array("username" => $username));
        $profil = $query->fetch();
    }
    catch (Exception $exc)
    {
        abort("erreur get_user");
    }
     if($query->rowCount()==0){
        return false;
    }
    else{
        return $profil;
    }
}

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}




function check_login()
{
    global $user;
    
    if (!isset($_SESSION['user'])) {
        redirect('index.php');
    } else {
        $user = $_SESSION['user'];
       
        
    }
    
}

function check_password($password, $hash)
{
    return $hash === my_hash($password);  
}

function abort($err)
{
    global $error;
    $error = $err;
    include 'error.php';
    die;
}

function log_user($username){
    $_SESSION["user"] = $username;
    redirect("profil.php");
}


?>