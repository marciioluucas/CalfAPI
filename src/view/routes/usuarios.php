<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 10/02/2018
 * Time: 12:39
 */
try {
    $router = new \view\Router();
    $app = $router->getApp();
    $app->get('/','AnimalController:post');
    $router->setApp($app);
} catch (Exception $e) {
}