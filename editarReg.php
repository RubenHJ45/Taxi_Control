<?php

session_start();

if (empty($_SESSION['id'])) {
    header("Location:index.php");
}
include 'conector.php';
// var_dump($_GET['meses']);    

 $nombre = $_SESSION['nombre'];
 $apellido = $_SESSION['apellido'];
 //$licencia = $_SESSION['licencia'];

if (!isset($_POST['actualizar'])) {

    $id = $_GET['id'];

    $hora = $_GET['hora'];

    $fecha = $_GET['fecha'];

    $efectivo = $_GET['efectivo'];

    $tarjeta = $_GET['tarjeta'];

    $gasolina = $_GET['gasolina'];
    
    $concepto = $_GET['concepto'];

} else {

    $id = $_POST['id'];

    $hora = $_POST['hora'];

    $fecha = $_POST['fecha'];

    $efectivo = $_POST['efectivo'];

    $tarjeta = $_POST['tarjeta'];

    $gasolina = $_POST['gasolina'];
    
    $concepto = $_POST['concepto'];


    $sql = "UPDATE $nombre SET fecha='$fecha',hora='$hora', efectivo='$efectivo', gasolina='$gasolina', tarjeta= '$tarjeta', concepto= '$concepto' WHERE id='$id'";

    $query = $conn->query($sql);

  // var_dump($sql);
   
     header("Location:https://controltaxirubmos.000webhostapp.com/inicio.php");
}


?>


<!DOCTYPE html>

<html lang="es">
 <script>
           
  history.replaceState(null,null,Location.pathname)
           
       </script>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="css/styles.css" />
    <title>EDITAR REGISTROS</title>
    
    <script>
         function format(input){
              
                 var num = input.value.replace(/\./g,'');
                 
                 if(!isNaN(num)){
                        num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{2})/g,'$1.');
                        num = num.split('').reverse().join('').replace(/^[\.]/,'');
                        input.value = num;
                }else{ 
                    alert('Solo se permiten numeros');
                    input.value = input.value.replace(/[^\d\.]*/g,'');
                }
        }
    </script>
</head>

<body class="dark" >
 <nav class="navbar navbar-dark bg-dark ">
  <div class="container-fluid">
      <p class="text-info"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']  ?></p> <a href="controlador_cerrar.php"><input type="button" class="btn btn-sm btn-danger" value="SALIR"></a>
      <h3 class="text-center ">CONTROL DE FACTURACION TAXI</h3>
      
    <div>
          <a href="inicio.php"><input class="btn btn-sm btn-primary" type="button" value="INICIO"></a>
           <a href="usuarios.php"><input type="button" class="btn btn-sm btn-primary" value="USUARIOS"></a>
      <a href="totalMes.php"><input class="btn btn-sm btn-primary" type="button" value="MES"></a>
    
    </div>
             
  </div>
</nav>

    <h1 class="text-center mt-3">EDITAR REGISTROS</h1>

    <div class="container   justify-content-center ">

        <div class=" row  ">
            
            <form name="formulario" class="justify-content-center d-flex p-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                <input type="hidden" value="<?php echo $id ?> " name="id">
                
                 <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">CONCEPTO
                    <select class="ms-2 form-select" name="concepto">
                        <option value=""></option>
                        <option value="CABIFY">CABIFY</option>
 <option value="UBER">UBER</option>
                        <option  value="FREENOW">FREENOW</option>
                        <option  value="TAXI">TAXI</option>
                    </select></span>
                    
               


                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white" id="inputGroup-sizing-default">FECHA
                    <input type="text" value="<?php echo $fecha ?>" class="ms-2 form-control rounded-3" name="fecha" placeholder="fecha"></span>
                    
                 <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">HORA
                    <input type="text" name="hora" value="<?php echo $hora ?>" class="ms-2 form-control rounded-3" placeholder="hora"></span>


                <span class="mt-2 input-group-text ms-2  rounded-3 bg-success text-white" id="inputGroup-sizing-default">EFECTIVO
                    <input type="text" value="<?php echo $efectivo ?>" name="efectivo" class="ms-2 rounded-3 form-control" onkeyup="format(this)" onchange="format(this)" onfocus="if(this.value == '0') { this.value = ''; }" placeholder="efectivo "></span>

                <span class="mt-2 input-group-text  ms-2 rounded-3 bg-primary text-white" id="inputGroup-sizing-default ">TARJETA
                    <input type="text" value="<?php echo $tarjeta ?>" name="tarjeta" class="ms-2 rounded-3 form-control" onkeyup="format(this)" onchange="format(this)" placeholder="Tarjeta"> </span>

                <span class="mt-2 input-group-text ms-2  rounded-3 bg-danger text-white" id="inputGroup-sizing-default">GASOLINA
                    <input type="text" value="<?php echo $gasolina ?>" name="gasolina" class="ms-2 rounded-3 form-control" onkeyup="format(this)" onchange="format(this)" onfocus="if(this.value == '0') { this.value = ''; }" placeholder="gasolina"> 

                    <input type="submit" name="actualizar" value="EDITAR" class="btn btn-warning ms-3"></span>


               </div> 
            </form>
            
        </div>
        <div class="container justify-content-center d-flex">
            <a  href="inicio.php"><button class="btn btn-primary ">VOLVER</button></a>
            </div>
    </div>
</body>

</html>