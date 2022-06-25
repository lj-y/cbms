<?php
require('../conn.php');
$ids = $_POST['ids'];
//print_r($ids);
//$str = ' ';
for( $i=0;$i<count($ids);$i++){
	// $str =$str.$ids[$i];
	// echo $ids[$i];
	 $sql = "delete from  $tableName where id_b = $ids[$i] ;";
	 if(!mysqli_query($con,$sql)){  echo "Error!";break;}
}
echo "删除成功！ ";


?>