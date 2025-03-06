<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="css/estilos.css">
  <title>Subir</title>
</head>
<body>
  <header>
    <div class="contenedor">
      <h1 class="titulo">PUBLICAR</h1>
      <hr class="border">
    </div>
  </header>

  <div class="contenedor">
  <form class="formulario" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    
    <!-- Campo para subir una foto -->
    <div class="form-group file-group">
      <label for="foto">Seleccionar Miniatura</label>
      <input type="file" id="foto" name="foto" accept="image/*" required>
    </div>
    
    <!-- Campo para subir un video -->
    <div class="form-group file-group">
      <label for="video">Seleccionar Video</label>
      <input type="file" id="video" name="video" accept="video/*" required>
    </div>
    
    <!-- Campo de texto para título -->
    <div class="form-group">
      <input type="text" id="titulo" name="titulo" placeholder="Título" required>
    </div>

    <!-- Campo de texto para actriz -->
    <div class="form-group">
      <input type="text" id="usuario" name="usuario" placeholder="Usuario" required>
    </div>

    <!-- Campo de texto para categoría -->
    <div class="form-group">
      <input type="text" id="categoria" name="categoria" placeholder="Categoría" required>
    </div>

    <!-- Campo de texto para descripción -->
    <div class="form-group">
      <textarea name="descripcion" id="descripcion" placeholder="Ingresa una descripción" required></textarea>
    </div>

    <!-- Mostrar errores -->
    <?php if(isset($error)): ?>
      <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <!-- Botón para enviar el formulario -->
    <div class="form-group">
        <input type="submit" class="submit" value="Subir">
        <?php if (!empty($mensaje_exito)): ?>
            <span class="mensaje-exito"><?php echo $mensaje_exito; ?></span>
        <?php endif; ?>
    </div>
  </form>
</div>


</body>
</html>
