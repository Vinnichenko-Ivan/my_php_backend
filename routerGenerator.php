<?php

function generate($prefix = 'api', $generateFile = 'router.php'){
    $allPHPFiles = [];
    $pathQueue = [];
    $pathQueue[1] = $prefix;
    $counter = 1;
    $counterPHP = 1;
    $tempCounter = 2;
    while(array_key_exists($counter, $pathQueue))
    {
        foreach (scandir($pathQueue[$counter]) as $temp){
            if($temp == '.' or $temp == '..')
            {
                continue;
            }
            if(!(preg_match('/.*\..*/i', $temp) == 1)){
                $pathQueue[$tempCounter] = $pathQueue[$counter] . '/' . $temp;
                $tempCounter += 1;
            }
            else if((preg_match('/.+\.php/i', $temp) == 1))
            {
                $allPHPFiles[$counterPHP] = $pathQueue[$counter] . '/' . $temp;
                $counterPHP += 1;
            }
        }
        $counter += 1;
    }

//    echo json_encode($allPHPFiles);
    $allRegAndPHP = [];
    foreach ($allPHPFiles as $key => $value)
    {
        $tempReg = str_replace("{uuid}", "([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})", $value);
        $tempReg = str_replace("{int}", "\d+", $tempReg);
        $tempReg = str_replace(".php", "", $tempReg);
        $tempReg = str_replace("/", "\/", $tempReg);
        $allRegAndPHP["/^" . $tempReg . "$/i"] = $value;
    }

    $text = '<?php' . " \n ";
    $text = $text . 'function mainRouter($request)' . " \n ";
    $text = $text . '{' . " \n ";
    $text = $text . '$regexAndPaths = [];' . " \n ";

    foreach ($allRegAndPHP as $key => $value)
    {
        $text = $text . '$regexAndPaths[\'' . $key . '\'] = \'' . $value . '\';' . ' \n ';
    }

    $text = $text . 'foreach ($regexAndPaths as $key => $value)' . " \n ";
    $text = $text . '{' . " \n ";
    $text = $text . 'if(preg_match($key, $request->path) == 1)' . " \n ";
    $text = $text . '{' . " \n ";
    $text = $text . 'include_once $value;' . " \n ";
    $text = $text . 'route($request);' . " \n ";
    $text = $text . 'return;' . " \n ";
    $text = $text . '}' . " \n ";
    $text = $text . '}' . " \n ";
    $text = $text . 'setHTTPStatus(404);' . " \n ";
    $text = $text . '}' . " \n ";

    file_put_contents('router.php', '<?php');
    echo $text;
}
generate();


//function mainRouter($request)
//{
//    $regexAndPaths = [];
//
//    include_once $regexAndPaths[$request->path];
//    route($request);
//}