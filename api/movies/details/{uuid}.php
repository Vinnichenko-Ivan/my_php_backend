<?php
function route($request)
{
    try{
        $connect = connect();
        $movie = get_movie_by_id($connect, $request->getParams()['id']);
        echo json_encode(to_movie_details_model($movie));
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }

}