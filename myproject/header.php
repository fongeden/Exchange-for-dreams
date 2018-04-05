<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="http://localhost/myproject/login/bootstrap-3.2.0-dist/css/bootstrap.css">
	  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
    <link rel="stylesheet" type="text/css" href="http://localhost/myproject/header.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
	<!-- <link type="text/css" rel="stylesheet" href="http://localhost/myproject/css/bar.css"> -->
    <title>Index</title>
</head>
<body>
<nav class="navbar navbar-default" style="color:black;position:top;z-index:3">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header_navbar_collapse" aria-expanded="false" aria-controls="header_navbar_collapse" aria-label="Toggle navigation">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  	<a href="http://localhost/myproject/index.php"><img src="http://localhost/myproject/logo1.png"></a>
  </div>

  <div class="collapse navbar-collapse" id="header_navbar_collapse">
  
  <div class = "nav navbar-nav">
    <li><a href="#">About Us</a></li>
    <li><a href="#">Contact Us</a></li>
  </div>


  <div id="loginDiv" class="nav navbar-nav navbar-right">
    <li id="login"><a href="http://localhost/myproject/login/login.php">Login <i class="fas fa-sign-in-alt"></i></a></li>
    <li id="register"><a href="http://localhost/myproject/login/registration.php">Register <i class="fas fa-user-plus"></i></a> </li>
  </div>
</div>

<!-- </div> -->
</nav>

</body>

<?php
if (isset($_SESSION["email"])){
	$name=$_SESSION['user_name'];
	$changeToLogout='<script>$("#login").remove();$("#register").remove();
	$("#loginDiv").append("<li class=\'dropdown\'>\
        <a class=\'dropdown-toggle\' data-toggle=\'dropdown\' href=\'#\'>'.$name.' '.'<i class=\'fas fa-user-circle\'></i>\
        <span class=\'caret\'></span></a>\
        <ul class=\'dropdown-menu\'>\
          <li id=\'profile\'><a href=\'http://localhost/myproject/login/profile.php\'>Profile <i class=\'fas fa-user\'></i> </div></a></li>\
          <li id=\'upload\'><a href=\'http://localhost/myproject/forum/createPost.php\'>Upload <i class=\'fas fa-upload\'></i></a></li>\
          <li id=\'favourite\'><a href=\'http://localhost/myproject/login/favourite.php\'>Favourite <i class=\'fas fa-heart\'></i></a></li>\
        </ul>\
      </li>");
  $("#loginDiv").append("<li class=\'dropdown\'>\
        <a class=\'dropdown-toggle\' data-toggle=\'dropdown\' href=\'#\'>Chat <i class=\'fas fa-comments\'></i>\
        <span class=\'caret\'></span></a>\
        <ul id=\'noticeContent\' class=\'dropdown-menu\'>\
        </ul>\
      </li>");
	$("#loginDiv").append("<li id=\'upload\'><a href=\'http://localhost/myproject/forum/createPost.php\'>Upload <i class=\'fas fa-upload\'></i></a></li>");
  $("#loginDiv").append("<li id=\'profile\'><a href=\'http://localhost/myproject/login/profile.php\'>Profile <i class=\'fas fa-user\'></i> </div></a></li>");$("#loginDiv").append("<li id=\'logout\'><a href=\'http://localhost/myproject/login/logout.php\'>Logout <i class=\'fas fa-sign-out-alt\' style=\'color:black\'></i></a></li>")
  </script>';
  

	echo $changeToLogout;	
	
}
?>
<script>
$(document).ready(function(e){	
	$.ajaxSetup({
		cache: false
	});
	setInterval( function(){ $('#noticeContent').load('http://localhost/myproject/notice.php'); }, 1000 );
});

// 
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<!-- 
<div class="dropdown">
<button onclick="myFunction()" class="dropbtn">Dropdown</button>
  <div id="myDropdown" class="dropdown-content">
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>
  </div>
</div>

 -->