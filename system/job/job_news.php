<div style="width: 100%;height:35px;background:#0094da;font-size:14px;font-weight:bold;color:#FFFFFF">
<div style="float:left;width:36px;height:35px;">
</div>
<div style="float:left;width:510px;padding-top:8px">
Nội dung tuyển dụng
</div>
<div style="float:left;width:165px;padding-top:8px">
Danh mục
</div>
<div style="float:left;width:80px;padding-top:8px">
Tỉnh
</div>
<div style="float:left;width:80px;padding-top:8px">
Ngày đăng
</div>
</div>
<?php
if($_REQUEST['nhucau']=='0')
{
    $where="and nhucau=0";
}
elseif($_REQUEST['nhucau']=='1')
{
    $where="and nhucau=1";
}
else
{
	$where="";
}
$uri=$_SERVER['REQUEST_URI'];
$url = explode("&", $uri);
$sql_pro_vip = "select * from job where vip=1 $where order by vip desc";
$result_vip = @mysql_query($sql_pro_vip,$con);
for($i=1;$i<=mysql_num_rows($result_vip)&&$row_pro_vip=@mysql_fetch_array($result_vip);$i++)
{
    $sql_cat_adv_vip=@mysql_query("SELECT name FROM job_cat where id='".$row_pro_vip['job_cat']."' ");
    $row_cat_adv_vip=@mysql_fetch_assoc($sql_cat_adv_vip);
    $sql_city_vip=@mysql_query("SELECT id,name FROM city where id='".$row_pro_vip['city']."' ");
    $row_city_vip=@mysql_fetch_assoc($sql_city_vip);
    if($i%2)
    {
        $color="#EAEAEA";
    }
    else
    {
        $color="#FFFFFF";
    }
    if($row_pro_vip['vip']=='1')
    {
        $bg="images/vip-icon.png";
    }
    else
    {
        $bg="images/icon_content_adv.png";
    }
?>
<div style="width: 100%;height:35px;padding-top:5px;background-color:<?php echo $color;?>">
<div style="float:left;width:36px;height:35px;background-image: url('<?php echo $bg;?>');">
</div>
<div style="float:left;width:510px;padding-top:8px">
<a href="./tuyen-dung/<?php echo doidau(mb_strtolower($row_pro_vip['name'],"UTF8"));?>-vn-<?php echo $row_pro_vip['id'];?>.html"><?php echo dwebvn($row_pro_vip['name'],12);?></a>
</div>
<div style="float:left;width:165px;padding-top:8px">
<?php echo $row_cat_adv_vip['name'];?>
</div>
<div style="float:left;width:120px;padding-top:8px">
<?php if($row_pro_vip['city']=='0'){?>Toàn quốc<?}else{?><?php echo $row_city_vip['name'];?><?}?>
</div>
<div style="float:left;width:80px;padding-top:8px">
<?php echo $row_pro_vip['date'];?>
</div>
</div>
<?}?>
<?php
$row=20;
$col=1;
$MAXPAGE=5;
$p=0;
if ($_REQUEST['p']!='') $p=$_REQUEST['p'];
$sql_pro = "select * from job where vip=0 $where order by upvip desc limit ".$row*$col*$p.",".$row*$col;
$result = @mysql_query($sql_pro,$con);
$total=demsql("job");
for($j=1;$j<=$row&&$row_pro=@mysql_fetch_array($result);$j++)
{
    $sql_cat_adv=@mysql_query("SELECT name FROM job_cat where id='".$row_pro['job_cat']."' ");
    $row_cat_adv=@mysql_fetch_assoc($sql_cat_adv);
    $sql_city=@mysql_query("SELECT id,name FROM city where id='".$row_pro['city']."' ");
    $row_city=@mysql_fetch_assoc($sql_city);
    if($j%2)
    {
        $color="#EAEAEA";
    }
    else
    {
        $color="#FFFFFF";
    }
    if($row_pro['vip']=='1')
    {
        $bg="images/vip-icon.png";
    }
    else
    {
        $bg="images/icon_content_adv.png";
    }
?>
<div style="width: 100%;height:35px;padding-top:5px;background-color:<?php echo $color;?>">
<div style="float:left;width:36px;height:35px;background-image: url('<?php echo $bg;?>');">
</div>
<div style="float:left;width:510px;padding-top:8px">
<a href="./tuyen-dung/<?php echo doidau(mb_strtolower($row_pro['name'],"UTF8"));?>-vn-<?php echo $row_pro['id'];?>.html"><?php echo dwebvn($row_pro['name'],12);?></a>
</div>
<div style="float:left;width:165px;padding-top:8px">
<?php echo $row_cat_adv['name'];?>
</div>
<div style="float:left;width:120px;padding-top:8px">
<?php if($row_pro['city']=='0'){?>Toàn quốc<?}else{?><?php echo $row_city['name'];?><?}?>
</div>
<div style="float:left;width:80px;padding-top:8px">
<?php echo $row_pro['date'];?>
</div>
</div>
<?}?>

<? if ($total>0) { ?>
<div style="clear:both;height:10px;padding-top:5px">
<hr color="#E9E9E9" width="100%" SIZE=1 align="center">
</div>
<div class="">
<TABLE bgcolor="#FFFFFF" cellSpacing=10 cellPadding=0 width="100%" border=0 id="table35" style="line-height: 120%; text-align: justify" align="center">
<?
$pages=count_page($total,($row*$col));
echo '<tr><td class="smallfont" align="left" >
'.$total.'</b> Tuyển Dụng</td>';
echo '<td class="smallfont" align="right">';
$param="";
if ($p>1) echo '<a class="buton_timkiem" title="&#272;&#7847;u tiên" href="'.$uri.'&p=0">&lt;</a> ';
if ($p>0) echo '<a class="buton_timkiem" title="V&#7873; tr&#432;&#7899;c" href="'.$uri.'&p='.($p-1).'">&lt;&lt;</a> ';
$from=($p-5>0?$p-1:0);
$to=($p+5<$pages?$p+5:$pages);
for ($i=$from;$i<$to;$i++)
{
	if ($i!=$p) echo '<a href="'.$uri.'&p='.$i.'">'.($i+1).'</a> ';
	else echo '<a class="active1">'.($i+1).'</a> ';
}
if ($p<$i-1) echo '<a class="buton_timkiem" title="Ti&#7871;p theo" href="'.$uri.'&p='.($p+1).'">&gt;&gt;</a> ';
if ($p<$pages-1) echo '<a class="buton_timkiem" title="Cu&#7889;i cùng" href="'.$uri.'&p='.($pages-1).'">&gt;</a>'; 
echo '</td></tr></table>';
?>

</div>
<?
}
?>