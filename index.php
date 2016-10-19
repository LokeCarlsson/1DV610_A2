<?php

session_start();

require_once('controller/RoutingController.php');

error_reporting(E_ALL);
ini_set('display_errors', '1');

$rc = new RoutingController();
$rc->init();
