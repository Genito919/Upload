<?php

function conexion($tabla, $usuario, $pass){
    try {
        // Establecemos la conexión a la base de datos
        $conexion = new PDO("mysql:host=localhost;dbname=$tabla", $usuario, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configuración para manejar errores correctamente
        return $conexion;  // Retorna la conexión
    } catch (PDOException $e) {
        // Si ocurre un error, muestra un mensaje y retorna false
        echo 'Error de conexión: ' . $e->getMessage();
        return false;
    }
}

?>
