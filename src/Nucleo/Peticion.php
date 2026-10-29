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
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    
    // Extraer únicamente el path (ignorando query strings como ?id=1)
    $path = parse_url($uri, PHP_URL_PATH);

    // Limpiar el prefijo de la subcarpeta local de XAMPP
    $pathLimpio = str_replace('/luiszg', '', $path);

    // Si la ruta queda vacía o en blanco, aseguramos que sea '/'
    return ($pathLimpio === '' || $pathLimpio === '/') ? '/' : $pathLimpio;
}

    public function obtenerTipoPeticionHttp(): string 
    {
        return $this->tipoPeticionHttp;
    }
}