<?php

class App
{
    protected $controller = 'Dashboard';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->getParseURL();
        $url = ($url) ? $url : [$this->controller];

        // controller
        $this->controller = file_exists("../app/controllers/$url[0].php") ? $url[0] : 'Http';
        unset($url[0]);

        require_once "../app/controllers/{$this->controller}.php";
        $this->controller = new $this->controller;

        // method
        if (isset($url[1]) && method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            unset($url[1]);
        }

        // params
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller dan method, serta mengirim params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function getParseURL() // mengubah url ke array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            $url[0] = ucfirst(strtolower($url[0]));
            return $url;
        }
    }
}
