<?php

class JWT
{
    public string $login;
    public string $date_created;
    public string $db_fire;
    public string $signature;

    public function __construct(array $arr = null)
    {
        if ($arr != null)
        {
            $this->login = $arr['login'];
            $this->date_created = $arr['date_created'];
            $this->db_fire = $arr['db_fire'];
            $this->signature = $arr['signature'];
        }
    }

}