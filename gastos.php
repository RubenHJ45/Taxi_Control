<?php

session_start();

// if (empty($_SESSION['id'])) {
//     header("Location:index.php");
// }
// if ($_SESSION['nivel']=='2') {
//     header("Location:totalMes.php");
// }

require_once 'conector.php';


// No mostrar los errores de PHP
error_reporting(0);



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
                        columns: [1, 2, 3, 4, 5] //exportar solo la primera y segunda columna
                    },
                    titleAttr: 'Exportar a PDF',
                    className: 'btn btn-danger '
                }]

            });
        });
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

            horaImprimible = hora + " : " + minuto

            document.form_reloj.fecha.value = dias_semanas[today.getDay()] + ' ' + day + '/' + month + '/' + year 

            setTimeout("mueveReloj()", 1000)
        }
    </script>

    <title id="tituloPag"></title>
</head>

<body class="dark" onload="mueveReloj()" onselectstart='return false'>
    <?php


    if (isset($_POST['insertar'])) {

        $mes = $_POST['meses'];

        $fecha = $_POST['fecha'];

        $importe = $_POST['importe'];

        $concepto = $_POST['concepto'];

        $comentario = $_POST['comentario'];

        $total = $_POST['total'];


        $sql = "INSERT INTO gastos (fecha, importe,concepto,comentario ) 
VALUES ('$fecha','$importe','$concepto','$comentario')";
        $query = $conn->query($sql);

        header("Location:gastos.php");
    }
    // var_dump($sql);


    ?>

    <nav class="navbar navbar-dark bg-dark ">
        <div class="container-fluid">
            <p class="text-info "><a href="controlador_cerrar.php"><input type="button" class="btn btn-sm btn-danger" value="SALIR"></a> <span class="ms-3 btn btn-sm btn-warning"><?php echo $_SESSION['nombre'] . " " . $_SESSION['apellido']  ?> </span></p>
            <h3 id="titulomes"></h3>




            <div>
                <a href="inicio.php"><input class="btn btn-sm btn-primary" type="button" value="INICIO"></a>
                <a href="usuarios.php"><input type="button" class="btn btn-sm  btn-primary" value="USUARIOS"></a>
                <a href="facturas.php"><input type="button" class="btn btn-sm btn-primary" value="FACTURAS"></a>
                <a href="totalMes.php"><input class="btn btn-sm btn-primary" type="button" value="MES"></a>

            </div>

        </div>
    </nav>


    <!-- AQUI EMPIEZA LA WEB -->
    <div class="container ">

    <div style="width:100%; padding:-50px;" class="row">

        <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">



            
                <?php
                $mes = $_GET["meses"];

                ?>

                <form action="gastos.php?mesese=<?php echo $mes; ?>" class="mt-1  ">
                    <label for="" class="ms-2 mt-2">MOSTRAR MES</label>
                    <span class="input-group-text ms-2 bg-info text-white rounded-3" id="inputGroup-sizing-default">MES
                        <select class="form-select ms-2" name="meses" id="meses" onchange="this.form.submit()">
                            <option value=""></option>
                            <option value="1">ENERO</option>
                            <option value="2">FEBRERO</option>
                            <option value="3">MARZO</option>
                            <option value="4">ABRIL</option>
                            <option value="5">MAYO</option>
                            <option value="6">JUNIO</option>
                            <option value="7">JULIO</option>
                            <option value="8">AGOSTO</option>
                            <option value="9">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                        </select></span>
                </form>


                <form class="w-100 " name="form_reloj" action="gastos.php?meses=<?php echo $mes ?>" method="post">

                    <input type="submit" name="insertar" value="GUARDAR" class="btn btn-success text-white ms-2 mt-2  rounded-3 w-100">




                    <label for="importe" class=" p-2 ms-1">IMPORTE</label>
                    <input type="text" id="efect" name="importe" class="form-control p-2 ms-2" placeholder="importe €">

                    <label for="concepto" class=" p-2 ms-1">CONCEPTO</label>
                    <input type="text" id="tarj" name="concepto" class="form-control p-2 ms-2" placeholder="concepto">

                    <label for="comentario" class=" p-2 ms-1">COMENTARIO</label>
                    <textarea type="text" id="tarj" name="comentario" cols="80" rows="2" style="resize: none;" class="form-control p-2 ms-2" placeholder="comentario"></textarea>

                    <label for="fecha" class="p-2 ms-1">FECHA</label>
                    <input type="text" id="fecha" class="form-control ms-2 mb-3 " name="fecha">

                    <label for="tarjeta" class=" p-2 ms-1">TOTAL</label>
                    <input type="text" name="total" id="total" class="form-control p-2 ms-2" placeholder="total €">
            

            </form>

        </div>

        <div class="col-sm-14 col-md-8 col-lg-8 col-xl-8">
            <div class=" table-responsive mt-3">
          

                <table id="example" class="table  mt-2 table-dark  table-striped table-hover table-bordered " data-page-length="6">

                    <thead class="text-center border">
                        <tr>
                            <th>ID</th>
                            <th>FECHA</th>
                            <th>IMPORTE</th>
                            <th>CONCEPTO</th>
                            <th>COMENTARIO</th>
                            <!-- <th>TOTAL</th> -->
                            <th>OPCIONES</th>
                        </tr>
                    </thead>


                    <?php
                    $mes = $_GET["meses"];
                    $sumar_importe = 0;
                    $sumar_total = 0;




                    // WHERE (fecha LIKE '%VIERNES%') AND (fecha LIKE '%/3/%')

                    $sql = "SELECT * FROM gastos WHERE fecha LIKE '%/$mes/%' ";

                    $query = $conn->query($sql);

                    foreach ($query as $row) :


                        $mes = $_GET["meses"];

                        $sumar_importe = $sumar_importe + floatval($row['importe']);


                    ?>


                        <tr>
                            <td class="text-center"><?php echo  $row['id']  ?></td>

                            <td class="text-center" style="color: lightskyblue;"><?php echo  $row['fecha']  ?></td>


                            <td class="text-center"><?php echo $row['importe'] ?> €</td>

                            <td class="text-center"><?php echo $row['concepto'] ?> </td>

                            <td class="text-center"><?php echo $row['comentario'] ?> </td>

                            <!-- <td class="text-center"><?php echo $sumar_importe ?> </td> -->

                            <td class="text-center"><a href="borrarGastos.php?id=<?php echo $row['id']; ?>&meses=<?php echo $mes ?>"><i id='borrar' name='borrar' class="bi bi-trash-fill btn btn-danger" type='button' onclick="return confirm('Estas seguro que quieres borra el registro?')"></i> </a>

                                <a href="editGastos.php?id=<?php echo $row['id']; ?>&meses=<?php echo $mes; ?>&fecha=<?php echo $row['fecha']; ?>&importe=<?php echo $row['importe']; ?>&concepto=<?php echo $row['concepto']; ?>&comentario=<?php echo $row['comentario'] ?>">
                                    <i class="bi bi-pencil btn btn-warning" id='editar' name='editar'></i>


                                </a>
                            </td>

                        <?php endforeach; ?>
                </table>

                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h1 class="border rounded-3 p-2 text-center"><?php echo "TOTAL GASTOS" . "<br><spam style='color:lawngreen;'>" .  $sumar_importe;  ?>€</spam>
                    </h1>
                </div>
            </div>
        </div>



    </div>



    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

    <script>
        //var lista = [];

        let dias_semanas = ["DOMINGO", "LUNES", "MARTES", "MIERCOLES", "JUEVES", "VIERNES", "SABADO"];


        let mes_anio = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];

        // crea un nuevo objeto `Date`
        var today = new Date();

        // `getDate()` devuelve el día del mes (del 1 al 31)
        var day = today.getDate();

        // `getMonth()` devuelve el mes (de 0 a 11)
        var month = today.getMonth() + 1;

        // `getFullYear()` devuelve el año completo
        var year = today.getFullYear();
        //alert(dias_semanas);

        document.getElementById('total').value = "<?php echo $sumar_importe ?>";


        // document.getElementById('dia0').value = dias_semanas[today.getDay()] + day + month +  year;

        document.getElementById('titulomes').innerHTML = 'GASTOS' + " " + mes_anio[<?php echo $mes ?> - 1];
         document.getElementById('tituloPag').innerHTML = 'GASTOS DE ' + " " + mes_anio[<?php echo $mes ?> - 1];
    </script>
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