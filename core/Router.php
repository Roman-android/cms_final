<?php

namespace core;

class Router
{
    private $config_pages;
    private $page;

    public function __construct()
    {
        $this->config_pages = require_once 'config/config_pages.php';
        $this->init();
    }


    private function init()
    {
        echo 'Class \'Router\'<br>';
        $this->parseUri();
        $this->parseHost();
        $this->parseGetParam();

        /*====================*/
        $path = 'controllers\\' . ucfirst($this->page) . 'Controller';
        $controller = new $path;
        $controller->init();
    }

    private function parseUri()
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $trimUrl = trim($url, '/');
        $urlToArray = explode('/', $trimUrl);
        $this->page = $urlToArray[0];
        if (in_array($this->page, $this->config_pages)) {
            echo "Страница {$this->page} существует" . '<br>';
        } else {
            echo "Страница {$this->page} отсутствует" . '<br>';
        };
    }

    private function parseHost()
    {
        $host = $_SERVER['HTTP_HOST'];
        echo 'HTTP_HOST = ' . $host . '<br>';
    }

    private function parseGetParam()
    {
        $getParam = $_GET['test'] ?? "Параметр test не обнаружен";
        echo '$_GET[test] = ' . $getParam;
    }


}