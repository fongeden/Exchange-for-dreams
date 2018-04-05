<?php
if(!isset($_SESSION)) { 
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
}else{
	;
}

$iid = $_REQUEST["iid1"];
$currid = $_SESSION['user_id'];

$sql = "select like from items where item_id='$iid'";
$result = $dbcon->query($sql);
$row = $result->fetchArray(SQLITE3_ASSOC);
$templike = $row['like'];
$templike = $templike - 1;
$sql = "update items set like='$templike' where item_id='$iid'";
$dbcon->query($sql);

$sql = "select * from like where user_id='$currid' and item_id='$iid'";
$result = $dbcon->query($sql);
while($row = $result->fetchArray(SQLITE3_ASSOC)){
	$sql = "delete from like where user_id='$currid' and item_id='$iid'";
	$dbcon->query($sql);
}

echo $templike;
?>