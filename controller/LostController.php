<?php

class LostController {

    function index() {
        $indexView = new KenyonView('lost');
        $indexView->outputView();
    }

}

?>