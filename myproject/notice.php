<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
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
 
$uname=$_SESSION["user_name"];
$room="SELECT DISTINCT room1 FROM chatbox where (room1 like '%$uname%') ORDER BY time DESC";
$result=$dbcon->query($room);
$check="";
while ($extract=$result->fetchArray(SQLITE3_ASSOC)){
	$sender=str_replace($uname,"",$extract['room1']);	
	if (strcmp($check,$sender)!=0){
	echo "<li><a href='http://localhost/myproject/chat/index.php?uploader_name=$sender'><b>$sender</b> send some messages to you!</a></li>";
	}
	$check=$sender;
}
?>