<?php
if (isset($_POST["username"]) && isset($_POST["nombre"]) && isset($_POST["apellidos"]) && isset($_POST["password"]) && isset($_POST["conf_password"])){
    $username = $_POST["username"];
    $nombre = $_POST["nombre"];
    $apellidos = $_POST["apellidos"];
    $password = $_POST["password"];
    $conf_password = $_POST["conf_password"];
    session_start();
    if (isset($_SESSION["error"]))
        unset($_SESSION["error"]);
    $error = [
        "username" => $username,
        "nombre" => $nombre,
        "apellidos" => $apellidos,
        "password" => $password,
        "conf_password" => $conf_password
    ];
    if ($username != "" && $nombre != "" && $apellidos != "" && $password != "" && $conf_password != "") { // SI TODOS LOS CAMPOS SE HAN RELLENADO
        if ($password == $conf_password) { // SI LA CONFIRMACIÓN DE LA CONTRASEÑA COINCIDE
            $mysqli = new mysqli("127.0.0.1", "root","", "red_social");
            if (!$mysqli->connect_errno) {
                $query = "INSERT INTO usuarios (username,nombre,apellidos,password) VALUES ('$username', '$nombre', '$apellidos', '$password')";
                $res=$mysqli->query($query);
                if ($mysqli->errno == 1062)
                    $error["usernameDuplicado"] = 1;
                elseif ($mysqli->errno==0){
                    $query = "INSERT INTO muros (username) VALUE('$username')";
                    $res=$mysqli->query($query);
                    $_SESSION["error"] = $error;
                    header("location:perfil.php?user=$username");
                }
            } else $error["conexionFallida"] = 0;
        }
    } else $error["incompleto"]=1;
} else header("location:index.php");

if (isset($error["usernameDuplicado"]) || isset($error["conexionFallida"]) || isset($error["incompleto"])) {
    $_SESSION["error"] = $error;    // SE PASA POR SESSION UN ARRAY CONTENIENDO TODOS LOS ERRORES (EN CASO DE HABERLOS)
    header("location:registro.php"); // SI NO HAY ERRORES LLEVA AL PERFIL DEL USUARIO REGISTRADO
}
?>