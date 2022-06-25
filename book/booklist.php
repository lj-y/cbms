<?php
session_start();
$_SESSION['CurPage']=  isset($_SESSION['CurPage'] ) ?$_SESSION['CurPage']:1;
//echo "sseion:".$_SESSION['CurPage'];
$CurPage = $_SESSION['CurPage'];
if(!isset($_SESSION['checked'])){
    echo "异常操作<a href='../index.html' target='_parent'>点此返回</a>";
exit();}
if(!$_SESSION['checked']){echo '不存在用户<a href="../index.html">返回</a>';exit();}

if(isset($_GET['id_b'])){   $id_b=$_GET['id_b']; 

//二维数组购物车，其一维数组为： 名称  数量； 首次为空 
//其数据来源于href的id_b
if (empty($_SESSION['gwc'])) {
    // echo '空';
    if (isset($id_b)) {
        $arr = array( 
            array($id_b,1) 
        );
        $_SESSION['gwc'] = $arr;
    }
}
else
{  
//  echo '非空';
    $arr = $_SESSION['gwc'];
    $chuxian = false;
    foreach ($arr as $v ) {
        if ($v[0]==$id_b ) {   $chuxian=true;  }
    }
    
    if ($chuxian) {
        // echo "chx";
        for ($i=0; $i < count($arr) ; $i++) { 
            if ($arr[$i][0]==$id_b) {
                // echo "加2";
                // echo $arr[$i][1];
                $arr[$i][1]= $arr[$i][1]+1;
            }
        }
         $_SESSION['gwc'] = $arr;   
    }
    else
    {
        $asg =  array($id_b ,1 );
        $arr[] = $asg;
        $_SESSION['gwc'] = $arr;
    }
}

$argwc =  $_SESSION['gwc'];

foreach ($argwc as $a) {
    // echo " {$a[0]} {$a[1]}|" ;
}

}//if(isset)
// print_r($argwc);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.min.css">  
<script type = "text/javascript" src = "/lib/jquery/jquery.js" ></script>
<title>The Management System of Infomaintion</title>
<style>
*{ margin:0 auto;    
padding:0px;
cellpadding:0px; 
cellspacing:0px;
border: 0px solid #7ff;
}
body{background-color: #9cc;}
a{
text-decoration: none;
}

.CurPage{ background: #C9F; text-align:center;}
table { 
    border: 1px solid red;
    background-color:#cccccc;
    line-height:25px;
    position:absolute;
    top:50px;
    left:0px;
    text-align:left;
    border-collapse:collapse;   
}

.xh{  text-align:center;}

table tr{  
    height:35px;    
}
.bottom{ padding-left:35px;}
#ta1{ background-color:#CCC;}
span{ vertical-align:middle;}
</style>
</head>
<body>
<!--<form action='#' method= 'get'>-->
<table width="720"  border="1px">
    <tr  bgcolor="#cd96cd" >
        <td width  = "80"  class = "xh" >Number</td>
        <td width  = "180">Name</td>
        <td width  = "50">Price</td>
        <td width = "150">Attr</td>
        <td width = "50">User</td>
        <td>Edit</td>
        <td>Delete</td>
        <td>DelMore</td>
        <td width='50'>Buy </td>
    </tr>
<?php 
require('../conn.php');
require('../func.php');
$pageTotalNum = totalNum($con);
 //每页显示行数 $pageSize
if(isset($_GET['recorders']) ){     $pageSize =   $_GET['recorders']; }else{ $pageSize=10;}
// echo $pageSize;
//当前页 $CurPage
$CurPage = $CurPage != null ?$CurPage :1;
$CurPage = isset($_GET['CurPage'] )?  $_GET['CurPage']:$_SESSION['CurPage'];
$_SESSION['CurPage'] =  $CurPage;
//echo " session_CurPage:".$_SESSION['CurPage'] ;
// echo "当前页 ".$CurPage;   

if(!isset($_GET['recorders'])  ||  $_GET['recorders']==null){
 $_GET['recorders']= $pageSize;
}else{    $pageSize=$_GET['recorders'];}

// echo '总页数 = '.$PageNum =ceil($pageTotalNum/$pageSize);
$pageNum =ceil($pageTotalNum/$pageSize);
//echo " star =".$star = ($CurPage-1)*$pageSize;
$star = ($CurPage-1)*$pageSize;
// echo ' 总计录数 ='.$pageTotalNum;
$sql = "select * from {$tableName} limit $star,$pageSize;";
// $sql = "select * from {$tableName};";
$result  = mysqli_query($con,$sql);
// var_dump($result);
// $result  = mysql_query($sql);
$i=1;
while(
    $row = mysqli_fetch_array($result)
    // $row = mysql_fetch_array($result)
){

//detail 用于详细资料的链接
if($i++%2==0){echo '<tr  bgcolor="#F0FFF0" class="detail" 
    title ='.$CurPage.' id='.$row['id_b'].'>';}else{  echo  '<tr class="detail"   title='.$CurPage. ' id ='.$row['id_b'].'>' ;}   
?>

    <td class  = "xh"><?php echo 1+$star++;?></td>
    <td class  = "bookname"><?php echo $row['name'];?></td>
    <td><?php echo $row['price'];?></td>
    <td><?php echo $row['isbn']; ?></td>
    <td><?php echo $row['user']; ?></td>
    <td>
        <a href="editBook.php?id_b=<?php echo $row['id_b'];?>&CurPage=<?php echo $CurPage;?>"  >
            <span title='编辑' class="glyphicon glyphicon-edit"></span>
        </a>
    </td>
    <td>
        <a href="RemoveBook.php?id_b=<?php echo $row['id_b']; ?>"   onclick="return confirm('确定要删除图书《<?php echo $row["name"];?>》吗？')" title='删除'>
            <span class="glyphicon glyphicon-trash"></span>
        </a>
    </td>
    <td  class='box'><input type ='checkbox'  id =  <?php echo $row['id_b']; ?>  /></td>
    <!-- <td  onclick ="buybooks('<?php  echo $row["name"]; ?>')">Buy</td> -->
    <td onclick ="buybooks('<?php  echo $row["name"]; ?>')">
        <!-- 发送数据到$Session['gwc'] -->
        <a href="booklist.php?id_b=<?php echo $row['name']; ?>" title = '加入购物车'>Buy</a>
    </td>
</tr>

<?php
}
mysqli_free_result($result);
// mysql_free_result($result);
?>
<tr style="background:#D5D5fa;">
    <td colspan="5"  class='bottom'>
        <a  href="booklist.php?CurPage=1&recorders=<?php echo $pageSize;  ?>"title='首页'>First</a>  
        <a href="booklist.php?CurPage=<?php echo $CurPage-1>1?$CurPage-1:1  ; ?>&recorders=<?php echo $pageSize;  ?>"  title='前一页'>PRE</a>  

        <a href='booklist.php?CurPage=<?php if($CurPage>1){echo $CurPage-1;}else{ echo 1;}?>&recorders=<?php echo $pageSize;  ?>  '> &lt;</a>
        <a href = "booklist.php?CurPage=<?php echo $CurPage-4;?>&recorders=<?php echo $pageSize;  ?>   "><?php if($CurPage>4)echo "…"; ?></a>
        <a href = "booklist.php?CurPage=<?php echo $CurPage-2;?>&recorders=<?php echo $pageSize;  ?>  "><?php if(($CurPage-2)>0)echo $CurPage-2; ?></a>

        <a href = "booklist.php?CurPage=<?php echo $CurPage-1;?>&recorders=<?php echo $pageSize;  ?>"><?php if(($CurPage-1)>0)echo $CurPage-1; ?></a>

        <a href = "booklist.php?CurPage=<?php echo $CurPage;?> &recorders=<?php echo $pageSize;  ?> "><?php if($CurPage<=10)echo "<span style='color:#F00'  id='sp'>$CurPage</span>"; ?></a>

        <a href = "booklist.php?CurPage=<?php echo $CurPage+1;?> &recorders=<?php echo $pageSize;  ?>  "><?php if(($CurPage+1)<=$pageNum)echo $CurPage+1; ?></a>

        <a href = "booklist.php?CurPage=<?php echo $CurPage+2;?> &recorders=<?php echo $pageSize;  ?>   "><?php if(($CurPage+2)<=$pageNum)echo $CurPage+2; ?></a>
        <a href = "booklist.php?CurPage=<?php echo $CurPage+4;?> &recorders=<?php echo $pageSize;  ?>  "><?php if($CurPage<$pageNum-2)echo "…"; ?></a>
        <a href='booklist.php?CurPage=<?php if($CurPage<$pageNum){echo $CurPage+1;}else{echo $pageNum;}?>  &recorders=<?php echo $pageSize;  ?> '>  &gt;</a>&nbsp;
        <a href="booklist.php?CurPage=<?php  echo $CurPage>=$pageNum?$pageNum: $CurPage+1; ?>&recorders=<?php echo $pageSize;  ?>" title='下一页'>Next</a>  
        <a href ="booklist.php?CurPage=<?php echo $pageNum;?>&recorders=<?php echo $pageSize;  ?>"title='尾页'>End</a>
    </td>
    <td colspan="4"  >
        <input type = 'checkbox'  id='all' >All
        <input type = 'checkbox' onclick = 'reverse()' id ='res' >Rev
        <button onclick='moredel()' id = 'moredel' title='选定多个删除'>Remove</button>
        &nbsp;&nbsp;&nbsp;
        <span>
            <a href = '../cart/cart.php'  onclick =''>
                <img title='查看购物车' src = '../images/cart1.png' >
            </a>
        </span>
    </td>
</tr>
<tr bgcolor="#aaa">
    <td  ></td >
    <td colspan="8"  >
        To Page
        <!--行数需传回地址栏-->
        <input type="text" size="3" name='CurPage' class='CurPage' >
        &nbsp;
        <input type="text" size="3" name='recorders' value='' class='CurPage'  id ='pn'>/Page
        <input type="submit" value="Confirm" class="conf" >
    </td >
</tr>
</table>
<!--</form>-->
<script type="text/javascript">
var books =[];
function buybooks(book){
    books.push(book);
    books=unique4(books)
    alert('商品：'+books+' 已加入购物车');
    }
    function unique4(array){
     array.sort(); 
     var re=[array[0]];
     for(var i = 1; i < array.length; i++){
      if( array[i] !== re[re.length-1])
      {
       re.push(array[i]);
      }
     }
     return re;
}

$(document).ready(function(){
    $('.CurPage').val('1');
    $('#pn').val('<?php
    if(isset($_GET["recorders"])){   echo $_GET["recorders"];}else{  echo "1";}
     ?>')

    $("#all").click(function(){  $(".box>input:checkbox").prop('checked',this.checked);});

    $("#res").click(function(){
        $(".box>input:checkbox").each(function () { this.checked = !this.checked; });
    });

    $(".box").bind("click",function(event){
            event.stopPropagation();

    });
    $("#moredel").click(function(){
        var ids = [];
        $(".box>input:checked").each(function () {  
            ids.push(this.id); 
        });
        $.ajax({
            type:"POST",
            url: "more_del.php",
            dataType: "text",
            data:{"ids":ids},
            success:function(res){ 
             alert(res);
             window.location.href= "booklist.php?CurPage=1";
            },
            error:function(){   alert("error");}
        });

    });// moredel click


    $("tr.detail").not("#moredel").click(function(){
      window.location.href= 'selectBook.php?id_b='+this.id+'&CurPage='+this.title;
    });

    $(".conf").click(function(){  
      var CurPage = $('.CurPage:eq(0)').val();
      var recorders = $('.CurPage:eq(1)').val();
      window.location.href= 'booklist.php?CurPage='+CurPage+'&recorders='+recorders;
    });


});// document.ready

</script>
</body>
</html>