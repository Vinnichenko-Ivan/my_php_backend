<?php
function route($request)
{
    try{
        if(key_exists('movieId', $request->getParams()))
        {
            $connect = connect();
            $jwt = new JWT(from_token($request->getToken()));
            if(validate_JWT($connect, $jwt))
            {
                $reviewModifyModel = new ReviewModifyModel($request);
                $review = review_from_ReviewModifyModel($reviewModifyModel);
                $review->setCreateDateTime(date("Y-m-d H:i:s"));
                $review->setUserId($jwt->id);
                $review->setMovieId($request->getParams()['movieId']);//TODO возможно стоит по id
                edit_review($connect, $review);
            }
            else
            {
                setHTTPStatus(401);
            }
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