<?
$hang=5;
$sql_news_top=mysql_query("SELECT * FROM news where user='".$user."' and top=1 limit 7 ");?>
<div class="category_title">Tin nổi bật</div>
<div id="news_top">
<? for($i=1;$i<=$hang&&$row_news=mysql_fetch_array($sql_news_top);$i++)
{?>
<div class="news_top">

<div class="news_top_anh">
<?if($domain=='')
	{?>
<a href="./<? echo $user;?>/news-views/<? echo $row_news['id']; ?>/<? echo $row_news['cat_id']; ?>/<? echo str_replace($marTViet,$marKoDau,$row_news['name']); ?>.html">
<img src="<? echo $row_news['image'];?>" width="90" height="80">
</a>
<?}else{?>
<a href="./news-views/<? echo $row_news['id']; ?>/<? echo $row_news['cat_id']; ?>/<? echo str_replace($marTViet,$marKoDau,$row_news['name']); ?>.html">
<img src="<? echo $row_news['image'];?>" width="90" height="80">
</a>
<?}?>
</div>
<div class="news_top_tieude">
<? echo $row_news['name'];?>
</div>

</div>
<div class="news_top_line"></div>
<?}?>
</div>