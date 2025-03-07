<?php

  include "common/utils.php";
  include "common/config.php";
  include "common/mysql.php";

  # Conectar con la base de datos
  $connection = Connect($config['database']);

  # Verificar si la conexión es válida
  if (!$connection) {
      die("Error al conectar con la base de datos");
  }

  # Consulta SQL
  $sql  = "SELECT * FROM images WHERE enabled = 1 ORDER BY id DESC";

  # Ejecutar la consulta
  $rows = ExecuteQuery($sql, $connection);

  # Cerrar la conexión
  Close($connection);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thumbnail Gallery</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/bootstrap/css/thumbnail-gallery.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">GALLERY</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="admin/index.php?page=login">[admin]</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Galleria</h1>
        </div>

        <?php
        if (is_array($rows) && count($rows) > 0) {
            foreach ($rows as $row) {
                echo '<div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#">
                            <img class="img-responsive css_img" src="images/' . htmlspecialchars($row['file']) . '" alt="">
                        </a>' . htmlspecialchars($row['name']) . '
                      </div>';
            }
        } else {
            echo '<div class="col-lg-12"><p>No hay imágenes disponibles.</p></div>';
        }
        ?>

    </div>

    <hr>

    <footer>
        <div class="row">
            <div class="col-lg-12">
                <p></p>
            </div>
        </div>
    </footer>
</div>

<script src="assets/bootstrap/js/jquery.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
