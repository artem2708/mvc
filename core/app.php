<?php

class App
{
    private $config = [];

    public $db;


    public function __construct()
    {

        define("URI", $_SERVER['REQUEST_URI']);
        define("ROOT", $_SERVER['DOCUMENT_ROOT']);

    }

    public function autoload()
    {

        spl_autoload_register(function ($class) {

            $class = strtolower($class);
            if (file_exists(ROOT . '/core/classes/' . $class . '.php')) {

                require_once ROOT . '/core/classes/' . $class . '.php';

            } else if (file_exists(ROOT . '/core/models/' . $class . '.php')) {

                require_once ROOT . '/core/models/' . $class . '.php';

            }

        });

    }


    public function config()
    {

        $this->requireClass('/core/config/database.php');

        try {

            $this->db = new PDO('mysql:host=' . $this->config['database']['hostname'] . ';dbname=' . $this->config['database']['dbname'],
                $this->config['database']['username'],
                $this->config['database']['password']);

            $this->db->query('SET NAMES utf8');
            $this->db->query('SET CHARACTER_SET utf8_unicode_ci');

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {

            echo $e->getMessage();

        }

    }

    public function requireClass($path)
    {

        require ROOT . $path;

    }

    function start()
    {

        $route = explode('/', URI);

        $route[1] = strtolower($route[1]);

        if (file_exists(ROOT . '/app/controllers/' . $route[1] . '.php')) {
            $this->requireClass('/app/controllers/' . $route[1] . '.php');
            $controller = new $route[1]();
        } else {
            $this->requireClass('/app/controllers/main.php');
            $main = new Main();
        }

    }

}

?>