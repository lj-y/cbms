<?php
include 'fyseek.func.php';

$bookname= $_GET['bookname'];
$price1= $_GET['price1'];
$price2= $_GET['price2'];
$isbn = $_GET['isbn'];
$pr1 = intval($price1);
$pr2 = intval($price2);
// 总记录数
$totalnums = totalnums($sql);
// 每页显示条数
$fnum = 8;
// 翻页数
$pagenum = ceil($totalnums / $fnum);
// 页数常量
@$tmp = $_GET['page'];

//防止恶意翻页
if ($tmp > $pagenum)
    echo "<script>window.location.href='index.php'</script>";


//计算分页起始值
if ($tmp == "") {
    $num = 0;
} else {
    $num = ($tmp - 1) * $fnum;
}


// 查询语句
if(!empty($pr1) or !empty($pr2)){
	$sql = "select * from  $tableName where  price >$pr1 and price<$pr2   LIMIT".$num .",$fnum";
}
else{	$sql = "select * from  $tableName where name like '%$bookname%'  and isbn like '%$isbn%' LIMIT".$num.",$fnum";
}

$result = doresult($sql);


// 遍历输出
while (! ! $rows = dolists($result)) {
    echo $rows['price'] . " " . $rows['name'] . "<br>";
}


// 翻页链接
for ($i = 0; $i < $pagenum; $i ++) {
    echo "<a href=index.php?page=" . ($i + 1) . ">" . ($i + 1) . "</a>";
}
?>