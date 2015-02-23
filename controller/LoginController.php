<?php

class LoginController {

    public function index() {
        $loginView = new KenyonView('login');
        $featVidArr = $this->getFeatureVidId();
        if ($featVidArr == 0) {
            $loginView->assignSmartVar("UserName", $_SESSION['UserName']);
            $loginView->assignSmartVar("type", "home");
            $loginView->outputView();
        } else {
            $vidName = $featVidArr['vidName'];
            $vidDescrip = $featVidArr['descrip'];
            $vidPath = $featVidArr['vidPath'];
            $loginView->assignSmartVar("type", "home");
            $loginView->assignSmartVar("UserName", $_SESSION['UserName']);
            $loginView->assignSmartVar("vidName", $vidName);
            $loginView->assignSmartVar("vidDescrip", $vidDescrip);
            $loginView->assignSmartVar("vidPath", $vidPath);
            $loginView->outputView();
        }
    }

    public function LogOut() {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
        );
        session_unset();
        session_destroy();
        header('Location:/');
    }

    public function Videos() {
        $loginView = new KenyonView('login');
        $loginView->assignSmartVar("type", "videos");
        $loginView->assignSmartVar("UserName", $_SESSION['UserName']);
        if ((integer) $_SESSION['Admin'] == 1)
            $loginView->assignSmartVar("isAdmin", $_SESSION['Admin']);
        $loginView->outputView();
    }

    public function Account() {
        try {
            $loginView = new KenyonView('login');
            $logClass = new LoginClass($_SESSION['UserName']);
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['acctEmail']) && isset($_POST['acctNewPass'])) {
                $logClass->updateAcctInfo($_POST['acctEmail'], $_POST['acctNewPass']);
                $loginView->assignSmartVar("update", "success");
            }
            $acctStruct = $logClass->getAccountInfo();
            $loginView->assignSmartVar("type", "account");
            $loginView->assignSmartVar("UserName", $_SESSION['UserName']);
            $loginView->assignSmartVar("FNAME", $acctStruct['firstName']);
            $loginView->assignSmartVar("LNAME", $acctStruct['lastName']);
            $loginView->assignSmartVar("EMAIL", $acctStruct['email']);
            $loginView->outputView();
        } catch (Exception $ex) {
            $frontErr = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
            $frontErr->emailError('Login Controller Error, ' . __LINE__);
            $frontErr = null;
        }
    }

    private function getFeatureVidId() {
        $logClass = new LoginClass();

        $fid = $logClass->getFeatureVidId();

        return $fid;
    }

    public function getVideoGridData($valid = null, $command = null) {
        if (!$this->isGridOk($valid, $command)) {
            header("Location:/Login");
        } else {
            if (isset($_POST['vidId']))
                $theId = $_POST['vidId'];
            $logClass = new LoginClass();
            $numRows = $logClass->getJSONdataRows();
            if (isset($theId))
                $vidData = $logClass->getJSONdataTable($theId);
            else
                $vidData = $logClass->getJSONdataTable();
            if (!isset($_POST['vidId'])) {
                $fullEncode = array("iTotalDisplayRecords" => $numRows, "iTotalRecords" => $numRows, "aaData" => $vidData);
            } else {
                $fullEncode = $vidData;
            }
            echo json_encode($fullEncode);
        }
    }

    public function updateVideoGridData($valid = null, $command = null) {
        if (!$this->isGridOk($valid, $command)) {
            header("Location:/Login");
        } else {
            if (isset($_POST['newVidId']))
                $theId = $_POST['newVidId'];
            else
                throw InvalidArgumentException("No vid id passed to admin update");
            if (isset($_POST['newName']))
                $newName = $_POST['newName'];
            else
                $newName = "";
            if (isset($_POST['newDescrip']))
                $newDesc = $_POST['newDescrip'];
            else
                $newDesc = "";
            if (isset($_POST['doDisableIt']))
                $disableIt = true;
            else
                $disableIt = false;
            $logClass = new LoginClass();
            try {
                $success = $logClass->updateVideoData($theId, $newName, $newDesc, $disableIt);
                if ($success)
                    echo json_encode(array("result" => true, "name" => $newName, "desc" => $newDesc, "id" => $theId));
                else
                    echo json_encode(array("result" => false, "name" => $newName, "desc" => $newDesc, "id" => $theId));
            } catch (Exception $ex) {
                echo json_encode(array("result" => false, "name" => $newName, "desc" => $newDesc, "id" => $theId));
            }
        }
    }

    private function isGridOk($prm1, $prm2) {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            return true;
        } elseif (!isset($prm1) || $prm1 != 'true') {
            return false;
        } elseif (!isset($prm2) || $prm2 != 'getVid') {
            return false;
        } else {
            return true;
        }
    }

}

?>