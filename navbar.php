<?php
// Verificar si la página actual es index.php para resaltar el enlace correspondiente
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Barra de navegación -->
<nav class="navbar">
  <div class="navbar-brand">
    <a href="index.php" class="brand-link">
      <i class="fas fa-camera-retro"></i> Galería SER CROCHET
    </a>
  </div>
  
  <div class="navbar-links">
    <a href="index.php" class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>">
      <i class="fas fa-home"></i> Inicio
    </a>
    
    <a href="upload.php" class="nav-link <?= ($current_page == 'upload.php') ? 'active' : '' ?>">
      <i class="fas fa-cloud-upload-alt"></i> Subir
    </a>
    
    <a href="galeria.php" class="nav-link <?= ($current_page == 'galeria.php') ? 'active' : '' ?>">
      <i class="fas fa-images"></i> Galería
    </a>
    
    <a href="https://tienda-sercrochet.vercel.app/" class="nav-link" target="_blank">
      <i class="fas fa-store"></i> Ver Tienda
    </a>
  </div>
  
  <button class="navbar-toggle" id="navbarToggle">
    <i class="fas fa-bars"></i>
  </button>
</nav>

<style>
  /* Estilos para la barra de navegación */
  .navbar {
    background-color: #3a2e32;
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }
  
  .navbar-brand {
    display: flex;
    align-items: center;
  }
  
  .brand-link {
    color: #f8e1e7;
    text-decoration: none;
    font-size: 1.2rem;
    font-weight: 600;
    display: flex;
    align-items: center;
  }
  
  .brand-link i {
    margin-right: 10px;
    font-size: 1.4rem;
  }
  
  .navbar-links {
    display: flex;
    gap: 15px;
    align-items: center;
  }
  
  .nav-link {
    color: #d4a5b5;
    text-decoration: none;
    font-size: 1rem;
    padding: 8px 12px;
    border-radius: 4px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
  }
  
  .nav-link:hover {
    color: #f8e1e7;
    background-color: rgba(158, 106, 122, 0.3);
  }
  
  .nav-link.active {
    color: #f8e1e7;
    background-color: #9e6a7a;
    font-weight: 500;
  }
  
  .navbar-toggle {
    display: none;
    background: none;
    border: none;
    color: #f8e1e7;
    font-size: 1.5rem;
    cursor: pointer;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .navbar {
      flex-direction: column;
      align-items: flex-start;
      padding: 15px;
    }
    
    .navbar-links {
      display: none;
      width: 100%;
      flex-direction: column;
      gap: 5px;
      margin-top: 15px;
    }
    
    .navbar-links.show {
      display: flex;
    }
    
    .nav-link {
      padding: 10px;
      border-radius: 4px;
      background-color: rgba(58, 46, 50, 0.8);
    }
    
    .navbar-toggle {
      display: block;
      position: absolute;
      right: 20px;
      top: 15px;
    }
  }
</style>

<script>
  // Toggle para el menú en móviles
  document.getElementById('navbarToggle').addEventListener('click', function() {
    const links = document.querySelector('.navbar-links');
    links.classList.toggle('show');
  });
</script>