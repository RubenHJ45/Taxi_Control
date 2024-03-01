<?php

include 'conector.php';

session_start();

if (empty($_SESSION['id'])) {
    header("Location:index.php");
}


$nivel = $_SESSION['nivel'];
$nombre = $_SESSION['nombre'];


// No mostrar los errores de PHP
error_reporting(0);


$dia = $_POST['dia'];
$mes = $_POST["meses"];
$semana = $_POST["semanas"];
$gasolina = $_POST["gasolina"];

$visible = "none";


$mensual = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
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

    <link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <script src="./node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="./datatables/datatables.min.js"></script>
    <script src="./datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="./datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="./datatables/Buttons-2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="./datatables/Buttons-2.3.6/js/buttons.html5.min.js"></script>
    <script src="./datatables/JSZip-2.5.0/jszip.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable({


                "language": {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Hay _TOTAL_ Resultados",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Resultados",
                    "infoFiltered": "(Filtrado de _MAX_ total Resultados)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Resultados",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                  responsive: "true",
                dom: 'Bfrtilp',
                buttons: [{
                    extend: 'pdfHtml5',
                    text: '<i class="bi bi-download xl"> PDF</i>',
                    exportOptions: {
                        columns: [1, 2,3, 4,5] //exportar solo la primera y segunda columna
                    },
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger '
                }]

            });
        });
    </script>

    <title>TOTAL MES </title>
</head>
<body class="dark" onselectstart = 'return false'>
     <nav class="navbar " onselectstart = 'return false'>
 
      <?php
      
      $sql = "SELECT * FROM roles ";

    $query = $conn->query($sql);

    foreach ($query as $row){
        
        $rol = $row['descripcion'];
    }
      
      ?>
    
      <div class="container-fluid">
            <p class="text-info "><a href="controlador_cerrar.php"><input type="button" class="btn btn-sm btn-danger " value="SALIR"></a>
            
            <span class="ms-3 btn btn-sm btn-warning"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']  ?> </span><a href="editarUsuario.php?id=<?php echo $fila['id']; ?>&nombre=<?php echo $nombre; ?>&nivel=<?php echo $fila['nivel']; ?>&apellido=<?php echo $_SESSION['apellido'] ; ?>&licencia=<?php echo $fila['licencia']; ?>&usuario=<?php echo  $fila['usuario'] ?>&clave=<?php echo $fila['clave']; ?>&nivel=<?php echo $fila['nivel'] ?>">
                                    <i class="bi bi-pencil btn btn-success btn-sm" id='editar' name='editar'></i>


                                </a></p> <h3>TOTALES </h3> 

              <div>
          <a href="inicio.php"><input style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;" class="btn btn-sm btn-primary" type="button" value="INICIO"></a>
          
           <!--<a href="usuarios.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="USUARIOS"></a>-->
           
<a href="gastos.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="GASTOS"></a>
<a href="totales.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="TOTALES"></a>

<!--<a href="facturas.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="FACTURAS"></a>-->

        </div>
    
      </div>

     
 
</nav>



<div class="container">
<h1 class=" text-center"><?php echo $mensual[$_GET["meses"]-1] ; ?></h1>


<form action="totalMes.php" class="text-center ">

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 d-flex">
                
 

                <span class="input-group-text me-2 mt-2 mb-2 bg-info text-white  rounded-3" id="">
          
 <input type="text" class="form-control ms-2 " name="conductor" value="<?php if($_SESSION['nivel']=='2'){ echo 'Ruben';}else {echo $nombre;}  ?>" />

                    
   
                    <select name="meses" class="form-select  ms-2" id="meses" onchange="this.form.submit()">

                        <option value=""> mes</option>
                        <option value="1">ENERO</option>
                        <option value="02">FEBRERO</option>
                        <option value="03">MARZO</option>
                        <option value="04">ABRIL</option>
                        <option value="05">MAYO</option>
                        <option value="06">JUNIO</option>
                        <option value="07">JULIO</option>
                        <option value="08">AGOSTO</option>
                        <option value="09">SEPTIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>


                    </select>
                    
                    
      <select name="anios" class="form-select  ms-2" id="meses" >

                    
                        <option value="2024" selected>2024</option>
                        <option value="2025" >2025</option>
                        <option value="2026" >2026</option>
                        <option value="2027" >2027</option>
                


                    </select>
                    
                    
                    </span>

        </form>
          </div>
        
     <div class=" table-responsive ">     
<table id="example" class="table  mt-2 table-dark  table-striped table-hover table-bordered " >

    <thead class="text-center border">
        <tr class="w-50">
            <th>ID</th>
            <th>FECHA</th>
            <th>EFECTIVO</th>
            <th>TARJETA</th>
            <th>GASOLINA</th>
            <th>TOTAL</th>
            <th style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;">OPCIONES</th>
        </tr>
    </thead>


    <?php
    
    
    $mes = $_GET["meses"];
    $anios = $_GET["anios"];
