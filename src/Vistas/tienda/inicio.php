<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>luiszg.com - Tienda Oficial</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 50px; background: #f8f9fa; color: #333; }
        .contenedor { max-width: 800px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; border-bottom: 2px solid #eaeaea; padding-bottom: 10px; }
        .producto { background: #fdfdfd; border: 1px solid #e1e4e8; padding: 20px; margin-bottom: 15px; border-radius: 6px; }
        .producto h3 { margin-top: 0; color: #0366d6; }
        a.btn { display: inline-block; background: #2ea44f; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        a.btn:hover { background: #22863a; }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>luiszg.com</h1>
        <p>Plataforma de E-Commerce desarrollada en PHP 8.x puro bajo arquitectura limpia y principios SOLID.</p>
        
        <h2>Catálogo de Módulos y Documentación</h2>
        
        <?php if (!empty($catalogos)): ?>
            <?php foreach ($catalogos as $prod): ?>
                <div class="producto">
                    <h3><?= htmlspecialchars($prod['nombre']) ?></h3>
                    <p>Precio: <strong>$<?= number_format($prod['precio'], 2) ?></strong></p>
                    <a class="btn" href="/descargar?pdf=<?= urlencode($prod['pdf']) ?>">Descargar PDF de Muestra</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos registrados actualmente.</p>
        <?php endif; ?>
    </div>
</body>
</html>