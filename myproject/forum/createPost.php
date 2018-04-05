<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php include ("../header.php"); ?>

<html>
<head>

    <link rel="stylesheet" type="text/css" href="createPost.css">
  </head>
<body>

<br>
<div class="container" >
    <div class="jumbotron">
        <div >
            <div >
                <div >
                    <h3><center>Create New Exchange Stock Post</center></h3>
					
                </div>
				<hr>
                <div >
                    
					<form class="form-horizontal" action="upload.php" method="post" enctype="multipart/form-data" runat="server">
					  <div class="form-group">
						<label class="control-label col-sm-2" for="itemName">Stock Name:</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="itemName" name="itemName" required maxlength="50">
						</div>
					  </div>
					  <div class="form-group">
						
						  <label class="control-label col-sm-2" for="itemType">Item Type:</label>
						  <div class="col-sm-10">
						  <select class="form-control" id="itemType" name="itemType">
							<option>Accessory</option>
							<option>Clothes</option>
							<option>Daily-Necessility</option>
							<option>Electronic</option>
							<option>Forniture</option>
							<option>Toys</option>
							<option>Others</option>
						  </select>
						  </div>
						</div>
					  <div class="form-group">
						<label class="control-label col-sm-2" for="itemDescription">Description:</label>
						<div class="col-sm-10"> 
						  <textarea class="form-control" id="itemDescription" rows="5" name="itemDescription" required ></textarea>
						</div>
					  </div>
					  <div class="form-group">
						<label class="control-label col-sm-2" for="itemDescription">Upload Item Images:</label>
						<div class="col-sm-10"> 
					  <input name="upload[]" id="imgInp" type="file" class="btn btn-default" multiple required/>
					  Item Icon<br><img id="blah" src="#" alt="your image" height="200px" hidden/>
						</div>
					  </div>
					  <div class="form-group"> 
						<div class="col-sm-offset-2 col-sm-10">
						  <button type="submit" class="btn btn-primary">Submit</button>
						</div>
					  </div>
					</form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
	
	$('#blah').show();
  }
}

$("#imgInp").change(function() {
  readURL(this);  
});
</script>
</body>

</html>
