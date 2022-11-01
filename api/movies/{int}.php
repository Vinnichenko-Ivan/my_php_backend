<?php
function route($request)
{
    $filmsCount = 3;
    $moviePerPage = 2;
    $maxPage = 2;
    try{

        $connect = connect();
        $filmsCount = count_of_films($connect);
        $maxPage = ceil((float)$filmsCount / (float)$moviePerPage);

        $page = $request->getParams()['page'];
        if($page > $maxPage)
        {
            setHTTPStatus(404);
            return;
        }
        $movies = get_movies($connect, $moviePerPage * ($page - 1), $moviePerPage);
        $moviesPaged = to_movies_paged_list_model($movies);
        $moviesPaged->pageInfo = new PageInfoModel();
        $moviesPaged->pageInfo->currentPage = $page;
        $moviesPaged->pageInfo->pageCount = $maxPage;
        $moviesPaged->pageInfo->pageSize = count($moviesPaged->movies);
        echo json_encode($moviesPaged);
    }
    catch (Exception $e) {
        simpleExceptionHandler($e);
    }
}