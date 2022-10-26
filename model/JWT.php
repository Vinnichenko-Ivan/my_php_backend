<?php

class JWT
{
    public string $login;
    public string $date_created;
    public string $db_fire;
    public string $signature;

    public function __construct(object $obj = null)
    {
        if ($obj != null)
        {
            $this->login = $obj->login;
            $this->date_created = $obj->date_created;
            $this->db_fire = $obj->db_fire;
            $this->signature = $obj->signature;
        }
    }

}