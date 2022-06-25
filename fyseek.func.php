<?php
require ('conn.php');
/** 数据库连接常量
define('DB_HOST', 'localhost');
define('DB_USER', 'fy13');
define('DB_PWD', 'fy13'define('DB_NAME', 'fy13');
//$tableName="bookst";

**/
// 连接数据库
function conn()
{
    $conn = mysql_connect($host, $user, $pwd, $db);
    mysql_query($conn, "set names utf8");
    return $conn;
    echo "connect ok";
}


//获得结果集
function doresult($sql){
   $result=mysql_query(conn(), $sql);
   return  $result;
}


//结果集转为对象集合
function dolists($result){
    return mysql_fetch_array($result, MYSQL_ASSOC);
}


function totnums($sql) {
    $result=mysql_query(conn(), $sql);
    return $result->num_rows;
}


// 关闭数据库
function closedb()
{
    if (! mysql_close()) {
        exit('关闭异常');
    }
}


?>