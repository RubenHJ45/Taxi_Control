<?php

session_start();
require_once 'conector.php';

if (empty($_SESSION['id'])) {
    header("Location:index.php");
}
if ($_SESSION['nivel'] == '2') {
    header("Location:totalMes.php");
}




// No mostrar los errores de PHP
error_reporting(0);
//echo 'hola nevo';
$nombre = $_SESSION['nombre'];

$nivel = $_SESSION['nivel'];

$licencia = $_SESSION['licencia'];

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


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" integrity="sha384-4LISF5TTJX/fLmGSxO53rV4miRxdg84mZsxmO8Rx5jGtp/LbrixFETvWa5a6sESd" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="./node_modules/bootstrap-icons/font/bootstrap-icons.css">-->
    
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
<!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">-->

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
                        columns: [1, 3, 4,5, 7] //exportar solo la primera y segunda columna
                    },
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger '
                }]

            });
        });
        
        
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
    
    
    
    <script>
    
        function mueveReloj() {
            momentoActual = new Date()
            hora = momentoActual.getHours()
            minuto = momentoActual.getMinutes()
            segundo = momentoActual.getSeconds()

            str_segundo = new String(segundo)
            if (str_segundo.length == 1)
                segundo = "0" + segundo

            str_minuto = new String(minuto)
            if (str_minuto.length == 1)
                minuto = "0" + minuto

            str_hora = new String(hora)
            if (str_hora.length == 1)
                hora = "0" + hora

            horaImprimible = hora + ":" + minuto

           // document.form_reloj.fecha.value = dias_semanas[today.getDay()] + ' ' + day + '/' + month + '/' + year;
            document.form_reloj.hora.value = horaImprimible;

            setTimeout("mueveReloj()", 1000)
           
        }
        
    </script>



    <title>FACTURACION TAXI</title>
</head>

<body class="dark" onload="mueveReloj(),initComponet()" onselectstart='return true'>

    <?php
  
    $nombre = $_SESSION['nombre'];

    if (isset($_POST['insertar'])) {


        $concep = $_POST['concepto'];

        $fecha = $_POST['fecha'];

        $hora = $_POST['hora'];

        $efectivo = $_POST['efectivo'];

        $tarjeta = $_POST['tarjeta'];

        $gasolina = $_POST['gasolina'];

        $total = $_POST['total'];


        $sql = "INSERT INTO $nombre$apellido$licencia (fecha, hora, efectivo,tarjeta,gasolina, concepto, total ) 
VALUES ('$fecha','$hora','$efectivo','$tarjeta','$gasolina','$concep', '$total')";

        $query = $conn->query($sql);

        //var_dump($sql);

    }



    
    ?>
    
 <script>
           
  history.replaceState(null,null,Location.pathname)
           
       </script>
  
       
    <nav class="navbar navbar-dark bg-dark " onselectstart='return false'>
        <!--<div class="switches">-->


        <!--</div>-->

    
   <?php 
          
          $id = $_SESSION['id'];
          
          
             $sql2 = "SELECT * FROM usuarios WHERE id = '$id'";

                        $query = $conn->query($sql2);

                        foreach ($query as $row) {
          
                        $nivel = $row['nivel'];
                        $licencia = $row['licencia'];
                        $apellido = $row['apellido'];
                        $nombre = $row['nombre'];
                        $nivel = $row['nivel'];
                        $usu = $row['usuario'];
                        $clave = $row['clave'];
                        
                        }
          ?>
        <div class="container-fluid">
            <p class="text-info "><a href="controlador_cerrar.php"><input type="button" class="btn btn-sm btn-danger" value="SALIR"></a> 
            <span class="ms-3 btn btn-sm btn-warning"><?php echo $nombre . " " . $apellido ?> </span>
          
       
          
            <a href="editarUsuario.php?id=<?php echo $id; ?>&nombre=<?php echo $nombre; ?>&apellido=<?php echo $apellido ; ?>&licencia=<?php echo $licencia; ?>&usuario=<?php echo  $usu; ?>&clave=<?php echo $clave; ?>&nivel=<?php echo $nivel;?>">
                                    <i class="bi bi-pencil btn btn-success btn-sm" id='editar' name='editar'></i>
                                </a></p>   
            <h3>INICIO </h3>

            <div> 
              
                <a href="usuarios.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="USUARIOS"></a>
                
                <!--<a href="inicioAnterior.php"><input class="btn btn-sm btn-primary" type="button" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;"  value="INI-ANT"></a>-->
                
                <a href="totalMes.php"><input class="btn btn-sm btn-primary" type="button" value="TOTAL MES"></a>
                
                 
                 
                <a href="gastos.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="GASTOS"></a>
                
                <!--<a href="facturas.php"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="FACTURAS"></a> -->
                
