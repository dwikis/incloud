<?php
session_start();
 $serverName = "localhost";
 $username = "root";
 $password = "";
 $dbName = "music";
 $conn = new mysqli($serverName,$username,$password,$dbName);
 $song_name = $_GET['song'];
   

$q = "select * from song where song_name= '$song_name'";
$res2=$conn->query($q);
while($f2 = $res2->fetch_assoc()){
    $view = $f2['view'];
    $id = $f2['id'];
}

 $jumlahSebelumnya = $view;
 $jumlahSekarang = $jumlahSebelumnya+1;
 $query = "update song set view = $jumlahSekarang where song_name = '$song_name' ";
 $conn->query($query);

 if(isset($_SESSION['user_id'])){
     $id_user = $_SESSION['user_id'];
    $q2 = "select * from favorite where id_user = $id_user and id_song = $id";
    $res3=$conn->query($q2);
    $check = mysqli_num_rows($res3); 
    // echo $check;
    if($check>=1){
        while($f3 = $res3->fetch_assoc()){
            $view_user = $f3['view'];
        }
        $jumlahSekarang = $view_user+1;
        echo $jumlahSekarang;
         $query = "update favorite set view = $jumlahSekarang where id_user = '$id_user' and id_song = $id ";
         $conn->query($query);
    }
    else{
        $query = "insert into favorite (id_user,id_song,view) values($id_user,$id,1)";
         $conn->query($query);
    }
}
?>