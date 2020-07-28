<?php
session_start();
include('player.php');
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "music";
$linkfile = 'http://localhost/Music-Streaming/play.php?artist=';
$linksong = 'http://localhost/Music-Streaming/play.php?song=';
$conn = new mysqli($serverName,$username,$password,$dbName);
if(!isset($_SESSION['user_name'])){
    header("Location: http://localhost/Music-Streaming/landing.php");
}
$id = $_SESSION['user_id']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" text="text/css" href="home.css">
    <!-- <link rel="stylesheet" text="text/css" href="landing.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- <script src="landing.js"> </script> -->
    <title>Home</title>
</head>
<script>
    function fun(x) {
        document.getElementById(x).submit();

    }
</script>

<body>
    <div class="mainContainer">
        <ul id="navbar" class="nav justify-content-center">
            <li class="nav-item active">
                <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="landing.php">LANDING</a>
            </li>
            <li class="nav-item">
                <!-- <a class="nav-link" href="trending.php">TRENDING</a> -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="userplaylist.php">MY PLAYLIST</a>
            </li>
            <li class='nav-item profile'>
                <div class='dropdown'>
                    <button type='button' class='btn dropdown-toggle'
                        data-toggle='dropdown'><?php echo $_SESSION['user_name'][0]; ?></button>
                    <ul class="dropdown-menu">
                        <li><a href="userplaylist.php" style='color:black; font-size:13px; padding-left:10px;'>My
                                Playlist</a></li>
                        <li><a href="upload.php" style='color:black; font-size:13px; padding-left:10px;'>Upload</a></li>
                        <li><a href="landing.php?logout=1" style='color:black; font-size:13px; padding-left:10px;'>Log
                                out</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <div class="container-fluid">
            <?php 
            echo "<h2>Your Favorite Genre</h2><br>";
        ?>
            <div class="row">
                <?php 
      $q2 = "SELECT s.genre as genre FROM `favorite` as f INNER JOIN song as s ON f.id_song = s.id where f.id_user =$id group by s.genre order by s.view desc limit 3";
      $res2=$conn->query($q2);
      $check = mysqli_num_rows($res2);
      if($check>=1){ 
      while($f2 = $res2->fetch_assoc()){
          $fgenre = $f2['genre'];
          echo "<div class='col-lg-12'>";
          echo "<h2>Recommended on $fgenre</h2>";
          echo "</div>";
          $query = "SELECT * FROM song where genre = '$fgenre' order by view DESC limit 4";
          $res=$conn->query($query);
          while($f = $res->fetch_assoc()){
       
        echo "<div class='col-lg-3'>";
        echo "<a style='color:#eee' href='$linksong$f[song_name]'><div class='card' >";
        echo "<img style='width:100px;height:100px;margin-right:25px;margin-top:30px;' class='card-img-top' src=".$f['song_image']." alt='Card image'>";
        echo "<div class='card-body'>";
        echo "<p class='card-title'>".$f['song_name']."</p>";
        // echo "<p class='card-text'>".$f2['grid_content']."</p>";
        echo "</a>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
          }
      }
    }
    else{

    }
      ?>

            </div>

         


        </div>
        <div class="container-fluid">

<h2 style="color: white;">Rekomendasi Artist</h2>
<br>
<div class="row" style="margin-left:5%">

<?php 
 $q2 = "select * from song group by artist order by view DESC limit 20";
 $res2=$conn->query($q2);
 while($f2 = $res2->fetch_assoc()){
   echo "<a href='$linkfile$f2[artist]'>";
   echo "<div class='col-lg-2'>";
   echo "<div class='card' >";
   echo "<img style='width:100px;height:100px;margin-left:50px;margin-top:30px;' class='card-img-top' src=".$f2['song_image']." alt='Card image'>";
   echo "<div class='card-body'>";
   echo "<h4 class='card-title'>".$f2['artist']."</h4>";
   echo "<p class='card-text'>".$f2['genre']."</p>";
//    echo "<a href='$linkfile$f2[artist]'><button><i class='fa'>&#xf04b</i></button></a>";
   echo "</div>";
   echo "</div>";
   echo "</div>";
   echo "</a>";
 }
 ?> 
</div>

 <h2 style="color: white;">Baru Rilis</h2>
 <br>
<div class="row" style="margin-left:5%">
 <?php 
 $q2 = "select * from song order by id DESC limit 20  ";
 $res2=$conn->query($q2);
 while($f2 = $res2->fetch_assoc()){
   $link = 'http://localhost/Music-Streaming/play.php?song='.$f2['song_name'];
   echo "<a href='$link'>";
   echo "<div class='col-lg-2'>";
   echo "<div class='card' >";
   echo "<img style='width:100px;height:100px;margin-left:50px;margin-top:30px;' class='card-img-top' src=".$f2['song_image']." alt='Card image'>";
   echo "<div class='card-body'>";
   echo "<h7 class='card-title'>".$f2['artist']."</h7>";
   echo "<p class='card-text'>".$f2['song_name']."</p>";
   
//    echo "<a href='$link'>><button><i class='fa'>&#xf04b</i></button></a>";
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
<script>
    function autoNext() {
        setInterval(function () {
            var u = document.getElementById('player');
            if (u.currentTime == u.duration) {
                forw();
            }
        }, 3000);
    }
    var prevIndex = 0;

    function stateManage() {

    }
    var currentIndex;

    function passIndex(x) {
        currentIndex = x;
        var a = < ? php echo json_encode($songsArray); ? > ;
        var b = < ? php echo json_encode($songsImageArray); ? > ;
        var c = < ? php echo json_encode($songsNameArray); ? > ;
        var d = < ? php echo json_encode($songsArtistName); ? > ;
        console.log(d);
        pla(x, d[x], b[x], c[x]);
    }


    function pla(x, y, z, w) {
        autoNext();
        currentIndex = x;
        var passedArray = < ? php echo json_encode($songsArray); ? > ;
        currentContent = < ? php echo json_encode($songsNameArray); ? > ;
        // console.log(currentContent);
        var g = document.getElementById('player');
        g.setAttribute('src', passedArray[x]);
        document.getElementById('pl').click();
        document.getElementById('player_title').innerHTML = w;
        document.getElementById('player_content').innerHTML = y;
        document.getElementById('player_image').src = z;
        document.getElementById('player_image').style.display = "block";
        document.getElementsByClassName('splay')[x].style.display = "none";
        document.getElementsByClassName('spause')[x].style.display = "block";


    }

    function pau() {
        document.getElementById('pa').click();
        document.getElementsByClassName('splay')[currentIndex].style.display = "block";
        document.getElementsByClassName('spause')[currentIndex].style.display = "none";
    }

    function forw() {
        var temp = < ? php echo json_encode($sindex) ? > ;
        if (currentIndex == temp - 1) {
            passIndex(0);
        } else {
            passIndex(currentIndex + 1);
        }
    }

    function back() {
        if (currentIndex == 0) {
            passIndex(0);
        } else {
            passIndex(currentIndex - 1);
        }
    }
</script>

</html>