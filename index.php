<?php
require 'funciones.php';

// Activa la visualización de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$conexion = conexion('proyecto_bloger', 'root', '1920');

if (!$conexion) {
    die('Error en la conexión a la base de datos.');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) {
    $archivo_foto = $_FILES['foto'];
    $archivo_video = $_FILES['video'];
    $ruta_imagen = null;
    $ruta_video = null;

    // Verificar y procesar la foto
    if ($archivo_foto['error'] === UPLOAD_ERR_OK) {
        $check_imagen = @getimagesize($archivo_foto['tmp_name']);
        if ($check_imagen !== false) {
            $carpeta_destino_imagen = '../MI_PROYECTO/miniaturas/';
            $archivo_imagen_subido = $carpeta_destino_imagen . $archivo_foto['name'];
            if (move_uploaded_file($archivo_foto['tmp_name'], $archivo_imagen_subido)) {
                $ruta_imagen = $archivo_foto['name'];
            } else {
                echo "Error al subir la imagen.";
            }
        } else {
            echo "El archivo seleccionado no es una imagen válida.";
        }
    }

    // Verificar y procesar el video
    if ($archivo_video['error'] === UPLOAD_ERR_OK) {
        $tipo_video = mime_content_type($archivo_video['tmp_name']);
        if (strpos($tipo_video, 'video/') !== false) { 
            $carpeta_destino_video = '../MI_PROYECTO/videos/';// RUTA DE VIDEO
            $archivo_video_subido = $carpeta_destino_video . $archivo_video['name'];
            if (move_uploaded_file($archivo_video['tmp_name'], $archivo_video_subido)) {
                $ruta_video = $archivo_video['name'];
            } else {
                echo "Error al subir el video.";
            }
        } else {
            echo "El archivo seleccionado no es un video válido.";
        }
    }

    // Insertar datos en la base de datos
    if (!isset($error)) {
        $statement = $conexion->prepare('
            INSERT INTO articulos (titulo, usuario, categoria, descripcion, miniatura, video) 
            VALUES (:titulo, :usuario, :categoria, :descripcion, :miniatura, :video)
        ');

        $resultado = $statement->execute(array(
            ':titulo' => $_POST['titulo'],
            ':usuario' => $_POST['usuario'],
            ':categoria' => $_POST['categoria'],
            ':descripcion' => $_POST['descripcion'],
            ':miniatura' => $ruta_imagen,
            ':video' => $ruta_video
        ));

        if ($resultado) {
            // Limpiar los campos del formulario después del envío exitoso
            header("Location: ".$_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error al guardar el artículo: " . implode(":", $statement->errorInfo());
        }
    }
}

// Requiere la vista para mostrar el formulario
require 'views/subir.view.php';
?>


