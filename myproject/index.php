
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="index.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
    <title>Index</title>
</head>

<body>
<?php include ("header.php"); ?>
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
?>

<div >
<video autoplay muted loop id="myVideo" style=" z-index: 0;width:100%;position: top;left: 0;">
  <source src="background.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
  
</video>

<div class="j">
  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
     <h2 id="project_name"><b><marquee height ="20%" scrollamount="10">Exchange for Dreams <span id="slogan"><b>@We make dreams real</b></marquee></b></span></h2>
<form class="form-inline content" action="#searchitem" method="post">
      <input class="form-control mr-sm-2" id="search" type="text" placeholder="Search through the items to exchange for dreams" aria-label="Search" name="key">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search" id = "sbt"><i class="fas fa-search"></i></button>
      
    </form>       
</div>
</div>


</div>
 <div class="slideshow-container">
<div id="slides">

</div>
</div>
<br>
<div style="text-align:center" id="dot">
</div>

<?php
  $sql = "SELECT * from items ORDER BY upload_time DESC";
  $result = $dbcon->query($sql);
  $count = $dbcon->querySingle("SELECT COUNT(*) from items");
  // echo '<script>alert();document.getElementByClassName("slideshow-container").style.display = \'block\';$("#slides").remove();</script>';
  if($count == 0){
    echo '<script>$(".slideshow-container").hide();$("#id").hide();
    $(".jumbotron").attr("style","margin-bottom:0px;")</script>';

  }elseif($count == 1){
      $row = $result->fetchArray(SQLITE3_ASSOC);
      $sql = "SELECT * from item_pic where item_id = ".$row['item_id'];
      $img = $dbcon->query($sql)->fetchArray(SQLITE3_ASSOC)['item_pic'];
    echo '<script>$("#dot").append("<span class=\'dot\'></span>");$("#slides").append("<img src=\''.$img.'\' style=\'width:100%\'>");</script>';
  }else{
    for($i = 0;$i<5 && $i<$count;$i++){
      $row = $result->fetchArray(SQLITE3_ASSOC);
      $sql = "SELECT * from item_pic where item_id = ".$row['item_id'];
      $img = $dbcon->query($sql)->fetchArray(SQLITE3_ASSOC)['item_pic'];
      echo '<script>$("#dot").append("<span class=\'dot\'></span>");$("#slides").append("<div class=\'mySlides fade\'><img src=\''.$img.'\' style=\'width:100%\'></div>");</script>';
    }
  }
?>



<script src="index.js"></script>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'searchitem')" id="defaultOpen">Search</button> 
  <button class="tablinks" onclick="openCity(event, 'All')" >All</button> 
  <button class="tablinks" onclick="openCity(event, 'Accessory')">Accessories</button>
  <button class="tablinks" onclick="openCity(event, 'Clothes')">Clothes</button>
  <button class="tablinks" onclick="openCity(event, 'Daily-Necessility')">Daily necessities</button>  
  <button class="tablinks" onclick="openCity(event, 'Electronic')">Eletronics</button>
  <button class="tablinks" onclick="openCity(event, 'Forniture')">Furniture</button>  
  <button class="tablinks" onclick="openCity(event, 'Toys')">Toys</button>
  <button class="tablinks" onclick="openCity(event, 'Others')">Others</button>
</div>


<div id="searchitem" class="tabcontent">
  <div id = "searchContent">
    <h3>Search items</h3>
    <p>Here is all the items that you search waiting for exchange</p>
  </div>
</div>
<?php 
  if(isset($_POST["search"])){
    $key = $_POST["key"];
    echo '<script>$("#searchContent").remove();
    $("#searchitem").append("<div class=\'col-lg-12\' id=\'searchContent\' style=\'text-align:center;\'><h3>Searching: '.$key.'</h3></div><div class=\'row\'></div>");
    </script>';
    $sql = "SELECT * FROM items where item_name like '%$key%'";
    $result = $dbcon->query($sql);
    while($searchRow = $result->fetchArray(SQLITE3_ASSOC)){
      $itemId = $searchRow['item_id'];
      $sql = "SELECT * from item_pic where item_id = $itemId";
      $itemPic = $dbcon->query($sql)->fetchArray(SQLITE3_ASSOC)['item_pic'];

    echo '<script>$("#searchContent").append("<a href=\'http://localhost/myproject/post.php?iid1='.$itemId.'\'><div class=\'column\' ><img src=\''.$itemPic.'\' alt=\'Fjords\' style=\'height:90%;max-width:100%;\'><center>'.$searchRow['item_name'].'</center><br></div></a>");</script>';
    }
  }
  ?>



<?php
function displayimage($dbcon,$check_type){
  if(strcmp($check_type,"All") != 0){
    $pic_sql = "SELECT * from items where item_type = '$check_type'";
  }else{
    $pic_sql = "SELECT * from items";
  }
  $result = $dbcon->query($pic_sql);
  while($searchRow = $result->fetchArray(SQLITE3_ASSOC)){
    $itemId = $searchRow['item_id'];
    $sql = "SELECT * from item_pic where item_id = $itemId";
    $itemPic = $dbcon->query($sql)->fetchArray(SQLITE3_ASSOC)['item_pic'];

    echo '<script>$("#'.$check_type.'").append("<a href=\'http://localhost/myproject/post.php?iid1='.$itemId.'\'><div class=\'column\' ><center><img src=\''.$itemPic.'\' alt=\'Fjords\' style=\'height:90%;max-width:100%;\'></center><center>'.$searchRow['item_name'].'</center><br></div></a>");</script>';
    }
  
}
?>

<div id="All" class="tabcontent">
  <h3>All items</h3>
  <p>Here are all the items waiting for exchange</p>
    <?php displayimage($dbcon,"All");?>    
</div>

<div id="Accessory" class="tabcontent">
  <h3>Accessories</h3>
  <p>Here are all the accessories waiting for exchange</p>
    <?php displayimage($dbcon,"Accessory");?>  
</div>

<div id="Clothes" class="tabcontent">
  <h3>Clothes</h3>
  <p>Here are all the clothes waiting for exchange</p>
    <?php displayimage($dbcon,"Clothes");?>   
</div>

<div id="Toys" class="tabcontent">
  <h3>Toys</h3>
  <p>Here are all the toys waiting for exchange</p>  
    <?php displayimage($dbcon,"Toys");?> 
</div>

<div id="Electronic" class="tabcontent">
  <h3>Eletronics</h3>
  <p>Here are all the eletronics waiting for exchange</p>
    <?php displayimage($dbcon,"Electronic");?>  
</div>

<div id="Forniture" class="tabcontent">
  <h3>Furniture</h3>
  <p>Here are all the Furniture waiting for exchange</p>
    <?php displayimage($dbcon,"Forniture");?>  
</div>

<div id="Daily-Necessility" class="tabcontent">
  <h3>Daily necessities</h3>
  <p>Here are all the Daily necessities waiting for exchange</p>
    <?php displayimage($dbcon,"Daily-Necessility");?>  
</div>

<div id="Others" class="tabcontent">
  <h3>Others</h3>
  <p>Here are all the other items waiting for exchange</p>
    <?php displayimage($dbcon,"Others");?>  
</div>

<script>
document.getElementById("defaultOpen").click();
</script>
     
</body>
</html>   