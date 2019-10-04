<html>
<head>
<title>File Upload Using PHP and cURL - php-guru.in</title>
<style type="text/css">
body
{
    font-family:Verdana, Geneva, sans-serif;
    font-size:12px;
}
</style>
</head>
<body>
<font style="color: red;"> < ?php echo ucfirst($errmsg);?> </font><br>
<br>
<table border="1" cellspacing="0" cellpadding="3" style="border-collapse:collapse;" bordercolor="#CCCCCC">
  <form action="uploadpost.php" method="post" name="frmUpload" enctype="multipart/form-data">
    <tr>
      <td>Upload</td>
      <td align="center">:</td>
      <td><input name="file" type="file" id="file"/></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td><input name="btnUpload" type="submit" value="Upload" /></td>
    </tr>
  </form>
</table>
</body>
</html>