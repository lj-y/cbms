<?php
require('../conn.php');
$id = $_POST['id'];
$num = explode('/',$id);
$id_b = $num[0];
//echo '行号：' .$num[0]. ' 图片序号：' .$num[1];
$sql = "select  * from $tableName where id_b =$id_b;";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);
//原img图片名字符串
//echo $row['img'];
// 原img转为数组
$var = explode('|',$row['img']);
// 删除数组元素// $i = $num[1];
array_splice($var,$num[1],1);
//print_r($var);
// 重新拼接为新的字符串
$arr = array($var);
$new=implode("|",$arr[0]);
//print_r($new);
// 更新img
//echo $num[1];
//更新img// 
$sql  = "UPDATE $tableName SET  img ='{$new}'  where id_b = $id_b ;";
//echo $sql;
if( mysqli_query($con,$sql)){echo "删除成功！";}else{echo "ng";}
mysqli_free_result($result);

?>