$conductor = $_GET['conductor'];
  
    $gasolina = $_GET["gasolina"];
    $sumar_efectivo = 0;
    $sumar_tarjeta = 0;
    $sumar_gasolina = 0;
    $sumar_caja = 0;
    $beneficio = 0;
    $sin_gasolina = 0;
    $total_suma_e_t = 0;
    $mi_ingreso2 = 0;
    $sumaTotal = 0;
 

    // var_dump($mes);

    $sql = "SELECT * FROM $conductor WHERE fecha LIKE '%/$mes/%$anios' ";

    $query = $conn->query($sql);

    foreach ($query as $row) :
       
        $mes = $_GET["meses"];
       
        
        $sumar_efectivo = $sumar_efectivo + floatval($row['efectivo']);
        $sumar_tarjeta = $sumar_tarjeta + floatval($row['tarjeta']);
        $sumar_gasolina = $sumar_gasolina + floatval($row['gasolina']);
        $sumar_total = $sumar_total+ floatval($row['total']);

        $total_suma_e_t = $sumar_efectivo + $sumar_tarjeta;
        
        $sin_gasolina = $sumar_efectivo - $sumar_gasolina;
        
        $mitad_gasolina = $sumar_gasolina /2;

        $beneficio = $total_suma_e_t - $sumar_gasolina ;
         
        $mi_ingreso = $beneficio /2 ;
        
        $mi_ingreso2 = $mi_ingreso - $sin_gasolina;
        
        $sumaTotal = $mi_ingreso2 + $sin_gasolina;
    ?>


        <tr>
            <td class="text-center"><?php echo  $row['id']  ?></td>
            
            <td class="text-center" style="color: lightskyblue;"><?php echo  $row['fecha']  ?></td>

            <td class="text-center"> <?php echo  $row['efectivo']  ?>€</td>

            <td class="text-center"><?php echo $row['tarjeta'] ?> €</td>

            <td class="text-center"><?php echo $row['gasolina'] ?> €</td>
            
            <td class="text-center"><?php echo $total_suma_e_t ?> €</td>
            

            <td style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;" class="text-center">
                
                <a href="borrarReg.php?id=<?php echo $row['id']; ?>&dia=<?php echo $dia ?>&mes=<?php echo $mes ?>&semana=<?php echo $semana ?>"><i id='borrar' name='borrar' class="bi bi-trash-fill btn btn-danger" type='button' onclick="return confirm('Estas seguro que quieres borra el registro?')"></i> 
                </a>

                <a href="editarReg.php?id=<?php echo $row['id']; ?>&dia=<?php echo $dia; ?>&meses=<?php echo $mes; ?>&semanas=<?php echo $semana ?>&fecha=<?php echo $row['fecha']; ?>&efectivo=<?php echo $row['efectivo']; ?>&tarjeta=<?php echo $row['tarjeta']; ?>&gasolina=<?php echo $row['gasolina'] ?>">
                    <i class="bi bi-pencil btn btn-warning" id='editar' name='editar'></i>
                </a>
            </td>
            

        <?php endforeach; ?>

        
</table>

</div>


</div>

<div class="container  p-2 mt-3 mb-5 ">
    
<div class="row ">
    
<div class="col">
    <h1 class="border rounded-3 p-2 text-center"><?php echo "EFECTIVO" . "<br><spam style='color:lawngreen;'>" .  $sumar_efectivo ;  ?>€</spam>
    </h1>
</div>
<div class="col" style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;">
    <h1 class="border rounded-3 p-2 text-center"><span class="fs-6"><?php echo "SIN GASOLINA" . "</span><br><spam style='color:lawngreen;'>" .  $sin_gasolina ;  ?>€</span>
    </h1>
</div>
<div class="col">
    <h1 class="border rounded-3 p-2 text-center "><?php echo "TARJETA" . "<br><spam class='text-info'>" .  $sumar_tarjeta;  ?>€</spam>
    </h1>
</div>
<div class="col">
    <h1 class="border rounded-3 p-2 text-center"><?php echo "GASOLINA" . "<br><spam style='color:red;'>" .  $sumar_gasolina; ?>€</spam>
    </h1>
</div>
<div class="col">
    <h1 class="border rounded-3 p-2 text-center"><?php echo "TOTAL" . "<br><spam style='color:lawngreen;'>" .  $total_suma_e_t ;  ?>€</spam>
    </h1>
</div>
 <div class="col">
    <h1 class="border rounded-3 p-2 text-center"><?php echo "BENEFICIO" . "<br><spam style='color:lawngreen;'>" . $beneficio;  ?>€</spam>
    </h1>
</div>

</div>
<div class="row">
    
<div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;">
    <h1 class="border rounded-3 p-2 text-center"><?php echo "PROPIETARIO" . "<br><spam style='color:lawngreen;'>" . $beneficio /2;  ?>€</spam>
    </h1>   
  
</div>

<div class="col"  style="display:<?php if($nivel=='2'){echo $visible= 'block';} ?>;">
<h1 class="border rounded-3 p-2 text-center "><?php echo $conductor. "" . "<br><spam style='color:lawngreen;'>" . $mi_ingreso2 ;  ?>€</spam></h1>
</div>

</div>
 <script src="js/scripts.js"></script>

</body>
</html>