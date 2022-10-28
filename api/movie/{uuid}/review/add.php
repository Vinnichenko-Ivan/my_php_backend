<?php
function route($request)
{
    try{
        $connect = connect();
        $jwt = new JWT(from_token($request->getToken()));
        if(validate_JWT($connect, $jwt))
        {
            $reviewDTO = new ReviewModifyModel($request);
            $review = review_from_ReviewModifyModel($reviewDTO);
            $review->setCreateDateTime(date("Y-m-d H:i:s"));
            $review->setUserId($jwt->id);
            $review->setMovieId($request->getParams()['movieId']);
            add_review($connect, $review);
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