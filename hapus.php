<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "music";
$conn = new mysqli($serverName,$username,$password,$dbName);


$id_musik=$_GET["id"];
$insertQuery = "delete from user_playlist where id='".$id_musik."'";
if($conn->query($insertQuery)){
    header("Location: http://localhost/Music-Streaming/userplaylist.php");
}
else{
    echo "Error: " . "<br>" . $conn->error;
}

?>