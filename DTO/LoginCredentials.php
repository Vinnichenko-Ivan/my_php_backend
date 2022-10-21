<?php

class LoginCredentials
{
    public string $userName;
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
        if(property_exists($body, 'userName'))
        {
            $this->userName = $body->userName;
        }
        else
        {
            $this->userName = null;
        }
    }

}