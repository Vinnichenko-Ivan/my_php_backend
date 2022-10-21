<?php

class ProfileModel
{
    public string $id;
    public string $nickName;
    public string $email;
    public string $avatarLink;
    public string $name;
    public string $birthDate;
    public int $gender;

    public function __construct(Request $request)
    {
        $body = $request->getBody();
        $compulsory = ['name', 'email', 'birthDate'];
        $nullable = [];
        foreach ($compulsory as $temp)
        {
            if(!property_exists($body, $temp))
            {
                throw DTOCastException();
            }
        }

        $this->name = $body->name;
        $this->email = $body->email;

        if(!property_exists($body, 'birthDate'))
        {
            $this->birthDate = null;
        }
        else
        {
            $this->birthDate = $body->birthDate;
        }
        if(!property_exists($body, 'id'))
        {
            $this->id = null;
        }
        else
        {
            $this->id = $body->id;
        }
        if(!property_exists($body, 'nickName'))
        {
            $this->nickName = null;
        }
        else
        {
            $this->nickName = $body->nickName;
        }
        if(!property_exists($body, 'avatarLink'))
        {
            $this->avatarLink = null;
        }
        else
        {
            $this->avatarLink = $body->avatarLink;
        }
        if(!property_exists($body, 'gender'))
        {
            $this->gender = -1;
        }
        else
        {
            $this->gender = $body->gender;
        }
    }

}