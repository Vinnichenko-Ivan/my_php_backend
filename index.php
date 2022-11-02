<?php
include_once 'routerGenerator.php';
include_once 'request.php';
include_once 'utils/headers.php';
include_once 'utils/exception.php';
include_once 'utils/logger.php';
include_once 'utils/crypto.php';
include_once 'utils/database/DBRequest.php';
include_once 'mapper/mapper.php';


foreach (glob("utils/exception/*.php") as $filename)
{
    include_once $filename;
}

foreach (glob("DTO/*.php") as $filename)
{
    include_once $filename;
}

foreach (glob("model/*.php") as $filename)
{
    include_once $filename;
}

include_once 'router.php';

header('Content-Type: application/json');
mainRouter(getRequest());


