<?php
session_start();
if(!isset($_SESSION['checked'])){echo "非法操作,不存在用户 <a href='index.html'>返回</a>";exit();}
if(!($_SESSION['checked'])){echo "非法操作,不存在用户 <a href='index.html'>立即返回</a>";exit();}
require('../conn.php');
require('../func.php');
if(!isset($_GET['page'])  ||  $_GET['page']==null){
 $_GET['page']=1;}
if(isset($_GET['page'])){$page = $_GET['page'];}else{ $page=1;}
if($page==1){
if(isset($_SESSION['bookname'])){$bookname=$_SESSION['bookname'];}else{ $bookname=$_GET['bookname'];}
if(isset($_SESSION['pr1'])){$price1=$_SESSION['pr1'];}else{ $price1=$_GET['price1'];}
if(isset($_SESSION['pr2'])){$price2=$_SESSION['pr2'];}else{ $price2=$_GET['price2'];}
if(isset($_SESSION['isbn'])){$isbn=$_SESSION['isbn'];}else{ $isbn=$_GET['isbn'];}

$pr1 = intval($price1);
$pr2 = intval($price2);
$_SESSION['bookname']=$bookname;
$_SESSION['pr1']=$pr1;
$_SESSION['pr2']=$pr2;
$_SESSION['isbn']=$isbn;
}else{
$bookname=$_SESSION['bookname'];
$pr1=intval($_SESSION['pr1']);
$pr2=intval($_SESSION['pr2']);
$isbn=$_SESSION['isbn'];
}

if(!empty($pr1) or !empty($pr2)){
	$sql = "select * from  $tableName where  price >$pr1 and price<$pr2  ";
}
else{	$sql = "select * from  $tableName where name like '%$bookname%'  and isbn like '%$isbn%' ";
 }
$result = mysqli_query($con,$sql);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>图书管理系统</title>
<style>
*{ margin:0 auto;  border:#66FFFF solid 0px;  padding:0;}
#page{ background: #C9F; text-align:center;}
body{ background-color:#9cc}
table{ 
	line-height:25px;
	position:absolute;
	top:50px;
	left:5px;
	background-color: #FCC;
	text-align:center;
	border-collapse:collapse;
}

table tr{
	height:15px; 
	}
#ta1{ background-color:#CCC;}
</style>
</head>
<body>
<table width="512" height="" border="1"   border="1px">
<tr bgcolor="#CCCC99"><td>序号</td><td>书名</td><td>价格</td><td>ISBN</td></tr>

<?php
//总记录数
//echo "总计录数";
$pageTotalNum = nums($con,$sql);
//分页数
$pageSize = 5;
//总页数
//echo "总页数 ".
$pageNum =ceil($pageTotalNum/$pageSize);
// echo $pageNum =ceil($pageTotalNum/$pageSize);
// 当前页码
  if(!isset($_GET['page']) )  {  $page=1;}else{$page=$_GET['page'];}
// 开始显示记录
$star = ($page-1)*$pageSize;

// 防止恶意翻页操作
if(!isset($_GET['page'])  ||  $_GET['page']==null){
 $_GET['page']=1;
}
$sql = $sql." limit $star,$pageSize";

$result  = mysqli_query($con,$sql);
$i=1;
while(
	$row = mysqli_fetch_array($result)
){
	if($i%2==0){echo '<tr bgcolor="#919BE6">';}else{ echo "<tr>";}	
?>
<td><?php echo $i++;?></td><td><?php echo $row['name'];?></td><td><?php echo $row['price']; ?></td><td><?php echo $row['isbn']; ?></td>
<?php
}
mysqli_free_result($result);
?>
</tr>

<tr>
<td colspan='4' id='end'>
<?php
// 翻页链接
for ($j= 0; $j<$pageNum; $j++) {
     echo "<a href=seekBooks_do.php?page=".($j+1).">" .'    ' . ($j + 1)  ."</a>";
     echo "&nbsp; &nbsp";
}

?>
</td>
</tr>
</table>

</DIV>
<p>&nbsp;</p>
</body>
</html>
