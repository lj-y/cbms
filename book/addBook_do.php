<?Php
session_start();
require('../conn.php');
echo $bookname= $_GET['bookname'];
$price= $_GET['price'];
$isbn = $_GET['isbn'];
 echo $cuser = $_SESSION['cuser'];
if(empty($bookname)||empty($price)||empty($isbn) ){
	echo '<script>alert("输入有空，重新输入！");window.location.href="addBook.php";</script>';
}else{
	echo "uuuuu";
	 $sql = "insert into  $tableName (name,price,isbn,user)values('$bookname','$price','$isbn','$cuser')";
	 if(mysqli_query($con,$sql)){ echo '<script>alert("保存成功！");window.location.href="addBook.php";</script>';}else{ echo "ng"; return false; }
}
?>