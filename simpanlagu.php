<?php
session_start();
  $serverName = "localhost";
  $username = "root";
  $password = "";
  $dbName = "music";
  $conn = new mysqli($serverName,$username,$password,$dbName);



$artist = $_POST['artist'];
$genre = $_POST['genre'];
$lagu = $_POST['song_name'];
$user_id = $_SESSION['user_id'];

$q2 = "select * from genre where nama = '".$genre."'";
$res2=$conn->query($q2);
while($f2 = $res2->fetch_assoc()){
    $warna = $f2['warna'];
}



// $song_name = $_POST['song_name'];

$address = basename($_FILES["song_address"]["name"]);
$image = "Assets/landingAssets/".basename($_FILES["song_image"]["name"]);

function uploadGambar($nama){
    $target_dir = "Assets/landingAssets/";
    $target_file = $target_dir . basename($_FILES[$nama]["name"]);
    $uploadOk = 1;
    
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$nama]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES[$nama]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES[$nama]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES[$nama]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }
}
uploadGambar("song_image");

echo "Upload: " . $_FILES["song_address"]["name"] . "<br />";
echo "Type: " . $_FILES["song_address"]["type"] . "<br />";
echo "Size: " . ($_FILES["song_address"]["size"] / 1024) . " Kb<br />";
echo "Temp file: " . $_FILES["song_address"]["tmp_name"] . "<br />";

$target_dir = "Assets/webPlayerAssets/songs/";
        $target_file = $target_dir . basename($_FILES["song_address"]["name"]);
        move_uploaded_file($_FILES["song_address"]["tmp_name"], $target_file);
    // move_uploaded_file($_FILES["song_address"]["tmp_name"],
    // "upload/" . $_FILES["song_address"]["name"]);
    echo "Stored in: " . $target_file;
    

    $insertQuery = "insert into song(id_user,song_address,song_image,artist,song_name,warna,genre) values('$user_id','$target_file','$image','$artist','$lagu','$warna','$genre')";
    
    if ($conn->query($insertQuery) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    
      header("Location: http://localhost/Music-Streaming/upload.php");





?>