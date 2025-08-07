<?php include("db.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Subir Imagen | SER CROCHET</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #f8e1e7;
      --accent-color: #9e6a7a;
      --dark-color: #3a2e32;
    }
    
    body {
      font-family: 'Raleway', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 20px;
      color: var(--dark-color);
    }
    
    .container {
      max-width: 600px;
      margin: 30px auto;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    
    h1 {
      text-align: center;
      color: var(--dark-color);
      margin-bottom: 30px;
    }
    
    .back-link {
      display: inline-block;
      margin-bottom: 20px;
      color: var(--accent-color);
      text-decoration: none;
    }
    
    .form-group {
      margin-bottom: 20px;
    }
    
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: 500;
    }
    
    input[type="text"],
    select {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-family: inherit;
    }
    
    .file-upload {
      border: 2px dashed #ddd;
      padding: 40px;
      text-align: center;
      border-radius: 8px;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .file-upload:hover {
      border-color: var(--accent-color);
      background-color: rgba(158, 106, 122, 0.05);
    }
    
    .file-upload i {
      font-size: 40px;
      color: var(--accent-color);
      margin-bottom: 15px;
    }
    
    #fileInput {
      display: none;
    }
    
    .submit-btn {
      width: 100%;
      background-color: var(--accent-color);
      color: white;
      border: none;
      padding: 12px;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s;
    }
    
    .submit-btn:hover {
      background-color: var(--dark-color);
    }
    
    .preview-container {
      margin-top: 20px;
      text-align: center;
      display: none;
    }
    
    .preview-image {
      max-width: 100%;
      max-height: 200px;
      border-radius: 6px;
      border: 1px solid #eee;
    }
  </style>
</head>
<body>
  <div class="container">
    <a href="galeria.php" class="back-link">
      <i class="fas fa-arrow-left"></i> Volver a la Galería
    </a>
    
    <h1><i class="fas fa-cloud-upload-alt"></i> Subir Nueva Imagen</h1>
    
    <form action="guardar.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="nombre">Nombre de la imagen</label>
        <input type="text" id="nombre" name="nombre" required>
      </div>
      
      <div class="form-group">
        <label for="categoria">Categoría</label>
        <select id="categoria" name="categoria" required>
          <option value="">Seleccionar categoría</option>
          <option value="Bolsos">Bolsos</option>
          <option value="Accesorios">Accesorios</option>
          <option value="Decoración">Decoración</option>
          <option value="Otros">Otros</option>
        </select>
      </div>
      
      <div class="form-group">
        <label>Seleccionar imagen</label>
        <div class="file-upload" onclick="document.getElementById('fileInput').click()">
          <i class="fas fa-images"></i>
          <p>Haz clic para seleccionar una imagen</p>
          <p><small>Formatos aceptados: JPG, PNG, GIF (Máx. 5MB)</small></p>
          <input type="file" id="fileInput" name="imagen" accept="image/*" required>
        </div>
      </div>
      
      <div class="preview-container" id="previewContainer">
        <p>Vista previa:</p>
        <img class="preview-image" id="previewImage">
      </div>
      
      <button type="submit" class="submit-btn">
        <i class="fas fa-upload"></i> Subir Imagen
      </button>
    </form>
  </div>
  
  <script>
    // Vista previa de la imagen seleccionada
    document.getElementById('fileInput').addEventListener('change', function(e) {
      const previewContainer = document.getElementById('previewContainer');
      const previewImage = document.getElementById('previewImage');
      
      if (this.files && this.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          previewImage.src = e.target.result;
          previewContainer.style.display = 'block';
        }
        
        reader.readAsDataURL(this.files[0]);
      } else {
        previewContainer.style.display = 'none';
      }
    });
  </script>
</body>
</html>