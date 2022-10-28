<?php
function route($request)
{
    $filmsCount = 3;
    $pagePerPage = 2;
    $maxPage = 2;
    try{
        $connect = connect();
        $page = $request->getParams()['page'];
        if($page > $maxPage)
        {
            setHTTPStatus(404);
            return;
        }
        $movies = get_movies($connect, $pagePerPage * ($page - 1), $pagePerPage);
        $moviesPaged = to_movies_paged_list_model($movies);
        $moviesPaged->pageInfo = new PageInfoModel();
        $moviesPaged->pageInfo->currentPage = $page;
        $moviesPaged->pageInfo->pageCount = $maxPage;
        $moviesPaged->pageInfo->pageSize = count($moviesPaged->movies);
        echo json_encode($moviesPaged);
    }
    catch (Exception $e) {
        echo $e->getMessage();
        setHTTPStatus(503);//TODO нормальные ошибки.
    }
}