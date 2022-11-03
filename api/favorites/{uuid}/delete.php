<?php
function route($request)
{
    try{
        if(is_uuid_param($request->getSegmentPath()[2]))
        {
            $params = [];
            $params['id'] = $request->getSegmentPath()[2];
            $connect = connect();
            $jwt = new JWT(from_token($request->getToken()));
            if(validate_JWT($connect, $jwt))
            {
                delete_to_favorite($connect, $jwt->id, $params['id']);
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