<?php
include_once 'request.php';
header('Content-Type: application/json');
echo json_encode(getRequest());
echo json_encode($_GET);
echo json_encode($_SERVER);