<?php
header("Access-Control-Allow-Origin: *");
if (isset($_GET["id"])) {
    $id_mensaje = $_GET["id"];
    $mysql = new mysqli("localhost", "root","", "red_social");
    $query = "DELETE FROM mensajes WHERE id_mensaje = {$id_mensaje}";
    $res = $mysql->query($query);

    $query = "ALTER TABLE mensajes DROP id_mensaje";
    $res = $mysql->query($query);

    $query = "ALTER TABLE mensajes ADD id_mensaje INT NOT NULL AUTO_INCREMENT PRIMARY KEY";
    $res = $mysql->query($query);

    $mysql->close();
    echo "success";
} else
    echo "error";
?>