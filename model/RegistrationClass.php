<?php

class RegistrationClass extends KenyonDatabaseModel {
    
    private $friendArray;

    public function __construct($fname = '', $lname = '', $year = '') {
        parent::__construct();

        $this->friendArray = array($fname,$lname,$year);
    }

    public function checkRegistrationStatus() {
        $sql = "SELECT * FROM friends WHERE firstName = ? AND lastName = ? AND gradYear = ?";
        
        $q = $this->conn->prepare($sql);
        
        $q->execute($this->friendArray);
        
        $res = $q->fetch();
        
        if (!$res) {
            return false;
        }
        else {
            return $this->doesFriendExist($res['id']);
        } 
    }
    
    public function addLogin($username,$email,$pass,$fid) {
        $sql = 'select COUNT(*) as ct from logins where loginID = ?';
        
        $q = $this->conn->prepare($sql);
        
        $q->execute(array($username));
        
        $res = $q->fetch();
        
        if ($res['ct'] != 0) {
            return false;
        }
        
        $sql = 'select COUNT(*) as ct from logins where email = ?';
        
        $q = $this->conn->prepare($sql);
        
        $q->execute(array($email));
        
        $res = $q->fetch();
        
        if ($res['ct'] != 0) {
            return false;
        }
        
        $sql = 'INSERT INTO logins(loginID,userPass,email,isAdmin,friendID,confirmed) VALUES (:username,:pass,:email,0,:fid,0);';
        
        $q = $this->conn->prepare($sql);
        
        $q->execute(array(
            ':username' => $username,
            ':pass' => password_hash($pass,PASSWORD_DEFAULT),
            ':email' => $email,
            ':fid' => $fid
        ));
        
        return true;
    }
    
    private function doesFriendExist($fid) {
        $sql = "SELECT COUNT(*) as ct FROM logins WHERE friendID = ?";
        
        $q = $this->conn->prepare($sql);
        
        $q->execute(array($fid));
        
        $res = $q->fetch();
        
        return ($res['ct'] == 0 ? $fid : false);
    }
}

?>