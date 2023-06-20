<?php
require_once 'inc/database.php';
require_once 'inc/function.php';

session_start();
setlocale(LC_TIME, "fr_FR.UTF-8");


define('BASE', $_SERVER['DOCUMENT_ROOT'] . '/PHP/airbnb/UPLOADS/');

define('URL', 'http://localhost/PHP/airbnb/UPLOADS/');