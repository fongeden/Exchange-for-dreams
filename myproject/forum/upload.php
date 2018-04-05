<head>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<?php

 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

$itemName=$_POST['itemName'];
$itemType=$_POST['itemType'];
$itemDescription=$_POST['itemDescription'];
date_default_timezone_set("Asia/Hong_Kong");
$date=date('m/d/Y h:i:s a');

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

$total = count($_FILES['upload']['name']);

$dbcon->query('insert into items (user_id,item_name,item_type,item_description,upload_time) VALUES ("'.$_SESSION["user_id"].'","'.$itemName.'","'.$itemType.'","'.$itemDescription.'","'.$date.'")');
// Loop through each file
for($i=0; $i<$total; $i++) {
  //Get the temp file path
  $tmpFilePath = $_FILES['upload']['tmp_name'][$i];
  $url="http://localhost/myproject/upload_img/".$_FILES['upload']['name'][$i];
  //Make sure we have a filepath
  if ($tmpFilePath != ""){
    //Setup our new file path
    $newFilePath =$_SERVER['DOCUMENT_ROOT'] ."/myproject/upload_img/" . $_FILES['upload']['name'][$i];
	
    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {
		
		$get_item_id="select * from items WHERE item_name='$itemName'AND upload_time='$date'";
		$item_id=$dbcon->query($get_item_id)->fetchArray(SQLITE3_ASSOC)["item_id"];
		$dbcon->query('insert into item_pic (item_id,item_pic) VALUES ("'.$item_id.'","'.$url.'")');
    
    }
  }
}



header("Location: http://localhost/myproject/index.php");//use for the redirection to some page
   
?>