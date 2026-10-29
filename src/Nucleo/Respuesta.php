<?php
/**
 * SISTEMA: luiszg.com
 * CLASE: Respuesta
 */

declare(strict_types=1);

namespace App\Nucleo;

class Respuesta 
{
    private string $contenidoCuerpo;
    private int $codigoEstadoHttp;
    private array $cabecerasHttp;

    public function __construct(string $contenidoCuerpo = '', int $codigoEstadoHttp = 200, array $cabecerasHttp = []) 
    {
        $this->contenidoCuerpo = $contenidoCuerpo;
        $this->codigoEstadoHttp = $codigoEstadoHttp;
        $this->cabecerasHttp = $cabecerasHttp;
    }

    public function enviarRespuestaAlNavegador(): void 
    {
        // Enviar el código de estado HTTP (ej. 200, 404, 500)
        http_response_code($this->codigoEstadoHttp);

        // Enviar cabeceras HTTP adicionales si existen
        foreach ($this->cabecerasHttp as $nombre => $valor) {
            header("{$nombre}: {$valor}");
        }

        // Imprimir el contenido final (HTML o datos binarios) hacia el cliente
        echo $this->contenidoCuerpo;
    }
}