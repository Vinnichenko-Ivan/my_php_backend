<?php

class UserRegisterModel
{
    public string $userName;
    public string $name;
    public string $password;
    public string $email;
    public string $birthDate;
    public int|null $gender;

    /**
     * @throws Exception
     */

    public function __construct(Request $request = null)
    {
        if(!is_null($request))
        {
            $body = $request->getBody();
            $compulsory = ['userName', 'name', 'password', 'email'];
            $nullable = [];
            foreach ($compulsory as $temp)
            {
                if(!property_exists($body, $temp))
                {
                    throw new BadDTOCastException();
                }
            }

            $this->userName = $body->userName;
            $this->name = $body->name;
            $this->password = $body->password;
            $this->email = $body->email;

            if(!property_exists($body, 'birthDate'))
            {
                $this->birthDate = null;
            }
            else
            {
                $this->birthDate = $body->birthDate;
            }

            if(!property_exists($body, 'gender'))
            {
                $this->gender = null;
            }
            else
            {
                $this->gender = $body->gender;
            }
        }
    }
}