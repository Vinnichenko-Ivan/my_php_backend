<?php

function route($request)
{
    try{
        $registerDto = new UserRegisterModel($request);
        if(preg_match('/(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z!@#$%^&*]{6,}/i', $registerDto->password) == 1)
        {
            if(preg_match('/^[a-z0-9_-]{3,16}$/i', $registerDto->userName))
            {
                if(preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', $registerDto->email))
                {
                    $user = to_user($registerDto);
                    add_user(connect(), $user);
                }
                else
                {
                    throw new BadEmailException();
                }
            }
            else
            {
                throw new BadUserNameException();
            }
        }
        else
        {
            throw new WeakPasswordException();
        }
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }
}