<a href="totales.php?meses=<?php echo $mes; ?>&anios=<?php echo $anio ?>"><input type="button" class="btn btn-sm btn-primary" style="display:<?php if($_SESSION['nivel']!='1'){echo $visible= 'none';} ?>;" value="TOTALES"></a>
 
            </div>

        </div>

    </nav>
 

   <div  class="container " onselectstart='return false'> 
 
 <div id="alerta_dia" class="alerta_dia"></div>
 
        <div style ="width:100%; padding:-30px;"class="row">
            
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4" >
            

 <form name="form_dia" class="" action="<?php $_SERVER['PHP_SELF']  ?>" method="post">
     
   
   
       
      <!--<label for="mostrar_dia" class="ms-2 mt-2">MOSTRAR DIA</label>-->

      <i class="bi bi-calendar-date-fill ms-3"> Ver dia por fecha</i>
     
     <div class=" d-flex ">
 
                            <span class="input-group-text ms-2 mb-2 bg-info text-white rounded-3" id="inputGroup-sizing-default">
                                <input type="number" class="form-control ms-2" name="dia" id="dia" placeholder="dia"></span>
                                
                            <span class="input-group-text ms-2 mb-2 bg-info text-white rounded-3" id="inputGroup-sizing-default">
                                <input type="number" class="form-control ms-2" name="mes" id="mes" placeholder="mes"></span>
                                
                            <span class="input-group-text ms-2 mb-2 bg-info text-white rounded-3" id="inputGroup-sizing-default">
                                <input type="number" class="form-control ms-2" name="anio" id="anio"  placeholder="año"> </span>
                       
                </div> 
               
               
                <input type="submit" value="VER DIA" class="btn  btn-primary ms-2 w-100">
</form>

  
        <form name="form_reloj" class="w-100 " action="<?php $_SERVER['PHP_SELF']  ?>" method="post">

<div class="container mt-2 ms-1  d-flex ">
    
<i  class="bi bi-car-front-fill ms-1" ></i>

   <select class="ms-1 fs-3 rounded-2 mt-2 form-control" name="concepto" required >
        <option  selected disabled></option>
                        <option value="CABIFY">CABIFY</option>
                        <option value="FREENOW">FREENOW</option>
                        <option value="TAXI">TAXI</option>
                        <option value="GASOLINA">GASOLINA </option>
                        <option value="GLP">GLP</option>
                    </select>
                    
  <i class="bi bi-floppy-fill  ms-1"></i>
       
<input type="submit" name="insertar" value="GUARDAR"  class="btn btn-success  text-white fs-3 ms-3 mt-2  rounded-3 ">
                 
                    </div>
<div class="container ms-1 d-flex mt-2">
                    <i  class="bi bi-cash-coin" ></i>
                    <input type="text" onkeyup="format(this)" onchange="format(this)" id="efect2" name="efectivo" value="0"  
onfocus="if(this.value == '0') { this.value = ''; }"
                    class="form-control fs-3  ms-2" placeholder="efectivo ">

                    <i  class="bi bi-credit-card-2-back-fill ms-1" ></i>
                    <input type="text" onkeyup="format(this)" onchange="format(this)" id="tarj2" name="tarjeta" value="0" 
                    
onfocus="if(this.value == '0') { this.value = ''; }"
                    
                    class="form-control fs-3  ms-2" placeholder="tarjeta ">
                    </div>

<div class="container ms-1 d-flex mt-2">
<i  class="bi bi-fuel-pump-fill" ></i>
                    <input type="text" onkeyup="format(this)" onchange="format(this)" id="gas2" name="gasolina" value="0" class="form-control fs-3 ms-2"
onfocus="if(this.value == '0') { this.value = ''; }"
                    placeholder="gasolina ">


<i  class="bi bi-wallet2 ms-1" ></i>

                    <input type="text" name="total" id="total" class="form-control fs-3 ms-2" placeholder="total €">
                    
                    </div>
                   
                    <?php 
                    
                    $fecha = $row['fecha'];
                    
                     $sql = "SELECT * FROM $nombre  WHERE fecha LIKE '$fecha' ";
                     
                     $fecha = $row['fecha'];

                    $query = $conn->query($sql);
                    
                    $fechaNocturna = $row['fecha'];
                    
                    echo  $fechaNocturna;
                    
                    
                    ?>
                    

