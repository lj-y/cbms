<style type="text/css">
	*{background-color: #9cc;}
</style>

<?php
require('../conn.php');
	 $sql = "TRUNCATE TABLE  $tableName";
	if(mysqli_query($con,$sql)){
		echo '正在处理，请稍等...<br>3秒后自动跳转。';
		sleep(3);
          header("refresh:3;url=booklist.php");

}else{
echo "出现错误！";
}

?>