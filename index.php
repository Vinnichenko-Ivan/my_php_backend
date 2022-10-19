<?php
include_once 'router.php';
include_once 'request.php';
include_once 'utils/headers.php';
header('Content-Type: application/json');
echo mainRouter(getRequest());
