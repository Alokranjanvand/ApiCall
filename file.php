<?php
if(isset($_POST['mode']) && ($_POST['mode']=="fileupload"))
{
  if(is_array($_FILES)) 
  {
    if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
      $sourcePath = $_FILES['userImage']['tmp_name'];
      $targetPath = "images/".$_FILES['userImage']['name'];
      if(move_uploaded_file($sourcePath,$targetPath)) {
?>
<img class="img-fluid" width="100%" height="100" src="<?php echo $targetPath; ?>" />
<?php
  }
    }
      }
	  exit();
}
?>
<html>
<head>
   <title>PHP AJAX Image Upload</title>
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
</head>
<body>
<div class="container">
   <div class="col-md-6 offset-md-3">
      <div class="card">
         <div class="card-title p-1 bg-success">
            <h6>PHP AJAX Image Upload</h6>
         </div>
         <div class="card-body">
            <form id="uploadForm" method="post">
               <div class="col-md-12 bg-light mb-2 text-center">
                  <div id="targetLayer">No Image</div>
               </div>
               <div class="form-group">
                  <input name="userImage" type="file" class="form-controller" />
               </div>
			   <div class="form-group">
                  <input  type="hidden" name="mode" id="name" value="fileupload" class="form-controller" />
               </div>
               <input type="submit" value="Submit" class="btn btn-success" />
            </form>
         </div>
      </div>
   </div>
</div>
</div>
</body>
<script type="text/javascript">
$(document).ready(function (e) {
   $("#uploadForm").on('submit',(function(e) {
      e.preventDefault();
      $.ajax({
           url: "upload.php",
         type: "POST",
         data:  new FormData(this),
         contentType: false,
           cache: false,
         processData:false,
         success: function(data)
          {
			  alert(data);
            $("#targetLayer").html(data);
          },
              error: function() 
          {
          }            
      });
	}));
});
</script>
</html>