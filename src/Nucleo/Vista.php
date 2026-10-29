<?php
/**
 * SISTEMA: luiszg.com
 * CLASE: Vista
 */

declare(strict_types=1);

namespace App\Nucleo;

class Vista 
{
    private string $dirPlantillas;

    public function __construct(string $dirPlantillas) 
    {
        $this->dirPlantillas = rtrim($dirPlantillas, '/\\') . DIRECTORY_SEPARATOR;
    }

    public function renderizar(string $nombrePlantilla, array $datos = []): string 
    {
        $archivoPlantilla = $this->dirPlantillas . $nombrePlantilla . '.php';

        if (!file_exists($archivoPlantilla)) {
            throw new \RuntimeException("La plantilla de vista [{$nombrePlantilla}] no existe en: {$archivoPlantilla}");
        }

        // Extraer los datos para que estén disponibles como variables dentro del archivo PHP de la vista
        extract($datos, EXTR_OVERWRITE);

        // Capturar la salida del buffer para retornar el HTML como un string limpio
        ob_start();
        require $archivoPlantilla;
        return ob_get_clean();
    }
}