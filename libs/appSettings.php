<?php

$appSetDB = new KenyonDatabaseModel();

$_APPSET = $appSetDB->getAppSettings();

foreach ($_APPSET as $val) {
    $_SESSION[$val['Name']] = $val['Value'];
}

?>