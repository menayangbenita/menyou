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

// Set the timezone
date_default_timezone_set(Get::model('Preferences')->getPreference('Timezone'));