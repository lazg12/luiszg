<?php
/**
 * SISTEMA: luiszg.com
 * CLASE: Peticion
 */

declare(strict_types=1);

namespace App\Nucleo;

class Peticion 
{
    private string $rutaSolicitada;
    private string $tipoPeticionHttp;

    public function __construct() 
    {
        // Limpiamos la URI para obtener solo la ruta relativa
        $this->rutaSolicitada = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->tipoPeticionHttp = $_SERVER['REQUEST_METHOD'];
    }

    public function obtenerRutaSolicitada(): string 
    {
        return $this->rutaSolicitada;
    }

    public function obtenerTipoPeticionHttp(): string 
    {
        return $this->tipoPeticionHttp;
    }
}