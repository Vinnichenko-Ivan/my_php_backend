<?php
function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            if($request->getType() == 'GET')
            {
                delete_to_favorite($connect, $jwt->id, $request->getParams()['id']);
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