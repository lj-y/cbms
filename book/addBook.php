<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">  
<title>添加商品</title>
<style>
body{ background-color:#9cc}
form{   
 margin-left:35px;margin-top:50px;
}
</style>
</head>
<body>
<form action="addBook_do.php" method="get">
<table width="500" height="154" border="0">
  <tr>
    <td width="83">商品名：</td>
    <td width="267"><input name="bookname" type="text" value='' required='required'></td>
 </tr>
  <tr>
    <td>价格(¥)：</td>
    <td><input type="text"  name="price" value='' pattern ='^[0-9]+(.[0-9]{1})?$' title ='输入正确的价格'></td>
  </tr>
  <tr>
    <td>属性:</td>
   <!-- <td><input type="text"  name="isbn" value='' pattern="^(9787)\d*$"></td>-->
      <td><input type="text"  name="isbn" value='' ></td>
  </tr>
  <tr>
    <td><p><input type="submit" value="确定"></p></td>
  </tr>
</table>
</form>
</body>
</html>