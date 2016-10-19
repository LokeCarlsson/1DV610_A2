<?php

require_once('controller/RoutingController.php');

session_start();

$start = new RoutingController();
$start->init();