<div class="container ms-1 d-flex mt-2">
<i class="bi bi-calendar-date-fill "></i>
                 <input type="text" id="fecha"  class="form-control ms-2 fs-3 mb-2" name="fecha">

</div>

<div class="container ms-1 d-flex mt-1">
<i class="bi bi-hourglass-split  "></i>
<input type="text" id="hora" class="form-control fs-3 ms-1 mb-2" name="hora">

</div>

<button class="btn w-100 btn-warning ms-2 mb-1 " onclick="establecerFecha(this)">ESTABLECER FECHA NOCHE</button>

<div class="container  d-flex mt-1">
<button type="button" class="btn w-50  btn-info ms-2 mb-1 " data-bs-toggle="modal" data-bs-target="#exampleModal">GUARDAR DIA </button> 
<button type="button" class="btn w-50 btn-primary ms-2 mb-1" data-bs-toggle="modal" data-bs-target="#exampleModalVer">
 VER MES
</button>

</div>


<!--<button type="button" class="btn w-100 btn-primary ms-2 mb-1"><a class="text-white" href="totales.php">TOTALES</a></button>-->

          
                </form>
                
                
                 <?php


            if (isset($_POST['insertarTotales'])) {

                $mes = $_POST['mesesTotal'];

                $fechaMes = $_POST['fechaMes'];

                $totalMes = $_POST['totalMes'];



                $sql = "INSERT INTO totales (fecha, total ) 
VALUES ('$fechaMes','$totalMes')";

                $query = $conn->query($sql);

                // var_dump($sql);
            }
            ?>




<!--MODAL GUARDAR MES-->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark">
                        <div class="modal-header">
                            <h5 class="modal-title text-warning mb-2" id="exampleModalLabel">GUARDAR MES</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="col">
                                <form name="formuMes" action="inicio.php" method="post">


                            </div>


                            <div class="col text-warning">
                                FECHA
                                <input type="text" name="fechaMes" id="fechaMes" class="form-control border border-warning border-5 mt-2 mb-2 text-warning bg-dark" placeholder="fecha mes"></span>
                            </div>
                            <div class="col text-warning">
                                TOTAL
                                <input type="text" name="totalMes" id="totalMes" class="form-control mt-2 mb-2 border border-warning border-4 text-warning bg-dark" placeholder="Total mes" required></span>
                            </div>
                          
                            <div class="text-center ">
                                <input type="submit" style="border:solid 5px #20c997 ;" name="insertarTotales" value="GUARDAR" class="btn btn-success border-warning text-warning ms-2 mt-2 rounded-3 ">


                            </div>
                              </form>
                              
                              <div class="d-flex  justify-content-center">
                            <button id="establecerMes" class="btn text-warning border-warning border  border-4  btn-dark ms-2  mt-2 mb-2" onclick="establecerFechaMes(this)">ESTABLECER FECHA NOCHE</button>
                            </div>
                          

                        </div>
                    </div>



                </div>
            </div>
        
       
