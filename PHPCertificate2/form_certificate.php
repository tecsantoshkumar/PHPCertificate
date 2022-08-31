<?php
if(isset($_POST['name'])){
	$font="BRUSHSCI.TTF";
	$image=imagecreatefromjpeg("certificate.jpg");
	$color=imagecolorallocate($image,19,21,22);
	$name="santosh";
	imagettftext($image,50,0,365,420,$color,$font,$_POST['name']);
	$date="6th may 2020";
	imagettftext($image,20,0,450,595,$color,"AGENCYR.TTF",$date);
	$file=time();
	$file_path="certificate/".$file.".jpg";
	$file_path_pdf="certificate/".$file.".pdf";
	imagejpeg($image,$file_path);
	imagedestroy($image);

	require('fpdf.php');
	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->Image($file_path,0,0,210,150);
	$pdf->Output($file_path_pdf,"F");
}
?>
<form method="post">
	<input type="textbox" name="name"/>
	<input type="email" name="email" placeholder="Enter email"/>
	<input type="submit"/>
</form>