<?php

class RegistrationController {

    public function index() {
        try {
            if (!isset($_POST['fname']) || !isset($_POST['lname']) || !isset($_POST['year']) || !isset($_POST['hidRegVal']) || $_POST['hidRegVal'] != 'newRegTrue') {
                throw new InvalidArgumentException(
                "The registration controller has been invoked without the correct POST params.");
            }
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $year = $_POST['year'];

            $regClass = new RegistrationClass($fname, $lname, $year);

            if ($fid = $regClass->checkRegistrationStatus()) {
                $regView = new KenyonView('registration');
                $regView->assignSmartVar('firstName', $fname);
                $regView->assignSmartVar('lastName', $lname);
                $regView->assignSmartVar('gradYear', $year);
                $regView->assignSmartVar('fid', $fid);
                $regView->outputView();
            } else {
                $regView = new KenyonView('index');
                $regView->assignSmartVar('BadReg', 'True');
                $regView->outputView();
            }
        } catch (Exception $ex) {
            $err = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
            $err->emailError('Registration Controller Error, ' . __LINE__);
            $err = null;
        }
    }

    public function CreateLogin() {
        try {

            if (!isset($_POST['loginId']) || !isset($_POST['emailIt']) || !isset($_POST['passTime']) || !isset($_POST['captcha_code'])) {
                throw new InvalidArgumentException(
                "The registration action controller CreateLogin has been invoked without the correct POST params.");
            }

            $regIt = new RegistrationClass();
            $success = $regIt->addLogin($_POST['loginId'], $_POST['emailIt'], $_POST['passTime'], $_POST['fid']);

            if ($success) {
                $newLogView = new KenyonView('registration');
                $newLogView->assignSmartVar('addedLogin', 'true');
                $newLogView->assignSmartVar('login', $_POST['loginId']);
                $newLogView->outputView();
            } else {
                $newLogView = new KenyonView('registration');
                $newLogView->assignSmartVar('addedLogin', 'false');
                $newLogView->outputView();
            }
        } catch (Exception $ex) {
            $err = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
            $err->emailError('Registration CreateLogin Controller Error, ' . __LINE__);
            $err = null;
        }
    }

    public function checkCapt() {
        try {
            include_once $_SERVER['DOCUMENT_ROOT'] . '/libs/securimage/securimage.php';
            $securimage = new Securimage();
            if ($securimage->check($_POST['captcha_code']) == false) {
                echo 'false';
            } else {
                echo 'true';
            }
            session_unset();
            session_destroy();
        } catch (Exception $ex) {
            $err = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
            $err->emailError('Registration CheckCapt Controller Error, ' . __LINE__);
            $err = null;
        }
    }

}

?>