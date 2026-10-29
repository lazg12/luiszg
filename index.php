<?php
/**
 * SISTEMA: Página web (luiszg.com)
 * MÓDULO : Front Controller Principal (index.php)
 * 
 * @package    App
 * @author     Luis Zambrano Gahón <ignot>
 * @copyright  2026 Luis Zambrano Gahón
 * @license    MIT / Propietaria
 * @version    v1.0.0
 */

declare(strict_types=1);

// 1. Configuración de Entorno y Errores (Ajustar a 0 en producción real)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 2. Autocargador simple PSR-4 o inclusión de clases del Núcleo y Controladores
// Si usas Composer, bastaría con: require_once __DIR__ . '/vendor/autoload.php';
// Aquí cargamos manualmente nuestros componentes estructurales diseñados:
require_once __DIR__ . '/src/Nucleo/Peticion.php';
require_once __DIR__ . '/src/Nucleo/Respuesta.php';
require_once __DIR__ . '/src/Nucleo/Enrutador.php';
require_once __DIR__ . '/src/Nucleo/Vista.php';
require_once __DIR__ . '/src/Servicios/ServicioCatalogo.php';
require_once __DIR__ . '/src/Controladores/ControladorTienda.php';

// Importar los namespaces necesarios
use App\Nucleo\Peticion;
use App\Nucleo\Enrutador;
use App\Nucleo\Vista;
use App\Servicios\ServicioCatalogo;
use App\Controladores\ControladorTienda;

try {
    // 3. Inicializar los componentes base del sistema
    $peticion = new Peticion();
    $enrutador = new Enrutador();
    
    // Instanciar servicios y vistas con sus rutas absolutas en Hostinger
    $directorioVistas = __DIR__ . '/src/Vistas/';
    $directorioPdf = __DIR__ . '/public/assets/pdf/';
    
    $vista = new Vista($directorioVistas);
    $servicioCatalogo = new ServicioCatalogo($directorioPdf);

    // Inyectar dependencias en el Controlador de la Tienda
    $controladorTienda = new ControladorTienda($servicioCatalogo, $vista);

    // 4. Registrar el Mapa de Rutas de la Tienda
    $enrutador->registrarRutaGet('/', [$controladorTienda, 'mostrarInicio']);
    $enrutador->registrarRutaGet('/descargar', [$controladorTienda, 'descargarCatalogoPdf']);

    // 5. Despachar la petición actual a través del enrutador
    $respuesta = $enrutador->despacharPeticion($peticion);

    // 6. Emitir la respuesta HTTP limpia hacia el navegador del cliente
    $respuesta->enviarRespuestaAlNavegador();

} catch (\Throwable $excepcion) {
    // Manejo global de errores seguros para producción en Hostinger
    http_response_code(500);
    echo "<h1>Error Interno del Servidor</h1>";
    echo "<p>Lo sentimos, ha ocurrido un error inesperado en luisszg.com.</p>";
    
    // En entorno de desarrollo local puedes descomentar esto para depurar:
    // echo "<pre>" . htmlspecialchars($excepcion->getMessage()) . "</pre>";
}