<?php

if (isset($_GET["username"]) && isset($_GET["id_muro"]) && isset($_GET["contenido"])) {
    $username = $_GET["username"];
    $id_muro = $_GET["id_muro"];
    $contenido = $_GET["contenido"];
    $valoracion = 0;

    $mysql = new mysqli("localhost", "root", "", "red_social");
    $query = "INSERT INTO mensajes(username,contenido,valoracion, id_muro) values ({$username},{$contenido},{$valoracion},{$id_muro})";
    $res = $mysql->query($query);
    $mysql->close();

    echo "success";
} else
    echo "error";


?>