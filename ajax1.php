<!doctype html>
<html>
<head>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
<div id="result"></div>
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
$(document).ready(function(){
	$('#loginBtn').click(function(){
		username=$('#username').val();
		password=$('#password').val();
		//alert(id);
		$.post('login.php',{username:username,password:password},function(res){
		alert('Suceess');
		$('#result').html(res);
		});
	});
});
</script> 
</body>
</html>