</div>

            <div class="col-sm-14 col-md-8 col-lg-8 col-xl-8">
 

                <div class=" table-responsive mt-3">
                    <table id="example" class="table mt-2 table-dark  table-striped table-hover table-bordered " data-page-length="5">

                        <thead class="text-center border">
                            <tr>
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>HORA</th>
                                <th>EFECTIVO</th>
                                <th>TARJETA</th>
                                <th>GASO</th>
                                <th>CONCEP</th>
                                <th>TOTAL</th>
                                <th>OPCION</th>
                            </tr>
                            
                              
                        </thead>


                        <?php
                        $sumar_efectivo = 0;
                        $sumar_tarjeta = 0;
                        $sumar_gasolina = 0;
                        $sumar_caja = 0;
                        $beneficio = 0;
                        $sumar_gastos = 0;


                            
                         $dia = $_POST['dia'];
                         $mes = $_POST['mes'];
                        $anio = $_POST['anio'];
                  
                         $sql = "SELECT * FROM $nombre  WHERE fecha LIKE '%$dia/$mes/$anio%' ";
                        $query = $conn->query($sql);

                        foreach ($query as $row) :
                            
                            $fecha = $row['fecha'];
                            

                            $sumar_efectivo = $sumar_efectivo + floatval($row['efectivo']);
                            $sumar_tarjeta = $sumar_tarjeta + floatval($row['tarjeta']);
                            $sumar_gasolina = $sumar_gasolina + floatval($row['gasolina']);                          
                            $sumar_caja = $sumar_efectivo + $sumar_tarjeta;

                            $beneficio = $sumar_caja - $sumar_gasolina;


                        ?>


                            <tr>

                                <td class="text-center"><?php echo  $row['id']  ?></td>

                                <td class="text-center" style="color: lightskyblue;"><?php echo  $fecha ?></td>

                                <td class="text-center"><?php echo  $row['hora']  ?></td>

                                <td class="text-center"> <?php echo  $row['efectivo']  ?>€</td>

                                <td class="text-center"><?php echo $row['tarjeta'] ?> €</td>

                                <td class="text-center"><?php echo $row['gasolina'] ?> €</td>

                                <td class="text-center"><?php echo $row['concepto'] ?></td>

                                <td class="text-center"><?php echo $sumar_caja ?> €</td>

                                <td class="text-center"><a href="borrarReg.php?id=<?php echo $row['id']; ?>&fecha=<?php echo $row['fecha']; ?>"><i id='borrar' name='borrar' class="bi bi-trash-fill btn btn-danger" type='button' onclick="return confirm('Estas seguro que quieres borra el registro?')"></i> </a>

                                    <a href="editarReg.php?id=<?php echo $row['id']; ?>&fecha=<?php echo $row['fecha']; ?>&hora=<?php echo $row['hora']; ?>&efectivo=<?php echo $row['efectivo']; ?>&tarjeta=<?php echo $row['tarjeta']; ?>&gasolina=<?php echo $row['gasolina'] ?>&concepto=<?php echo $row['concepto']; ?>">
                                        <i class="bi bi-pencil btn btn-warning" id='editar' name='editar'></i>


                                    </a>
                                </td>

                            <?php endforeach; ?>
                    </table>

                </div>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 ">
                <h1 id="borde" class="border rounded-3 border-red p-2 text-center"><?php echo "EFECTIVO" . "<br><spam style='color:lawngreen;'>" .  $sumar_efectivo;  ?>€</spam>
                </h1>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4">
                <h1 id="borde" class="border rounded-3 p-2 text-center"><?php echo "TARJETA" . "<br><spam class='text-info'>" .  $sumar_tarjeta;  ?>€</spam>
                </h1>
            </div>
            <div id="borde" class="col-sm-12 col-md-4 col-lg-4">
                <h1 class="border border-red rounded-3 p-2 text-center"><?php echo "COMBUSTIBLE" . "<br><spam style='color:red;'>" .  $sumar_gasolina; ?>€</spam>
                </h1>
            </div>

            <div class="col-12">
                <h1 id="borde" class="border rounded-3 p-2 text-center"><?php echo "TOTAL" . "<br><spam style='color:lawngreen;'>" .  $sumar_caja;  ?>€</spam>
                </h1>
            </div>
            
            <script>
                  $(document).ready(function() {
            $('#example1').DataTable({


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
                    text: '<i class="bi bi-download "> PDF</i>',
                    exportOptions: {
                        columns: [1,2] //exportar solo la primera y segunda columna
                    },
                    titleAttr: 'Exportar a PDF modal',
                    className: 'btn btn-danger '
                }]

            });
        });
            </script>
<!--MODAL VER-->
<div class="modal fade" id="exampleModalVer" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">MES POR DIA</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
     
      <div class="modal-body">

         <div class=" table-responsive mt-3">
                    <table id="example1" class="table mt-2 table-dark  table-striped table-hover table-bordered " data-page-length="5">

                        <thead class="text-center border">
                            <tr>
                                <th>ID</th>
                                <th>FECHA</th>
                                <th>TOTAL</th>
                                <!--<th>TOTALES</th>-->
                            </tr>
                        </thead>
                        
                        <?php
                        
                        $sql = "SELECT * FROM totales  ";

                        $query = $conn->query($sql);
                    
                        foreach ($query as $row) :
                        $sumar_totales = $sumar_totales + $row['total'];
                        
                        ?>
                        
                        <tr>

                                <td class="text-center"><?php echo  $row['id']  ?></td>

                                <td class="text-center" style="color: lightskyblue;"><?php echo $row['fecha'] ?></td>

                                <td class="text-center"><?php echo  $row['total']  ?>€</td>
                                
                                <!--<td class="text-center text-success"><?php echo  $sumar_totales  ?></td>-->
                            </tr>
                            
                            <?php endforeach; ?>
                        </table>
                    
        </div>
      </div>
      <h2 class="text-center text-success">TOTAL <?php echo $sumar_totales ?>€</h2>
      <div class="modal-footer">
          
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CERRAR</button>
       
      </div>
    </div>
  </div>
