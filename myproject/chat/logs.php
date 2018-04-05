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
 
$uname=$_REQUEST['uname'];
$room=$_SESSION['user_name'].$uname;

$logs="SELECT * FROM chatbox where room1='$room' or room2='$room' ORDER BY chatbox_id DESC";
$result=$dbcon->query($logs);
if ($result){
while ($extract=$result->fetchArray(SQLITE3_ASSOC)){
	echo "<div class='panel panel-info'><span style='float: left;'>".$extract['time']."</span><span style='float: left;'>&emsp;</span><span style='float: left;width: 55px;'><b>" . $extract['name'] . "</b></span>&emsp;:<span>" . $extract['message'] . "</span><br /></div>";
}
}
?>