<?php

class IndexController {

    public function index() {
        $checkIt = new LoginClass();
        if ($checkIt->alreadyLoggedIn($_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT'])) {
            header("Location:/Login");
            $checkIt = null;
            exit(0);
        } else {
            $checkIt = null;
            if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login']) && isset($_POST['passTime'])) {
                $logIt = new LoginClass();
                if (($uid = $this->validateLogin($_POST['login'], $_POST['passTime'])) != false) {
                    $logIt->setSecureSession($uid);
                    $logIt->logAttempt($uid,$_SERVER['REMOTE_ADDR'],'good');
                    $logIt = null;
                    header("Location:/Login");
                    exit(0);
                } else {
                    $logIt->logAttempt($_POST['login'],$_SERVER['REMOTE_ADDR'],'bad');
                    $indexView = new KenyonView('index');
                    $indexView->assignSmartVar('isLive', $_SESSION['isLive']);
                    $indexView->assignSmartVar('badLog', 'true');
                    $indexView->outputView();
                }
            } else {
                $indexView = new KenyonView('index');
                $indexView->assignSmartVar('isLive', $_SESSION['isLive']);
                $indexView->outputView();
            }
        }
    }

    private function validateLogin($user, $passW) {
        $logClass = new LoginClass($user, $passW);
        return $logClass->doesItExist();
    }

    public function SendUserInfo($type = null, $email = null) {
        if ($type == null || $email == null) {
            throw new InvalidArgumentException(
            "The SendUserInfo controller has been invoked without the correct GET params.");
        }
        switch ($type) {
            case 'User':
                $logClass = new LoginClass();
                $sentIt = $logClass->forgotIt($type, $email);
                echo $sentIt;
                break;

            case 'Pass':
                $logClass = new LoginClass();
                $sentIt = $logClass->forgotIt($type, $email);
                echo $sentIt;
                break;

            default:
                echo 'false';
                return;
        }
    }

}

?>