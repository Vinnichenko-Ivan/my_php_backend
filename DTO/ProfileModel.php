<?php

class ProfileModel
{
    public string $id;
    public string $nickName;
    public string $email;
    public string|null $avatarLink;
    public string $name;
    public string $birthDate;
    public int|null $gender;

    /**
     * @throws BadDTOCastException
     */
    public function __construct(Request $request = null)
    {
        if($request != null)
        {
            $body = $request->getBody();
            $compulsory = ['name', 'email', 'birthDate', 'id'];
            $nullable = [];
            foreach ($compulsory as $temp)
            {
                if(!property_exists($body, $temp))
                {
                    throw new BadDTOCastException();
                }
            }

            $this->name = $body->name;
            $this->email = $body->email;
            $this->birthDate = $body->birthDate;
            $this->id = $body->id;

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
                $this->gender = null;
            }
            else
            {
                $this->gender = $body->gender;
            }
        }
    }

}