<?php
require_once '../vendor/autoload.php';
require_once 'config/config.php';

// Error Reporting
if (ENV == 'Production') {
    error_reporting(0);
    error_reporting(E_ERROR | E_PARSE);
    ini_set('display_errors', 0);
};

foreach(scandir("../core") as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) !== 'php') continue;
    require_once "../core/$file";
}

// Build in functions

function gets() {
    echo '<pre>';
    var_dump($_GET);
}

function posts() {
    echo '<pre>';
    var_dump($_POST);
}

function dd($x) {
    echo '<pre>';
    var_dump($x); die;
}

function pd($x) {
    echo '<pre>';
    print_r($x); die;
}
function dump($x) {
    echo '<pre>';
    var_dump($x);
    echo "</pre>";
}
function pdump($x) {
    echo '<pre>';
    print_r($x);
    echo "</pre>";
}

function redirectTo($route, $response_code = 200) {
    http_response_code($response_code);
    header('Location: ' . BASEURL . $route);
    exit;
}

function returnJson($array, $response_code = 200) {
    http_response_code($response_code);
    echo json_encode($array);
    exit;
}

function csrf_generate() {
    unset($_SESSION['csrf_token']);
    $_SESSION['csrf_token'] = base64_encode(random_bytes(32));
    return $_SESSION['csrf_token'];
}

function csrf() {
    $csrf = $_SESSION['csrf_token'];
    return '<input type="hidden" name="csrf_token" value="'.$csrf.'">';
}

function csrf_validate($redirect_url) {
    if (!isset($_SESSION['csrf_token'])) {
        Flasher::setFlash("<b>CSRF token doesn't set up yet!</b>", 'warning');
        redirectTo($redirect_url);
    } elseif (!isset($_POST['csrf_token'])) {
        Flasher::setFlash("<b>CSRF token not available!</b>", 'warning');
        redirectTo($redirect_url);
    } elseif (strcmp($_POST['csrf_token'], $_SESSION['csrf_token']) !== 0) {
        Flasher::setFlash("<b>CSRF error</b>. Please try again!", 'warning');
        redirectTo($redirect_url);
    }
}
