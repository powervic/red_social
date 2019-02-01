<?php

if (isset($_GET["busqueda"])) {
    $data = array();

    $mysql = new mysqli("localhost", "root", "", "red_social");
    $query = "SELECT * FROM usuarios";
    $res = $mysql->query($query);
    $fila = $res->fetch_assoc();
    while($fila){
        $data[]= $fila;

        $fila = $res->fetch_assoc();
    }
    echo json_encode($data);
} else
    echo "error";

?>