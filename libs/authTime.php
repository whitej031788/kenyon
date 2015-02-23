<?php

//Called for any page that requires someone to be logged in
//Called in the FrontController for any AuthControllers

$isAuth = true;

if (!isset($_SESSION)) {
    $isAuth = false;
}

if (isset($_SESSION['IPaddr']) && $_SESSION['IPaddr'] != $_SERVER['REMOTE_ADDR']) {
    $isAuth = false;
}

if (isset($_SESSION['userAgent']) && $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']) {
    $isAuth = false;
}

if (!isset($_SESSION['userAgent']) || !isset($_SESSION['IPaddr']) || !isset($_SESSION['FirstName']) || !isset($_SESSION['LastName']) ||
        !isset($_SESSION['FID']) || !isset($_SESSION['LID']) || !isset($_SESSION['GradYear']) || !isset($_SESSION['UserName']) || !isset($_SESSION['Admin']) || !isset($_SESSION['email'])) {
    $isAuth = false;
}

if (!isset($_SESSION['LAST_ACTIVITY'])) {
    $isAuth = false;
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 2700)) {
    $isAuth = false;
}

if (!$isAuth) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    session_unset();
    session_destroy();
    $badSess = new KenyonView('badsession');
    $badSess->outputView();
    exit(0);
} else {
    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
    $logClass = new LoginClass();
    $isAuth = $logClass->valSession();
    if (!$isAuth) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
        );
        session_destroy();
        $badSess = new KenyonView('badsession');
        $badSess->outputView();
        exit(0);
    } else {
        return;
    }
}
?>