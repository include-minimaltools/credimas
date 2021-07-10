<?php
    error_reporting(E_ALL);

    ini_set('ignore_repeated_errors', TRUE);
    ini_set('display_error', FALSE);
    ini_set('log_errors', TRUE);

    ini_set('error_log','console.log');

    require_once 'class/messages/error.php';
    require_once 'class/messages/success.php';

    require_once 'libs/database.php';
    require_once 'libs/controller.php';

    require_once 'class/SessionController.php';

    require_once 'libs/model.php';
    require_once 'libs/view.php';
    require_once 'libs/app.php';
    require_once 'config/config.php';
    require_once 'database/USER.php';

    $app = new App();
?>