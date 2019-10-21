<!doctype html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
<div id="result"></div>
<div id="result2"></div>
<div>
<input type="text" name="result" id="result1"/></div>
<form id="loginform" method="post">
    <div>
        Username:
        <input type="text" name="username" id="username" />
        Password:
        <input type="password" name="password" id="password" />    
        <input type="button" name="loginBtn" id="loginBtn" value="Login" />
		
    </div>
</form>
<script type="text/javascript">
$(document).ready(function() {
    $('#loginform').click(function(e) {
        e.preventDefault();
		$('#result2').html("<b>Loading response...</b>");
        $.ajax({
            type: "POST",
            url: 'login.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);
 
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    //location.href = 'my_profile.php';
					alert('Suceess');
					$("#result1").val('result1= '+jsonData.success);
					$("#result2").text('result2= '+jsonData.success);
					$('#result').html(response);
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
       });
     });
});
</script>
</body>
</html>
