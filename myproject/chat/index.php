<?php
?>

<html>
<head>
<title>Chat Box</title>
<link rel="stylesheet" type="text/css" href="index.css">


<?php include ("../header.php");
$uploader_name=$_REQUEST['uploader_name'];

?>

<script>

function submitChat() {
	if(form1.uname.value == '' || form1.msg.value == '') {
		alert("ALL FIELDS ARE MANDATORY!!!");
		return;
	}

	var uname = form1.uname.value;
	var msg = form1.msg.value;
	var xmlhttp = new XMLHttpRequest();
	document.getElementById("message").value = "";
	xmlhttp.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200) {
			document.getElementById('chatlogs').innerHTML = this.responseText;
		}
	};

	xmlhttp.open("GET","insert.php?uname="+uname+"&msg="+msg,true);
	xmlhttp.send();

}

$(document).ready(function(e){
	var name=form1.uname.value;
	$.ajaxSetup({
		cache: false
	});
	setInterval( function(){ $('#chatlogs').load('logs.php?uname='+name); }, 1000 );
});

</script>


</head>
<body>
<div class="container">
<form class="form-horizontal" name="form1" >
<br >
Chatting with:<input class="form-control" id="receiver" type="text" name="uname" value="<?php echo $uploader_name;?>" disabled/> <br />
Your Message: <br />
<div class="form-group">
<div class="col-sm-10">
<input name="msg" class="form-control" id="message" required></input><br />
</div>
    <a href="#" id="send" class="btn btn-primary col-sm-2" onclick="submitChat()">Send</a><br /><br />

</div>
</form>

<div id="chatlogs" class="jumbotron" style="height:700px;overflow: scroll;overflow-x: hidden;" >
LOADING CHATLOG...
</div>
</div>
</body>
<?php
echo "<script>var input = document.getElementById('message');

// Execute a function when the user releases a key on the keyboard
input.addEventListener('keyup', function(event) {
  // Cancel the default action, if needed
  event.preventDefault();
  // Number 13 is the 'Enter' key on the keyboard
  if (event.keyCode === 13) {
    // Trigger the button element with a click
    document.getElementById('send').click();
  }
});</script>"
?>
