<?php
session_start();
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "music";
$linkfile = 'http://localhost/Music-Streaming/play.php?artist=';
$linksong = 'http://localhost/Music-Streaming/play.php?song=';
$conn = new mysqli($serverName,$username,$password,$dbName);
if(isset($_POST['signUp'])){
    $name = $_POST['name'];
    $phone = 2122;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $_SESSION['dataTemp'] = ["name"=>$name,"phone"=>$phone,"email"=>$email,"password"=>$password];
    
    // $insertQuery = "insert into user(name,email,password,phone) values('$name','$email','$password','$phone')";
    // $conn->query($insertQuery);


       header('Location: http://localhost/Music-Streaming/sendmail.php?email='.$email);


    // header('http://localhost/Music-Streaming/otp.php');
  }
  else if(isset($_POST['otp'])){
        $otp = $_POST['otp'];
        $otp_check = $_SESSION['otp'];

        if($otp == $otp_check){
            $name = $_SESSION['dataTemp']['name'];
            $phone = '1212';
            $email = $_SESSION['dataTemp']['email'];
            $password = $_SESSION['dataTemp']['password'];
            $insertQuery = "insert into user(name,email,password,phone) values('$name','$email','$password','$phone')";
            $conn->query($insertQuery);
            session_destroy();
            header('Location : http://localhost/Music-Streaming/landing.php');
            
        }
        else{
            echo "<script> alert('Password Otp Salah')</script>";
        }
  }
  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
</head>

<body>
    <div class="container">
    <br>
    <br>
    <br>
        <div class="row">
            <div class="col-md-6">
                <form action="" method="post">
                <label for="otp">Masukan Otp</label>
                    <input type="text" name="otp" class="form-control" placeholder="kode otp">
                    <br>
                    <input type="submit" value="kirim" class="form-control">
                </form>
            </div>
        </div>
    </div>
</body>

</html>