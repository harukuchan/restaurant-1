<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
include('core/config.php');
include('source/mysource.php');
$p = new restaurant;
$conn =mysqli_connect('localhost','minhnghia','123456','restaurant');
$txt=mysqli_real_escape_string($conn,$_POST['txt']);
$sql="select reply from chatbot_hints where question like '%$txt%'";
$res=mysqli_query($conn,$sql);
if(mysqli_num_rows($res)>0){
	$row=mysqli_fetch_assoc($res);
	$html=$row['reply'];
}else{
	$html="Sorry not be able to understand you";
}
$added_on=date('Y-m-d h:i:s');
mysqli_query($conn,"insert into message(message,added_on,type) values('$txt','$added_on','user')");
$added_on=date('Y-m-d h:i:s');
mysqli_query($conn,"insert into message(message,added_on,type) values('$html','$added_on','bot')");
echo $html;
?>