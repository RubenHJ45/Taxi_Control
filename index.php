<?php
session_start();


 //No mostrar los errores de PHP
error_reporting(0);


    include ('conector.php');
    include("controlador_avanzado.php");   
    
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="css/styles.css" />

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/datatables.net/js/jquery.dataTables.min.js"></script>

    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    

    <title>LOGIN</title>
</head>

<body class="p-4 dark" onselectstart = 'return false'>

    <div class="container abs-center  p-4 mt-3 mb-3  ">
        <h1 class="title text-center ">CONTROL TAXI</h1>
        <h2 class=" text-center  mt-3">BIENVENIDO</h2>
        <div class="row ">
 
   



        <form method="post" action="#" class="justify-content-center d-flex p-3 ">            
           
                <div class="col-sm-12 col-md-6 col-lg-8 col-xl-4 text-center">
                    
                    <h2 class=""><i class="bi bi-person-circle "></i> Usuario</h2>
                    <input type="text" id="usuario" name="usuario" class="form-control  mb-3 ">       
                    
                        <h2> <i class="bi bi-lock-fill"></i> Password</h2>
                        
                        
                        <div class="col d-flex">
                        
                        <input type="password" id="txtPassword" name="password" class="form-control mb-3">
                     
                        </div>
               
                    <input type="submit" name="entrar" class="btn btn-success  fs-4 mt-4" value="ENTRAR">
                </div>
                
                
                    
        </form>
   
  <!-- <h3 class="text-center">Aun no estas registrado? </br> Hazlo <a href="registro.php">aqui</a></h3>-->
   
   
   
 

    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>