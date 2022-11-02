<?php 
 function mainRouter($request) 
 { 
 $regexAndPaths = []; 
 $regexAndPaths['/^api\/favorites$/i'] = 'api/favorites.php';
$regexAndPaths['/^api\/account\/login$/i'] = 'api/account/login.php';
$regexAndPaths['/^api\/account\/logout$/i'] = 'api/account/logout.php';
$regexAndPaths['/^api\/account\/profile$/i'] = 'api/account/profile.php';
$regexAndPaths['/^api\/account\/register$/i'] = 'api/account/register.php';
$regexAndPaths['/^api\/admin\/dropLog$/i'] = 'api/admin/dropLog.php';
$regexAndPaths['/^api\/admin\/genRoute$/i'] = 'api/admin/genRoute.php';
$regexAndPaths['/^api\/movies\/\d+$/i'] = 'api/movies/{int}.php';
$regexAndPaths['/^api\/favorites\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})\/add$/i'] = 'api/favorites/{uuid}/add.php';
$regexAndPaths['/^api\/favorites\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})\/delete$/i'] = 'api/favorites/{uuid}/delete.php';
$regexAndPaths['/^api\/movies\/details\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})$/i'] = 'api/movies/details/{uuid}.php';
$regexAndPaths['/^api\/movie\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})\/review\/add$/i'] = 'api/movie/{uuid}/review/add.php';
$regexAndPaths['/^api\/movie\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})\/review\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})\/delete$/i'] = 'api/movie/{uuid}/review/{uuid}/delete.php';
$regexAndPaths['/^api\/movie\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})\/review\/([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})\/edit$/i'] = 'api/movie/{uuid}/review/{uuid}/edit.php';
foreach ($regexAndPaths as $key => $value) {if(preg_match($key, $request->getPath()) == 1) {include_once $value;route($request);return;}}setHTTPStatus(404);}