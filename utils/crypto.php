<?php

function gen_JWT(string $login) : JWT
{
    $jwt = new JWT();
    $jwt->login = $login;
    $jwt->db_fire = generateRandomString(100);
    $jwt->date_created = date("Y-m-d H:i:s");
    $jwt->signature = my_crypt(my_signature());
    return $jwt;
}

function to_token(JWT $jwt):string{
    return base64_encode(json_encode($jwt));
}

function from_token(string $token){
    return json_decode(base64_decode($token));
}

function my_key(): string{
    return 'AABABABAB123123123BABABA321123BABASDASDADFDSSSADS43113415FSAAS';
}

function my_signature(): string{
    return 'ServerCV01.0';
}

function type_crypto(): string{
    return 'aes-256-cbc-hmac-sha256';
}

function validate_JWT($connect, JWT $jwt):bool{
    if(my_encrypt($jwt->signature) != my_signature())
    {
        return false;
    }
    if(username_by_jwt($connect, hash_fire_db($jwt->db_fire)) != $jwt->login)
    {
        return false;
    }//TODO time
    return true;
}

function hash_password(string $password):string{
    return $password;//TODO hash("sha256",$user->getPassword())
}

function hash_fire_db(string $fire_db):string{
    return hash("sha256", $fire_db);//TODO hash("sha256",$user->getPassword())
}

function my_crypt(string $info):string{
    return openssl_encrypt($info, type_crypto(), my_key());
}

function my_encrypt(string $info):string{
    return openssl_decrypt($info, type_crypto(), my_key());
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}