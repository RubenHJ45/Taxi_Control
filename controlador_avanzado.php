<?php
session_start();

    if (!empty($_POST['entrar'])) {
       
        if (!empty($_POST['usuario']) and !empty($_POST['password'])) {
            $usuario = $_POST['usuario'];
            $clave = $_POST['password'];
           $sql=$conn->query("SELECT * FROM usuarios WHERE usuario='$usuario' and clave='$clave' ");
           if ($datos=$sql->fetch_object()) {
                $_SESSION['id']=$datos->id;
                $_SESSION['nombre']=$datos->nombre;
                $_SESSION['apellido']=$datos->apellido;
                $_SESSION['nivel']=$datos->nivel;
                header('Location:inicio.php');
           } else {
            echo "<div class='text-center alert alert-danger fs-3'>ACCESO DENEGADO</div>";
           }
           
        } else {
           echo '<div class="text-center alert alert-danger fs-3">CAMPOS VACIOS</div>';
        }
        
     
    }



?>