<?php
/**
 * Created by PhpStorm.
 * Date: 23.03.2017
 * Time: 11:27
 */
//echo "front controller"."<br>";

//echo "your request:".$_SERVER['REQUEST_URI'];
//Общие настройки
ini_set('display_errors',1);
error_reporting(E_ALL);

//Подключение файлов системы
define('ROOT',dirname(__FILE__));
//echo ROOT;
require_once (ROOT.'/components/Router.php');
require_once (ROOT.'/components/Db.php');

//Подключение базы данных

//Вызов Router

$router = new Router();
$router->run();