<?php
function route($request)
{
    try{
        if(is_uuid_param($request->getSegmentPath()[4]))
        {
            $params = [];
            $params['id'] = $request->getSegmentPath()[4];

            $connect = connect();
            $jwt = new JWT(from_token($request->getToken()));
            if(validate_JWT($connect, $jwt))
            {
                $user_id = get_review_user_id($connect, $params['id']);
                if($user_id == null)
                {
                    throw new NotFoundException();
                }

                if($user_id == $jwt->id)
                {
                    delete_review($connect, $params['id']);
                }
                else if(get_user_role($connect, $jwt->id) == 'moderator')
                {
                    delete_review($connect, $params['id']);
                    log_info('moderator' . $jwt->id . 'delete review' . $params['id']);
                }
                else if(get_user_role($connect, $jwt->id) == 'admin')
                {
                    delete_review($connect, $params['id']);
                }
                else
                {
                    throw new ForbiddenException();
                }
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