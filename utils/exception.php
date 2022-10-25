<?php
function DTOCastException(): Exception
{
    return new Exception('DTO cast error.');
}

function DBErrorException(): Exception
{
    return new Exception('DBError.');
}
