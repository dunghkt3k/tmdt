<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="mobile_home/template/js/load_tem.js"></script>
<div id="wrapper">
            <script type="text/javascript">
    $(function () {
        $($(".skins-by-category")[0]).removeClass("hidden1").addClass("show");

        addSwiperWidget();
    });

    function addSwiperWidget() {
        var mySwiper = new Swiper('.swiper-container', {
            loop: true,
            grabCursor: true,
            onSlideChangeEnd: (function (swiper, direction) {
                var currentIconChoosePos = $(".icon-container").find(".swiper-slide-active").attr("pos");

                showSkinByPosition(currentIconChoosePos);
            })
        })

        $('.arrow-left').on('click', function (e) {
            e.preventDefault()
            mySwiper.swipePrev()
        });

        $('.arrow-right').on('click', function (e) {
            e.preventDefault()
            mySwiper.swipeNext()
        });
    }

    function showSkinByPosition(position) {
        hideCurrentTitle();

        shownTitleByPosition(position);

        hideCurrentSkinCategory();

        shownSkinCategoryByPosition(position);

        return false;
    }

    function hideCurrentTitle() {
        var currentDesc = $("#title-container div.show");
        $(currentDesc).fadeOut(150);
        $(currentDesc).removeClass("show").addClass("hidden1");
    }

    function hideCurrentSkinCategory() {
        var currentCategory = $("#category-container div.show");
        $(currentCategory).fadeOut(150);
        $(currentCategory).removeClass("show").addClass("hidden1");
    }

    function shownTitleByPosition(position) {
        var nextDesc = $("#title_" + position);
        $(nextDesc).fadeIn(300);
        $(nextDesc).removeClass("hidden1").addClass("show");
    }

    function shownSkinCategoryByPosition(position) {
        var nextCategory = $("#skincategory_" + position);
        $(nextCategory).fadeIn(300);
        $(nextCategory).removeClass("hidden1").addClass("show");
    } 
</script>

<?
$uri=$_SERVER['REQUEST_URI'];
$url = explode("&", $uri);
$row=24;
$MAXPAGE=10;
$name=$_GET['name'];
$p=0;
if ($_REQUEST['p']!='') $p=$_REQUEST['p'];
$sql = "select * from orders where user_mem='".$_SESSION['mem']."'  and kichhoat = '1'   order by orders_id  desc limit ".$row*$p.",".$row;
$result = @mysql_query($sql,$con);
$total=CountRecord("orders");
?>
 

<div id="index-skins">
    <div class="div-title">
        <h1 class="h3-tittle-uppercase"><b>T???ng ????n h??ng: <b style="color: red;"><?php echo $total;?></b></b></h1>
    </div>
    <div class="skins-home-items">
        <div class="icon-container">
            <a class="arrow-left">
                <img src="mobile_home/template/images/left_arrow_dark.png" alt="">
            </a>
            <a class="arrow-right">
                <img src="mobile_home/template/images/right_arrow_dark.png" alt="">
            </a>
            <div class="swiper-container" style="cursor: -webkit-grab;">
                <div class="swiper-wrapper" style="width: 13170px; height: 55px; transform: translate3d(-2634px, 0px, 0px); -webkit-transform: translate3d(-2634px, 0px, 0px); transition-duration: 0.3s; -webkit-transition-duration: 0.3s;">
<?php
$sql_t1=mysql_query("SELECT * FROM orders where user_mem='".$_SESSION['mem']."' and kichhoat = '1'   order by orders_id DESC");
$toalt1=mysql_num_rows($sql_t1);
$tong1=$toalt1/6;
for($i=0;$i<=$tong1&&$row_t1=mysql_fetch_array($sql_t1);$i++)
{?>
                    <div class="swiper-slide" pos="<?php echo $i;?>" style="width: 1317px; height: 55px;">
                        <div class="group-content">
                            <div class="group-icon">
                                <img src="mobile_home/template/images/next_tem.png" alt="">
                            </div>
                        </div>
                    </div>
<?}?> 
                    </div>
            </div>
        </div>
        <div id="title-container" class="group">
            <div class="group-content">
                <div class="group-desc">
