<?php
function route($request)
{
    try{
        if(is_uuid_param($request->getSegmentPath()[2]))
        {
            $params = [];
            $params['movieId'] = $request->getSegmentPath()[2];

            $connect = connect();
            $jwt = new JWT(from_token($request->getToken()));
            if(validate_JWT($connect, $jwt))
            {
                $reviewDTO = new ReviewModifyModel($request);
                $review = review_from_ReviewModifyModel($reviewDTO);
                $review->setCreateDateTime(date("Y-m-d H:i:s"));
                $review->setUserId($jwt->id);
                $review->setMovieId($params['movieId']);
                add_review($connect, $review);
            }
            else
            {
                throw new UnauthorizedException();
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