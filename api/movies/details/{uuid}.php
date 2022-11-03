<?php
function route($request)
{
    try{
        if(is_uuid_param($request->getSegmentPath()[3]))
        {
            $params = [];
            $params['id'] = $request->getSegmentPath()[3];
            $connect = connect();
            $movie = get_movie_by_id($connect, $params['id']);
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