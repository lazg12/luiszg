<?php
/**
 * SISTEMA: luiszg.com
 * CLASE: Enrutador
 */

declare(strict_types=1);

namespace App\Nucleo;

class Enrutador 
{
    private array $mapaRutas = [];

    public function __construct() {}

    public function registrarRutaGet(string $rutaSolicitada, callable | array $accionManejadora): void 
    {
        $this->mapaRutas['GET'][$rutaSolicitada] = $accionManejadora;
    }

    public function registrarRutaPost(string $rutaSolicitada, callable | array $accionManejadora): void 
    {
        $this->mapaRutas['POST'][$rutaSolicitada] = $accionManejadora;
    }

    public function despacharPeticion(Peticion $peticion): Respuesta 
    {
        $ruta = $peticion->obtenerRutaSolicitada();
        $metodo = $peticion->obtenerTipoPeticionHttp();

        // Limpiar la ruta para que coincida (por si se ejecuta en subcarpetas locales o en la raíz)
        // Si estás ejecutando en http://localhost/luiszg/, puedes ajustar esto más adelante si fuera necesario.

        if (isset($this->mapaRutas[$metodo][$ruta])) {
            $accion = $this->mapaRutas[$metodo][$ruta];

            // Si la acción es un array [Controlador, 'metodo'] o un callable/closure
            if (is_callable($accion)) {
                return $accion($peticion);
            } elseif (is_array($accion)) {
                [$controlador, $metodoAccion] = $accion;
                return $controlador->$metodoAccion($peticion);
            }
        }

        // Si la ruta no existe, devolvemos un Error 404 limpio
        return new Respuesta("<h1>404 No Encontrado</h1><p>La ruta solicitada no existe en luisszg.com.</p>", 404);
    }
}