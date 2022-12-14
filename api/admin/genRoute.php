<?php
include_once 'routerGenerator.php';

function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            if(get_user_role($connect, $jwt->id) == 'admin')
            {
                generate();
            }
        }
        else
        {
            setHTTPStatus(401);
        }
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }
}