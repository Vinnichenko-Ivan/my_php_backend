<?php
function route($request)
{
    try{
        $connect = connect();
        $loginCredentials = new LoginCredentials($request);
        $password_in_db = get_password_by_login($connect, $loginCredentials->username);
        if($password_in_db == null)
        {
            throw new BadLoginCredentialException();
        }
        else if(hash_password($loginCredentials->password) == $password_in_db)
        {
            $jwt = gen_JWT($loginCredentials->username, user_id_by_username($connect, $loginCredentials->username));
            add_jwt_by_username($connect, $jwt->login, $jwt->date_created, hash_fire_db($jwt->db_fire));
            echo json_encode(['token' => to_token($jwt)]);
        }
        else
        {
            throw new BadLoginCredentialException();
        }
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }
}