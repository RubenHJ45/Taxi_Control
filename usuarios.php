<?php
include 'conector.php';
session_start();

if (empty($_SESSION['id'])) {
    header("Location:index.php");
}

$id = $_SESSION['id'];


if (isset($_POST['insertar'])) {


    $nombre = $_POST['nombre'];

    $apellido = $_POST['apellido'];
    
    $licencia = $_POST['licencia'];

    $usuario = $_POST['usuario'];

    $clave = $_POST['clave'];

    $nivel = $_POST['nivel'];



    $sql = "INSERT INTO usuarios (nombre, apellido,licencia,usuario,clave, nivel ) 
VALUES ('$nombre','$apellido','$licencia','$usuario','$clave','$nivel')";
    $query = $conn->query($sql);
    
    
   

    if ($sql) {
      
        $sql2 = "CREATE TABLE `id20529045_controltaxi`.`$nombre$apellido$licencia` ( `id` INT NOT NULL AUTO_INCREMENT , `fecha` VARCHAR(150) NOT NULL ,`hora` VARCHAR(50) NOT NULL , `efectivo` DOUBLE NULL, `tarjeta` DOUBLE NULL,`gasolina` DOUBLE NULL,`concepto` VARCHAR(150) NULL, `total` DOUBLE NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;";
        $query = $conn->query($sql2);
    }


    //var_dump($sql);
    
    
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="css/styles.css" />

    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/datatables.net/js/jquery.dataTables.min.js"></script>

    <script src="./node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="./node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>


    <title>USUARIOS</title>
</head>

<body class="dark" onselectstart = 'return false'>
    <nav class="navbar navbar-dark bg-dark ">
        <div class="container-fluid">
            <p class="text-info "><a href="controlador_cerrar.php"><input type="button" class="btn btn-sm btn-danger" value="SALIR"></a> <span class="ms-3 btn btn-sm btn-warning"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']  ?> </span></p> 
            <h3>USUARIOS</h3>

            <div>
                <a href="inicio.php"><input class="btn btn-sm btn-primary" type="button" value="INICIO"></a>
                <!--<a href="facturas.php"><input type="button" class="btn btn-sm btn-primary" value="FACTURAS"></a>-->
                <a href="totalMes.php"><input class="btn btn-sm btn-primary" type="button" value="TOTAL MES"></a>
                <!--<a href="gastos.php"><input type="button" class="btn btn-sm btn-primary" value="GASTOS"></a>-->
      
            </div>

        </div>
    </nav>
    <!--<h1 class=" text-center p-3">USUARIOS REGISTRADOS</h1>-->
    <div class="container">
        <div class=" row">
            <div class="mt-3 col-sm-4">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#exampleModal">
                + Nuevo
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">NUEVO USUARIO</h5>
                            
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body bg-dark">
                            
                            <form name="formulario" class="" action="usuarios.php" method="post">


                                <label for="nombre" class=" p-2 ms-1">NOMBRE</label>
                                <input type="text" id="nombre" name="nombre" class="form-control p-2 ms-2" placeholder="nombre" required>

                                <label for="apellido" class=" p-2 ms-1">APELLIDO</label>
                                <input type="text" id="apellido" name="apellido" class="form-control p-2 ms-2" placeholder="apellido"></span>
                                
                                <label for="licencia" class=" p-2 ms-1">Nº LICENCIA</label>
                                <input type="text" id="licencia" name="licencia" class="form-control p-2 ms-2" placeholder="licencia"></span>


                                <label for="usuario" class=" p-2 ms-1">USUARIO </label>
                                <input type="text" id="usuario" name="usuario" class="form-control p-2 ms-2" placeholder="usiario" required></span>

                                <label for="clave" class=" p-2 ms-1">CLAVE</label>
                                <input type="password" name="clave" id="clave" class="form-control p-2 ms-2" placeholder="clave" required></span>

                                <label class="c-black p-2 ms-1">NIVEL</label>
                                <input type="text" name="nivel" class="form-control ms-2 mb-3 " id="nivel" placeholder="nivel" required>
                        </div>
                        <div class="modal-footer">

                            <input type="submit" name="insertar" value="GUARDAR" class="btn btn-success text-white ms-2 mt-3 mb-2 rounded-3 w-100">
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            </div>

            <div class="table-responsive col-sm-12 col-md-12 col-lg-12 col-xl-12 mb-3 p-3">
                <table id="example" class="table mt-2 table-dark  table-striped table-hover table-bordered mb-3" data-page-length="5">

                    <thead class="text-center border">
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>APELLIDO</th>
                            <th>Nº LICENCIA</th>
                            <th>USUARIO</th>
                            <th>NIVEL</th>
                            <th>OPCIONES</th>
                        </tr>
                    </thead>
                    <?php

                    $sql = "SELECT * FROM usuarios ORDER BY id";

                    $query = $conn->query($sql);


                    foreach ($query as $fila) :

                    ?>
                        <tr>
                            <td class="text-center"><?php echo  $fila['id']  ?></td>
                            <td class="text-center"><?php echo  $fila['nombre']  ?></td>
                            <td class="text-center"><?php echo  $fila['apellido']  ?></td>
                            <td class="text-center"><?php echo  $fila['licencia']  ?></td>
                            <td class="text-center"> <?php echo  $fila['usuario']  ?></td>
                            <td class="text-center"><?php echo $fila['nivel'] ?> </td>


                            <td class="text-center"><a href="borrarUsuario.php?id=<?php echo $fila['id']; ?>"><i id='borrar' name='borrar' class="bi bi-trash-fill btn btn-danger" type='button' onclick="return confirm('Estas seguro que quieres borra el registro?')"></i> </a>

                                <a href="editarUsuario.php?id=<?php echo $fila['id']; ?>&nombre=<?php echo $fila['nombre']; ?>&nivel=<?php echo $fila['nivel']; ?>&apellido=<?php echo $fila['apellido']; ?>&licencia=<?php echo $fila['licencia']; ?>&usuario=<?php echo  $fila['usuario'] ?>&clave=<?php echo $fila['clave']; ?>&nivel=<?php echo $fila['nivel'] ?>">
                                    <i class="bi bi-pencil btn btn-warning" id='editar' name='editar'></i>


                                </a>
                            </td>
                        </tr>

                    <?php
                    endforeach;
                    ?>
            </div>
        </div>
        

        <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
                
</body>

</html>