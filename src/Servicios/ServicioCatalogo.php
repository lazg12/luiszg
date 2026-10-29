<?php
/**
 * SISTEMA: luiszg.com
 * CLASE: ServicioCatalogo
 */

declare(strict_types=1);

namespace App\Servicios;

class ServicioCatalogo 
{
    private string $dirPdf;

    public function __construct(string $dirPdf) 
    {
        $this->dirPdf = rtrim($dirPdf, '/\\') . DIRECTORY_SEPARATOR;
    }

    public function obtenerCatalogoProductos(): array 
    {
        // Datos simulados de ejemplo (puedes conectarlo a tu base de datos MySQL/PostgreSQL más adelante)
        return [
            ['id' => 1, 'nombre' => 'Diseño Arquitectónico C++20', 'precio' => 49.99, 'pdf' => 'geometria.pdf'],
            ['id' => 2, 'nombre' => 'E-Commerce Pure PHP 8 Core', 'precio' => 29.99, 'pdf' => 'ecommerce.pdf']
        ];
    }

    public function obtenerRutaPdf(string $nombreArchivo): ?string 
    {
        // Limpiar nombre de archivo por seguridad contra ataques de ruta (Directory Traversal)
        $nombreLimpio = basename($nombreArchivo);
        $rutaCompleta = $this->dirPdf . $nombreLimpio;

        if (file_exists($rutaCompleta)) {
            return $rutaCompleta;
        }

        return null;
    }
}