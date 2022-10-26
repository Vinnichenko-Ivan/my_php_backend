<?php
function route($request)
{
    try{
        $connect = connect();
        $loginCredentials = new LoginCredentials($request);
        $password_in_db = get_password_by_login($connect, $loginCredentials->username);
        if(hash_password($loginCredentials->password) == $password_in_db)
        {
            $jwt = gen_JWT($loginCredentials->username);
            add_jwt_by_username($connect, $jwt->login, $jwt->date_created, $jwt->db_fire);
            echo json_encode(['token' => to_token($jwt)]);
        }
        else
        {
            setHTTPStatus(400, "Password or login error");
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
        setHTTPStatus(503);//TODO нормальные ошибки.
    }
}