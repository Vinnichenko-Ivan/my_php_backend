<?php
function route($request)
{
    try{
        if(key_exists('id', $request->getParams()))
        {
            $connect = connect();
            $jwt = new JWT(from_token($request->getToken()));
            if(validate_JWT($connect, $jwt))
            {
                if(get_review_user_id($connect, $request->getParams()['id'] == $jwt->id))
                {
                    delete_review($connect, $request->getParams()['id']);
                }
                else if(get_user_by_id($connect, $jwt->id) == 'moderator')
                {
                    delete_review($connect, $request->getParams()['id']);
                    log_info('moderator' . $jwt->id . 'delete review' . $request->getParams()['id']);
                }
                else if(get_user_by_id($connect, $jwt->id) == 'admin')
                {
                    delete_review($connect, $request->getParams()['id']);
                }
                else
                {
                    throw new ForbiddenException();
                }
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