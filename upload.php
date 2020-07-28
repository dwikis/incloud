<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <style type="text/css">
        body {
            background-color: #111;
        }

        label {
            color: #eee;
        }

        h1 {
            color: #eee;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Upload Artist/Band</h1>
    </div>
    <br>
    <?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: http://localhost/Music-Streaming/landing.php");
}
    $serverName = "localhost";
    $username = "root";
    $password = "";
    $dbName = "music";
    $conn = new mysqli($serverName,$username,$password,$dbName);

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

    if(isset($_POST['artist'])){
        echo $_POST['artist'];
        $nama_artist = $_POST['artist'];
        $caption = $_POST['caption'];
        $pname = $nama_artist;
        $link = "http://localhost/Music-Streaming/play.php?artist=".$pname;
        $laravel = "/play/".$pname;
        //codingan upload gambar dan file
        uploadGambar('Gartist');
        $Gartist = basename( $_FILES['Gartist']["name"]);
        $Gartist = "./Assets/landingAssets/".$Gartist;
        $Gcover = basename( $_FILES['Gcover']["name"]);
        $Gcover = "./Assets/landingAssets/".$Gcover;
        uploadGambar('Gcover');
        $warna = $_POST['warna'];

        $insertQuery = "insert into artist(Artist_image,Artist_name,Artist_cover_image,p_name,color) 
        values('$Gartist','$nama_artist','$Gcover','$pname','$warna')";
        $conn->query($insertQuery);

        $insertQuery2 = "insert into landing_grid(grid_image,grid_content_title,grid_content,laravel,phplink) 
        values('$Gartist','$nama_artist','$caption','$laravel','$link')";
        $conn->query($insertQuery2);


        
    }


?>
    <div class="container" back>
    <h2 style="color:#eee;margin-right:40px;position:relative;right:12px;">Pilih Nama artist / Masukan Nama Artist Baru </h2>
    <br>

    <div class="row">
                  <?php
                        $q2 = "select * from song where id_user = ".$_SESSION['user_id']." group by artist";
                        $res2=$conn->query($q2);
                        while($f2 = $res2->fetch_assoc()){
                            $artist = $f2['artist'];
                            ?>

                         <button onclick='masukandata("<?php echo $artist ?>")' style='color:#000;margin-right:10px;'><?php echo $artist ?></button>
                         <?php
                        }
                        ?>
        
    </div>
        <div class="row">
            <form  action="simpanlagu.php" method="post" enctype="multipart/form-data">

                <br>
                <div class="col-sm-12">
                    <label for="judul">Nama Artis : </label>
                    <!-- <input class="form-control" list="artist"  placeholder="Nama Artist" autocomplete="off" name="artist" id="artist">
                    <datalist id="artist">
                       
                        <option   value="">
                     
                    </datalist> -->
                    <input type="text" class="form-control" autocomplete="off" name="artist" id="artist" placeholder="Nama Artist">
                </div>
                <br>
                <div class="col-sm-12">
                    <label for="judul">Nama Lagu: </label>
                    <input type="text" class="form-control" autocomplete="off" name="song_name" placeholder="Nama Lagu">
                </div>
                <br>
                <div class="col-sm-12">
                    <label for="judul">Genre : </label>
                    <select name="genre" class="form-control">

                        <?php 
                $q2 = "select * from genre";
                $res2=$conn->query($q2);
                while($f2 = $res2->fetch_assoc()){
                 
                    ?>
                        <option value="<?php echo $f2['nama']; ?>"><?php echo $f2['nama'] ?></option>
                        <?php  } ?>
                    </select>
                </div>
                <br>
                <div class="col-sm-12">
                    <label for="judul">File Lagu : </label>
                    <input type="file" class="form-control" name="song_address" placeholder="Js">
                </div>
                <br>
                <!-- <div class="col-sm-12">
                    <label for="judul">Artist Id : </label>
                    <input type="text" class="form-control" value=""
                        name="id_user" placeholder="Js">
                </div>
                <br> -->
                <div class="col-sm-12">
                    <label for="judul">Cover Lagu : </label>
                    <input type="file" class="form-control" name="song_image" placeholder="Gambar Lagu">
                </div>
                <br>
                <div class="col-sm-12">
                    <input type="submit" class="btn btn-success" value="Tambah Lagu">
                </div>
            </form>

            <div class="col-sm-6">
               <!-- artist  -->
            </div>
        </div>
    </div>
    <script>
        function masukandata(data){
            var input = document.getElementById('artist');
            input.value = data;
        }
    </script>
</body>

</html>