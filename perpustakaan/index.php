<?php

if( !session_id() ) session_start(); // Menjalankan session untuk Login nanti

require_once 'app/init.php';

$app = new App(); // Jalankan Routing