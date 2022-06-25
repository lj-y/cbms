<?php
function totalNum($con){
	$sql = "select * from bookst";
	$result = mysqli_query($con,$sql);
	/** if (!$result) {
           printf("Error: %s\n", mysqli_error($conn));
           exit();
    }
    */
	$num = mysqli_num_rows($result);
	return($num);
}

function nums($con,$sql){
	$result = mysqli_query($con,$sql);
	$num = mysqli_num_rows($result);
	return $num ;
}

function free($result){
	mysqli_free_result($result);
	mysqli_close($con);
}

function msg($url){
	echo '<script>document.write("用户名或密码错误，3秒后返回...");window.setTimeout(function(){window.location.href =$url },3000); </script>';
}

?>