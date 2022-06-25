<?PHP
require('../conn.php');
// mysqli_query('set names utf8');
$id_b= $_GET['id_b'];
$CurPage = $_GET['CurPage'];
$name = $_GET['bookname'];
$price = $_GET['price'];
$isbn =$_GET['isbn'];
$user =$_GET['user'];
$sql = "update $tableName set name='$name',  price='$price', isbn='$isbn' , user='$user'  where id_b='$id_b'";
if(mysqli_query($con,$sql)){
echo "<script>alert('修改成功!');window.location.href='booklist.php?CurPage=$CurPage'</script>";
}else{ echo "修改失败！";}
?>