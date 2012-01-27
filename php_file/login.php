<?php
session_start();

$task = ($_POST['task']) ? $_POST['task'] : null;

include ('database_class.php');

switch($task){

     case "login_member":
     login_member();
     break;
 
     case "logout_member":
     logout_member();
     break;

     default:
     echo "{failure:true}";
     break;
} 

function login_member(){
    $db_login = new database;
    $pass = stripslashes($_POST['passtxt']);
    $passwd = md5($pass.$config['key_word']);
    $user = stripslashes($_POST['usertxt']);
    $query_login = "SELECT user_name, user_password FROM tbl_user WHERE user_name = '$user' AND user_password = '$passwd'";
    $db_login->query($query_login);
    if ($db_login->numRows() >= 1)
    {
        $_SESSION['session_id'] = $user;
        $date = date("Y-m-d");
        $ip = $_SERVER['REMOTE_ADDR'];
        $query_session = "INSERT INTO tbl_login VALUES('','".$_SESSION['session_id']."','$user','$date','$ip')";
        $db_login->query($query_session);
        
        echo '{success:true, successInfo:"Login Berhasil"}';
    }else{
        echo '{success:false,errorInfo:"Username or Password might be wrong"}';
    }
    
}

function logout_member(){
    $db_logout = new database;
    $query_logout = "DELETE FROM tbl_login WHERE login_session ='".$_SESSION['session_id']."'";
    $db_logout->query($query_logout);
    
    unset($_SESSION['session_id']);
}
?>
