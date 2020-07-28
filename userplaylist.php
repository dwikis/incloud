<?php
session_start();
include('player.php');
$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "music";
$conn = new mysqli($serverName,$username,$password,$dbName);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="userplaylist.css" text="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="mainContainer">
    <ul id="navbar" class="nav justify-content-center">
            <li class="nav-item">
            <a class="nav-link" href="home.php">HOME</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="landing.php">LANDING</a>
            </li>
            <!-- <li class="nav-item">
            <a class="nav-link" href="trending.php">TRENDING</a>
            </li> -->
            <li class="nav-item active">
            <a class="nav-link" href="#">MY PLAYLIST</a>
            </li>
            <li class='nav-item profile'>
                <div class='dropdown'>
                <button type='button' class='btn dropdown-toggle' data-toggle='dropdown'><?php echo $_SESSION['user_name'][0]; ?></button>
                <ul class="dropdown-menu">
                <li><a href="userplaylist.php" style='color:black; font-size:13px; padding-left:10px;'>My Playlist</a></li>
                <li><a href="landing.php" style='color:black; font-size:13px; padding-left:10px;'>Log out</a></li>
                </ul>
                </div>
            </li>
        </ul>
        <!-- <input class="search" type="search" placeholder="Search" name='search' /> -->
<?php
$userPlatlistQuery ="SELECT * FROM `user_playlist` as u INNER JOIN song as s ON u.song_id = s.id where u.user_id = ".$_SESSION['user_id'];
   $result = $conn->query($userPlatlistQuery);
                        
        echo "<table>";
        $sindex = 0;
        $songsArray=Array();
        $simage = Array();
        $sartist = Array();
        $sname = Array();
        $sindex = 0;
            while($sres = $result->fetch_assoc()){
                $songsArray []=$sres['song_address'];
                $songsNameArray []=$sres['song_name'];
            
            echo "<tr class='tableRow'>";
            $sname[] = $sres['song_name'];
            $sartist[] = $sres['artist'];
            $simage []= $sres['song_image'];
            
                echo "<td id='td1' class='songBtn'><i  class='fa splay' onclick='"."pla(`$sindex`,`$sartist[$sindex]`,`$simage[$sindex]`,`$sname[$sindex]`)'".">&#xf04b;</i><i  onclick='pau()' style='display:none' class='fa spause'>&#xf04c;</i></td>";
                echo "<td id='td2'><img src= ".$sres['song_image']."></td>";
                echo "<td id='td3' class='songName'><h4>".$sres['song_name']."</h4><p>".$sres['artist']."</p></td>";
                echo "<td id='td4' class='songTime'><a href='hapus.php?id=".$sres['id']."'>hapus</a></td>";
                
                
            echo "</tr>";
            $sindex = $sindex+1;
            }
        echo "</table>";


?>
    </div>

    <script>

  

function addToPlaylist(x){
    var http = new XMLHttpRequest();
    http.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            $('.toast').toast('show');
        }
    };
    http.open('get','updatePlaylist.php?q='+x,true);
    http.send();
}

    function autoNext() {
  setInterval(function(){ 
      var u = document.getElementById('player');
      if(u.currentTime == u.duration){
          forw();
      } 
    }, 3000);
}

function playAll(){
    document.getElementsByClassName('splay')[0].click();
}

var prevIndex = 0;
   var currentIndex = 0;
   var currentImage=<?php echo json_encode($simage); ?>;
   var currentTitle=<?php echo json_encode($sname); ?>;
   var currentContent;
   
   function pla(x,y,z,w){
      console.log(currentImage);
       $('.songName').css('color','white');
       $('.songBtn').css('color','white');
       $('.songTime').css('color','white');
       $('.tableRow').css('background-color','');
       $('.splay').css('display','block');
       $('.spause').css('display','none');
        currentIndex = x;
        var passedArray =  <?php echo json_encode($songsArray); ?>;
        
        currentContent = <?php echo json_encode($songsNameArray); ?>;
        // console.log(currentContent);
        var g = document.getElementById('player');
        g.setAttribute('src',passedArray[x]);
        document.getElementById('pl').click();
        document.getElementById('player_title').innerHTML = w;
        fetch('http://localhost/Music-Streaming/view.php?song='+w);
        document.getElementById('player_content').innerHTML = y;
        document.getElementById('player_image').src = z;
        document.getElementsByClassName('songName')[x].style.color = '#41e23e';
        document.getElementsByClassName('songTime')[x].style.color = '#41e23e';
        document.getElementsByClassName('songBtn')[x].style.color = '#41e23e';
        document.getElementsByClassName('tableRow')[x].style.backgroundColor = '#5a5656';
        document.getElementById('player_image').style.display = "block";
        document.getElementsByClassName('splay')[x].style.display = "none";
        document.getElementsByClassName('spause')[x].style.display = "block";
        autoNext();      
       
   }
   
   function pau(){
       document.getElementById('pa').click();
       document.getElementsByClassName('splay')[currentIndex].style.display = "block";
       document.getElementsByClassName('spause')[currentIndex].style.display = "none";
   }
   function forw(){
       var totalIndex = <?php echo json_encode($sindex); ?>;
       console.log('total - '+totalIndex);
       if(currentIndex==totalIndex-1){
           console.log('inside if');
        var temp;
       currentIndex = 0;
       temp = currentIndex;
       console.log(currentContent[temp]);
       console.log('image'+currentImage);
       console.log('title '+currentTitle);
       pla(currentIndex,currentContent[temp],currentImage[temp],currentTitle[temp]);
       }
       else{var temp;
       currentIndex = parseInt(currentIndex)+1;
       temp = currentIndex;
       console.log(currentContent[temp]);
       console.log('image'+currentImage);
       console.log('title '+currentTitle);
       pla(currentIndex,currentContent[temp],currentImage[temp],currentTitle[temp]);
       }
   }
   function back(){
       if(currentIndex==0){
           console.log('inside if');
        var temp;
       currentIndex = 0;
       temp = currentIndex;
       console.log(currentContent[temp]);
       console.log('image'+currentImage);
       console.log('title '+currentTitle);
       pla(currentIndex,currentContent[temp],currentImage[temp],currentTitle[temp]);
       }
       else{var temp;
       currentIndex = parseInt(currentIndex)-1;
       temp = currentIndex;
       console.log(currentContent[temp]);
       console.log('image'+currentImage);
       console.log('title '+currentTitle);
       pla(currentIndex,currentContent[temp],currentImage[temp],currentTitle[temp]);
       }
   }
   </script>
</body>
</html>