<?php

class ErrorController {

    private $errString;
    private $traceString;
    private $to = 'whitej031788@gmail.com';
    private $reqURL;
    private $ref;
    private $xhr;
    private $IP;

    public function __construct($err = null, $trace = null,$xhr = null) {
        $this->errString = $err;
        $this->traceString = $trace;
        $this->reqURL = $_SERVER['REQUEST_URI'];
        if(isset($_SERVER['HTTP_REFERER'])) {
            $this->ref = $_SERVER['HTTP_REFERER'];
        } else {
            $this->ref = "Not sent";
        }
        $this->xhr = $xhr;
        $this->IP = $_SERVER['REMOTE_ADDR'];
    }

    public function index() {
        $indexView = new KenyonView('error');
        $indexView->outputView();
    }

    public function emailError($subject) {
        $message = <<<HEREDOC
                
Request URL: $this->reqURL.

Refer URL: $this->ref.
                
IP Addr: $this->IP.  

Error String: $this->errString.
            
StackTrace:  
                
$this->traceString;
            
HEREDOC;
        $header = 'From: whitej031788@gmail.com' . "\r\n" . 'Reply-To: whitej031788@gmail.com';

        mail($this->to, $subject, $message, $header);
        if (!$this->xhr)
            $this->redir($this->errString);
    }

    private function redir($errType) {
        if (strstr($errType, "The controller action") || strstr($errType, "The action controller")) {
            header('Location: /Lost');
        } else {
            header('Location: /Error');
        }
    }

}

?>