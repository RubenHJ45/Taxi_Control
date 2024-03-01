<?php
session_start();
if (empty($_SESSION['id'])) {
    header("Location:index.php");
}

$nombre = $_SESSION['nombre'];

include('conector.php');

    $id =$_GET['id'];

 

    $sql = "DELETE FROM $nombre WHERE ID='$id'";
    $query = $conn->query($sql);

    //var_dump($sql);

header("Location:inicio.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BORRAR REGISTRO</title>
</head>
<body>


    
</body>
</html>