<?php
session_start();

/*
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
*/

require_once 'core/load.php';

if (isset($_GET)) {

    $handler = get_path();

    if ($handler) {
        //if ($handler != 'login' and $handler != 'verify' and heading('name') != 'setup' and !isset($_SESSION['session_token'])) redirect('user-login');
        $handler();
    } else {
        require_once 'themes/' . get('theme') . '/404.php';
    }
}
