<?php
function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            if(key_exists('id', $request->getParams()))
            {
                add_to_favorite($connect, $jwt->id, $request->getParams()['id']);
            }
            else
            {
                throw new ParamMissingException();
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