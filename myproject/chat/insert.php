<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
	
class MyDB extends SQLite3 {
      function __construct() {
         $this->open('../login/database/test.db');
      }
   }
   $dbcon = new MyDB();
   if(!$dbcon) {
      echo $dbcon->lastErrorMsg();
   } else {
      ;
   }
$uname=$_REQUEST["uname"];
$msg=$_REQUEST["msg"];
$room1=$_SESSION['user_name'].$uname;
$room2=$uname.$_SESSION['user_name'];
$name=$_SESSION['user_name'];
date_default_timezone_set("Asia/Hong_Kong");
$date=date('m/d/Y h:i:s a');
$insert_msg="insert into chatbox (name,message,room1,room2,time) values ('$name','$msg','$room1','$room2','$date')";
$dbcon->query($insert_msg);
$logs="SELECT * FROM chatbox where room1='$room1' or room2='$room2' ORDER BY chatbox_id DESC";
$result=$dbcon->query($logs);

while ($extract=$result->fetchArray(SQLITE3_ASSOC)){
	echo "<div class='panel panel-info'><span style='float: left;'>".$extract['time']."</span><span style='float: left;'>&emsp;</span><span style='float: left;width: 55px;'><b>" . $extract['name'] . "</b></span>&emsp;:<span>" . $extract['message'] . "</span><br /></div>";
}

?>