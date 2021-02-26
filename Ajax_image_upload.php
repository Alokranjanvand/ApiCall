<?php
if(isset($_FILES['img']))
{
   $con=mysqli_connect('localhost','root','','upload_image');
   if(!$con)
   {
      die('Connection Not Established');
   }
   if(!empty($_FILES['img']['name']))
   {
      $target_folder = 'files/';
      $filename = $_FILES['img']['name'];
	  $name = $_POST['name'];
      $upload_image = $target_folder.$filename;
      if(move_uploaded_file($_FILES['img']['tmp_name'],$upload_image))
      {
         if(!$con)
         {
            die('Connection Not Established');
         }
         $ins_img = "insert into images(img_name,name) values ('$filename','$name')";
         $ins_query = mysqli_query($con,$ins_img);
         if($ins_query)
         {
            return true;
         }
         else
         {
            return false;
         }
      }
   }
}
/*
CREATE DATABASE IF NOT EXISTS `upload_image` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `upload_image`;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img_name` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;
*/
?>
<!Doctype html>
<html>
<head>
   <title>Upload image without form submit using ajax with php</title>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
   <div class="col-sm-6" style="margin-top:10%;"">
      <input type="file" id="img" class="form-control" />
	  <input type="text" id="name" class="form-control" />
	  <button id="add">Add</button>
   </div>
   <div style="margin-top:10px;">
      <?php
      $con=mysqli_connect('localhost','root','','upload_image');
      if(!$con)
      {
         die('Connection Not Established');
      }
      $sel = "select * from images order by id desc";
      $sel_query = mysqli_query($con,$sel);
      if(mysqli_num_rows($sel_query) > 0)
      {
		  ?>
		  <table class="table">
		 <tr>
			<th>Name</th>
			<th>Image</th>
		 </tr>
		 <?php
         while($img = mysqli_fetch_array($sel_query))
		 {
		 ?>
		 
		<tr>
			<th><p><?php echo $img['name'];?></p></th>
			<th><img src="files/<?php echo $img['img_name'];?>" class="img" height="50"/></th>
		 </tr>
         
		 
		 <?php
		 }
		 ?>
		 </table>
		 <?php

      }
      else
      {
         echo 'No files';
      }
      ?>
   </div>
   <script>
   $(document).ready(function(){
	$('#add').click(function(){
      var property=document.getElementById("img").files[0];
      var img_name=property.name;
      var property=$('#img').prop('files')[0];
      var form_data = new FormData();
      form_data.append("img",property);
	  form_data.append('name', $("#name").val());
      $.ajax({
         url:"index.php",
         method:"POST",
         data:form_data,
         contentType:false,
         cache:false,
         processData:false,
         success:function(data)
         {
            location.reload();
         }
      })
   });
    });
</script>
</body>
</html>
