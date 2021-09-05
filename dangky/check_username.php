<?php
###### db ##########
$db_username = 'root';
$db_password = '';
$db_name = 'data';
$db_host = 'localhost';
################


//check we have username post var
if(isset($_POST["username"]))
{
	//check if its ajax request, exit script if its not
	if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
		die();
	}
	
	//try connect to db
	$connecDB = mysqli_connect($db_host, $db_username, $db_password,$db_name)or die('could not connect to database');
	
	//trim and lowercase username
	$username =  strtolower(trim($_POST["username"])); 
	
	//sanitize username
	$username = filter_var($username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
	
	//check username in db
	$results = mysqli_query($connecDB,"SELECT user FROM thanhvien WHERE user='$username'");
	
	//return total count
	$username_exist = mysqli_num_rows($results); //total records
	
	//if value is more than 0, username is not available
	if($username_exist) {
		die('<b style="color:red;">Tên tài khoản đã có người sử dụng, vui lòng chọn tên khác</b>');
	}else{
		die('<b style="color:blue;">Tên tài khoản có thể sử dụng</b>');
	}
	
	//close db connection
	mysqli_close($connecDB);
}
?>

