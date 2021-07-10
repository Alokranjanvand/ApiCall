<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "ehs@#$987";
$dbname = "dairy_bank";
$link1 = mysql_connect($dbhost,$dbuser,$dbpass) or mysql_error("Not able to connect with MySql Server");
$link = mysql_select_db($dbname,$link1) or mysql_error("Not able to connect with Database");
?>
<html>
    <head>
        <title>Pagination</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<style>
.active{ background-color: #337ab7 !important; color:#fff !important;}
</style>   
   </head>
    <body>
	
        <div class="table-responsive" id="tabledata" style="width: 600px; border: 1px solid black; margin: 10px;">
                
        </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script type="text/javascript">
  $(document).ready(function(){
    function loadData(page){
		alert(page);
		
		//alert(zone);
      $.ajax({
        url  : "ajax_pagination_part2.php",
        type : "POST",
        cache: false,
        data : {page_no:page},
        success:function(response){
			//alert(response);
          $("#tabledata").html(response);
        }
      });
    }
    loadData();
    
    // Pagination code
    $(document).on("click", ".pagination li a", function(e){
      e.preventDefault();
      var pageId = $(this).attr("id");
      loadData(pageId);
    });
  });
  
</script>

    </body>
</html>
