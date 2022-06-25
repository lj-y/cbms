<?php
// 换链接
require('../conn.php');
$id_b= $_GET['id_b'];
$CurPage= $_GET['CurPage'];
$sql = "select * from $tableName where id_b=$id_b";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($result);
mysqli_free_result($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type = "text/javascript" src = "/lib/jquery/jquery.js" ></script>
<title>编辑图书</title>
<style>
	*{
		//margin:0px  auto;
		//padding:0px;
		//border: 0px solid green;
		}
		
  #disf{
   //  display: none; 
  }
  span{
     /*display: none;*/
}
  .pic{
    margin:5px;
    padding: 5px;
    border: 1px solid gray;
    width: 200px;
    height: 160px;
  }
  .picture{  float:left;}
 
  .tabde{
      border:1px solid green;
      }
	.id_hid{  display: none; }
	.c{ clear:both; }

</style>
</head>
<body>
<form action="saveBook.php" method="get" id="firf">
<table width="481" height="154" border="0">
  <tr>
    <td width="83">品名：</td>
    <td width="267"><input name="bookname" type="text" value="<? echo $row['name']; ?>" readonly="readonly"></td>
  </tr>
  <tr>
    <td>价格：</td>
    <td><input type="text"  name="price" value="<? echo $row['price']; ?>" readonly="readonly"> 元</td>
  </tr>
  <tr>
    <td>编号:</td>
    <td><input type="text"  name="isbn" value="<? echo $row['isbn']; ?>" readonly="readonly"></td>
  </tr>
  <tr>
    <td>用户:</td>
    <td><input type="text"  name="user" value="<? echo $row['user']; ?>" readonly="readonly"></td>
  <tr class="id_hid">
    <td > <input type="text" name="id_b" value="<?php echo $row['id_b'];?>" readonly="readonly"></td>
	 <td> <input type="text" name="CurPage" value="<?php echo $CurPage;?>"></td>
  </tr>
  </tr>
    <td><a href=""><span>详细资料</span></a></td>
    <!-- <td><input type="submit" value="确认"></td> -->
  </tr>
</table>
</form>
<hr>
<form action="../detail/do_detail.php?CurPage=<?php echo $CurPage;?>" method="post" id="disf" enctype="multipart/form-data">
  <div >
	  <div>简要介绍：</div>
	  <div>
		  <textarea name="detail" id="" cols="30" rows="10" readonly="readonly"><?php echo $row['detail'];?></textarea>
	  </div>
<?php 
    //上传前取得图片字段img
    $arr = explode('|',$row['img']);   
      echo "当前图片数量：".  $num = count($arr)-1;
      echo "<hr>";
      
    if($num>0){  
        for($i=0;$i<$num;$i++){
           // 显示图片
            if( $i%3==0 ){   echo "<div>"; }
           echo "<div class ='picture'>
               <div><img class='pic' src='../images/".$arr[$i]."'  /></div>";
           // echo     "<div class = 'good_del' id= '$id_b/$i'>删除</div>
            echo "  </div>";
         
  //换行
        // 最后一幅图片，并且非倍数。
       if(  $i%3!=0 && $i == $num-1){ echo "</div>"; }
    } // end if
           if( ($i+1)%3==0 && $i !=0 ){   echo "</div>"; }  
           


        } // end for   
      

 ?>
  <div class="id_hid"><input type="text" name="id_b" value="<?php echo $row['id_b'];?>"></div>
  </div>
  <div class='c'>
<!--   <div><input type="file" value="上传图片" name="file" class="upimg"></div>
  <div><input type="submit" value="确定" class="confirm"><input type="reset" value="重置"></div> -->
  </div>
</form>
<script>
 $(function(){
   // $('#disf').hidden();
})
	$(function(){
	   $('span').click(function(){
	      $('#disf').toggle();
	      return false;
	    });
	  
	// 删除图片 记录行号 img序号  排除上传input
	  // $('input').not('.upimg').click(function(){
	  $('.good_del').click(function(){
	    $.ajax({
	      type:"POST",
	      url: "goods_del.php",
	      dataType: "text",
	      data:{"id":this.id},
	      success:function(res){ 
	       alert(res);
	      history.go(0);
	      // location.replace(location) ;
	      },
	      error:function(){ alert("error");}
	    });//$.ajax
	  }); //del
	    
	})  //$(function) 
</script>
</body>
</html>