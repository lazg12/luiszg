<?php

declare(strict_types=1);

namespace App\Nucleo;

/**
 * Sistema de Enrutamiento Central HTTP (Router).
 *
 * Mapea verbos HTTP y URI solicitadas con sus correspondientes 
 * controladores o ejecuciones en el sistema del E-Commerce.
 *
 * @package   App\Nucleo
 * @author    Luis Zambrano Gahón (ignot) <luiszg.com>
 * @license   MIT License
 * @link      https://github.com/lazg12/luiszg
 * @version   1.0.0
 */
class Enrutador 
{
    /**
     * Almacena el mapa multidimensional de rutas registradas.
     * Estructura: ['METODO_HTTP' => ['/ruta' => manejador]]
     *
     * @var array<string, array<string, callable|array>>
     */
    private array $mapaRutas = [];

    /**
     * Inicializa una nueva instancia del enrutador.
     */
    public function __construct() {}

    /**
     * Registra una ruta para el método HTTP GET.
     *
     * @param string $rutaSolicitada Ruta URL que debe coincidir (ej: '/' o '/catalogo').
     * @param callable|array $accionManejadora Función anónima o arreglo [Controlador::class, 'metodo'].
     * @return void
     */
    public function registrarRutaGet(string $rutaSolicitada, callable|array $accionManejadora): void 
    {
        $this->mapaRutas['GET'][$rutaSolicitada] = $accionManejadora;
    }

    /**
     * Registra una ruta para el método HTTP POST.
     *
     * @param string $rutaSolicitada Ruta URL que debe coincidir (ej: '/checkout/procesar').
     * @param callable|array $accionManejadora Función anónima o arreglo [Controlador::class, 'metodo'].
     * @return void
     */
    public function registrarRutaPost(string $rutaSolicitada, callable|array $accionManejadora): void 
    {
        $this->mapaRutas['POST'][$rutaSolicitada] = $accionManejadora;
    }

    /**
     * Evalúa la petición entrante y despacha la respuesta correspondiente.
     *
     * @param Peticion $peticion Instancia con la información HTTP recolectada.
     * @return Respuesta Instancia con el contenido HTML/JSON y el código de estado HTTP.
     */
    public function despacharPeticion(Peticion $peticion): Respuesta 
    {
        $ruta = $peticion->obtenerRutaSolicitada();
        $metodo = $peticion->obtenerTipoPeticionHttp();

        if (isset($this->mapaRutas[$metodo][$ruta])) {
            $accion = $this->mapaRutas[$metodo][$ruta];

            if (is_callable($accion)) {
                return $accion($peticion);
            } elseif (is_array($accion)) {
                [$controlador, $metodoAccion] = $accion;
                return $controlador->$metodoAccion($peticion);
            }
        }

        return new Respuesta("<h1>404 No Encontrado</h1><p>La ruta solicitada no existe en luiszg.com.</p>", 404);
    }
}