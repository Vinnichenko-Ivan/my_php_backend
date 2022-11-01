<?php
function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            if(key_exists('global', $request->getParams()))
            {
                delete_all_jwt_by_username($connect, $jwt->login);
            }
            else
            {
                delete_jwt_by($connect, hash_fire_db($jwt->db_fire));
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