</div>

    <!--FIN DE FORMULARIOS NUEVOS MESES -->

      
       <script>
       
        var dias_semanas = ["DOMINGO", "LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES", "SABADO"];
        var mes_anio = ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', 'DICIEMBRE'];
            
            
       function establecerFecha(){
        
        <?php
        
                 $sql = "SELECT * FROM Ruben   ";
                        $query = $conn->query($sql);

                        foreach ($query as $row) {
        
                        $fecha = $row['fecha'];
                            
                        }
        ?>
       
        
           document.getElementById('fecha').value = "<?php echo $fecha  ?>";
        
         
       }
         
       function establecerFechaMes(){document.getElementById('fechaMes').value = "<?php echo $fecha  ?>";}
         
         
         function mostrarDia(){
          
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();
            
                str_day = new String(day)
            if (str_day.length == 1)
                day = "0" + day
                
             str_month = new String(month)
            if (str_month.length == 1)
                month = "0" + month
            
            document.getElementById('dia').value = day;
            document.getElementById('mes').value = month;
            document.getElementById('anio').value = today.getFullYear();
        
            
         }
       
       function actualizarFecha() {
           
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();
            
          str_day = new String(day)
            if (str_day.length == 1)
                day = "0" + day
                
             str_month = new String(month)
            if (str_month.length == 1)
                month = "0" + month
            
           document.getElementById('fecha').value = dias_semanas[today.getDay()] + ' ' + day + '/' + month + '/' + year;
           document.getElementById('fechaMes').value = dias_semanas[today.getDay()] + ' ' + day + '/' + month + '/' + year;
         
            
       }
    
          function Refuerzo() {
              
                var today = new Date();
                var day = today.getDate();
                var month = today.getMonth() + 1;
                var year = today.getFullYear();
            
              str_day = new String(day)
                if (str_day.length == 1)
                    day = "0" + day
                    
                 str_month = new String(month)
                if (str_month.length == 1)
                    month = "0" + month
            
           document.getElementById('fecha').value = dias_semanas[today.getDay()] + ' ' + day + '/' + month + '/' + year;
           
                let recoger_fecha = document.getElementById('fecha').value
                let recoger_dia = recoger_fecha.substr(0, 2)
                let recoger_dia_numero =  recoger_fecha.substr(7, 2) % 2 == 1
               // alert(recoger_dia_numero)
                
                if (recoger_dia == "SA" && recoger_dia_numero || recoger_dia == "DO" && recoger_dia_numero ){
                    return document.getElementById('alerta_dia').innerHTML = `<div class='text-center fs-4 alert alert-danger fs-3'>LIBRAS HASTA LAS 20:00<br> (Toca Refuerzo de 20:00 a 06:00)</div>`

                } else if (recoger_dia == "MI") {
                    return document.getElementById('alerta_dia').innerHTML = `<div class='text-center alert alert-danger fs-3'>DESCANSO OBLIGATORIO</div>`
                }

                // else {
                //     return document.getElementById('alerta_dia').innerHTML = `<div class='text-center alert alert-success fs-3'>JORNADA LABORAL</div>`

                // }


            }
  
   
            document.getElementById('total').value = "<?php echo $sumar_caja ?>";
            
             document.getElementById('totalMes').value = "<?php echo $sumar_caja ?>";
            totalefec = document.getElementById('totalEfectivo').value = "<?php echo $sumar_efectivo ?>";
            totalTarjeta = document.getElementById('totalTarjeta').value = "<?php echo $sumar_tarjeta ?>";
            totalGasolina = document.getElementById('totalGasolina').value = "<?php echo $sumar_gasolina ?>";
             
        
            document.getElementById('meses2').value = mes_anio[today.getMonth()];
         
            function initComponet(){
                
                mostrarDia(),
                actualizarFecha(),
                Refuerzo()
                
                
            }

           
        </script>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="js/scripts.js"></script>
        
     
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