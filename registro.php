<?php
session_start();
if (isset($_SESSION["error"]))
    $error = $_SESSION["error"];
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body class="bg-dark">
<div class="jumbotron display-3 text-center">Registro</div>
<div class="container text-center">
    <form action="comprobacion.php" class="text-left text-white" method="post">
        <?php
        if (isset($error["conexionFallida"])){
            ?>
            <script>
                alert("La base de datos no responde. Inténtalo más tarde.");
            </script>
            <?php
        }
        if (isset($error["usernameDuplicado"])){
            echo "<div class=\"alert alert-danger\">Ese nombre de usuario ya está en uso.</div>";
        }
        if (isset($error) && $error["username"] == ""){
            echo "<div class=\"alert alert-danger\">Es necesario escribir un nombre de usuario.</div>";
        }
        ?>
        <div class="form-group"><label for="username">Usuario: </label><input type="text" class="form-control" name="username"></div>
        <?php
        if (isset($error) && $error["nombre"] == ""){
            echo "<div class=\"alert alert-danger\">Es necesario rellenar el nombre.</div>";
        }
        ?>
        <div class="form-group"><label for="nombre">Nombre: </label><input type="text" class="form-control" name="nombre"></div>
        <?php
        if (isset($error) && $error["apellidos"] == ""){
            echo "<div class=\"alert alert-danger\">Es necesario rellenar los apellidos.</div>";
        }
        ?>
        <div class="form-group"><label for="apellidos">Apellidos: </label><input type="text" class="form-control" name="apellidos"></div>
        <?php
        if (isset($error) && $error["password"] == ""){
            echo "<div class=\"alert alert-danger\">Es necesario introducir una contraseña.</div>";
        }
        ?>
        <div class="form-group"><label for="password">Contraseña: </label><input type="password" class="form-control" name="password"></div>
        <?php
        if (isset($error) && ($error["conf_password"] == "" || $error["password"] != $error["conf_password"])){
            echo "<div class=\"alert alert-danger\">Las contraseñas deben coincidir.</div>";
        session_destroy();
        }
        ?>
        <div class="form-group"><label for="conf_password">Confirmar contraseña: </label><input type="password" class="form-control" name="conf_password"></div>
        <button class="btn btn-info">Registrarse</button>
    </form>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</html>
