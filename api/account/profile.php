<?php
function route(Request $request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            if($request->getType() == 'GET')
            {
                $user = get_user_by_id($connect, $jwt->id);
                $profile = to_user_profile($user);
                echo json_encode($profile);
            }
        }
        else
        {
            setHTTPStatus(401);
        }
    }
    catch (Exception $e) {
        echo $e->getMessage();
        setHTTPStatus(503);//TODO нормальные ошибки.
    }
}