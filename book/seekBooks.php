<?php
session_start();
if(empty($_SESSION['checked'])){echo "非法查询 <a href='index.html'>返回</a>";exit();}
if(!$_SESSION['checked']){echo "重新输入用户名或密码";exit();}
$_SESSION['bookname']=null;
$_SESSION['pr1']=null;
$_SESSION['pr2']=null;
$_SESSION['isbn']=null;
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">  
<title>查找商品</title>
<style>
body{ background-color:#9cc}
form{   
 margin-left:35px;margin-top:50px;
}
</style>
</head>
<body>
<form action="seekBooks_do.php" method="get">
<table width="481" height="154" border="0">
  <tr>
    <td width="83">商品名：</td>
    <td width="267"><input name="bookname" type="text" value=''></td>
  </tr>
  <tr>
    <td>价格：</td>
    <td>
    <input  name="price1" type="text" value='' size="5"> <s>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</s>
    <input  name='price2' type="text" size="5"> &nbsp;元</td>
  </tr>
  <tr>
    <td>属性:</td>
    <td><input type="text"  name="isbn" value=''></td>
  </tr>
  <tr>
    <td><p><input type="submit" value="确定"></p></td>
  </tr>
</table>
</form>
</body>
</html>