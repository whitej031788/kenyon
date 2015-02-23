<?php

class KenyonView {

    private $controller;
    private $smarty;

    public function __construct($controller) {
        $this->controller = $controller;
        $this->smarty = new Smarty();
    }

    public function outputView() {
        $this->smarty->display($this->controller . '.tpl');
    }

    public function assignSmartVar($key,$val) {
        $this->smarty->assign($key,$val);
    }
}
?>