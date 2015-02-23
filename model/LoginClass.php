<?php

class LoginClass extends KenyonDatabaseModel {

    private $user;
    private $pass;

    public function __construct($userN = null, $passW = null) {
        parent::__construct();

        $this->user = $userN;
        $this->pass = $passW;
    }

    public function setSecureSession($uid) {
        try {
            $sql = "CALL getSessInit(?);";

            $q = $this->conn->prepare($sql);

            $q->execute(array($uid));

            $res = $q->fetch();

            self::sessionStart('KenyonExCollegian');

            $_SESSION['FirstName'] = $res['firstName'];
            $_SESSION['LastName'] = $res['lastName'];
            $_SESSION['GradYear'] = $res['gradYear'];
            $_SESSION['UserName'] = $res['loginID'];
            $_SESSION['email'] = $res['email'];
            $_SESSION['Admin'] = $res['isAdmin'];
            $_SESSION['LID'] = $res['id'];
            $_SESSION['FID'] = $res['friendID'];
            $_SESSION['LAST_ACTIVITY'] = time();
        } catch (Exception $e) {
            $frontErr = new ErrorController($e->getMessage(), $e->getTraceAsString());
            $frontErr->emailError('Login Set Secure Sess Error, ' . __LINE__);
            $frontErr = null;
        }
    }

    public function doesItExist() {
        $sql = 'SELECT userPass,loginID from logins where (loginID = :user);';

        $q = $this->conn->prepare($sql);

        $q->execute(array(
            ':user' => $this->user
        ));

        $res = $q->fetch();

        if (count($res) == 0) {
            return false;
        } else {
            $PW = $res['userPass'];
            return password_verify($this->pass, $PW) ? $res['loginID'] : false;
        }
    }

    public function forgotIt($type, $email) {
        try {
            $sql = "select email,loginID from logins where email = ?";

            $q = $this->conn->prepare($sql);

            $q->execute(array($email));

            $res = $q->fetch();

            if (!$res) {
                return "false";
            } else {
                switch ($type) {
                    case 'User':
                        $this->emailInfo($type, $res);
                        return $res['email'];

                    case 'Pass':
                        $newOne = $this->genRandomPass(10);
                        $newPass = password_hash($newOne, PASSWORD_DEFAULT);
                        $res['newPass'] = $newOne;
                        $sql = "UPDATE logins SET userPass = :userPass where email = :email;";
                        $q = $this->conn->prepare($sql);
                        $q->execute(array(
                            ':userPass' => $newPass,
                            ':email' => $res['email']
                        ));
                        $this->emailInfo($type, $res);
                        return $res['email'];

                    default:
                        return "false";
                }
            }
        } catch (Exception $ex) {
            $frontErr = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
            $frontErr->emailError('Login Class Error, ' . __LINE__);
            $frontErr = null;
            return "false";
        }
    }

    private function emailInfo($type, $data) {
        $to = $data['email'];
        $header = 'From: kenyonmaster@kenyon.com' . "\r\n" . 'Reply-To: whitej031788@gmail.com';

        if ($type == 'User') {
            $subject = "KEC Forgot Username Request";
            $message = <<<HEREDOC
The Kenyon Ex Collegian received a forgotten username request for this email address. Your username is:
                    
            {$data['loginID']}
            
Please use this to login and keep it handy.
HEREDOC;
        } else if ($type == 'Pass') {
            $subject = "KEC Forgot Password Reset";
            $message = <<<HEREDOC
The Kenyon Ex Collegian received a request to reset the password this email address. Your new temporary password is:
                    
            {$data['newPass']}
            
Please use this to login and keep it handy. You can also reset it once you login.
HEREDOC;
        } else {
            return;
        }

        mail($to, $subject, $message, $header);
    }

    private function genRandomPass($length) {
        $random_string = "";

        $valid_chars = 'abcdefghijklmnpqrstuvwxyzABCDEFGHIJKLMNOPQSTUVWXYZ0123456789&*#$';

        $num_valid_chars = strlen($valid_chars);

        for ($i = 0; $i < $length; $i++) {

            $random_pick = mt_rand(1, $num_valid_chars);

            $random_char = $valid_chars[$random_pick - 1];

            $random_string .= $random_char;
        }

        return $random_string;
    }

    private static function sessionStart($name, $limit = 0, $path = '/', $domain = null, $secure = null) {
// Set the cookie name before we start.
        session_name($name . '_Session');

// Set the domain to default to the current domain.
        $domain = isset($domain) ? $domain : isset($_SERVER['SERVER_NAME']);

// Set the default secure value to whether the site is being accessed with SSL
        $https = isset($secure) ? $secure : isset($_SERVER['HTTPS']);

// Set the cookie settings and start the session
        session_set_cookie_params($limit, $path, $domain, $secure, true);
        session_start();
        $_SESSION['IPaddr'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
    }

    public function alreadyLoggedIn($ip, $agent) {
        if (!isset($_SESSION)) {
            return false;
        }

        if (isset($_SESSION['IPaddr']) && $_SESSION['IPaddr'] != $ip) {
            return false;
        }

        if (isset($_SESSION['userAgent']) && $_SESSION['userAgent'] != $agent) {
            return false;
        }

        if (!isset($_SESSION['userAgent']) || !isset($_SESSION['IPaddr']) || !isset($_SESSION['FirstName']) || !isset($_SESSION['LastName']) ||
                !isset($_SESSION['FID']) || !isset($_SESSION['LID']) || !isset($_SESSION['GradYear']) || !isset($_SESSION['UserName']) || !isset($_SESSION['Admin']) || !isset($_SESSION['email'])) {
            return false;
        }

        if (!isset($_SESSION['LAST_ACTIVITY'])) {
            $isAuth = false;
        }

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2700)) {
            $isAuth = false;
        }

