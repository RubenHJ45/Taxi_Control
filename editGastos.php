<?php

session_start();
if (empty($_SESSION['id'])) {
    header("Location:index.php");
}
include 'conector.php';
   

if (!isset($_POST['actualizar'])) {

    $id = $_GET['id'];

    $mes = $_GET['meses'];

    $fecha = $_GET['fecha'];

    $importe = $_GET['importe'];

    $concepto = $_GET['concepto'];

    $comentario = $_GET['comentario'];

} else {

    $id = $_POST['id'];

    $mes = $_POST['meses'];

    $fecha = $_POST['fecha'];

    $importe = $_POST['importe'];

    $concepto = $_POST['concepto'];

    $comentario = $_POST['comentario'];


    $sql = "UPDATE gastos SET fecha='$fecha', importe='$importe', concepto= '$concepto', comentario='$comentario'  WHERE id='$id'";

    $query = $conn->query($sql);
   
   header("Location:gastos.php?meses=$mes");
   
   // var_dump($sql);
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
    <title>EDITAR REGISTROS</title>
</head>

<body class="dark" onselectstart = 'return false'>
 <nav class="navbar navbar-dark bg-dark ">
  <div class="container-fluid">
      <p class="text-info"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']  ?></p><a href="controlador_cerrar.php"><input type="button" class="btn btn-sm btn-danger" value="SALIR"></a>
      <h3 class="text-center ">CONTROL DE FACTURACION TAXI</h3>
      
    <div>
          <a href="inicio.php"><input class="btn btn-sm btn-primary" type="button" value="INICIO"></a>
           <a href="usuarios.php"><input type="button" class="btn btn-sm btn-primary" value="USUARIOS"></a>
      <a href="totalMes.php"><input class="btn btn-sm btn-primary" type="button" value="MES"></a>
     
    </div>
             
  </div>
</nav>

    <h1 class="text-center mt-3">EDITAR REGISTROS</h1>

    <div class="container abs-center  p-2 mb-3 mt-1   justify-content-center ">

        <div class=" row  ">
            
            <form name="formulario" class="justify-content-center d-flex p-3" action="editGastos.php?meses=<?php echo $mes ?>" method="post">
                
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                <input type="hidden" value="<?php echo $id ?> " name="id">
                
                <!-- <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">DIA
                    <input type="text" name="dia" value="<?php echo $dia ?>" class="ms-2 form-control rounded-3" placeholder="dia"></span> -->



                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">MES
                    <input type="text" name="meses" value="<?php echo $mes ?>" class="ms-2 form-control rounded-3" placeholder="mes"></span>

                <!-- <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">SEMANA
                    <input type="text" name="semanas" value="<?php echo $semana ?>" class="ms-2 form-control rounded-3" placeholder="semana"></span> -->

                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white" id="inputGroup-sizing-default">FECHA
                    <input type="text" value="<?php echo $fecha ?>" class="ms-2 form-control rounded-3" name="fecha" placeholder="fecha"></span>

                <span class="mt-2 input-group-text ms-2  rounded-3 bg-success text-white" id="inputGroup-sizing-default">IMPORTE
                    <input type="text" value="<?php echo $importe ?>" name="importe" class="ms-2 rounded-3 form-control" placeholder="importe "></span>

                <span class="mt-2 input-group-text  ms-2 rounded-3 bg-primary text-white" id="inputGroup-sizing-default ">CONCEPTO
                    <input type="text" value="<?php echo $concepto ?>" name="concepto" class="ms-2 rounded-3 form-control" placeholder="comentario"> </span>

                <span class="mt-2 input-group-text ms-2  rounded-3 bg-danger text-white" id="inputGroup-sizing-default">COMENTARIO
                    <textarea   name="comentario"  cols="40" rows="2" class="ms-2 rounded-3 form-control" placeholder="comentario"><?php echo $comentario ?></textarea>

                    <input type="submit" name="actualizar" value="EDITAR" class="btn btn-warning ms-3"></span>


               </div> 
            </form>
            
        </div>
        <div class="container justify-content-center d-flex">
            <a  href="gastos.php?meses=<?php echo $mes ?>"><button class="btn btn-primary ">VOLVER</button></a>
            </div>
    </div>
</body>

</html>