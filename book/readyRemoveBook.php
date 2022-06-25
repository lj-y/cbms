<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>删除图书</title>
</head>
<body>
<script type="text/javascript">
window.onload=function(){
	var pass = prompt("请输入您的密码",'');
	if(pass=='jie99'){ alert("ok"); 
		window.location.href = './removeBook.php?id_b='+<?php echo $_GET['id_b'];?> ;
	}else{	alert("密码错误!");
			window.location.href = './right.php'; 
		}
}
</script>
</body>
</html>

    