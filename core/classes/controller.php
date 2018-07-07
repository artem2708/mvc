<?php

abstract class Controller
{

    private $route = [];

    private $args = 0;

    private $params = [];

    function __construct()
    {
        $this->route = explode('/', URI);

        $this->args = count($this->route);

        $this->router();
    }

    abstract function Index();

    private function router()
    {
        if (class_exists($this->route[1])) {

            if ($this->args >= 3) {
                if (method_exists($this, $this->route[2])) {
                    $this->uri(2, 3);
                } else {
                    $this->uri(0, 2);
                }
            } else {
                $this->uri(0, 2);
            }

        } else {

            if ($this->args >= 2) {
                if (method_exists($this, $this->route[1])) {
                    $this->uri(1, 2);
                } else {
                    $this->uri(0, 1);
                }
            } else {
                $this->uri(0, 1);
            }

        }
    }

    /**
     * @param $method
     * @param $param
     */
    private function uri($method, $param)
    {
        for ($i = $param; $i < $this->args; $i++) {
            $this->params[$i] = $this->route[$i];
        }

        if ($method == 0)
            call_user_func_array(array($this, 'Index'), $this->params);
        else
            call_user_func_array(array($this, $this->route[$method]), $this->params);
    }

    /**
     * @param $path
     * @param array $data
     */
    function view($path, $data = [])
    {
        if (is_array($data))
            extract($data);

        require(ROOT . '/app/views/' . $path . '.php');
    }

}

?>