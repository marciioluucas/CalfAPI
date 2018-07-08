<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 11/02/2018
 * Time: 23:12
 */
require 'vendor/autoload.php';
require 'src/util/Config.php';

use src\Utils\Api;


$api = new Api();
$api->getDatabase();
$api->groupRoutes();
try {
    $api->runApp();
} catch (Exception $e) {
}