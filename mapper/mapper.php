<?php

function to_user(UserRegisterModel $userRegisterModel):User{
    $user = new User();
    $user->setName($userRegisterModel->name);
    $user->setBirthDate($userRegisterModel->birthDate);
    $user->setEmail($userRegisterModel->email);
    $user->setGender($userRegisterModel->gender == 1 ? Gender::Male : Gender::Female);
    $user->setPassword($userRegisterModel->password);
    $user->setUsername($userRegisterModel->userName);
    return $user;
}

function change_user_info(ProfileModel $profileModel, User $user){
    $user->setName($profileModel->nickName);//id изменять не буду.
    $user->setBirthDate($profileModel->birthDate);
    $user->setEmail($profileModel->email);
    $user->setGender($profileModel->gender == 1 ? Gender::Male : Gender::Female);
    $user->setAvatarlink($profileModel->avatarLink);
    $user->setUsername($profileModel->name);
    return $user;
}

function to_user_profile(User $user):ProfileModel{
    $profile = new ProfileModel();
    $profile->birthDate = $user->getBirthDate();
    $profile->email = $user->getEmail();
    $profile->gender = $user->getGender() == Gender::Male?1:0;
    $profile->name = $user->getName();
    $profile->avatarLink = $user->getAvatarLink();
    $profile->id = $user->getId();
    $profile->nickName = $user->getUsername();
    return $profile;
}



function to_genre_model(Genre $genre):GenreModel{
    $genreModel = new GenreModel();
    $genreModel->id = $genre->getId();
    $genreModel->name = $genre->getName();
    return $genreModel;
}

function to_array_genre_model(array $genres):array
{
    $genreModels = [];
    foreach ($genres as $genre)
    {
        $genreModels[] = to_genre_model($genre);
    }
    return $genreModels;
}

function to_review_model(Review $review):ReviewModel{
    $reviewModel = new ReviewModel();
    $reviewModel->id = $review->getId();
    $reviewModel->createDateTime = $review->getCreateDateTime();
    $reviewModel->rating = $review->getRating();
    $reviewModel->reviewText = $review->getReviewText();
    $reviewModel->isAnonymous = $review->isAnonymous();
    if($reviewModel->isAnonymous)
    {
        $reviewModel->author = null;
    }
    else
    {
        $reviewModel->author = $review->getId();
    }
    return $reviewModel;//TODO доделать авторство
}

function to_review_short_model(Review $review):ReviewShortModel{
    $reviewModel = new ReviewShortModel();
    $reviewModel->id = $review->getId();
    $reviewModel->rating = $review->getRating();
    return $reviewModel;
}

function to_array_review_model(array $reviews):array{
    $reviewModels = [];
    foreach ($reviews as $review)
    {
        $reviewModels[] = to_review_model($review);
    }
    return $reviewModels;
}

function to_array_review_short_model(array $reviews):array{
    $reviewModels = [];
    foreach ($reviews as $review)
    {
        $reviewModels[] = to_review_short_model($review);
    }
    return $reviewModels;
}

function to_movies_element_model(Movie $movie):MovieElementModel{
    $movieElementModel = new MovieElementModel();
    $movieElementModel->id = $movie->getId();
    $movieElementModel->country = $movie->getCountry();
    $movieElementModel->genres = to_array_genre_model($movie->getGenres());
    $movieElementModel->poster = $movie->getPoster();
    $movieElementModel->reviews = to_array_review_short_model($movie->getReviews());
    $movieElementModel->year = $movie->getYear();
    $movieElementModel->name = $movie->getName();
    return $movieElementModel;
}

function review_from_ReviewModifyModel(ReviewModifyModel $reviewModifyModel): Review
{
    $review = new Review();
    $review->setReviewText($reviewModifyModel->reviewText);
    $review->setIsAnonymous($reviewModifyModel->isAnonymous);
    $review->setRating($reviewModifyModel->rating);
    return $review;
}

function to_array_movies_element_model(array $movies):array{
    $movies_element = [];
    foreach ($movies as $movie)
    {
        $movies_element[] = to_movies_element_model($movie);
    }
    return $movies_element;
}

function to_movies_list_model(array $movies):MoviesListModel{
    $moviesListModel = new MoviesListModel();
    $moviesListModel->movies = to_array_movies_element_model($movies);
    return $moviesListModel;
}

function to_movies_paged_list_model(array $movies):MoviesPagedListModel{
    $moviesPagedListModel = new MoviesPagedListModel();
    $moviesPagedListModel->movies = to_array_movies_element_model($movies);
    $moviesPagedListModel->pageInfo = new PageInfoModel();//TODO работа с пагинацией
    return $moviesPagedListModel;
}

function to_movie_details_model(Movie $movie):MovieDetailsModel
{
    $movieDetailsModel = new MovieDetailsModel();
    $movieDetailsModel->id = $movie->getId();
    $movieDetailsModel->genres = to_array_genre_model($movie->getGenres());
    $movieDetailsModel->name = $movie->getName();
    $movieDetailsModel->country = $movie->getCountry();
    $movieDetailsModel->year = $movie->getYear();
    $movieDetailsModel->reviews = to_array_review_model($movie->getReviews());
    $movieDetailsModel->poster = $movie->getPoster();
    $movieDetailsModel->ageLimit = $movie->getAgeLimit();
    $movieDetailsModel->budget = $movie->getBudget();
    $movieDetailsModel->description = $movie->getDescription();
    $movieDetailsModel->director = $movie->getDirector();
    $movieDetailsModel->fees = $movie->getFees();
    $movieDetailsModel->tagline = $movie->getTagline();
    $movieDetailsModel->time = $movie->getTime();
    return $movieDetailsModel;
}
