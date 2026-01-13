<?php

require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/database.php'; 
require_once __DIR__ . '/core/App.php';
require_once __DIR__ . '/core/Controller.php';
if(file_exists(__DIR__ . '/core/Flasher.php')) {
    require_once __DIR__ . '/core/Flasher.php';
}