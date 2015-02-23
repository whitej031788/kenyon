<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST' || !isset($_POST['firstN']) || !isset($_POST['lastN']) || !isset($_POST['yearG']) || !isset($_POST['txtArea']) || !isset($_POST['emailA'])) {
    throw new Exception('The server returned an error, please contact the site Admin<br />');
}

try {

    $first = $_POST['firstN'];
    $last = $_POST['lastN'];
    $year = $_POST['yearG'];
    $txt = $_POST['txtArea'];
    $email = $_POST['emailA'];

    $to = 'whitej031788@gmail.com';
    $subject = 'New Friend Request From ' . ucwords($first) . ' ' . ucwords($last) . ', graduated in ' . $year;
    $message = <<<HEREDOC
                You have a new site request from $first $last. They say they graduated in $year. They also say you should know them because:

                $txt
        
                Email address is "$email" just in case.

                Get in contact with them to see if this is really them.
HEREDOC;
    $header = 'From: kenyonmaster@kenyon.com' . "\r\n" . 'Reply-To: whitej031788@gmail.com';

    mail($to, $subject, $message, $header);

    echo 'Your request has been sent successfully.<br /> An admin will follow up with you about site access<br />';
} catch (Exception $e) {
    $frontErr = new ErrorController($ex->getMessage(), $ex->getTraceAsString());
    $frontErr->emailError('Front Controller Error, ' . __LINE__);
    $frontErr = null;
}
?>