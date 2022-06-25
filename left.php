<?php
session_start();
require 'conn.php';
if(!isset($_SESSION['checked'])){echo "非法操作<a href='index.html' target='_parent'>立即返回</a>";exit();}
if(!$_SESSION['checked']){echo '不存在用户<a href="index.html">返回</a>';exit();}

?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">  
<link rel="stylesheet" type="text/css" href="tab_a.css">
<script src="/lib/jquery/jquery.js"></script>
<script src="/lib/bootstrap/js/bootstrap.min.js"></script>
<title>后台管理信息系统</title>
<style>
*{
	margin-left:0;margin-right:0;
	padding-left:0;padding-right:0;
	padding-bottom:0px;
}
body{
background:#B0C4DE;
}
a:link{ color: #9cc; }
.main{
     text-align:center;
}
#div1{   
width:85%;
font-size:15px;
}

div{   padding-top:10px;}

.lie{ 
color:black;
background:#919be6;
}

.mid{  display:none;}
.dis{ display:block;}
.mid, .lie{ 
text-indent : 1em;
vertical-align:bottom;
padding-bottom:3px;
text-align:left;
}  
.cusera{
color: #FF34B3;
margin-left:30px;
//margin-right:5px;
}

.cuserb{
color: #FF34B3;
}

.bottom{
vertical-align:bottom;
padding-bottom:3px;
color: #FF34B3;
background:#919be6;
padding-left:20px;
//text-indent : 1em;
}

</style>
</head>

<body>
<div  id="div1">

<div class='dis'>
<p class="main"><b>The MIS </b></p>
<div class='lie' >MS
	<span class="glyphicon glyphicon-user cusera"></span>
	<font color='blue'>&nbsp;<?php echo $_SESSION['cuser']; ?></font>
</div>
<div class="mid dis" title="查看列表"><a  onclick="list()"><span class="glyphicon glyphicon-book" ></span>&nbsp; List</a></div>
<div class="mid dis" title="添加商品"><a onclick="addbook()"><span class="glyphicon glyphicon-plus" ></span>&nbsp;Add </a></div>
<div class="mid dis" title="查找商品"><a onclick="seekbooks()"><span class="glyphicon glyphicon-search"></span>&nbsp;Find </a></div>
</div>
<div>
<div class='lie'>Database Manage</span></div>
<div class="mid" title="一键恢复"><a onclick = "restoreBooks()"><span class="glyphicon glyphicon-import"></span>Restore</a></div>
<div class="mid" title="清空商品"><a  onclick = "emptybooks()"><span class="glyphicon glyphicon-remove-sign"></span>Empty</a></div>
<div class="mid" title="导入数据"><a onclick = "importBooks()"><span class="glyphicon glyphicon-import"></span>Import data</a></div>
<div class="mid" title="导出数据"><a  onclick = "exportBooks()"><span class="glyphicon glyphicon-export"></span>Export data</a></div>
</div>

<div>
<div class= 'lie'>User Manage</div>
<div class="mid" title="查看用户"><a  onclick="adminlist()"><span class="glyphicon glyphicon-user"></span>&nbsp;User list</a></div>
<div class="mid" title="添加用户"><a onclick="addadmin()"><span class="glyphicon glyphicon-plus"></span>&nbsp;Add user</a></div>
</div>

<div>
<div class= 'bottom' title="退出帐户"><a onclick="logout()">
<font color="black"><B><span class="glyphicon glyphicon-off cuserb"></span>&nbsp;Log off</B></font></a></div>
</div>
</div>
<script type="text/javascript">
function addbook(){
	$frb = parent.document.getElementById('frb');
	$frb.src='book/addbook.php';
}

function list(){
	$frb = parent.document.getElementById('frb');
	$frb.src='book/booklist.php';
}

	
function seekbooks(){
	$frb = parent.document.getElementById('frb');
	$frb.src='book/seekbooks.php';
}
function restoreBooks(){
	var res = confirm("确定要恢复默认数据吗？");
	if(res){ 
		$frb = parent.document.getElementById('frb');
		$frb.src='dbase/restoreBooks.php';
	}
}

function emptybooks(){
var pas = confirm("清空图书需谨慎！确定清空图书吗？");
	if(pas){
	$frb = parent.document.getElementById('frb');
	$frb.src='book/emptyBooks.php';}
}

function importBooks(){
	$frb = parent.document.getElementById('frb');
	$frb.src='dbase/Import.html';
}

function exportBooks(){
	var exp = confirm("确定要导出数据吗？");
	if (exp) {
		$frb = parent.document.getElementById('frb');
		$frb.src='dbase/export.php';
	}
}

function adminlist(){
	$frb = parent.document.getElementById('frb');
	$frb.src='user/adminList.php';
}
function logout(){
$frb = parent.document.getElementById('frb');
$frb.src='logoff.php';
}

function addadmin(){
	$frb = parent.document.getElementById('frb');
	$frb.src='user/addAdmin.php';
}

$(function(){
	   $('.lie').click(function(){
	    $(this).nextAll().toggle();
	     return false;
	})
});

</script>
</body>
</html>