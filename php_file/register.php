<?php
session_start();
$task = ($_POST['task']) ? $_POST['task'] : null;
include ('database_class.php');

switch($task){

     case "register_member":
     register_member();
     break;
 
     case "cek_username":
     cek_username();
     break;

     default:
     echo "{failure:true}";
     break;
} 

function cek_username(){
  $db_cek = new database;  
  $username = stripslashes($_POST['username_txt']);
  $query = "SELECT user_name FROM tbl_user WHERE user_name = '$username'";
  $db_cek->query($query);
  if ($db_cek->numRows() != 0){
     echo 0;
  }else{
     echo 1; 
  } 
}

function register_member() {
   $db_register = new database; 
   $username = stripcslashes($_POST['username_txt']);
   $password = stripslashes($_POST['password_txt']);
   $md5pass = md5($password.$config['key_word']);
   $ip_addr = $_SERVER['REMOTE_ADDR'];
   $date = date("Y-m-d");

   $querySaveUser = "INSERT INTO tbl_user VALUES('','$username','$md5pass','$date','$ip_addr')";
   $querySaveCust = "INSERT INTO tbl_customer VALUES ('','$username','".$_POST['fname_txt']."','".$_POST['lname_txt']."')";

   $db_register->query($querySaveUser);

   $db_register->query($querySaveCust);

   echo '{success:true,successInfo:"Save successfull"}';
   
}

?>