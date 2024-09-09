<?php

function httpPOST($block = true) {
    $res = $_SERVER['REQUEST_METHOD'] != 'POST';
    if ($block && $res) {
        echo "method doesn't exist!";
        exit;
    } 
    return $res;
}

function gets() {
    return (object)$_GET;
}

function posts() {
    return (object)$_POST;
}

function pre($x = 'open') {
    if ($x == 'open') {
        echo '<style>b.string{color: #eb9432;}b.type{color: #7197fd;}b.equal{color: #ffffce;}</style><pre class="debug" style="background-color: #212121; color: white; padding: 16px; overflow: auto;">';
    } else { 
        echo '</pre><script>document.querySelectorAll(`pre.debug`).forEach(pre => {pre.innerHTML = pre.innerHTML.replace(/"(.*?)"/g, `<b class="string">"$1"</b>`).replace(/=&gt;/g, `<b class="equal">=&gt;</b>`).replace(/\[([^\]]*)\]/g, `[<b class="string">$1</b>]`).replace(/(\w+)\((\d+)\)/g, `<b class="type">$1</b>($2)`);});</script>'; 
    }
}

function dump($x) {
    pre('open');
    var_dump($x);
    pre('close');
}

function pdump($x) {
    pre('open');
    print_r($x);
    pre('close');
}

function dd($x) {
    pre('open');
    var_dump($x);
    pre('close'); die;
}

function pd($x) {
    pre('open');
    print_r($x);
    pre('close'); die;
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
    if (isset($_SESSION['csrf_token'])) unset($_SESSION['csrf_token']);
    $_SESSION['csrf_token'] = base64_encode(random_bytes(32));
    return $_SESSION['csrf_token'];
}

function csrf() {
    $csrf = $_SESSION['csrf_token'];
    return '<input type="hidden" name="csrf_token" value="'.$csrf.'">';
}

function csrf_validate($redirect_url) {
    if (!isset($_SESSION['csrf_token'])) {
        Flasher::setFlash("<b>CSRF token empty!</b>", 'warning');
        redirectTo($redirect_url);
    } elseif (!isset($_POST['csrf_token'])) {
        Flasher::setFlash("<b>CSRF token not available!</b>", 'warning');
        redirectTo($redirect_url);
    } elseif (strcmp($_POST['csrf_token'], $_SESSION['csrf_token']) !== 0) {
        Flasher::setFlash("<b>CSRF error</b>. Please try again!", 'warning');
        redirectTo($redirect_url);
    }
}

function stripAndSanitize($string) {
    $string = preg_replace('/[^a-zA-Z0-9\s]/', '', $string); // remove unnecessary characters
    $string = trim($string); // strip leading and trailing
    $string = preg_replace('/\s+/', ' ', $string); // Replace double spaces with singgle space
    return $string;
}