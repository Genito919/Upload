
<?php 
require 'funciones.php';

$conexion = conexion('proyecto_bloger', 'root', '1920');

if (!$conexion) {
    die(); // Error de conexión
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_FILES)) {
    // Comprobar si el archivo es una imagen o un video
    $check_img = @getimagesize($_FILES['foto']['tmp_name']);
    $check_video = isset($_FILES['video']['tmp_name']) && $_FILES['video']['tmp_name'] != '';

    // Comprobamos si es una imagen
    if ($check_img !== false) {
        // Directorio donde se guardarán las imágenes
        $carpeta_destino_imagen = '../MI_PROYECTO/miniaturas/'; // RUTA DE IMAGEN
        $archivo_subido_imagen = $carpeta_destino_imagen . $_FILES['foto']['name'];
        
        // Mover archivo de imagen a la carpeta destino
        move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido_imagen);
        $miniatura = $_FILES['foto']['name'];
    }

    // Comprobamos si es un video
    if ($check_video) {
        // Directorio donde se guardarán los videos
        $carpeta_destino_video = '../MI_PROYECTO/videos/'; // RUTA DE VIDEO
        $archivo_subido_video = $carpeta_destino_video . $_FILES['video']['name'];
        
        // Mover archivo de video a la carpeta destino
        move_uploaded_file($_FILES['video']['tmp_name'], $archivo_subido_video);
        $video = $_FILES['video']['name'];
    }

    // Si tenemos imagen o video, insertar en la base de datos
    if (isset($miniatura) || isset($video)) {
        $statement = $conexion->prepare('INSERT INTO articulos (titulo, usuario, categoria, descripcion, miniatura, video) 
                                        VALUES (:titulo, :usuario, :categoria, :descripcion, :miniatura, :video)');
        
        $statement->execute(array(
            ':titulo' => $_POST['titulo'],
            ':usuario' => $_POST['usuario'],
            ':categoria' => $_POST['categoria'],
            ':descripcion' => $_POST['descripcion'],
            ':miniatura' => isset($miniatura) ? $miniatura : null,
            ':video' => isset($video) ? $video : null
        ));

    } else {
        $error = "El archivo no es válido o es demasiado grande";
    }
}

require 'views/subir.view.php'; 
?>