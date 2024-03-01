<?php

include 'conector.php';

session_start();

if (empty($_SESSION['id'])) {
    header("Location:index.php");
}


$nivel = $_SESSION['nivel'];
$nombre = $_SESSION['nombre'];
// $mes = $_GET["meses"];
// $anio = $_GET['anios'];

// No mostrar los errores de PHP
error_reporting(0);


$dia = $_POST['dia'];
$mes = $_POST["meses"];
$anio = $_POST['anios'];

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
                        columns: [1, 2,3] //exportar solo la primera y segunda columna
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

<!--<a href="facturas.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="FACTURAS"></a>-->

        </div>
    
      </div>

     
 
</nav>



<div class="container">
<h1 class=" text-center"><?php echo $mensual[$_GET["meses"]-1] ; ?></h1>


<form action="totales.php" class="text-center ">

            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 ">
                
 

                <span class="input-group-text me-2 mt-2 mb-2 bg-info text-white  rounded-3" id="">
          
 <!--<input type="text" class="form-control ms-2 " name="conductor" value="Ruben" />-->

                    
   
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
            <th>TOTAL</th>
            <th>TOTALES</th>
            
         
            <!--<th style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;">OPCIONES</th>-->
        </tr>
    </thead>


    <?php
    
    
    $mes = $_GET["meses"];
    $anios = $_GET["anios"];
    $conductor = $_GET['conductor'];
  

 

    // var_dump($mes);

    $sql = "SELECT * FROM totales WHERE fecha LIKE '%/$mes/%$anios' ";

    $query = $conn->query($sql);

    foreach ($query as $row) :
       
        $mes = $_GET["meses"];
        
        $suma_totales = $suma_totales + $row['total'];
       
   
    ?>


        <tr>
            <td class="text-center"><?php echo  $row['id']  ?></td>
            
            <td class="text-center" style="color: lightskyblue;"><?php echo  $row['fecha']  ?></td>

            <td class="text-center"> <?php echo  $row['total']  ?>€</td>
            
            <td class="text-center"> <?php echo  $suma_totales ?>€</td>

         
            

            <!--<td style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;" class="text-center">-->
                
            <!--    <a href="borrarReg.php?id=<?php echo $row['id']; ?>&mes=<?php echo $mes ?>"><i id='borrar' name='borrar' class="bi bi-trash-fill btn btn-danger" type='button' onclick="return confirm('Estas seguro que quieres borra el registro?')"></i> -->
            <!--    </a>-->

            <!--    <a href="editarReg.php?id=<?php echo $row['id']; ?>&dia=<?php echo $dia; ?>&meses=<?php echo $mes; ?>&semanas=<?php echo $semana ?>&fecha=<?php echo $row['fecha']; ?>&efectivo=<?php echo $row['efectivo']; ?>&tarjeta=<?php echo $row['tarjeta']; ?>&gasolina=<?php echo $row['gasolina'] ?>">-->
            <!--        <i class="bi bi-pencil btn btn-warning" id='editar' name='editar'></i>-->
            <!--    </a>-->
            <!--</td>-->
            

        <?php endforeach; ?>

        
</table>

</div>

<div class="row">
    
<div class="col-sm-12 " style="display:<?php if($nivel=='2'){echo $visible= 'none';} ?>;">
    <h1 class="border rounded-3 p-4 text-center"><?php echo "TOTALES" . "<br><spam style='color:lawngreen;'>" . $suma_totales; ?>€</spam>
    </h1>   
  
</div>
</div>
</div>


    


 <script src="js/scripts.js"></script>

</body>
</html>