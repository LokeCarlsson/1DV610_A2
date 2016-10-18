<?php

require_once('controller/RoutingController.php');

session_start();

$start = new Routing();
$start->init();
