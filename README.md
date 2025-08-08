# Galería de Imágenes - SER CROCHET

![Preview](https://i.postimg.cc/Znvz8JCp/image.png)

Sistema para subir y gestionar imágenes de productos, con generación de URLs para el panel de administración.

## 🚀 Características
- Subida segura de imágenes (JPG, PNG, GIF)
- Generación automática de URLs absolutas
- Vista previa antes de subir
- Integración con MySQL
- Diseño responsive

## 🛠 Configuración Rápida
1. Clona el repositorio:
   ```bash
   git clone https://github.com/Brayan-palacio/ser-crochet-gallery.git
   ```
2. Importa la base de datos:
   ```sql
   mysql -u usuario -p galeria < galeria.sql
   ```
3. Configura `db.php` con tus credenciales

## 📂 Estructura de Archivos
```
ser-crochet-gallery/
├── uploads/       # Almacena imágenes subidas
├── db.php         # Configuración de DB
├── galeria.php    # Muestra todas las imágenes
├── guardar.php    # Procesa las subidas
└── upload.php     # Formulario de subida
```

## 🔒 Seguridad
- No subas `db.php` con credenciales reales
- Protege la carpeta `uploads` con `.htaccess`:

  ```apache
  Options -Indexes
  Deny from all
  <FilesMatch "\.(jpg|png|gif)$">
    Allow from all
  </FilesMatch>
  ```
