<?php
$URL = $_SERVER['SERVER_NAME'];

define('DS', DIRECTORY_SEPARATOR);
define('PUERTO', $_SERVER["SERVER_PORT"]);
//if( PUERTO != "") $URL.=':'.PUERTO.'/';

$ssl   = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on';
$proto = strtolower($_SERVER['SERVER_PROTOCOL']);
$proto = substr($proto, 0, strpos($proto, '/')) . ($ssl ? 's' : '' );

define('urlBase', $proto.'://'.$URL.'/');//devuelve http://localhost:81/

$rutaBase = substr(dirname(__DIR__), 0, -3);//devuelve /%ruta%/icosalud_web/
define('rutaBase', $rutaBase);
$rutaAbsoluta = "/home/somos19/bernardino.laboratoriorvo.com";
define('rutaAbsoluta', $rutaAbsoluta);