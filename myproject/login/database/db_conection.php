<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('database/test.db');
      }
   }
   $dbcon = new MyDB();
   if(!$dbcon) {
      echo $dbcon->lastErrorMsg();
   } else {
      ;
   }

   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS users
      (user_id 		INTEGER PRIMARY KEY AUTOINCREMENT    NOT NULL ,
      user_name     TEXT    			NOT NULL,
      user_pass     TEXT      			NOT NULL,
      user_email    TEXT 				NOT NULL,
      rank 			INT 				DEFAULT 0,
      pro_pic       TEXT 				DEFAULT 'http://localhost/myproject/login/profile_pic/default_propic.jpg',
      description    TEXT           DEFAULT '');
EOF;

	$ret = $dbcon->exec($sql);

	$sql =<<<EOF
      CREATE TABLE  IF NOT EXISTS items
      (item_id 		INTEGER PRIMARY KEY AUTOINCREMENT    NOT NULL,
      user_id 		INTEGER 			NOT NULL,
      item_name     TEXT    			NOT NULL,
      item_type     TEXT      			NOT NULL,
      item_description    TEXT 				NOT NULL,
      upload_time    TEXT,
      like 			INT 				DEFAULT 0,
      dislike 			INT 				DEFAULT 0);
EOF;

   $ret = $dbcon->exec($sql);


	$sql =<<<EOF
      CREATE TABLE  IF NOT EXISTS item_pic
      (item_id 		INTEGER   NOT NULL ,
      item_pic     TEXT    			NOT NULL);
EOF;

   $ret = $dbcon->exec($sql);

   $sql =<<<EOF
      CREATE TABLE  IF NOT EXISTS favourite
      (user_id 		INTEGER    NOT NULL,
      item_id     INTEGER    			NOT NULL);
EOF;

   $ret = $dbcon->exec($sql);

   $sql =<<<EOF
      CREATE TABLE  IF NOT EXISTS report
      (user_id 		INTEGER PRIMARY KEY    NOT NULL ,
      item_id     INTEGER    			NOT NULL);
EOF;

   $ret = $dbcon->exec($sql);

   $sql =<<<EOF
      CREATE TABLE  IF NOT EXISTS comment
      (comment_id INTEGER     PRIMARY KEY AUTOINCREMENT    NOT NULL,
      user_id 		INTEGER    NOT NULL ,
      item_id       INTEGER    			NOT NULL,
      content 		TEXT 	NOT NULL,
  	   com_time		TEXT    NOT NULL);
EOF;

   $ret = $dbcon->exec($sql);


$sql =<<<EOF
      CREATE TABLE  IF NOT EXISTS chatbox
      (chatbox_id 		INTEGER PRIMARY KEY AUTOINCREMENT    NOT NULL ,
      name     TEXT    			NOT NULL,
      message     TEXT      			NOT NULL,  
	  room1   TEXT NOT NULL,
	  room2   TEXT NOT NULL,
	  time TEXT NOT NULL
      );
EOF;

   $ret = $dbcon->exec($sql);

   $sql =<<<EOF
      CREATE TABLE IF NOT EXISTS like
      (user_id       INTEGER  NOT NULL,
         item_id   INTEGER    NOT NULL
      );
EOF;

   $ret = $dbcon->exec($sql);

  
   
?>

<?php
/**
 * Created by PhpStorm.
 * User: Ehtesham Mehmood
 * Date: 11/21/2014
 * Time: 1:13 AM
 */

// $dbcon=mysqli_connect("localhost","root","","users");

// $dbcon=new mysqli("localhost","root","","users");

// mysqli_select_db($dbcon,"users");

// $sql = "CREATE TABLE user(user_name TEXT , user_pass TEXT NOT NULL,user_email TEXT NOT NULL, rank INT(2) DEFAULT 0 ,pro_pic TEXT DEFAULT ''";
// $dbcon->query($sql);
// $sql = "CREATE TABLE items(item_id INT(6),item_name TEXT , type VARCHAR(10), item_pic TEXT DEFAULT '', item_description TEXT,item_like INT(4), item_dislike INT(4))";
// $dbcon->query($sql);
?>


 <!-- PRIMARY KEY, user_pass TEXT NOT NULL,user_email TEXT NOT NULL, rank INT(2) DEFAULT 0 ,pro_pic TEXT DEFAULT '' -->