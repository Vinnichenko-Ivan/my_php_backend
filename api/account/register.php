<?php

function route($request)
{
    try{
        $registerDto = new UserRegisterModel($request);
        $user = to_user($registerDto);
        add_user(connect(), $user);
    }
    catch (Exception $e) {
        setHTTPStatus(503);//TODO нормальные ошибки.
    }
}