        return true;
    }

    public function valSession() {
        $sql = "select COUNT(*) as ct from logins where email = ? AND friendID = ? and loginID = ?";

        $q = $this->conn->prepare($sql);

        $q->execute(array($_SESSION['email'], $_SESSION['FID'], $_SESSION['UserName']));

        $res = $q->fetch();

        if ($res['ct'] == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getFeatureVidId() {
        $sql = "select vidPath,descrip,vidName from videos where isFeature = 1";

        $q = $this->conn->prepare($sql);

        $q->execute();

        $res = $q->fetch();

        if (!$res) {
            return 0;
        } else {
            return $res;
        }
    }

    public function getAccountInfo() {
        $sql = "SELECT f.firstName,f.lastName,l.loginID,l.email from logins as l inner join friends as f "
                . "on l.friendID = f.id where l.loginID = ?";

        $q = $this->conn->prepare($sql);

        $q->execute(array($this->user));

        $res = $q->fetch();

        return $res;
    }

    public function updateAcctInfo($email, $pass) {
        if ($pass != "") {
            $sql = "UPDATE logins SET email = ?,userPass = ? where loginID = ?;";
            $myArr = array($email, password_hash($pass, PASSWORD_DEFAULT), $this->user);
        } else {
            $sql = "UPDATE logins SET email = ? where loginID = ?;";
            $myArr = array($email, $this->user);
        }

        $q = $this->conn->prepare($sql);

        $q->execute($myArr);

        $_SESSION['email'] = $email;
    }

    public function getJSONdataTable($id = null) {
        if ($id !== null) {
            $sql = "select vidName,descrip,vidPath from videos where id = ?;";
            $q = $this->conn->prepare($sql);
            $q->execute(array($id));
            $res = $q->fetch();
        } else {
            $startRow = $_POST['iDisplayStart'];
            $numRowDisplay = $_POST['iDisplayLength'];
            $sortCol = $_POST['iSortCol_0'];
            $sortOrder = $_POST['sSortDir_0'];
            $secLim = $startRow + $numRowDisplay;
            $sSearch = $_POST['sSearch'];

            switch ($sortCol) {
                case 0:
                    $sortCol = "vidName";
                    break;

                case 1:
                    $sortCol = "descrip";
                    break;

                case 2:
                    $sortCol = "vidPath";
                    break;

                default:
            }

            if ($sSearch != "")
                $searchClause = ' AND (vidName like ? OR descrip like ?)';
            else
                $searchClause = '';

            $sql = "select vidName,descrip,id,vidPath from videos where vidPath not like '%.avi' AND isDisable = 0" . $searchClause . " order by " . $sortCol . " " . $sortOrder . " LIMIT " . $startRow . ", " . $numRowDisplay . ";";

            $q = $this->conn->prepare($sql);

            if ($sSearch != "") {
                $q->bindValue(1, "%{$sSearch}%", PDO::PARAM_STR);
                $q->bindValue(2, "%{$sSearch}%", PDO::PARAM_STR);
                $q->execute();
            } else {
                $q->execute();
            }

            $res = $q->fetchAll();
        }

        return $res;
    }

    public function getJSONdataRows() {

        if (isset($_POST['sSearch'])) 
            $sSearch = $_POST['sSearch'];
        else
            $sSearch = "";

        if ($sSearch != "")
            $searchClause = ' AND (vidName like ? OR descrip like ?);';
        else
            $searchClause = '';

        $sql = "select COUNT(*) as ct from videos where vidPath not like '%.avi' AND isDisable = 0" . $searchClause;

        $q = $this->conn->prepare($sql);

        if ($sSearch != "") {
            $q->bindValue(1, "%{$sSearch}%", PDO::PARAM_STR);
            $q->bindValue(2, "%{$sSearch}%", PDO::PARAM_STR);
            $q->execute();
        } else {
            $q->execute();
        }

        $res = $q->fetch();

        return $res['ct'];
    }

    public function updateVideoData($id, $name, $desc, $disable) {
        try {
            if (!$disable) {
                $sql = "UPDATE videos SET vidName = ?,descrip = ? where id = ?;";
            } else {
                $sql = "UPDATE videos SET vidName = ?,descrip = ?,isDisable = 1 where id = ?;";
            }

            $q = $this->conn->prepare($sql);

            $q->execute(array($name, $desc, $id));

            return true;
        } catch (Exception $ex) {
            $frontErr = new ErrorController($ex->getMessage(), $ex->getTraceAsString(), true);
            $frontErr->emailError('updateVideoData Error, ' . __LINE__);
            $frontErr = null;
            return false;
        }
    }

    public function logAttempt($log, $ip, $type) {
        try {
            switch ($type) {
                CASE 'bad':
                    $sql = "INSERT INTO failLogin(ipAddr,login) VALUES (?,?);";
                    break;

                case 'good':
                    $sql = "INSERT INTO login_auth(ipAddr,login) VALUES (?,?);";
                    break;

                default:
                    break;
            }

            $q = $this->conn->prepare($sql);

            $q->execute(array($ip, $log));
        } catch (Exception $ex) {
            $frontErr = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
            $frontErr->emailError('log Failed Attempt Error, ' . __LINE__);
            $frontErr = null;
            return false;
        }
    }

}

?>