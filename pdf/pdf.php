<?php
require('vendor/autoload.php');
$con = mysqli_connect('localhost', 'root', '', 'mysite');
$certificate_no = $_GET['certificate_no'];
$res = mysqli_query($con, "select * from user_data where certificate_no='$certificate_no'");
if (mysqli_num_rows($res) > 0) {
	$html = '<style>
	.col-md-12 {
		margin-left: 22vw;
	}
	.certificate {
		margin: 0vh 12vw;
	}
	img {
		width: 63%;
		height: 63%;
	}
	h1 {
		margin-top: -28vh;
		margin-left: 9vw;
		font-style: italic;
	}
	p {
		margin-left: 14vw;
		margin-top: 7vh;
	}
	</style>';
	while ($row = mysqli_fetch_assoc($res)) {
		$name = $row['first_name'] . " " . $row['last_name'];
		$date = date(" jS \of F Y");
		$html = "<div class='col-md-12'><div class='certificate'><img src='certificate.jpg' alt='not found'><h1>" . $name . "</h1><p>" . $date . "</p></div></div>";
	}
} else {
	$html = "Data not found";
}
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
$file = 'media/' . time() . '.pdf';
$mpdf->output($file, 'I');
//D
//I
//F
//S
?>
<?php
if (mysqli_num_rows($res) > 0) {
}
