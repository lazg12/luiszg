<?php
/**
 * SISTEMA: luiszg.com
 * CLASE: ControladorTienda
 */

declare(strict_types=1);

namespace App\Controladores;

use App\Nucleo\Peticion;
use App\Nucleo\Respuesta;
use App\Nucleo\Vista;
use App\Servicios\ServicioCatalogo;

class ControladorTienda 
{
    private ServicioCatalogo $servicioCatalogo;
    private Vista $vista;

    public function __construct(ServicioCatalogo $servicioCatalogo, Vista $vista) 
    {
        $this->servicioCatalogo = $servicioCatalogo;
        $this->vista = $vista;
    }

    public function mostrarInicio(Peticion $peticion): Respuesta 
    {
        // Obtener el catálogo de productos desde el servicio
        $catalogos = $this->servicioCatalogo->obtenerCatalogoProductos();
        
        // Renderizar la vista y pasarle los datos
        $html = $this->vista->renderizar('tienda/inicio', ['catalogos' => $catalogos]);
        
        return new Respuesta($html, 200);
    }

    public function descargarCatalogoPdf(Peticion $peticion): Respuesta 
    {
        $nombrePdf = $peticion->obtenerParametroGet('pdf') ?? '';
        $rutaArchivo = $this->servicioCatalogo->obtenerRutaPdf($nombrePdf);

        if (!$rutaArchivo) {
            return new Respuesta("<h1>404 Archivo No Encontrado</h1><p>El documento PDF solicitado no existe.</p>", 404);
        }

        $cabeceras = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . basename($rutaArchivo) . '"',
            'Content-Length' => (string) filesize($rutaArchivo)
        ];

        $contenidoBinario = file_get_contents($rutaArchivo);
        return new Respuesta($contenidoBinario, 200, $cabeceras);
    }
}