<?
echo $_SESSION["session_message"];
$_SESSION["session_message"] = "";
$MAXPAGE=20;
?>
<table height="28" cellSpacing="0" cellPadding="0" width="100%" border="0">
      <tr align=center>
        <td class="title" width="100%">Option : <a href="./?act=option_m&page=<? echo $page?>&cat=<? echo $_REQUEST['cat']; ?>"><font class="V10pt" color="#ffffff">Nh&#7853;p M&#7899;i</font></a>&nbsp;&nbsp;
	</td>
      </tr>
    </table>
<?
	switch ($_GET['action'])
	{
		case 'del' :
			$id = $_GET['id'];
			$pro=GetOptionInfo($id);
			if ($pro)
			{
				$sql = "delete from option_home where id='".$id."'";
				$result = mysql_query($sql,$con);
				if ($result) 
				{

					echo "<p align=center class='err'>&#272;ã xóa thành công</p>";
				}
					else echo "<p align=center class='err'>Không th&#7875; xóa d&#7919; li&#7879;u</p>";
			}
			break;
	}
?>

<?
	if (isset($_POST['ButDel'])) {
		$cnt=0;
		foreach ($_POST['chk'] as $id)
		{
			$pro=GetOptionInfo($id);
			if ($pro)
			{
				@$result = mysql_query("delete from option_home where id='".$id."'",$con);
				if ($result) {
					$cnt++;

				}
			}
		}
		echo "<p align=center class='err'>&#272;ã xóa ".$cnt." ph&#7847;n t&#7917;</p>";
	}
	
	
	


?>

<?
	$page = $_GET["page"];
	$p=0;
	if ($page!='') $p=$page;
	$where="1=1";
	//if ($_REQUEST['status']!='') $where="products_status=".$_REQUEST['status']." ";
	if ($_REQUEST['cat']!='') $where="cat_id=".$_REQUEST['cat'];
?>
<form method="POST" name="frmList" action="index.php">
<input type=hidden name="page" value="<? echo $page; ?>">
<?
function taotrang($total,$link,$nitem,$itemcurrent,$step=10)
{	global $con;
	$ret="";
	
	$param="";
	$pages=count_page($total,$nitem);
	if ($itemcurrent>0) $ret.='<a title="&#272;&#7847;u tiên" href="'.$link.'0" class="lslink">[&lt;]</a> ';
	if ($itemcurrent>1) $ret.='<a title="V&#7873; tr&#432;&#7899;c" href="'.$link.($itemcurrent-1).'" class="lslink">[&lt;&lt;]</a> ';
	$from=($itemcurrent-$step>0?$itemcurrent-$step:0);
	$to=($itemcurrent+$step<$pages?$itemcurrent+$step:$pages);
	for ($i=$from;$i<$to;$i++)
	{
		if ($i!=$itemcurrent) $ret.='<a href="'.$link.$i.'" class="lslink">'.($i+1).'</a> ';
		else $ret.='<b>'.($i+1).'</b> ';
	}
	if (($itemcurrent<$pages-2) && ($pages>1)) $ret.='<a title="Ti&#7871;p theo" href="'.$link.($itemcurrent+1).'">[&gt;&gt;]</a> ';
	if ($itemcurrent<$pages-1) $ret.='<a title="Cu&#7889;i cùng" href="'.$link.($pages-1).'">[&gt;]</a>'; 
	return $ret;
}

	$pageindex=taotrang(CountRecord("option_home",$where),"./?act=option&cat=".$_REQUEST['cat']."&page=",$MAXPAGE,$page);
?>

<table cellspacing="0" cellpadding="0" width="100%">
<? if ($_REQUEST['code']==1) echo '<tr><td colspan="2" align="center" class="err">&#272;ã c&#7853;p nh&#7853;t thành công</td></tr>'; ?>
<tr>
<td class="smallfont">Trang : <? echo $pageindex; ?></td>
<td height="30" align="right" class="smallfont">
	<select size="1" name="ddCat" class="smallfont">
