<?php
$con = mysqli_connect("localhost", "root", "", "mysite");
if (isset($_POST['submit'])) {
    $certificate_no = $_POST['certificate_no'];
    $res = mysqli_query($con, "select * from user_data where certificate_no='$certificate_no'");

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            header('content-type:image/jpeg');
            $name = $row['first_name'] . " " . $row['last_name'];
            $date = date(" jS \of F Y");
            $font = "BRUSHSCI.TTF";
            $image = imagecreatefromjpeg("certificate.jpg");
            $color = imagecolorallocate($image, 19, 21, 22);
            imagettftext($image, 45, 0, 320, 450, $color, $font, $name);
            imagettftext($image, 20, 0, 450, 600, $color, "AGENCYR.TTF", $date);
            $file = $name;
            $file_path = "certificate/" . $file . ".jpg";
            $file_path_pdf = "certificate/" . $file . ".pdf";
            imagejpeg($image, $file_path);
            imagedestroy($image);

            require('fpdf.php');
            $pdf = new FPDF();
            $pdf->AddPage();
            $pdf->Image($file_path, 0, 0, 210, 150);
            $pdf->Output($file_path_pdf, "F");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificates</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <form action="" method="POST">
                <input type="text" name="certificate_no" placeholder="Enter your certificate no">
                <input type="submit" name="submit" value="Generate Certificate">
            </form>
        </div>
    </div>
</body>

</html>