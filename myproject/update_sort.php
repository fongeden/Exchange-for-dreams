<?php
 class MyDB extends SQLite3 {
     function __construct() {
        $this->open('login/database/test.db');
     }
  }
  $dbcon = new MyDB();
  if(!$dbcon) {
     echo $dbcon->lastErrorMsg();
  } else {
     ;
  } 
include ("displayimage.php");

$check_type=$_GET['check_type'];
$sort_by=$_GET['sort_by'];

displayimage($dbcon,$check_type,$sort_by)
?>