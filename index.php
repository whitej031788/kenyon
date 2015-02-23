<?php

try {

    session_start();

    require_once __DIR__ . "/application.php";

    $frontController = new FrontController();
    $frontController->run();
    
} catch (Exception $ex) {
    $frontErr = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
    $frontErr->emailError('Front Controller Error, ' . __LINE__);
    $frontErr = null;
}
?>