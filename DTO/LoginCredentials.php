<?php

class LoginCredentials
{
    public string $username;
    public string $password;

    /**
     * @throws BadDTOCastException
     */
    public function __construct(Request $request)
    {
        $body = $request->getBody();
        if($body == null)
        {
            throw new BadDTOCastException();
        }

        if(property_exists($body, 'password'))
        {
            $this->password = $body->password;
        }
        else
        {
            throw new BadDTOCastException();
        }
        if(property_exists($body, 'username'))
        {
            $this->username = $body->username;
        }
        else
        {
            throw new BadDTOCastException();
        }
    }

}