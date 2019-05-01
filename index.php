<?php

require("db.php");

$getImage = $conexion->prepare("SELECT image FROM images WHERE id = 1;");
$imagenObtenida = $getImage->execute();

if (!$imagenObtenida) die("Hubo un problema, por favor, contacta con el administrador.");

$image = $getImage->fetch(PDO::FETCH_ASSOC);
$image = $image["image"];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700" rel="stylesheet">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>Imágenes con Ajax</title>
</head>
<body>

    <div class="modal">
      <div class="modal-main">
        <div class="row">
          <div class="c-3-lg c-3-md c-1-sm close-modal"></div>
          <div class="c-6-lg c-6-md c-10-sm c-12-xs close-modal">
            <div class="modal-card" id="loading">
              <div class="preloader"></div>
              <span class="tag">Cargando...</span>
            </div>
          </div>
          <div class="c-3-lg c-3-md c-1-sm close-modal"></div>
        </div>
      </div>
    </div>

    <header>
        <h1>Subiendo imágenes con Ajax</h1>
    </header>


    <main>
        <section class="card">
            <div class="image-container">
                <img src="images/<?= $image ?>" alt="Imagen" id="Imagen">
            </div>
            <div class="upload-image">
                <form action="#" method="post" enctype="multipart/form-data" id="Formulario">
                    <input type="file" name="image" id="file">
                </form>
                <span id="upload-image">+</span>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="js/modal.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>