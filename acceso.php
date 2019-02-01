<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Acceso</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
<body class="bg-dark">
<div class="jumbotron display-3 text-center">Acceso</div>
<div class="container text-left text-white">
    <?php
    session_start();
    if (isset($_SESSION["error"])) {
        if (isset($_SESSION["error"]["userPassIncorrecto"]))
            echo "<div class=\"alert alert-danger\">Combinación usuario-contraseña incorrecta, inténtalo de nuevo.</div>";
        unset($_SESSION["error"]);
    }
    if(isset($_GET["user"]) && isset($_GET["pass"])) {
        $user = $_GET["user"];
        $pass = $_GET["pass"];
        error_reporting(0);
        $mysql= new mysqli("localhost","root","","red_social");
        if($mysql->connect_errno == false) {
            $query="SELECT * FROM usuarios";
            //EJECUCION DE LA QUERY
            $res=$mysql->query($query);
            $fila = $res->fetch_assoc();

            while ($fila) {
                //print_r($fila);
                if ($fila["username"] == $user && $fila["password"] == $pass) {
                    $_SESSION["error"] = $fila;
                    header("location:perfil.php?user=".$user);
                }
                $fila = $res->fetch_assoc();
            }
            if (!isset($_SESSION["error"])){
                $_SESSION["error"]["userPassIncorrecto"] = 1;
                header("location:acceso.php");
            }
        } else
            echo "<p class=\"alert alert-danger\">No se ha podido conectar a la base de datos, inténtalo más tarde.</p>";
    }
    ?>
    <form action="acceso.php" method="get">
        <div class="form-group">
            <label for="user">Usuario: </label>
            <input class="form-control" type="text" name="user">
        </div>
        <div class="form-group">
            <label for="pass">Contraseña</label>
            <input class="form-control" type="password" name="pass">
        </div>
        <button class="btn btn-outline-info">Acceder</button>
    </form>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</html>
