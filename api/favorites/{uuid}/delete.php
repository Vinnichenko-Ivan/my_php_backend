<?php
function route($request)
{
    try{
        if(key_exists('id', $request->getParams()))
        {
            $connect = connect();
            $jwt = new JWT(from_token($request->getToken()));
            if(validate_JWT($connect, $jwt))
            {
                delete_to_favorite($connect, $jwt->id, $request->getParams()['id']);
            }
            else
            {
                setHTTPStatus(401);
            }
        }
        else
        {
            throw new ParamMissingException();
        }
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }

}