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

$sql = "select * from favourite where user_id='$currid' and item_id='$iid'";
$result = $dbcon->query($sql);
if($row = $result->fetchArray(SQLITE3_ASSOC)){
	$sql = "delete from favourite where user_id='$currid' and item_id='$iid'";
	$dbcon->query($sql);
}
?>