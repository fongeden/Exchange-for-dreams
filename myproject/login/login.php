<?php
 if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
?>



<html>
<head lang="en">
    <meta charset="UTF-8">
    
	
    <title>Login</title>
</head>
<style>
    .login-panel {
        margin-top: 150px;

</style>

<body>
<?php include ("../header.php"); ?>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login.php">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>


                                <input class="btn btn-lg btn-success btn-block" type="submit" value="login" name="login" >

                            <!-- Change this to a button or input when using this as a form -->
                           <!--<a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>

<?php

include("database/db_conection.php");

if(isset($_POST['login']))
{
    $user_email=$_POST['email'];
    $user_pass=$_POST['pass'];

    $check_user="select * from users WHERE user_email='$user_email'AND user_pass='$user_pass'";
	$get_user="select * from users WHERE user_email='$user_email'AND user_pass='$user_pass'";
    $run=$dbcon->querySingle($check_user);
	
    if($run)
    {
        echo "<script>
		window.open('http://localhost/myproject/index.php','_self');		
	</script>";		
        $_SESSION['email']=$user_email;//here session is used and value of $user_email store in $_SESSION.
		$_SESSION['user_name']=$dbcon->query($get_user)->fetchArray(SQLITE3_ASSOC)["user_name"];
		$_SESSION['user_id']=$dbcon->query($get_user)->fetchArray(SQLITE3_ASSOC)["user_id"];
    }
    else
    {
        echo "<script>alert('Email or password is incorrect!')</script>";
    }
}
?>
