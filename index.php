<?php
//Front controller

// Загальні настройки
ini_set('display errors', 1);
error_reporting(E_ALL);

session_start();
//Підключення файлів системи
define('FT', '/FT/');
define('ROOT', dirname(__FILE__));
define('SHOWRELAX_BY_DEFAULT', 10);
define('SHOWPOSTER_BY_DEFAULT', 15);
define('SHOWPOSTER_BY_DEFAULT_EDIT', 30);
define('SHOWCOMMENT_BY_DEFAULT', 25);
define('SHOWNEWS_BY_DEFAULT', 15);
define('SHOWNEWS_BY_DEFAULT_EDIT', 30);
define('SHOWVIDEO_BY_DEFAULT', 6);
define('SHOWVIDEO_BY_DEFAULT_ADMIN', 25);
define('SHOWFA_BY_DEFAULT', 6);
define('GOMGAL', " Гомін Галичини");
define('NO_PHOTO', '/posterFoto/gg.webp');
define('SLMAIL', "sl147@ukr.net");
define('BanMAIL', "banevska@ukr.net");

require_once (ROOT."/components/Autoload.php");
require_once (ROOT."/components/Router.php");
require_once (ROOT."/components/Db.php");

$router = new Router();
$router->run();