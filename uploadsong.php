<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style type="text/css">
    body{
        background-color: #111 ;
    }
    label{
        color:#eee;
    }
    h1{
        color:#eee;
    }
        </style>
</head>
<body>
<?php
  $serverName = "localhost";
  $username = "root";
  $password = "";
  $dbName = "music";
  $conn = new mysqli($serverName,$username,$password,$dbName);
  $q2 = "select * from genre where id = '".$_POST['genre']."'";
  $res2=$conn->query($q2);
  while($f2 = $res2->fetch_assoc()){
    $warna = $f2['warna'];
    }
      ?>

?>
<div class="container">
<h1>Tambah Lagu Artist <?php echo $nama; ?> </h1>
</div>
<div class="container">
    <div class="row">     
        <form action="simpanlagu.php" method="post" enctype="multipart/form-data">
        <div class="col-sm-12">
            <label for="judul">Judul Lagu : </label>
            <input class="form-control" type="text" name="song_name" placeholder="Judul Lagu">
            </div>
            <br>
            <div class="col-sm-12">
            <label for="judul">File Lagu : </label>
            <input type="file" class="form-control" name="song_address" placeholder="Js">
            </div>
            <br>
            <div class="col-sm-12">
            <label for="judul">Artist Id : </label>
            <input type="text"  class="form-control" value="<?php echo $_GET['artist_id']  ?>" name="artist_id" placeholder="Js">
           
            </div>
            <br>
            <div class="col-sm-12">
            <label for="judul">Cover Lagu : </label>
            <input type="file" class="form-control" name="song_image" placeholder="Gambar Lagu">
        </div>
        <br>
        <div class="col-sm-12">
            <input type="submit" class="btn btn-success" value="Tambah Lagu">
        </div>
        </form>
    </div>
</div>
</body>
</html>