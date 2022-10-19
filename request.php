<?php
function getRequest(): stdClass
{
    $request = new stdClass();
    $request->type = $_SERVER['REQUEST_METHOD'];
    $request->path = $_GET['query'];
    $request->params = [];
    foreach ($_GET as $key => $value) {
        if($key != 'query')
        {
            $request->params[$key] = &$value;
        }
    }
    if($request->type == "GET"){
        return $request;
    }
    else{
        $request->body = json_decode(file_get_contents('php://input'));
    }
    return $request;
}