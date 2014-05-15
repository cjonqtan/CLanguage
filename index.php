<?php 

include __DIR__ . "/src/Language/CLanguage.php";

session_name('Test1i0329210');
session_start();

$conf = require __DIR__ . '/config/config_language.php';
$language = new \Foiki\Language\CLanguage($conf);







