<div id="pro_noidung">
<div id="pro_banchay_title">
SẢN PHẨM MỚI
</div>

<div id="pro_banchay content">
<? 
$hang=5;
$cot=3;
$sql2=mysql_query("SELECT * FROM products where user='".$user."' and new=0 order by id asc limit 12");?>
<? for($i=1;$i<=$cot;$i++)
 {?>
<div id="pro_banchay_content_bang">

<?
	for($j=1;$j<=$hang&&$row2=mysql_fetch_array($sql2);$j++)
	{?>
	<?if($domain=='')
		{?>
	<div id="pro_banchay_content_bang_pro">
	<li>
	<a href="./<? echo $user;?>/products/<? echo $row2['id']; ?>/<? echo $row2['cat_mem']; ?>/<? echo str_replace($marTViet,$marKoDau,$row2['name']); ?>.html">
	<img src="<? echo $row2['image'];?>" width="155" height="105">
	</a>
	</li>
	<li class="pro_banchay_content_bang_pro_name">
	<? echo $row2['name'];?>
	</li>
	<li class="gia">
	<? echo dwebvn($row2['short'],10);?>
	</li>
	<li class="pro_banchay_mua">
	<span style="float:left;margin-top:5px;margin-left:3px;font-size:11px; font-weight:bold; color:#FFFFFF">
	<? if ($row2['price']<=0) echo 'Liên hệ'; else echo number_format($row2['price']).' VNĐ'; ?>
	</span>
	<span style="float:right;margin-top:5px; margin-right:10px;">
	<a href="./<? echo $user;?>/mua-hang/<? echo $row2['id'];?>.html"><font color="#FFFFFF">MUA</font></a>
	</span>
	</li>
	</div>

	<?}else{?>
	<div id="pro_banchay_content_bang_pro">
	<li>
	<a href="./products/<? echo $row2['id']; ?>/<? echo $row2['cat_mem']; ?>/<? echo str_replace($marTViet,$marKoDau,$row2['name']); ?>.html">
	<img src="<? echo $row2['image'];?>" width="155" height="105">
	</a>
	</li>
	<li class="pro_banchay_content_bang_pro_name">
	<? echo $row2['name'];?>
	</li>
	<li class="gia">
	<? echo dwebvn($row2['short'],10);?>
	</li>
	<li class="pro_banchay_mua">
	<span style="float:left;margin-top:5px;margin-left:3px;font-size:11px; font-weight:bold; color:#FFFFFF">
	<? if ($row2['price']<=0) echo 'Liên hệ'; else echo number_format($row2['price']).' VNĐ'; ?>
	</span>
	<span style="float:right;margin-top:5px; margin-right:10px;">
	<a href="./mua-hang/<? echo $row2['id'];?>.html"><font color="#FFFFFF">MUA</font></a>
	</span>
	</li>
	</div>
	<?}?>

<?}?>
</div>
<div class="space"></div>
<?}?>





</div>

</div>