<?php

namespace core;

use core\Path;

/**
 * Classe Router
 * 
 * @Implementado sistema de rotas apenas atraves de GET e POST
 */
final class Router
{
    /**
     * @Rotas, conforme padrao:
     * 
     * array(
     *  METODO (GET OU POST) => [
     *      INDICE NUMERICO => [
     *          'route'   => URI - DIRETORIO PADRAO,
     *          'closure' => FUNCAO CALLBACK
     *      ],
     *      ...
     *  ],
     *  ...
     * )
     */
    private $routes = [];

    /**
     * @Separador de URI / parametro
     */
    private $separator = '@';

    /**
     * @Diretorio base para montar a URI
     */
    private $baseDir;

    public function __construct()
    {
        $this->baseDir = Path::find('pages_path');
    }

    /**
     * Rota via metodo GET
     * 
     * @param     uri: URI, sem informar o caminho base
     * @param     callback: o callback sera chamado quando a URI for igual ao baseDir + rota
     */
    public function get($uri, $callback)
    {
        $uri = explode($this->getSeparator(), $uri)[0];

        $this->addRoute('get', $uri, $callback);
    }

    /**
     * Rota via metodo POST
     * 
     * @param     O mesmo de $this->get()
     */
    public function post($uri, $callback)
    {
        $uri = explode($this->getSeparator(), $uri)[0];

        $this->addRoute('post', $uri, $callback);
    }

    /**
     * Executa o callback correspondente quando houver match entre a URI e a rota
     */
    public function dispatch()
    {
        $base = $this->getBaseDir().ltrim($this->getRequestUri(),'/');
        $requestUri = rtrim($base, '/');
        $requestMethod = $this->getRequestMethod();

        foreach ($this->getRoutes()[$requestMethod] as $route) {
            if ($requestUri == $route['route']) {
                call_user_func($route['closure']);
            }
        }
    }

    /**
     * Retorna o metodo da requisicao corrente
     */
    public function getRequestMethod()
    {
        ob_start();
        $method = $_SERVER['REQUEST_METHOD'];

        return strtolower($method);
    }

    /**
     * Retorna a URI atual
     */
    public function getRequestUri()
    {
        $uri = substr($_SERVER['REQUEST_URI'], strlen($this->baseDir));
        
        return '/' . trim(parse_url($uri, PHP_URL_PATH), '/');
    }

    /**
     * Retorna o separador de URI
     */
    public function getSeparator()
    {
        return $this->separator;
    }

    /**
     * Retorna o array de rotas
     */
    public function getRoutes()
    {
        return $this->routes;
    }

    /**
     * Retorna o caminho base para a URI
     */
    public function getBaseDir()
    {
        return $this->baseDir;
    }

    /**
     * Adiciona uma nova rota
     */
    private function addRoute($method, $route, $callback)
    {
        $method = strtolower($method);

        $route = $this->getBaseDir().trim($route, '/');
        $route = rtrim($route, '/');

        $this->routes[$method][] = array(
            'route' => $route,
            'closure' => $callback,
        );
    }
}