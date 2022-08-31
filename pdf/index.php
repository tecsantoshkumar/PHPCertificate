<!DOCTYPE html>
<html>
<head>
<script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.5/dist/html2canvas.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    body{
        padding: 0;
        margin: 0;
        
    }
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
</style>
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
<?php
$con=mysqli_connect("localhost","root","","mysite");
if (isset($_POST['submit'])) {
    $certificate_no = $_POST['certificate_no'];
    $res = mysqli_query($con, "select * from user_data where certificate_no='$certificate_no'");
if(mysqli_num_rows($res)>0){
    while ($row=mysqli_fetch_assoc($res)) {
        $name=$row['first_name']." ".$row['last_name'];
        $date=date(" jS \of F Y");
            $html = "<div class='col-md-12'><div id ='certificate' class='certificate'><img src='certificate.jpg' alt='not found'><h1>".$name . "</h1><p>" . $date. "</p></div></div>";
            echo $html;
        }
        $sql = "update user_data set certificate_status=1 where certificate_no='$certificate_no'";
        $res = mysqli_query($con, $sql);
        if ($res) {
            echo "Certificate Generated Successfully";
            echo "<button onclick='screenshot()'>Click to download</button>";
            echo "<a href='pdf.php?certificate_no=$certificate_no'>Click here to Download Certificates</a>";
        } else {
            echo "Error";
        }
    }
}
?>
<div>
        <h1>My Screenshot here</h1>
        <div id="myimage">

        </div>
</div>
    <script>
        function screenshot(){
            var content = document.getElementById("certificate");
            html2canvas(content).then(
                function(canvas){
                   document.getElementById("myimage").appendChild(canvas);
                }
            )
        }
    </script>