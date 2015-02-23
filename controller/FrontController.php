<?php

interface FrontControllerInterface {

    public function setController($controller);

    public function setAction($action);

    public function setParams(array $params);

    public function run();
}

class FrontController implements FrontControllerInterface {

    const DEFAULT_CONTROLLER = "IndexController";
    const DEFAULT_ACTION = "index";

    protected $controller = self::DEFAULT_CONTROLLER;
    protected $action = self::DEFAULT_ACTION;
    protected $params = array();
    protected $basePath = "Collegian/";
    protected $authControllers = array("LoginController");

    public function __construct(array $options = array()) {

        if (isset($_SESSION['debug']) && $_SESSION['debug'] == 1) {
            ini_set('display_startup_errors', 1);
            ini_set('display_errors', 1);
            error_reporting(-1);
        }

        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }

    protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        if (strpos($path . '/', $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }
        if ($path == "") {
            $controller = 'Index';
        } else {
            @list($controller, $action, $params) = explode("/", $path, 3);
        }
        if (isset($controller)) {
            $this->setController($controller);
        }
        if (isset($action)) {
            $this->setAction($action);
        }
        if (isset($params)) {
            $this->setParams(explode("/", $params));
        }
    }

    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller, true)) {
            if ($controller != 'Favicon.icoController') {
                if ($this->badUrlCheck()) {
                    file_put_contents(".htaccess", "Deny from " . $_SERVER['REMOTE_ADDR'] . "\n", FILE_APPEND | LOCK_EX);
                }
            }
            throw new InvalidArgumentException(
            "The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action) {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            if ($this->badUrlCheck()) {
                file_put_contents(".htaccess", "Deny from " . $_SERVER['REMOTE_ADDR'] . "\n", FILE_APPEND | LOCK_EX);
            }
            throw new InvalidArgumentException(
            "The controller action '$action' for controller '$this->controller' has been not defined.");
        }
        $this->action = $action;
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function run() {
        if (in_array($this->controller, $this->authControllers)) {
            require_once "libs/authTime.php";
        }
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }

    private function badUrlCheck() {
        $DB = new KenyonDatabaseModel();
        if (($countit = $DB->insertBadUrlAndGiveCount($_SERVER['REMOTE_ADDR'])) > 5) {
            $DB->disconnect();
            return true;
        } else {
            $DB->disconnect();
            return false;
        }
    }

}

?>