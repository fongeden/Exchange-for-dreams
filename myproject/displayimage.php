<?php
function displayimage($dbcon,$check_type,$sort_by){
  $items_sql="select * from items order by ".$sort_by." DESC";
  $items_result = $dbcon->query($items_sql);
  $do_break=0;
  while($items_row = $items_result->fetchArray(SQLITE3_ASSOC)){
      //print_r($row);
    echo "<div class=\"row\">";
    for($x=0;$x<5;$x++){
      //first time
      if($x==0){
        //get pic link, show only one pic
        $iname = $items_row['item_name'];
        $itype = $items_row['item_type'];
        $iid = $items_row['item_id'];
        //get id, name
        $pic_sql = "select * from item_pic where item_id = '$iid'";
        $pic_result = $dbcon->query($pic_sql);
        $pic_row = $pic_result->fetchArray(SQLITE3_ASSOC);   
        $ipic = $pic_row['item_pic'][0];        
        //start print
        if((!strcmp($itype,$check_type))||(!strcmp("All",$check_type))) {
          echo "<div class=\"column\">";
          echo "<center><img style=\"height:90%;max-width:100%;\" src=\"$ipic\" alt=\"Forest\" >";
          echo "<center><a href=\"http://localhost/myproject/post.php?iid1=$iid\">$iname</a></center><br>";
          echo "</div>";
        }
      }
      //
      elseif($items_row = $items_result->fetchArray(SQLITE3_ASSOC)){
        //get pic link, show only one pic
        $iname = $items_row['item_name'];
        $itype = $items_row['item_type'];
        $iid = $items_row['item_id'];
        //get id, name
        $pic_sql = "select * from item_pic where item_id = '$iid'";
        $pic_result = $dbcon->query($pic_sql);
        $pic_row = $pic_result->fetchArray(SQLITE3_ASSOC);   
        $ipic = $pic_row['item_pic'];        
        //start print
        if((!strcmp($itype,$check_type))||(!strcmp("All",$check_type))) {
          echo "<div class=\"column\">";
          echo "<center><img style=\"height:90%;max-width:100%;\" src=\"$ipic\" alt=\"Forest\" >";
          echo "<center><a href=\"http://localhost/myproject/post.php?iid1=$iid\">$iname</a></center><br>";
          echo "</div>";
        }
      }
      else{
        $do_break=1;
        break;
      }
    }
    echo "</div>";
    if($do_break==1){
      $do_break=0;
      break;
    }
  }
}
?>