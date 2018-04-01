<?php

namespace core;

use core\Path;

final class Page
{
    /**
     * Diretorio base
     */
    private $base = './pages/';

    /**
     * String para css
     */
    private $strCss = "link rel='stylesheet' href='{{:SEP}}'>";

    /**
     * String para javascript
     */
    private $strJs = "script src='{{:SEP}}'></script>";

    /**
     * Separador
     */
    private $spr = '{{:SEP}}';

    /**
     * Paginas que serao carregadas
     */
    private $pages = [
        'header' => [
            'file_name' => null,
            'file_content' => null
        ],
        'body' => [],
        'footer' => [
            'file_name' => null,
            'file_content' => null
        ]
    ];

    /**
     * Parametros que serao substituidos
     */
    private $params = [];

    /**
     * Configuracao de css e javascript
     */
    private $config = [
        'styles' => [],
        'scripts' => []
    ];

    public function __construct($config = false)
    {
        if (!$config && is_array($config)) {
            $this->pages[$config[0]]['file_name'] = $config;
        }
    }

    /**
     * Gera o conteudo e mostra em tela
     */
    public function render()
    {

    }

    /**
     * Seta o arquivo de body
     */
    public function setBody($page)
    {

    }

    /**
     * @param
     *      -> arr[0]: tipo do arquivo (folha de estilo ou script)
     *      -> arr[1]: nome do arquivo (se for um array a funcao sera recursiva)
     * 
     * Deve ser chamado conforme exemplo abaixo:
     * 
     * $page
     *      ->configure(['styles', ['main', 'bootstrap.min']])
     *      ->configure(['scripts', ['main', 'bootstrap.min']]);
     */
    public function configure($arr)
    {
        if (is_array($arr) && in_array(strtolower($arr[0]), ['styles', 'scripts'])) {
            $key = strtolower($arr[0]);
            $ext = ($key == 'styles') ? '.css' : '.js';

            if (!is_array($arr[1])) {
                $value = $arr[1].$ext;
                $file  ='./'.(substr($ext, 1)).'/'.$value;

                $this->config[$key][] = file_exists($file) ? $file : null;
            } else {
                // se for um array chama o proprio metodo
                $arrOfValues = $arr[1];

                foreach ($arrOfValues as $type) {
                    $nextArr[0] = $key;
                    $nextArr[1] = $type;
                    
                    $this->configure($nextArr); // :)
                }
            }
        } else {
            throw new \Exception('Parametro invalido!');
        }

        return $this;
    }

    public function mount($file)
    {
        if (!is_array($file)) {
            $type = (substr($file, 2, 3) == 'css') ? $this->getStrCss() : $this->getStrJs();
            $finalTransform = '<'.str_replace($this->getSeparator(), $file, $type);
            
            echo $finalTransform;
        } else {
            foreach ($file as $value) {
                $this->mount($value);
            }
        }
    }

    /**
     * @param
     *      -> arr[0]: nome da variavel definida no html
     *      -> arr[1]: valor da variavel (se for um array a funcao sera recursiva)
     */
    public function add($arr)
    {
        if (is_array($arr)) {
            $this->params = $arr;
        } else {
            $this->params[] = $arr;
        }
    }

    public function getBase()
    {
        return $this->base;
    }

    public function getStrCss()
    {
        return $this->strCss;
    }

    public function getStrJs()
    {
        return $this->strJs;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getSeparator()
    {
        return $this->spr;
    }
}