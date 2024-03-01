<?php

include 'conector.php';
session_start();

if (empty($_SESSION['id'])) {
    header("Location:index.php");
}


error_reporting(0);

if (!isset($_POST['actualizar'])) {

    $id = $_GET['id'];
    
    $nombre = $_GET['nombre'];

    $apellido = $_GET['apellido'];
    
    $licencia = $_GET['licencia'];

    $usuario = $_GET['usuario'];

    $clave = $_GET['clave'];

    $nivel= $_GET['nivel'];


} else {

    $id = $_POST['id'];
    
    $nombre = $_POST['nombre'];

    $apellido = $_POST['apellido'];
    
    $licencia = $_POST['licencia'];

    $usuario = $_POST['usuario'];

    $clave = $_POST['clave'];

    $nivel= $_POST['nivel'];




    $sql = "UPDATE usuarios SET nombre='$nombre', apellido='$apellido', licencia='$licencia', usuario='$usuario', clave= '$clave', nivel= '$nivel'   WHERE id='$id'";

    $query = $conn->query($sql);


    // if($sql){
        
    //     echo '<div class="text-center alert alert-success fs-4">EDITADO CON EXITO</div>';
    // }else{
    //      echo '<div class="text-center alert alert-danger fs-4">CAMPO NO EDITADO</div>';
    // }



 //var_dump($sql);
 
   header("Location:https://controltaxirubmos.000webhostapp.com/inicio.php");
}
?>

    
 <script>
           
  history.replaceState(null,null,Location.pathname)
           
       </script>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="css/styles.css" />
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/datatables.net/js/jquery.dataTables.min.js"></script>

    <script src="./node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>

    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="./node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>


    <title>EDITAR USUARIOS</title>
</head>

<body class="dark" >
 <nav class="navbar navbar-dark bg-dark ">
  <div class="container-fluid">
      <p class="text-info"><?php echo $nombre . " " . $apellido ?></p> <a href="controlador_cerrar.php"><input type="button" class="btn btn-sm btn-danger" value="SALIR"></a>
      <h3 class="text-center ">CONTROL DE EFECTIVO TAXI</h3>
      
    <div>
          <a href="inicio.php"><input class="btn btn-sm btn-primary" type="button" value="INICIO"></a>
           <a href="usuarios.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="USUARIOS"></a>
      <a href="totalMes.php"><input class="btn btn-sm btn-primary" type="button" value="MES"></a>
    
    </div>
             
  </div>
</nav>
    
    <h1 class="text-center">EDITAR USUARIO </h1>

    <div class="container abs-center  p-3 mb-3 mt-1  justify-content-center">

        <div class="row">
            
            <form name="formulariousuarios" class="justify-content-center d-flex p-3" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                
            <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                
                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">NOMBRE
                    <input type="text" name="nombre" value="<?php echo $nombre ?>" class="ms-2 form-control rounded-3" placeholder="nombre"></span>

                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">APELLIDO
                    <input type="text" name="apellido" value="<?php echo $apellido ?>" class="ms-2 form-control rounded-3" placeholder="apellido"></span>
                    
                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">Nº LICENCIA
                    <input type="text" name="licencia" value="<?php echo $licencia ?>" class="ms-2 form-control rounded-3" placeholder="licencia"></span>

                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white w-auto" id="inputGroup-sizing-default">USUARIO
                    <input type="text" name="usuario" value="<?php echo $usuario ?>" class="ms-2 form-control rounded-3" placeholder="usuario"></span>

                <span class=" mt-2 input-group-text ms-2 rounded-3 bg-info text-white" id="inputGroup-sizing-default">CLAVE
                    <input id="txtPassword"  type="password" value="<?php echo $clave ?>" class="ms-2 form-control rounded-3" name="clave" placeholder="clave"><button id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()"> <span class="fa fa-eye-slash icon"></span> </button></span>

                <span style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" class="mt-2 input-group-text ms-2  rounded-3 bg-success text-white" id="inputGroup-sizing-default" <input type="submit" name="actualizar" value="EDITAR" class="btn btn-warning ms-3">NIVEL
                    <input type="text" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="<?php echo $nivel ?>" name="nivel" class="ms-2 rounded-3 form-control" placeholder="nivel ">  </span>
                    
                    <input type="submit" name="actualizar" value="EDITAR" class="btn btn-warning ms-3">
                   

    

                   <script type="text/javascript">
function mostrarPassword(){
		var cambio = document.getElementById("txtPassword");
		if(cambio.type == "password"){
			cambio.type = "text";
			$('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
		}else{
			cambio.type = "password";
			$('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
		}
	} 
	
	$(document).ready(function () {
	//CheckBox mostrar contraseña
	$('#ShowPassword').click(function () {
		$('#Password').attr('type', $(this).is(':checked') ? 'text' : 'password');
	});
});
</script>


               </div> 
            </form>
            
        </div>
        <div class="container justify-content-center d-flex">
            <a  href="inicio.php"><button class="btn btn-primary ">VOLVER</button></a>
            </div>
    </div>
    
    
                    
</body>
</html>