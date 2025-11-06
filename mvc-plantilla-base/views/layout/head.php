<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Pacientes</title>
     <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <div class="container"><!-- Contenedor principal -->
        <div class="text-center pt-5 pb-4">
            <h4 class="text-center">App de Gestión de Pacientes - MVC</h4>
            <p class="lead">Sistema de gestión hospitalaria con CRUD, sesiones y cookies</p>

            <!-- Barra simple de estado de sesión -->
            <?php if(isset($_SESSION['user'])): ?>
                <p>Usuario: <b><?= $_SESSION['user']['nombre'] ?></b> | <a href="index.php?controller=AuthController&accion=logout">Cerrar Sesion</a></p>
            <?php else: ?>
                <p><a href="index.php?controller=AuthController&accion=login">Iniciar sesion</a></p>
            <?php endif; ?>
        </div>

        <?php 
            if(isset($_SESSION['user'])){
                echo "Bienvenido, " . $_SESSION['user']['nombre'];
            }else{
                echo "No has iniciado session";
            }
        ?>