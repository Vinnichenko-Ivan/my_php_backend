<?php
function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            $movies = get_favorites_by_user_id($connect, $jwt->id);
            echo json_encode(to_movies_list_model($movies));
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