<?php
    session_start();
    if(!isset($_SESSION["error"]))
        header("location:index.php");
    else
        $usuarioActual = $_SESSION["error"];
    if (!isset($_GET["user"]))
        header("location:perfil.php?user=Jorge");
    else
      $perfil = $_GET["user"];

    $mysql=new mysqli("localhost","root","","red_social");

    $query = "SELECT * FROM muros";
    $res = $mysql->query($query);
    $fila = $res->fetch_assoc();
    while($fila) {
        if($fila["username"] == $perfil)
            $id_muro = $fila["id_muro"];
        $fila = $res->fetch_assoc();
    }
 ?>
<html lang="es" dir="ltr">
<style>
    body, html {
        background-color: cornflowerblue !important;
    }
    #muro {
        margin: 0;
        padding: 0;
        width: 80%;
        float: left;
        background-color: cornflowerblue;
        border-right: 1px solid gray;
    }
    #muro > #cabecera {
        width:100%;
        height: 100px;
        line-height: 30px;
        padding: 30px;
        color: white;
        background-color: midnightblue;
        border-bottom: 1px solid black;
    }
    #contactos {
        color: white;
        margin: 0;
        padding: 0;
        width: 20%;
        height: 100%;
        float: right;
        background-color: powderblue;
    }
    #contactos > #cabecera {
        text-align: center;
        background-color: midnightblue;
        height: 75px;
        line-height: 75px;
    }
    #usuarioLogeado {
        width: 100%;
        text-align: right;
        height: 25px;
        line-height: 25px;
        padding-right: 30px;
        border: 1px solid gray;
        background-color: blue;
    }
    #contactos a {
        text-decoration: none !important;
        color: black;
    }
    #buscarUsuario {
        margin: 0;
    }
    #buscarUsuario input {
        width: 230px;
    }
</style>
<head>
      <meta charset="utf-8">
      <title>Muro</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  </head>
  <body>

    <!-- MURO -->
    <div class="container" id="muro">
      <h1 id="cabecera" data-perfil="<?=$perfil?>">Muro de <?=$perfil?></h1>
      <div class="container" id="listaMensajes">
          <div class="card">
               <div class='card-body'>
                   <h6 class="card-subtitle mb-2 text-muted">Comentar: </h6>
                   <div class="form-group">
                       <textarea class="card-text form-control" type="text" placeholder="¿En qué estás pensando?"></textarea>
                       <button class="btn btn-info" id="publicar" data-perfil="<?=$id_muro?>" data-username="<?=$usuarioActual['username']?>">PUBLICAR</button>
                   </div>
               </div>
          </div>
          <br>
        <!-- AQUI IRIA EL CODIGO PHP PARA AÑADIR LOS MENSAJES HACIENDO UNA PETICION A LA BASE DE DATOS -->
          <?php
          $query="SELECT * FROM mensajes";
          $res=$mysql->query($query);
          $fila=$res->fetch_assoc();
          while ($fila){
              if ($fila["id_muro"] == $id_muro) {
                  echo "<div class=\"card\" id={$fila["id_mensaje"]}>";
                  echo "<div class='card-body'>";
                  echo "<h6 class=\"card-subtitle mb-2 text-muted\">Escrito por ".$fila["username"]."</h6>";
                  echo "<p class=\"card-text\">".$fila["contenido"]."</p>";
                  echo "</div>";
                  echo "<p id='valoracion'>Valoración: ";
                  for ($i = 0; $i< $fila["valoracion"]; $i++)
                      echo "★";
                  for ($i = $fila["valoracion"]; $i<5; $i++)
                      echo "☆";
                  echo "<p>";
                  if ($fila["username"] == $usuarioActual["username"]) {
                      echo "<div class='button-group'><button id=\"modificar\" class=\"btn btn-warning btn-sm\">Modificar</button>";
                      echo "<button id=\"eliminar\" data-id={$fila["id_mensaje"]} class=\"btn btn-danger btn-sm\">Eliminar</button></div>";
                  }

                  echo "</div>";
                  echo "<br>";
              }
              $fila=$res->fetch_assoc();
          }
          ?>
      </div>
    </div>
    <!-- CONTACTOS -->
    <div class="container" id="contactos">
      <div id="usuarioLogeado">
        Has iniciado sesión como <b><?=$usuarioActual["nombre"]?></b>
      </div>
      <h3 id="cabecera">Contactos</h3>
        <div class="container form" id="buscarUsuario">
            <div class="form-group">
                <label style="color: black" for="buscar">Buscar usuario:</label>
                <input id="search" type="text" name="buscar" class="form-control">
                <button class="btn btn-info" id="btnSearch">&#128269;</button>
            </div>
        </div>
      <ul class="list-group" id="listaContactos" style="padding: 0">
        <!-- AQUI IRIA EL CODIGO PHP PARA AÑADIR LOS USUARIOS HACIENDO UNA PETICION A LA BASE DE DATOS -->
          <?php
/*          $mysql=new mysqli("localhost","root","","red_social");
          $query="SELECT * FROM usuarios";
          $res=$mysql->query($query);
          $fila=$res->fetch_assoc();
          while ($fila){
            echo  "<a href='perfil.php?user={$fila["username"]}'>";
            echo "<li class='list-group-item'>";
             echo $fila["nombre"]." ".$fila["apellidos"];
          echo "</li>";
          echo "</a>";
              $fila=$res->fetch_assoc();
          }
          */?>
      </ul>
    </div>
  </body>
  <script src="js/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(function(){
      $("#eliminar").on('click', function(){
         var id_mensaje = $(this).data('id');
         var urlEliminar = 'backend/remove.php?id='+id_mensaje;
         $.ajax({
             url: urlEliminar,
         }).done(function(data){
            //alert(data);
             location.reload();
         });
      });

      $("#publicar").on('click', function(){
         var contenido = $('textarea').val();
         var id_muro = $(this).data("perfil");
         var username = $(this).data("username");
         var urlCreate = 'backend/create.php?id_muro='+id_muro+'&username="'+username+'"&contenido="'+contenido+'"';
         $.ajax({
             url: urlCreate
         }).done(function(data){
             //alert(data);
             location.reload();
         });
      });

      $('#btnSearch').on('click', function(){
          $('#listaContactos').empty();
          var busqueda = $("#search").val().toLowerCase();
          var urlSearch = 'backend/search.php?busqueda='+busqueda;
          $.ajax({
            url: urlSearch,
            dataType: 'json'
          }).done(function(data){
            if (data == "error")
                alert("Error al realizar la búsqueda.");
            else {
                for(var i= 0;i < data.length; i++) {
                    if (busqueda == data[i]["username"] || busqueda == data[i]["apellidos"].toLowerCase() || busqueda == data[i]["nombre"].toLowerCase()){
                        $('#listaContactos').append(
                            "<a href='perfil.php?user="+data[i]["username"]+"'>" +
                            "   <li class='list-group-item'>" +
                                    data[i]["nombre"]+' '+data[i]["apellidos"] +
                            "   </li>" +
                            "</a>");
                    }

                }
            }
          });
        });
    });
</script>

</html>
