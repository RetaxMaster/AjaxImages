<?php

$conexion = new PDO("mysql:host=localhost;dbname=ajax_images", "root", "");
$setnames = $conexion->prepare("SET NAMES 'utf8'");
$setnames->execute();

?>