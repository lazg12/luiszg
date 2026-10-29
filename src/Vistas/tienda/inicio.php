<?php
/**
 * Vista de Inicio (Catálogo Principal)
 * luiszg.com - E-Commerce Modular
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>luiszg.com - Plataforma E-Commerce</title>
    <!-- Hoja de estilos externa -->
    <link rel="stylesheet" href="/luiszg/public/css/estilos.css">
</head>
<body>

    <main>
        <div class="logo-container">
            <img src="/luiszg/public/img/logo.gif" alt="Logotipo luiszg.com">
        </div>
        
        <h1>luiszg.com</h1>
        <p class="subtitle">Tienda de artículos de belleza.</p>

        <!-- Sección de Catálogos - Estilo Tarjetas Modernas -->
        <div class="catalogos-grid">
            <!-- Yanbal -->
            <a href="/luiszg/public/docs/catalogo-yanbal.pdf" class="card-catalogo" download>
                <div class="card-icon">
                    <img src="/luiszg/public/img/yanbal.jpg" alt="Logo Yanbal">
                </div>
                <span class="card-title">Yanbal</span>
                <span class="card-action">Descargar PDF</span>
            </a>

            <!-- L'Bel -->
            <a href="/luiszg/public/docs/catalogo-lbel.pdf" class="card-catalogo" download>
                <div class="card-icon">
                    <img src="/luiszg/public/img/lbel.png" alt="Logo L'Bel">
                </div>
                <span class="card-title">L'Bel</span>
                <span class="card-action">Descargar PDF</span>
            </a>

            <!-- Ésika -->
            <a href="/luiszg/public/docs/catalogo-esika.pdf" class="card-catalogo" download>
                <div class="card-icon">
                    <img src="/luiszg/public/img/esika.png" alt="Logo Ésika">
                </div>
                <span class="card-title">Ésika</span>
                <span class="card-action">Descargar PDF</span>
            </a>

            <!-- Cy°Zone -->
            <a href="/luiszg/public/docs/catalogo-cyzone.pdf" class="card-catalogo" download>
                <div class="card-icon">
                    <img src="/luiszg/public/img/cyzone.png" alt="Logo Cy°Zone">
                </div>
                <span class="card-title">Cy°Zone</span>
                <span class="card-action">Descargar PDF</span>
            </a>
        </div>
    </main>

    <footer>
        <p>© <?= date('Y'); ?> <strong>Luis Zambrano Gahón</strong>. Todos los derechos reservados.</p>
        <p>
            Plataforma E-Commerce | Versión <strong><?= defined('APP_VERSION') ? APP_VERSION : 'dev'; ?></strong>
            <span>•</span> 
            Distribuido bajo los términos de la <a href="https://opensource.org/licenses/MIT" target="_blank" rel="noopener">Licencia MIT</a>.
        </p>
    </footer>

</body>
</html>