<?php

require("db.php");

try {
    if (isset($_FILES["image"])) {
        
        $supported_files = ["image/jpeg", "image/png", "image/gif"];
        $image = $_FILES["image"];

        if (in_array($image["type"], $supported_files)) {
            $tmp_name = $image["tmp_name"];
            $name = $image["name"];
            $path = "images/$name";

            //Subiendo a la base de datos
            $uploadImage = $conexion->prepare("UPDATE images SET image = :image WHERE id = 1;");
            $wasUploaded = $uploadImage->execute(array(
                ":image" => $name
            ));

            if ($wasUploaded) {
                $path_old_image = "images/".$_POST["oldImage"];
                if (is_readable($path_old_image)) {
                    unlink($path_old_image);
                }
                move_uploaded_file($tmp_name, $path);

                $data["status"] = "true";
                $data["name"] = $name;
            }
            else {
                throw new Exception("Hubo un problema subiendo la imagen, por favor, contacte al administrador.");
            }
        }
        else {
            throw new Exception("Por favor, sube una imagen válida.");
        }
    }
    else {
        throw new Exception("No se ha subido ninguna imagen.");
    }
} catch (Exception $e) {
    $data["status"] = "false";
    $data["error"] = $e->getMessage();
}

echo json_encode($data);

?>