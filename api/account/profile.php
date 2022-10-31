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
            elseif ($request->getType() == 'PUT')
            {
                $profile = new ProfileModel($request);
                $user = get_user_by_id($connect, $jwt->id);
                change_user_info($profile, $user);
                edit_user($connect, $user);
            }
        }
        else
        {
            setHTTPStatus(401);
        }
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }
}