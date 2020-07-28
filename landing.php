<?php
session_start();

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "music";
$conn = new mysqli($serverName,$username,$password,$dbName);
$linkfile = 'http://localhost/Music-Streaming/play.php?artist=';
$linksong = 'http://localhost/Music-Streaming/play.php?song=';
$q1 = "select * from song  order by view DESC limit 5";
$res1=$conn->query($q1); 
$row = $res1 -> fetch_assoc();



//Import PHPMailer classes into the global namespace




?>

<!-- Profile Picture Upload
<?php
if(isset($_POST['signUp']))
{
  $file = $_FILES['profilePic'];
  $fileName = $file['name'];
  $tempLoc = $file['tmp_name'];
  $destination = 'Assets/users/profilePictures/'.$fileName;
  move_uploaded_file($tempLoc,$destination);
}
?> -->
<!-- Sign IN -->
<?php
if(isset($_POST['signUp'])){
  $name = $_POST['name'];
  $phone = $_POST['112'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $insertQuery = "insert into user(name,email,password,phone) values('$name','$email','$password','$phone')";
  $conn->query($insertQuery);
}
?>
<!-- login -->
<?php
$navBar = FALSE;
if(isset($_POST['logIn'])){
  $logEmail = $_POST['loginEmail'];
  $logPass = $_POST['loginPass'];
  $selectQuery = "select email, id, password, name from user where email='$logEmail' and password='$logPass'";
  $resultq=$conn->query($selectQuery);
  $show = $resultq->fetch_assoc();
  $displayName = '';
  if($show['email']==$logEmail && $show['password']==$logPass){
    $navBar = true;
    $userId = $show['id'];
    $displayName = $show['name'];
    $displayName = (explode(" ",$displayName));
    $_SESSION["user_id"] = $show['id'];
    $_SESSION["user_name"]= $displayName;
  }
  else{
    echo"null";
  }
  
}


if(isset($_GET['logout'])){
  session_destroy();
  // header("Location: http://localhost:3005/music/landing.php");
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" text="text/css" href="landing.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <script src="landing.js">  </script>
    <title>Beranda</title>
    <script>
    //   $(document).ready(function(){
           
    //     $('#tr2').hide();
    // $('#prevForm').hide();
    //     $("#prevForm").click(function(){
    //         $("#tr2").slideUp();
    //         $("#tr").slideDown();
    //         $('#prevForm').hide();
    //     });
        
    //     });
    //     function t(){
    //       console.log(document.getElementById('signUpBtn').value);
    //     }
        function checklog(){
          alert('Harap masuk terlebih dahulu');
        }
        
    </script>
</head>
<body>
  <!-- Nav Bar -->
  <?php
  if($navBar == false){
  echo "<ul id='navBar' class='nav justify-content-end'>";
    echo "<li class='nav-item'>";
      echo "<a class='nav-link active' href='#'>Beranda</a>";
    echo "</li>";
    echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='http://localhost/Music-Streaming/home.php' >Web player</a>";
    echo "</li>";
    echo "<li class='nav-item'>";
      echo "<a class='nav-link' onclick='showSignUp(true)'>Daftar</a>";
    echo "</li>";
    echo "<li class='nav-item'>";
      echo "<a class='nav-link' onclick='showLogIn(true)'>Masuk</a>";
    echo "</li>";
  echo "</ul>";
  }
  elseif($navBar == true){
    
    echo "<ul id='navBar' class='nav justify-content-end'>";
    // echo "<li class='nav-item'>";
    //   echo "<a href='#'><img src='830048.jpg' width='40px' height='40px' class='rounded-circle'></a>";
    // echo "</li>";
    echo "<li class='nav-item'>";
      echo "<a class='nav-link active' href='home.php'>Home</a>";
    echo "</li>";
    echo "<li class='nav-item'>";
      echo "<a class='nav-link' href='home.php'>Web player</a>";
    echo "</li>";
    echo "<li class='nav-item'>";
      echo "<div class='dropdown'>
      <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'>"
        .'Hi '.$displayName[0].
      "</button>
      <ul class='dropdown-menu'>
                <li><a href='userplaylist.php' style='color:black; font-size:13px; padding-left:10px;'>My Playlist</a></li>
                <li><a href='landing.php' style='color:black; font-size:13px; padding-left:10px;'>Log out</a></li>
                </ul>
    </div>";
    echo "</li>";
  echo "</ul>";
  }
  ?>
  

  <!-- SignUp -->
  <div class="signUpModalContainer" id="sign">
    <div class="signUpModal">
      <i onclick="showSignUp(false)" class="fa fa-times-circle"></i>
        <h2 style="text-align: center; letter-spacing: 3px;">Daftar Akun</h2>
        <hr>
        <!-- onsubmit="return check()" -->
            <form action="otp.php" method="POST"  name="signUpForm" enctype="multipart/form-data">
              <!-- <div id="tr"> -->
                <text id = "popName" data-toggle="popover" >
                  <input type="text" placeholder="Name" name="name"></text><br>

                <!-- <text id = "popPhone" data-toggle="popover" > -->
                  <!-- <input type="number" placeholder="phone no" name="phone"></text><br> -->

                <text id = "popEmail" data-toggle="popover" >
                  <input type="email" placeholder="Email" name="email" required></text><br>

                <text id = "popPass" data-toggle="popover" >
                  <input type="password" placeholder="Password" name="password"></text><br>
                  
                <text id = "popConfPass" data-toggle="popover" >
                  <input type="password" placeholder="Confirm Password" name="confPassword"></text><br>

                  <input type="radio" name="gender" value="male">                
                  <label for="male">Pria</label>                
                  <input type="radio" name="gender" value="female">
                  <label for="female">Wanita</label><br>
                  <input type="checkbox" name="terms"> Setuju dengan syarat & ketentuan ?<br>
                  <button type="submit" name="signUp" id="signUpBtn">Daftar</button><br>
              <!-- </div> -->
              <!-- <div id="tr2">
                Select Profile Picture : 
                <input type="file" name="profilePic" onchange="update()" name="fileUpload"><br>
                <img id="profilePicDisplay" alt=""><br><br>
                Date Of Birth : <input type="date" name="dob"><br><br>
                <button type="submit" name="signUp" id="signUpBtn">Sign Up</button><br>
              </div> -->
              <p>Sudah punya akun ?<span onclick="switchSL(true)"> Masuk</span></p>
            </form>
    </div>
  </div>

  <!-- Login -->
  <div class="logInModalContainer" id="log">
    <div class="logInModal">
    <i onclick="showLogIn(false)" class="fa fa-times-circle"></i>
      <h2 style="text-align: center; letter-spacing: 3px;">Masuk Akun</h2>
      <hr>
      <form action="#" method="POST">
        <input type="text" name="loginEmail" placeholder="Email"><br>
        <input type="password" name="loginPass" placeholder="Password"><br>
        <p id="forgot">Lupa kata sandi ?</p>
        <button type="submit" name="logIn">Masuk</button><br>
        <p>Pengguna baru ?<span onclick="switchSL(false)"> Daftar</span></p>
      </form>
    </div>
  </div>

<!-- Slider -->
  <div class="headContainer">
  <div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
      <li data-target="#demo" data-slide-to="3"></li>
      <li data-target="#demo" data-slide-to="4"></li>
    </ul>
    <div class="carousel-inner">

      <div class="carousel-item active">
        <a href="<?php echo $linksong.$row['song_name']; ?>"><img src="<?php echo $row['song_image']; ?>" alt="New York"></a>
        <div class="carousel-caption">
          <h1><?php echo $row['song_name']; ?></h1>
          <p><?php echo $row['genre']; ?></p>
        </div>   
      </div>

    <?php
    
    while($f = $res1->fetch_assoc()){
      echo "<div class='carousel-item'>";
      echo "<a href='$linksong$f[song_name]'><img src=".$f['song_image']."></a>";
      echo "<div class='carousel-caption'>";
      echo "<h1>".$f['song_name']."</h1>";
      echo "<p>".$f['genre']."</p>";
      echo "</div>";   
      echo "</div>";
    } 
    ?>
      
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
  </div>

  <!-- Contents of website -->
  <div class="main-container">
    <h1>Lihat Musik Lainnya ?</h1>
    <form method='get' action="home.php">
      <button type="submit" name="webplayer" class="launchBtn">Masuk Web Player</button>
    </form>
    
    <div class="container-fluid">

     <h2 style="color: white;">Rekomendasi Artist</h2>
    <div class="row">

     <?php 
      $q2 = "select * from song group by artist order by view DESC limit 8";
      $res2=$conn->query($q2);
      while($f2 = $res2->fetch_assoc()){
        echo "<a href='$linkfile$f2[artist]'>";
        echo "<div class='col-lg-3'>";
        echo "<div class='card' >";
        echo "<img class='card-img-top' src=".$f2['song_image']." alt='Card image'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title'>".$f2['artist']."</h4>";
        echo "<p class='card-text'>".$f2['genre']."</p>";
        echo "<a href='$linkfile$f2[artist]'><button><i class='fa'>&#xf04b</i></button></a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
      }
      ?> 
    </div>

      <h2 style="color: white;">Baru Rilis</h2>
    <div class="row">
      <?php 
      $q2 = "select * from song order by id DESC limit 8  ";
      $res2=$conn->query($q2);
      while($f2 = $res2->fetch_assoc()){
        $link = 'http://localhost/Music-Streaming/play.php?song='.$f2['song_name'];
        echo "<a href='$link'>";
        echo "<div class='col-lg-3'>";
        echo "<div class='card' >";
        echo "<img class='card-img-top' src=".$f2['song_image']." alt='Card image'>";
        echo "<div class='card-body'>";
        echo "<h4 class='card-title'>".$f2['artist']."</h4>";
        echo "<p class='card-text'>".$f2['song_name']."</p>";
        
        echo "<a href='$link'>><button><i class='fa'>&#xf04b</i></button></a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        echo "</a>";
      }
      ?>

    </div>

   


    </div>
  </div>
    
</body>

</html>