<?php
include("db.php");

// Obtener estadísticas básicas
$totalImagenes = $conn->query("SELECT COUNT(*) as total FROM imagenes")->fetch_assoc()['total'];
$ultimasImagenes = $conn->query("SELECT * FROM imagenes ORDER BY fecha_subida DESC LIMIT 3");
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Control | Galería SER CROCHET</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    :root {
      --primary-color: #f8e1e7;
      --accent-color: #9e6a7a;
      --dark-color: #3a2e32;
      --light-color: #fff9fa;
    }
    
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    
    body {
      font-family: 'Raleway', sans-serif;
      background-color: #f5f5f5;
      color: var(--dark-color);
      line-height: 1.6;
    }
    
    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 30px;
    }
    
    header {
      text-align: center;
      margin-bottom: 40px;
    }
    
    h1 {
      color: var(--dark-color);
      margin-bottom: 10px;
    }
    
    .subtitle {
      color: var(--accent-color);
      margin-bottom: 30px;
    }
    
    .dashboard {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }
    
    .card {
      background: white;
      border-radius: 10px;
      padding: 25px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      transition: transform 0.3s;
    }
    
    .card:hover {
      transform: translateY(-5px);
    }
    
    .card-stat {
      font-size: 2.5rem;
      font-weight: 700;
      color: var(--accent-color);
      margin-bottom: 10px;
    }
    
    .card-title {
      font-size: 1.1rem;
      margin-bottom: 15px;
      color: var(--dark-color);
    }
    
    .actions {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }
    
    .action-btn {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: white;
      border-radius: 10px;
      padding: 30px 20px;
      text-decoration: none;
      color: var(--dark-color);
      box-shadow: 0 4px 15px rgba(0,0,0,0.08);
      transition: all 0.3s;
    }
    
    .action-btn:hover {
      background: var(--primary-color);
      transform: translateY(-3px);
    }
    
    .action-btn i {
      font-size: 2.5rem;
      color: var(--accent-color);
      margin-bottom: 15px;
    }
    
    .recent-images {
      margin-top: 30px;
    }
    
    .image-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    
    .image-card {
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      position: relative;
    }
    
    .image-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
      transition: transform 0.3s;
    }
    
    .image-card:hover img {
      transform: scale(1.05);
    }
    
    .image-overlay {
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      background: rgba(0,0,0,0.7);
      color: white;
      padding: 10px;
      font-size: 0.9rem;
    }
    
    @media (max-width: 768px) {
      .dashboard {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1><i class="fas fa-camera-retro"></i> Panel de Control</h1>
      <p class="subtitle">Galería de Imágenes SER CROCHET</p>
    </header>
    
    <div class="dashboard">
      <div class="card">
        <div class="card-stat"><?= $totalImagenes ?></div>
        <h3 class="card-title">Imágenes Totales</h3>
        <p>Gestiona todo tu contenido multimedia</p>
      </div>
      
      <div class="card">
        <div class="card-stat">3</div>
        <h3 class="card-title">Categorías Principales</h3>
        <p>Bolsos, Accesorios, Decoración</p>
      </div>
      
      <div class="card">
        <div class="card-stat"><?= round($totalImagenes/30) ?> MB</div>
        <h3 class="card-title">Almacenamiento</h3>
        <p>Espacio utilizado aproximado</p>
      </div>
    </div>
    
    <h2>Acciones Rápidas</h2>
    <div class="actions">
      <a href="upload.php" class="action-btn">
        <i class="fas fa-cloud-upload-alt"></i>
        <span>Subir Nueva Imagen</span>
      </a>
      
      <a href="galeria.php" class="action-btn">
        <i class="fas fa-images"></i>
        <span>Ver Galería Completa</span>
      </a>
      
      <a href="#" class="action-btn">
        <i class="fas fa-tags"></i>
        <span>Gestionar Categorías</span>
      </a>
    </div>
    
    <div class="recent-images">
      <h2><i class="fas fa-clock"></i> Imágenes Recientes</h2>
      <div class="image-grid">
        <?php while($row = $ultimasImagenes->fetch_assoc()): ?>
          <a href="galeria.php" class="image-card">
            <img src="<?= htmlspecialchars($row['url']) ?>" alt="<?= htmlspecialchars($row['nombre']) ?>">
            <div class="image-overlay">
              <?= htmlspecialchars($row['nombre']) ?>
            </div>
          </a>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</body>
</html>