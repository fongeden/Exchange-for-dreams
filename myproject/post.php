<?php include ("header.php"); ?>
<?php
	$iid1 = $_GET['iid1'];
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>

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
   //if(isset($_POST['itemid'])){}
  
  $sql = "select * from items where item_id = '$iid1'";
  $result = $dbcon->query($sql);
  $row = $result->fetchArray(SQLITE3_ASSOC);
  $uid = $row['user_id'];
  $iid = $row['item_id'];

  $sql = "select user_name from users where user_id = '$uid'";
  $result = $dbcon->query($sql);
  $row1 = $result->fetchArray(SQLITE3_ASSOC);
  $up_name = $row1['user_name'];
?>


<html>
<head>
<title>Post</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="post.css">
</head>
<body>


<h2 style="text-align:center"><?php echo $row['item_name']; ?></h2>

<style>
body {
  font-family: Arial;
  margin: 0;
}

* {
  box-sizing: border-box;
}

img {
  vertical-align: middle;
}

/* Position the image container (needed to position the left and right arrows) */
.container {
  position: relative;
  width: 400px;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}</style>

<div class="row">
<div class="col-sm-6">
<div class="item">
<div class="container">
  
  <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

  <div class="row"><div class="row1">
    <!-- <div class="column">
      <img class="demo cursor" src="testimg1.jpg" style="width:100%" onclick="currentSlide(1)" alt="TEST">
    </div> -->
  </div></div>
</div>

<?php 
    $sql = "select item_pic from item_pic where item_id='$iid1'";
  $result10 = $dbcon->query($sql);
  $slidenum = 1;
  while($row10 = $result10->fetchArray(SQLITE3_ASSOC)){
    $tempimg = $row10['item_pic'];
    echo "<script>$('.prev').before('<div class=\"mySlides\"><img src=\"$tempimg\" style=\"width:100%\"></div>');</script>";
    echo "<script>$('.row1').append('<div class=\"column\"><img class=\"demo cursor\" src=\"$tempimg\" style=\"width:100%\" onclick=\"currentSlide($slidenum)\" alt=\"img1\"></div>');</script>";
    $slidenum = $slidenum + 1;
  }
?>


<script>
var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
</div>
</div>


<div class="col-sm-6">
<div class="info" style="font-size:18px;">
  <br>
  <p style="display:inline" id="uploadername">Uploader: <form style="display:inline" action="http://localhost/myproject/login/profile.php" method="post"><button type="submit" value="<?php echo $row1['user_name']; ?>" class="btn-link" name="user"><?php echo $row1['user_name']; ?></button></form></p>
  
  <p id="uploadtime" style="font-size:14px;">Upload time: <?php echo $row['upload_time'];?><br></p>
  <p style="font-size:14px;">Description: <?php echo $row['item_description'];?><br></p>
</div>

<?php 
    $uploader_name = $row1['user_name'];
    echo "<script>$('#uploadtime').before('<span class=\"chatwithuploader\"><form method=\"post\" action=\"chat/index.php\"><input hidden name=\"uploader_name\" type=\"text\" value=\"$uploader_name\"><input class=\"btn btn-primary\" type=\"submit\" value=\"Chat with $uploader_name directly\"></form></span>');</script>";
?>


<div class="buttons" style="font-size:18px;">
  <br>
  Number of likes: <span id="numoflike"><?php echo $row['like'];?></span> <input type="image" id="like" src="Like button.jpeg" style="height: 40px" /><input hidden type="image" id="likeg" src="Like button gray.jpeg" style="height: 40px" /> 
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span id="addtofav">Add to favourite: <input type="image" id="fav" src="add to fav.png" style="height: 40px" /><input hidden type="image" id="favg" src="add to fav gray.png" style="height: 40px" /></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input hidden style="font-size:14px;" type="button" id="report" value="Report this post">
</div> 

<?php 

$currid = $_SESSION['user_id'];

  $sql = "select * from like where user_id='$currid' and item_id='$iid1'";
  $result = $dbcon->query($sql);
  while($row = $result->fetchArray(SQLITE3_ASSOC)){
    echo "<script>$('#like').hide();$('#likeg').show();</script>";
  }

  $sql = "select * from favourite where user_id='$currid' and item_id='$iid1'";
  $result = $dbcon->query($sql);
  while($row = $result->fetchArray(SQLITE3_ASSOC)){
    echo "<script>$('#fav').hide();$('#favg').show();</script>";
  }


