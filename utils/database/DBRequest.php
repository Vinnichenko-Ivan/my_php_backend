<?php

function connect(): \PgSql\Connection
{
    $connect = pg_connect("host=127.0.0.1 port=5432 dbname=films user=filmuser password=filmsuser");
    if (pg_connection_status($connect) !== PGSQL_CONNECTION_OK) {
        log_err('DB connection error');
    }
    return $connect;
}

function query_to_db($connect, $text)
{
    return pg_fetch_object(pg_query($connect,'SELECT * FROM jwt_tokens'), 3);
}

function add_user($connect, UserRegisterModel $userRegisterModel)
{
    $query = 'INSERT INTO users(name, birth_date, username, email, password, gender, user_role) VALUES ($1, $2, $3, $4, $5, $6, $7);';

    $params = [];
    $params[1] = $userRegisterModel->name;
    $params[2] = $userRegisterModel->birthDate;
    $params[3] = $userRegisterModel->userName;
    $params[4] = $userRegisterModel->email;
    $params[5] = $userRegisterModel->password;
    $params[6] = $userRegisterModel->gender === 1 ? 'male' : 'female';
    $params[7] = 'user';
    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on add user. ' . pg_last_error($connect));
    }
}