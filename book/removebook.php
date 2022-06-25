<?PHP
require('../conn.php');
	$id_b = $_GET['id_b'];
	$sql = "delete from $tableName where id_b=$id_b";
	if(mysqli_query($con,$sql)){ echo  "<body style='background:#9cc'>删除成功!<script>window.location.href='booklist.php'</script></body>";};

?>