<?php
include("db.php");

// Obtener todas las imágenes ordenadas por fecha descendente
$query = "SELECT * FROM imagenes ORDER BY fecha_subida DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Galería de Imágenes | SER CROCHET</title>
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
      max-width: 1200px;
      margin: 0 auto;
    }
    
    h1 {
      text-align: center;
      color: var(--dark-color);
      margin-bottom: 30px;
    }
    
    .upload-link {
      display: inline-block;
      background-color: var(--accent-color);
      color: white;
      padding: 10px 20px;
      border-radius: 6px;
      text-decoration: none;
      margin-bottom: 30px;
      transition: all 0.3s;
    }
    
    .upload-link:hover {
      background-color: var(--dark-color);
      transform: translateY(-2px);
    }
    
    .gallery-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 25px;
    }
    
    .image-card {
      background: white;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 3px 15px rgba(0,0,0,0.1);
      transition: all 0.3s;
    }
    
    .image-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .image-container {
      height: 200px;
      overflow: hidden;
    }
    
    .image-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s;
    }
    
    .image-card:hover .image-container img {
      transform: scale(1.05);
    }
    
    .image-info {
      padding: 15px;
    }
    
    .image-name {
      font-weight: 600;
      margin-bottom: 5px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    
    .image-category {
      display: inline-block;
      background-color: var(--primary-color);
      color: var(--dark-color);
      padding: 3px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
      margin-bottom: 10px;
    }
    
    .copy-btn {
      width: 100%;
      background-color: var(--accent-color);
      color: white;
      border: none;
      padding: 8px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      transition: all 0.3s;
    }
    
    .copy-btn:hover {
      background-color: var(--dark-color);
    }
    
    .url-display {
      width: 100%;
      padding: 8px;
      border: 1px solid #eee;
      border-radius: 4px;
      font-size: 12px;
      margin-top: 10px;
      background: #fafafa;
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
    
    .alert {
      position: fixed;
      top: 20px;
      right: 20px;
      padding: 15px 25px;
      background-color: var(--accent-color);
      color: white;
      border-radius: 6px;
      box-shadow: 0 3px 15px rgba(0,0,0,0.2);
      display: none;
      z-index: 1000;
      animation: fadeIn 0.3s;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1><i class="fas fa-images"></i> Galería de Imágenes</h1>
    
    <a href="upload.php" class="upload-link">
      <i class="fas fa-cloud-upload-alt"></i> Subir Nueva Imagen
    </a>
    
    <div class="gallery-grid">
      <?php while($row = mysqli_fetch_assoc($result)): ?>
        <div class="image-card">
          <div class="image-container">
            <img src="<?= htmlspecialchars($row['url']) ?>" 
                 alt="<?= htmlspecialchars($row['nombre']) ?>"
                 onerror="this.src='https://via.placeholder.com/300?text=Imagen+no+disponible'">
          </div>
          <div class="image-info">
            <div class="image-name"><?= htmlspecialchars($row['nombre']) ?></div>
            <span class="image-category"><?= htmlspecialchars($row['categoria']) ?></span>
            <input type="text" 
                   value="<?= htmlspecialchars($row['url']) ?>" 
                   readonly 
                   class="url-display">
            <button class="copy-btn" onclick="copyToClipboard(this)">
              <i class="fas fa-copy"></i> Copiar URL
            </button>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  
  <div class="alert" id="alert">
    <i class="fas fa-check-circle"></i> URL copiada al portapapeles!
  </div>
  
  <script>
    function copyToClipboard(button) {
      const urlInput = button.previousElementSibling;
      urlInput.select();
      document.execCommand('copy');
      
      // Mostrar notificación
      const alert = document.getElementById('alert');
      alert.style.display = 'block';
      setTimeout(() => {
        alert.style.display = 'none';
      }, 2000);
    }
  </script>
</body>
</html>