<?php
$sql_t2=mysql_query("SELECT * FROM orders where user_mem='".$_SESSION['mem']."' and kichhoat = '1'  order by orders_id DESC");
$toalt2=mysql_num_rows($sql_t2);
$tong2=$toalt2/6;
for($j=0;$j<=$tong2&&$row_t2=mysql_fetch_array($sql_t2);$j++)
{?>
                    <div id="title_<?php echo $j;?>" class="desc-item hidden" style="display: none;">
                        <div class="tittle">
                            Trang <?php echo $j;?>
                        </div>
                    </div>
<?}?>
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <div id="category-container">
<?php
$sql_t3=mysql_query("SELECT * FROM orders where user_mem='".$_SESSION['mem']."' and kichhoat = '1' order by orders_id DESC");
$toalt3=mysql_num_rows($sql_t3);
$tong3=$toalt3/6;
for($k=0;$k<=$tong3;$k++)
{?>
                <div id="skincategory_<?php echo $k;?>" class="skins-by-category hidden1">
<?php
for($l=0;$l<=5&&$row_t3=mysql_fetch_array($sql_t3);$l++)
{?>
<?php
$timid=mysql_query("SELECT * FROM orderdetail where user_mem='".$_SESSION['mem']."'  and ordersdetail_ordersid='".$row_t3['orders_id']."' ");
$timid_in=mysql_fetch_assoc($timid);

$timid_sp=mysql_query("SELECT * FROM products where  id='".$timid_in['ordersdetail_product_id']."' ");
$timid_in_sp=mysql_fetch_assoc($timid_sp);
?>
      <form method="POST">
	  <div class="skins-item">
                            <div class="skins-item-thumbnail" style=" padding: 5px; "> 
                                

                                <div style=" float: left; ">
								
								<img  src="<?php echo $timid_in_sp['image'];?>" width="80px" height="80px" >
								</div>	
								 <b style=" float: left; font-size: 10px;    color: red;">&nbsp;<?php echo substr($timid_in_sp['name'],0,46);?>...</b> 
								 <br>
								 <b style=" float: left;font-size: 10px;    text-align: left; "> 
								 &nbsp;Ng??y:<?php echo $row_t3['orders_date'];?>
								  <b style=" float: right;font-size: 10px;    color: red; ">M??:<?php echo $row_t3['orders_id'];?></b>
								 <br>
								 &nbsp;Shop:<b style=" color: blue; "><?php echo $timid_in_sp['user'];?></b>
								  <br>
								   &nbsp;M??u s???c: <span style="background-color: #<?php echo $row_t3['mausac'];?>; outline: 1px solid #ccc;"><a href="java:">&nbsp;&nbsp;&nbsp;&nbsp;</a> </span>
					<?if($row_t3['kichthuoc']==""){?>	
					<?}else{?>
					  &nbsp;K??ch th?????c:<?php echo $row_t3['kichthuoc'];?>
					<?}?>
								
								    <br>
								  &nbsp;Status:
								  
								  
								  <?if($row_t3['active']=='0'){?>	
			<?
// x??a ???nh 1 baner
if (isset($_POST['huydonhang'])) {
	$active = $_POST['active'];
    $thongbao= '????n h??ng s??? '.$row_t3['orders_id'].' ???? b??? H???y b???i ng?????i mua';
date_default_timezone_set("Asia/Ho_Chi_Minh");
$date = date("d-m-Y H:i:s");
	

			
	
	$sql1111 = "update orders set active='5', active_shop='5' where orders_id='".$active."' and  user_mem='".$_SESSION['mem']."' ";
	
     if (mysql_query($sql1111)) {
			
			//$active = $_SESSION['active_id'];
				echo "<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."';
    </SCRIPT>";
		}	
		else {
				echo "<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Thao t??c kh??ng th??nh c??ng')
    window.location.href='http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."';
    </SCRIPT>";
		}
	
	if($row_t3['orders_id']== $active){	
	
				$sql_huy = "insert into thongbao (thongbao,date,user) values ('".$thongbao."' ,'".$date."','".$_SESSION['mem']."'  ) ";
				$sql_huy_shop = "insert into thongbao_shop (thongbao,date,user) values ('".$thongbao."' ,'".$date."','".$row_t3['orders_user']."'  ) ";
						if (mysql_query($sql_huy) && mysql_query($sql_huy_shop)) {
			
			//$active = $_SESSION['active_id'];
				echo "<SCRIPT LANGUAGE='JavaScript'>
   
    window.location.href='http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."';
    </SCRIPT>";
		}	
		else {
				echo "<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Thao t??c kh??ng th??nh c??ng')
    window.location.href='http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."';
    </SCRIPT>";
		}
					}else{
					}
					
		
  	


}	
?>						  				 

					<span style="background: #04a89f; padding: 1px; color: #fff; display: inline-block;">Ch??? duy???t</span>
					<input type="hidden" name="active" value="<?php echo $row_t3['orders_id'];?>">
				    <button  type="submit" name="huydonhang" onclick="return confirm('B???n ch???c ch???n h???y b??? ????n h??ng n??y');" style="font-size: 10px;background: #999999; padding: 1px; color: #fff; display: inline-block;">H???y</button>
						</form>	
					<?}else{?>
					<?}?>
					
					<?if($row_t3['active']=='1'){?>	
					<span style="background: #0e04a8; padding: 1px; color: #fff; display: inline-block;    ">??ang giao h??ng</span>
					<?}else{?>
					<?}?>
					<?if( ($row_t3['active']=='2') ) {?>	

					<span style="background: #0f8800; padding: 1px; color: #fff; display: inline-block;   ">???? giao</span>
					
					<?}else{?>
					<?}?>
					
					<?if($row_t3['active']=='20'){?>	
					<span style="background: #0f8800; padding: 1px; color: #fff; display: inline-block;   ">Kh??ch ???? nh???n h??ng v?? ????nh gi??</span>
					<?}else{?>
					<?}?>
					
					<?if($row_t3['active']=='3'){?>	
					<span style="background: #d020a2; padding: 1px; color: #fff; display: inline-block;    ">Kh??ch kh??ng nh???n h??ng</span>
					<?}else{?>
					<?}?>
														
					<?if($row_t3['active']=='4'){?>	
					<span style="background: #000000; padding: 1px; color: #fff; display: inline-block;   ">Chuy???n v??? cho Shop</span>
					<?}else{?>
					<?}?>
					
					<?if($row_t3['active']=='5'){?>	
					<span style="background: #999999; padding: 1px; color: #fff; display: inline-block;    ">???? h???y ????n h??ng</span>
					<?}else{?>
					<?}?>
					
					<?if($row_t3['active']=='6'){?>	
					<span style="background: #F44336; padding: 1px; color: #fff; display: inline-block;    ">H???t h??ng</span>
					<?}else{?>
					<?}?>
					
					<?if($row_t3['active']=='2'){?>	
					<a   onclick="return confirm('Kh??ng h??? tr??? ????nh gi?? tr??n ??i???n tho???i.Kh??ch h??ng vui l??ng truy c???p b???ng M??y vi t??nh ho???c Laptop ????? ????nh gi?? s???n ph???m n??y');" style="background: #F44336; padding: 1px; color: #fff; display: inline-block;    ">????nh gi??</a>
					<?}else{?>
					<?}?>
					<?if($row_t3['active']=='2'){?>	
					<a   onclick="return confirm('Kh??ng h??? tr??? khi???u n???i tr??n ??i???n tho???i.Kh??ch h??ng vui l??ng truy c???p b???ng M??y vi t??nh ho???c Laptop ????? khi???u n???i ????n h??ng n??y');" style="background: blue; padding: 1px; color: #fff; display: inline-block;    ">Khi???u n???i</a>
					<?}else{?>
					<?}?>
								  
					 <br>
					 <? 
					 $thanhtoan = ($timid_in['ordersdetail_price']*$timid_in['ordersdetail_quantity'] + $timid_in['phivanchuyen'] - $timid_in['trudiemlua'])
					 
					 ?>
					 &nbsp;Gi??:<b style=" color: blue; "><?php echo number_format($thanhtoan);?>?? </b>	
					
								(SL:<?php echo $timid_in['ordersdetail_quantity'];?>,PVC: <?php echo number_format($timid_in['phivanchuyen']);?>??)
								 </b>
								
							
								 
								
							
                            </div>
							
                            
                        </div>
<?}?>
               </div>
<?}?> 
        </div>
        <div class="clear"></div>
    </div>
</div>

        </div>
