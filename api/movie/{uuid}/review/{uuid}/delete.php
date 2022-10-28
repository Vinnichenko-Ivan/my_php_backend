<?php
function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            delete_review($connect, $request->getParams()['id']);//TODO возможно стоит по id фильма
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