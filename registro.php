<?php

session_start();
require_once 'conector.php';

// if (empty($_SESSION['id'])) {
//     header("Location:index.php");
// }
// if ($_SESSION['nivel'] == '2') {
//     header("Location:totalMes.php");
// }




// No mostrar los errores de PHP
error_reporting(0);
//echo 'hola nevo';

if (isset($_POST['insertar'])) {


    $nombre = $_POST['nombre'];

    $apellido = $_POST['apellido'];

    $correo = $_POST['correo'];

    $usuario = $_POST['usuario'];

    $clave = $_POST['clave'];

    $nivel = $_POST['nivel'];



    $sql = "INSERT INTO usuarios (nombre, apellido,correo,usuario,clave, nivel ) 
VALUES ('$nombre','$apellido','$correo','$usuario','$clave','$nivel')";
    $query = $conn->query($sql);
}

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

    <script src="./node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="./datatables/datatables.min.js"></script>
    <script src="./datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="./datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="./datatables/Buttons-2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="./datatables/Buttons-2.3.6/js/buttons.html5.min.js"></script>
    <script src="./datatables/JSZip-2.5.0/jszip.min.js"></script>



    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">

    <title>Registro usuarios </title>
</head>

<body class="dark " onload="mueveReloj()">

    <!-- <nav class="navbar navbar-dark bg-dark text-center"  onselectstart='return false'>



        <div class="container-fluid text-center p-2">

            <h3 >REGISTRO USUARIOS</h3>


        </div>

    </nav> -->

    <div class="container " onselectstart='return false'>
        
        <div class="row d-flex justify-content-center p-2">
            <div class="derecha col-sm-12 col-md-6 col-lg-6  mb-3 mt-3 p-3">
                <h2 class="text-center mb-3 p-4">!! REGISTRATE GRATIS ¡¡ </br>EL PRIMER MES </h2>

               <h4 class="text-center mb-3 p-4">Lleva el control de tu facturacion, control de km, que tu jefe pueda ver en todo momento el importe de tu nomina y mas... <!-- , si quieres pincha <a href="#">aqui</a> para ir al tutorial  --></h4>

                <img class="border rounded-3 p-1 justify-content-center mt-3" src="portada.JPG" alt="imagen portada">
                
                
            </div>
            
           
            
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 mt-5 border rounded-3 p-4">

                <h1 class="text-center mt-1 ">REGISTRO</h1>
                <form name="registro" class="" action="<?php $_SERVER['PHP_SELF']  ?>" method="post">

                    <label for="nombre" class=" mt-2 ">NOMBRE</label>
                    <input type="text" id="nombre" name="nombre" class="form-control p-2 " placeholder="nombre" required>

                    <label for="apellido" class="mt-2 ">APELLIDO</label>
                    <input type="text" id="apellido" name="apellido" class="form-control p-2 " required placeholder="apellido">

                    <label for="apellido" class="mt-2 ">CORREO</label>
                    <input type="email" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" required id="correo" name="correo" class="form-control p-2 " placeholder="correo">


                    <label for="usuario" class=" mt-2 ">USUARIO </label>
                    <input type="text" id="usuarrio" name="usuario" required class="form-control p-2 " placeholder="usiario">

                    <label for="clave" class=" mt-2 ">CONTRASEÑA</label>
                    <input type="password" name="clave" id="clave" required class="form-control p-2 " placeholder="clave">

                    <label class="mt-2">NIVEL</label>

                    <select class="form-control p-2 " name="nivel" id="nivel"  required>
                        <option disabled selected>Nivel</option>
                        <option value="2">PROPIETARIO (Propietario no Conductor)</option>
                        <option value="3">CONDUCTOR (Conductor Asalariado)</option>
                        <option value="4">PRO-CONDUCTOR (Conductor y Propietario)</option>
                    </select>


                    <label for="licencia" id="licenciaTitulo"  class="mt-2" >LICENCIA</label>
                    <input type="text" id="licencia" name="licncia"  class="form-control p-2" placeholder="Numero de Licencia (Conductor)">

                    <input type="submit" name="insertar" value="GUARDAR" class="btn btn-success text-white  w-100 mt-4 p-3 mb-2 rounded-3 ">

                </form>
                
                <a href="index.php" > <button class="btn btn-primary mt-3 w-100 p-3">LOGIN</button></a>
            </div>
        </div>


    </div>

    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>


</body>
<div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
                <svg class="bi" width="30" height="24">
                    <use xlink:href="#bootstrap"></use>
                </svg>
            </a>
            <span class="mb-3 mb-md-0 text-muted">© 2022 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#twitter"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#instagram"></use>
                    </svg></a></li>
            <li class="ms-3"><a class="text-muted" href="#"><svg class="bi" width="24" height="24">
                        <use xlink:href="#facebook"></use>
                    </svg></a></li>
        </ul>
    </footer>
</div>

</html>