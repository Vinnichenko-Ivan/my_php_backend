<?php

function route($request)
{
    try{
        $registerDto = new UserRegisterModel($request);
        if(preg_match('/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/i', $registerDto->password) == 1)
        {
            $user = to_user($registerDto);
            add_user(connect(), $user);
        }
        else
        {
            setHTTPStatus(400, 'Bad password');
        }
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }
}