$scp="<script>
  $('#like').click(function(){
      $('#like').hide();
      $('#likeg').show();


      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        document.getElementById('numoflike').innerHTML = this.responseText;
      }
      };
  
      xmlhttp.open(\"GET\",\"like.php?iid1=\"+'$iid1',true);
      xmlhttp.send();
     
  });

  $('#likeg').click(function(){
      $('#likeg').hide();
      $('#like').show();

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
        document.getElementById('numoflike').innerHTML = this.responseText;
      }
      };
  
      xmlhttp.open(\"GET\",\"undolike.php?iid1=\"+'$iid1',true);
      xmlhttp.send();
  });

  $('#fav').click(function(){
      $('#fav').hide();
      $('#favg').show();

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
      }
      };
  
      xmlhttp.open(\"GET\",\"favourite.php?iid1=\"+'$iid1',true);
      xmlhttp.send();
  });

  $('#favg').click(function(){
      $('#favg').hide();
      $('#fav').show();

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      if(this.readyState == 4 && this.status == 200) {
      }
      };
  
      xmlhttp.open(\"GET\",\"undofavourite.php?iid1=\"+'$iid1',true);
      xmlhttp.send();
  });
  </script>";
echo $scp;
?>

<style>
body {font-family: Arial, Helvetica, sans-serif;}

input[type=text], select, textarea {
    width: 300px;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
    resize: vertical;
}

input[type=submit] {
    background-color: #405E93;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #4378D5;
}

.container {
    border-radius: 5px;
    padding: 20px;
}
</style>

<div class="comment">
  
</div>
</div>
</div>
<?php
  echo "
    <script>
    $('.comment').append('<br>Comment:<form method=\"post\" action=\"http://localhost/myproject/post.php?iid1=$iid1\"><textarea id=\"mycomment\" name=\"comm\" placeholder=\"Write your comment here..\" style=\"width:300px; height:50px;\"></textarea><br><input type=\"submit\" name=\"submit\" value=\"Submit comment\"></form>');</script>
  ";
?>


<br><br>
<centre>
<div class="currcomment" style="font-size:20px;">
  
    <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<text style="font-size:30px;">Comment Section</text><br>
  
</div></centre>

<style>
.currcomment{
  background-color: #eee;
  border: 1px solid #ccc;
  border-radius: 50px;
}
</style>

<?php
if(isset($_POST['submit'])){
  $curruid = $_SESSION['user_id'];
  $input = $_POST['comm'];
  if($input == ''){
        echo "<script>alert('Comment cannot be empty!')</script>";
    exit();
    }
    date_default_timezone_set("Asia/Hong_Kong");
    $date = date('m/d/Y h:i:s a');

    $sql = "insert into comment(user_id, item_id, content, com_time) values ('$curruid', '$iid1', '$input', '$date')";
  $dbcon->query($sql);
}


$sql = "select * from comment where item_id='$iid'";
  $result = $dbcon->query($sql);

  while($row2 = $result->fetchArray(SQLITE3_ASSOC)){
    $tempuid = $row2['user_id'];
    $sql = "select user_name from users where user_id='$tempuid'";
    $resulttemp = $dbcon->query($sql);
    $row3 = $resulttemp->fetchArray(SQLITE3_ASSOC);
    $uname = $row3['user_name'];

    $time = $row2['com_time'];
    $comm = $row2['content'];
    
    echo "
            <script>
            $('.currcomment').append('<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$time &nbsp;&nbsp;&nbsp;&nbsp;<form style=\"display:inline\" action=\"http://localhost/myproject/login/profile.php\" method=\"post\"><button type=\"submit\" value=\"$uname\" class=\"btn-link\" name = \"user\">$uname</button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$comm<br></div>');
            </script>
        ";
        
  }
?>

<?php
	if (isset($_SESSION['user_name'])){
		$curruname = $_SESSION['user_name'];
 	}else{
		$curruname="";
	}

  if($curruname == $up_name){
      echo "<script>$('#report').hide();$('#like').hide();$('#likeg').hide();$('#addtofav').hide();$('.chatwithuploader').hide();</script>";
  }

	//$curruname = $_SESSION['user_name'];
 	if($curruname == "") 
    { 
         echo "
            <script>
            $('.comment').hide();
            $('#addtofav').hide();
            $('#report').hide();
            $('#like').hide();
            $('.chatwithuploader').hide();
            </script>
        ";
    } 
?>

</body>
</html>