<?php

class LoginCredentials
{
    public string $username;
    public string $password;

    public function __construct(Request $request)
    {
        $body = $request->getBody();
        if(property_exists($body, 'password'))
        {
            $this->password = $body->password;
        }
        else
        {
            $this->password = null;
        }
        if(property_exists($body, 'username'))
        {
            $this->username = $body->username;
        }
        else
        {
            $this->username = null;
        }
    }

}