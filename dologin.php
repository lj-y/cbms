<?php
session_start();
header("Content-type:text/html;charset=utf-8");
require 'conn.php';
// 表单用户名
 $name=$_GET['fuser'];
$_SESSION['cuser']=$name;
// // 表单用户密码
 $pass=md5($_GET['fpass']);
// echo "<br>";
// // 生成的验证码
// echo $_SESSION['char'];
//用户输入的验证码
// echo $_SESSION['very'];
$very = $_GET['very'];
// echo $name.' '.$pass.' '.$very."<br>";
$sql = "select name,password from {$tableAdmin} where name='$name'"; 
$result  = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
// var_dump($row);
// echo $row['name'].' '.$row['password'].' '.strtolower($_SESSION['char']);
// 首先验证用户名和密码
if(($name==$row['name']) && ($pass==$row['password'])){

	if(strtolower($_GET['very'])==strtolower($_SESSION['char'])){
		// 验证码正确
		$_SESSION['checked']=true;
		echo "<script>window.location.href='main.php'</script>";
		exit();

	}else{
		// 验证码错误
		echo "验证码错误！";
		echo '<script>window.location.href ="back.html?err=ver";</script>';
		exit();
	}
}else{ 
	// 用户名或密码错误
	echo "无访问权限";
	echo '<script>window.location.href ="back.html?err=ver";</script>';
	exit();
}

?>