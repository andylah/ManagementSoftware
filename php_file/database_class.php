<?php

class database {

var $host = "localhost";
var $user = "andylah";
var $pass = "";
var $db = "db1";
var $port = "3306";

var $link_ID = 0;
var $query_ID = 0;
var $record = array();
var $row;
var $loginError = "";

var $errNo = 0;
var $error = "";

   function connect(){
      if (0 == $this->link_ID){
         $this->link_ID = mysql_connect($this->host, $this->user, $this->pass);
      }
      if (!$this->link_ID){
         $this->halt("Link-ID == false, Connection Failed");
      }
      if (!mysql_query(sprintf("use %s", $this->db), $this->link_ID)){
         $this->halt("Cannot use database".$this->db);
      }
   }
   function query($query_string){
         $this->connect();
         $this->query_ID = mysql_query($query_string, $this->link_ID);
         $this->row = 0;
         $this->errNo = mysql_errno();
         $this->error = mysql_error();
         if (!$this->query_ID){
             $this->halt("Invalid SQL : ".$query_string);
         }
         return $this->query_ID;
   }
   function halt($msg){
         
         echo '{result:false, errorInfo:"$msg,"'.$this->errNo.', '.$this->error.'}';
         die (); 
   }
   function nextRecord(){
         @$this->record = mysql_fetch_array($this->query_ID);
         $this->row += 1;
         $this->errNo = mysql_errno();
         $this->error = mysql_error();
         $stat = is_array($this->record);
         if(!$stat){
             @mysql_free_result($this->query_ID);
             $this->query_ID = 0;
         }
         return $stat;
   }
   function singleRecord(){
         $this->record = mysql_fetch_array($this->query_ID);
         $stat = is_array($this->record);
         return $stat;
   } 
   function numRows(){
         return mysql_num_rows($this->query_ID);
   }
}
