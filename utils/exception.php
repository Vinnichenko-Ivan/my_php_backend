<?php

function simpleExceptionHandler(Exception $e): void
{
    if ($e instanceof BadDTOCastException) {
        setHTTPStatus(400, 'Bad body');
        log_warning('Bad body');
    }
    else if ($e instanceof ParamMissingException) {
        setHTTPStatus(400, 'Bad params');
        log_warning('Bad param');
    }
    else if ($e instanceof UnauthorizedException)
    {
        setHTTPStatus(401, 'JWT Unauthorized');
        log_warning('Unauthorized');
    }
    else if ($e instanceof BadLoginCredentialException)
    {
        setHTTPStatus(401, 'Bad Credential/ login or password incorrect');
        log_warning('Bad Credential');
    }
    else if($e instanceof NotFoundException)
    {
        setHTTPStatus(404);
    }
    else if($e instanceof WeakPasswordException)
    {
        setHTTPStatus(400, 'weak password');
    }
    else if($e instanceof DBQueryException)
    {
        setHTTPStatus(503);
    }
    else if($e instanceof BadEmailException)
    {
        setHTTPStatus(400, 'bad Email');
    }
    else if($e instanceof BadUserNameException)
    {
        setHTTPStatus(400, 'bad userName');
    }
    else if($e instanceof UserExistException)
    {
        setHTTPStatus(400, 'user exits');
    }
    else if($e instanceof NonUniqueEmailException)
    {
        setHTTPStatus(400, 'email exits');
    }
    else if($e instanceof ForbiddenException)
    {
        setHTTPStatus(403);
    }
    else
    {
        setHTTPStatus(503);
    }
}