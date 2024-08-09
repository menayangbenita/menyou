<?php 

require_once '/app/init.php';

if ($argc > 1) {
    // $argv[0] contains the name of the script itself
    // So, we start iterating from index 1
    for ($i = 1; $i < $argc; $i++) {
        echo "Argument $i: " . $argv[$i] . "\n";
    }
} else {
    echo "No arguments passed.\n";
}