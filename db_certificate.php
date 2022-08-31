<?php
$con=mysqli_connect("localhost","root","","mysite");
$res=mysqli_query($con,"select * from user_data where certificate_status=0 limit 1");
if(mysqli_num_rows($res)>0){
	header('content-type:image/jpeg');
	$font="BRUSHSCI.TTF";
	$image=imagecreatefromjpeg("certificate.jpg");
	$color=imagecolorallocate($image,19,21,22);
	while($row=mysqli_fetch_assoc($res)){
		$name=$row['first_name']." ".$row['last_name'];
		imagettftext($image,50,0,365,420,$color,$font,$name);
		$date=date("d-m-Y");
		imagettftext($image,20,0,450,595,$color,"AGENCYR.TTF",$date);
		$file=time().'_'.$row['id'];
		imagejpeg($image,"certificate/".$file.".jpg");
		imagedestroy($image);
		mysqli_query($con,"update student set status=1 where id='".$row['id']."'");
	}
}
?>