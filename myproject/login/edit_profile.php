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
	<link rel="stylesheet" type="text/css" href="edit_profile.css">
</head>
<body>
<?php include ("../header.php");
  include("database/db_conection.php");
  $uname=$_SESSION['user_name'];

  $sql = "SELECT * from users WHERE user_name = '$uname'";
  $result = $dbcon->query($sql);
  $row = $result->fetchArray(SQLITE3_ASSOC);
  ?>

<h1>User Profile</h1>

<div class="container">
    <form role="form" method="post" action="edit_profile.php" enctype="multipart/form-data">
    <input id="profile-image-upload" class="hidden" type="file" name="img">
    <div class="user_pro_pic" runat="server">
      <img id="blah" src="<?php echo $row['pro_pic']; ?>" alt="your image">
      <script src="edit_profile.js"></script>
    </div> 
    <div class="row">
      <div class="col-25">
        <label for="fname">Name</label>
      </div>
      <div class="col-75">
        <input type="text" id="name" name="name" placeholder="Your name.." value="<?php echo $row['user_name']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="lname">Rank</label>
      </div>
      <div class="col-75">
        <p>10</p>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="country">Email</label>
      </div>
      <div class="col-75">
        <input type="email" id="email" name="email" placeholder="Your name.." value="<?php echo $row['user_email']; ?>">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Description</label>
      </div>
      <div class="col-75">
        <input type="text" id="description" name="description" placeholder="Description.." value="<?php echo $row['description']; ?>">
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Edit" id="submit" name="edit">    
    </div>
  </form>

</div>
</body>
</html>
<?php 

if(isset($_POST['edit']))
{
  $uname=$_SESSION['user_name'];
  $uemail=$_SESSION['email'];

  $user_email=$_POST['email'];
  $user_name=$_POST['name'];
  $description=$_POST['description'];
  $update = true;
  
  #Edit User Name
  $check_uname="select COUNT(*) from users where user_name != '$uname' and user_name = '$user_name'";
  $num = $dbcon->querySingle($check_uname);
  if($num >0){
    $uname_exist = '<script>alert("User Name already existed!");</script>';
    echo $uname_exist;
    $update = false;
  }

  #Edit Email
  $check_email="select COUNT(*) from users where user_name != '$uname' and user_email = '$user_email'";
  $num = $dbcon->querySingle($check_email);
  if(($num >0) && ($update == true)){
    $email_exist = '<script>alert("Email already existed!");</script>';
    echo $email_exist;
    $update = false;

  }
  
  #Edit ALL
  if($update == true){
    $update_uname="update users SET user_name = '$user_name' WHERE user_name='$uname'";
    $dbcon->query($update_uname);
    $_SESSION['user_name'] = $user_name;

    $update_email="update users SET user_email = '$user_email' WHERE user_name='$uname'";
    $dbcon->query($update_email);
    $_SESSION['email'] = $user_email;

    $update_description="update users SET description = '$description' WHERE user_name='$uname'";
    $dbcon->query($update_description);

    
    $target_dir = "profile_pic/";
    $target_file = $target_dir . basename($_FILES["img"]["name"]);
    $url = "http://localhost/myproject/login/profile_pic/".$_FILES["img"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["edit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
      }
     if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
        // echo "The file ". basename( $_FILES["img"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    } 
    if(strcmp($url,"http://localhost/myproject/login/profile_pic/") != 0){
      $update_image="update users SET pro_pic = '$url' WHERE user_name='$uname'";
    }
    $dbcon->query($update_image);

    }

  echo "<script>
    window.open('http://localhost/myproject/login/profile.php','_self');    
  </script>";   
 
}

?>