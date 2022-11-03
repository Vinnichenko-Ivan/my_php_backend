<?php
function route($request)
{
    $filmsCount = 3;
    $moviePerPage = 5;
    $maxPage = 2;

    try{
        if(is_int_param($request->getSegmentPath()[2]))
        {
            $params = [];
            $params['page'] =$request->getSegmentPath()[2];
            $connect = connect();
            $filmsCount = count_of_films($connect);
            $maxPage = ceil((float)$filmsCount / (float)$moviePerPage);
            $page = $params['page'];
            if($page > $maxPage)
            {
                throw new NotFoundException();
            }
            $movies = get_movies($connect, $moviePerPage * ($page - 1), $moviePerPage);
            $moviesPaged = to_movies_paged_list_model($movies);
            $moviesPaged->pageInfo = new PageInfoModel();
            $moviesPaged->pageInfo->currentPage = $page;
            $moviesPaged->pageInfo->pageCount = $maxPage;
            $moviesPaged->pageInfo->pageSize = count($moviesPaged->movies);
            echo json_encode($moviesPaged);
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