<?
	$ms=GetListCat(17);
	echo '<option value="">[T&#7845;t c&#7843;]</option>';
	foreach ($ms as $m)
		if ($m[0]!=$_REQUEST['cat'])
			echo '<option value="'.$m[0].'">'.$m[1].'</option>';
		else
			echo '<option selected value="'.$m[0].'">'.$m[1].'</option>';
?>
	</select> 
	<input type="button" value="Chuy&#7875;n" class="button" onclick="window.location='./?act=option&cat='+ddCat.value">
	</td>
</tr>
</table>
<!-- end tim kiem -->
</td>
</tr>
</table>

<table border="1" cellpadding="2" style="border-collapse: collapse" bordercolor="#C9C9C9" width="100%" id="AutoNumber1">
  <tr>
    <td align=center nowrap class="title"><input type="checkbox" name="chkall" onclick="chkallClick(this);"></td>
    <td colspan="2" nowrap class="title">&nbsp;</td>
    <td align="center" nowrap class="title"><b>ID</b></td>
	<td align="center" nowrap class="title"><b>Thứ tự</b></td>
	 <td align="center" nowrap class="title"><b>Tên </b></td>
	 <td align="center" nowrap class="title"><b>Thông số sau</b></td>
<td align="center" nowrap class="title"><b>Danh m&#7909;c</b></td>
<td align="center" nowrap class="title"><b>Kiểu</b></td>

  </tr>
  
  <?php
           	$sql="select * from option_home where $where order by id limit ".($p*$MAXPAGE).",".$MAXPAGE;
        	$result=mysql_query($sql,$con);
        	$i=0;
           	while(($row=mysql_fetch_array($result)))
			{
			$i++;
			if ($i%2) $color="#d5d5d5"; else $color="#e5e5e5";
			$cat_system=GetCatInfo($row['cat_id']);
  ?>
  
  <tr>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <input type="checkbox" name="chk[]" value="<? echo $row['id']; ?>"></td>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <a href="./?act=option_m&cat=<? echo $_REQUEST['cat']; ?>&status=<? echo $_REQUEST['status']; ?>&id=<? echo $row['id']; ?>&page=<? echo $page?>">S&#7917;a</a></td>
    <td align="center" bgcolor="<? echo $color; ?>" class="smallfont">
    <a onclick="return confirm('B&#7841;n có ch&#7855;c ch&#7855;n mu&#7889;n xoá ?');" href="./?act=option&action=del&cat=<? echo $_REQUEST['cat']; ?>&status=<? echo $_REQUEST['status']; ?>&id=<? echo $row['id']; ?>">Xoá</a></td>
    <td bgcolor="<? echo $color; ?>" align="left" align="left" class="smallfont"><? echo $row['id']; ?>&nbsp;</td>
	<td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['thutu']; ?>&nbsp;</td>
	<td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['name']; ?>&nbsp;</td>
	<td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['doituong']; ?>&nbsp;</td>
	<td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $cat_system['name']; ?>&nbsp;</td>
    <td bgcolor="<? echo $color; ?>" class="smallfont"><? echo $row['option_home']; ?>&nbsp;</td>

  </tr>
  <?
              	}
  ?>
</table>
<input type="hidden" name="act" value="option"><table border="0" width="100%" cellspacing="0" cellpadding="0" id="table1">
	<tr>
		<td>
<input type="submit" value="Xóa Ch&#7885;n" name="ButDel" onclick="return confirm('B&#7841;n có ch&#7855;c ch&#7855;n mu&#7889;n xoá ?');" class="button"></td>
	</tr>
</table>
</form>
<script language="JavaScript">
function chkallClick(o) {
  	var form = document.frmList;
	for (var i = 0; i < form.elements.length; i++) {
		if (form.elements[i].type == "checkbox" && form.elements[i].name!="chkall") {
			form.elements[i].checked = document.frmList.chkall.checked;
		}
	}
}
</script>