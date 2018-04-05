<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="profile.css">
</head>
<body>
<?php
	include ("../header.php");
	include("database/db_conection.php");
	if (isset($_SESSION['user_name']) && !empty($_SESSION['user_name'])){
		$sname=$_SESSION['user_name'];
	}else{
		$sname="";
	}
  if(isset($_POST["user"])){
    $uname = $_POST["user"];
  }else{
	$uname=$_SESSION['user_name'];
  }

	$sql = "SELECT * from users WHERE user_name = '$uname'";
	$result = $dbcon->query($sql);
	$row = $result->fetchArray(SQLITE3_ASSOC);

?>

<h1>User Profile <?php if($uname == $sname){echo '<a href="edit_profile.php"><span class="glyphicon glyphicon-pencil"></span></a>';}?></h1>

<div class="user_pro_pic">
	<img src="<?php echo $row['pro_pic']; ?>">
</div>

<div class="container">
  <form action="action_page.php">
    <div class="row">
      <div class="col-25">
        <label for="fname">Name</label>
      </div>
      <div class="col-75" id = "uname">
        <p><?php echo $row['user_name']; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Rank</label>
      </div>
      <div class="col-75">
        <p><?php echo $row['rank']; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Email</label>
      </div>
      <div class="col-75">
        <p><?php echo $row['user_email']; ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Description</label>
      </div>
      <div class="col-75">
        <p><?php echo $row['description']; ?></p>
      </div>
    </div>
    <div class="row">
    </div>
  </form>

  
</div>
<div class="posted_items">
  	<h1>Posted Items:</h1>
	<div id="posted" class="row">
    </div>
  </div>
</body>
</html>

<?php
$sql = "SELECT * from users WHERE user_name = '$uname'";
$user_id = $dbcon->query($sql)->fetchArray(SQLITE3_ASSOC)['user_id'];
$sql = "SELECT * from items WHERE user_id = '$user_id'";
$result = $dbcon->query($sql);
if (isset($_POST['delete'])){	
	$delete_id=$_POST['delete'];
	
	echo "<script>$('div','input[value=\"$delete_id\"]').remove();</script>";
	$sql = "select * from item_pic WHERE item_id = '$delete_id'";
	$delete_link = $dbcon->query($sql)->fetchArray(SQLITE3_ASSOC)['item_pic'];
	
	$sql = "delete from items WHERE item_id = '$delete_id'";
	$dbcon->query($sql);
	$sql = "delete from item_pic WHERE item_id = '$delete_id'";
	$dbcon->query($sql);
	
}
while ($item=$result->fetchArray(SQLITE3_ASSOC)){
	$sql = "SELECT * from item_pic WHERE item_id = '".$item["item_id"]."'";
	$img_src=$dbcon->query($sql)->fetchArray(SQLITE3_ASSOC)['item_pic'];
	
	echo "<script>$('#posted').append('<div style=\"width:20%;float:left\" class=\"column\" >\
    <a href=\"http://localhost/myproject/post.php?iid1=".$item["item_id"]."\"><center><img src=\"$img_src\" alt=\"".$item['item_name']."\" style=\"height:250px;\"></center>\
      <center><p>".$item["item_name"]."</p></a><form id=\"deleteForm\" method=\"post\" action=\"profile.php\"><input name=\"delete\" value=\"".$item["item_id"]."\"hidden/><input type=\"submit\" class=\"btn btn-primary \" value=\"Delete\"/ style=\"background:red;margin-right:35%\"></form></center><br>\
  </div>')</script>";
}
if($uname != $sname){
	echo "<script>$('#deleteForm').hide()</script>";
}

?>
