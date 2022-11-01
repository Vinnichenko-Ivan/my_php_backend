<?php
function route($request)
{
    try{
        if(key_exists('id', $request->getParams()))
        {
            $connect = connect();
            $movie = get_movie_by_id($connect, $request->getParams()['id']);
            echo json_encode(to_movie_details_model($movie));
        }
        else
        {
            throw new ParamMissingException();
        }
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }

}