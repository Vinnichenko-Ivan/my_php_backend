<?php
function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            delete_jwt_by($connect, hash_fire_db($jwt->db_fire));
        }
        else
        {
            setHTTPStatus(401);
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
        setHTTPStatus(503);//TODO нормальные ошибки.
    }
}