<?php

function connect(): \PgSql\Connection
{
    $connect = pg_connect("host=127.0.0.1 port=5432 dbname=films user=filmuser password=filmsuser");
    if (pg_connection_status($connect) !== PGSQL_CONNECTION_OK) {
        log_err('DB connection error');
    }
    return $connect;
}

function result_to_array_obj(\PgSql\Result $result): array
{
    $arr = [];
    while ($data = pg_fetch_object($result))
    {
        $arr[] = $data;
    }
    return $arr;
}

function get_password_by_login($connect, string $username):string
{
    $query = 'SELECT password FROM users WHERE username = $1';

    $params = [];
    $params[1] = $username;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
    return result_to_array_obj($result)[0]->password;
}

function add_user($connect, User $user)
{
    $query = 'INSERT INTO users(name, birth_date, username, email, password, gender, user_role) VALUES ($1, $2, $3, $4, $5, $6, $7);';

    $params = [];
    $params[1] = $user->getName();
    $params[2] = $user->getBirthDate();
    $params[3] = $user->getUsername();
    $params[4] = $user->getEmail();
    $params[5] = hash_password($user->getPassword());
    $params[6] = $user->getGender() == 1 ? 'male' : 'female';
    $params[7] = 'user';
    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on add user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
}

function get_genres_by_movie_id($connect, string $movie_id):array//Genre
{
    $query = 'SELECT * FROM genre WHERE genre_id IN (SELECT genre_id FROM movie_genres WHERE movie_id = $1);';

    $params = [];
    $params[1] = $movie_id;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on get genres. ' . pg_last_error($connect));
    }

    $arr = result_to_array_obj($result);
    $genres = [];
    foreach($arr as $temp){
        $genre = new Genre();
        $genre->setName($temp->name);
        $genre->setId($temp->genre_id);
        $genres[] = $genre;
    }
    return $genres;
}

function get_review_by_movie_id($connect, string $movie_id):array//Genre
{
    $query = 'SELECT * FROM review WHERE movie_id = $1;';

    $params = [];
    $params[1] = $movie_id;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on get review. ' . pg_last_error($connect));
    }

    $arr = result_to_array_obj($result);
    $reviews = [];
    foreach($arr as $temp){
        $review = new Review();
        $review->setId($temp->review_id);
        $review->setCreateDateTime($temp->create_date_time);
        $review->setIsAnonymous($temp->is_anonymous);
        $review->setMovieId($temp->movie_id);
        $review->setRating($temp->rating);
        $review->setReviewText($temp->review_text);
        $review->setUserId($temp->user_id);
        $reviews[] = $review;
    }
    return $reviews;
}

function get_favorites_by_user_id($connect, string $user_id):array//Movie
{
    $query = 'SELECT * FROM movie WHERE movie_id IN (SELECT movie_id FROM favorites WHERE user_id = $1);';

    $params = [];
    $params[1] = $user_id;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on get favorites. ' . pg_last_error($connect));
    }

    $arr = result_to_array_obj($result);
    $movies = [];
    foreach($arr as $temp){
        $movies[] = movie_from_sql($connect, $temp);
    }
    return $movies;
}

function add_to_favorite($connect, string $user_id, string $movie_id):void
{
    $query = 'INSERT INTO favorites(user_id, movie_id) VALUES ($1, $2);';

    $params = [];
    $params[1] = $user_id;
    $params[2] = $movie_id;
    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on add favorites. ' . pg_last_error($connect));
    }
}

function delete_to_favorite($connect, string $user_id, string $movie_id):void
{
    $query = 'DELETE FROM favorites WHERE user_id = $1 AND movie_id = $2;';

    $params = [];
    $params[1] = $user_id;
    $params[2] = $movie_id;
    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on delete favorites. ' . pg_last_error($connect));
    }
}

function get_movies($connect, int $offset = 0,  int $limit = 5)
{
    $query = 'SELECT * FROM movie ORDER BY movie_id LIMIT $1 OFFSET $2;';

    $params = [];
    $params[1] = $limit;
    $params[2] = $offset;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on get movies. ' . pg_last_error($connect));
    }

    $arr = result_to_array_obj($result);
    $movies = [];
    foreach($arr as $temp){
        $movies[] = movie_from_sql($connect, $temp);
    }
    return $movies;
}

function get_movie_by_id($connect, string $movie_id):Movie
{
    $query = 'SELECT * FROM movie WHERE movie_id = $1;';

    $params = [];
    $params[1] = $movie_id;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on get movie. ' . pg_last_error($connect));
    }

    $arr = result_to_array_obj($result);
    return movie_from_sql($connect, $arr[0]);//TODO ничего не найдено
}

function movie_from_sql($connect, $temp): Movie
{
    $movie = new Movie();
    $movie->setId($temp->movie_id);
    $movie->setName($temp->name);
    $movie->setAgeLimit($temp->age_limit);
    $movie->setBudget($temp->budget);
    $movie->setCountry($temp->country);
    $movie->setDescription($temp->description);
    $movie->setDirector($temp->director);
    $movie->setFees($temp->fees);
    $movie->setGenres(get_genres_by_movie_id($connect, $temp->movie_id));
    $movie->setPoster($temp->poster);
    $movie->setReviews(get_review_by_movie_id($connect, $temp->movie_id));
    $movie->setTagline($temp->tagline);
    $movie->setTime($temp->time);
    $movie->setYear($temp->year);
    return $movie;
}

function add_review($connect, Review $review)
{
    $query = 'INSERT INTO review(user_id, movie_id, rating, is_anonymous, create_date_time, review_text) VALUES ($1, $2, $3, $4, $5, $6);';

    $params = [];
    $params[1] = $review->getUserId();
    $params[2] = $review->getMovieId();
    $params[3] = $review->getRating();
    $params[4] = $review->isAnonymous();
    $params[5] = $review->getCreateDateTime();
    $params[6] = $review->getReviewText();

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on add review. ' . pg_last_error($connect));
    }
}

function edit_review($connect, Review $review)
{
    $query = 'UPDATE review SET rating = $1, review_text = $2, is_anonymous = $3 WHERE movie_id = $4 AND user_id = $5;';

    $params = [];
    $params[1] = $review->getRating();
    $params[2] = $review->getReviewText();
    $params[3] = $review->isAnonymous();
    $params[4] = $review->getMovieId();
    $params[5] = $review->getUserId();


    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on edit review. ' . pg_last_error($connect));
    }
}

function delete_review($connect, string $review_id)
{
    $query = 'DELETE FROM review WHERE review_id = $1;';

    $params = [];
    $params[1] = $review_id;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on delete    review. ' . pg_last_error($connect));
    }
}

function get_user_by_id($connect, string $user_id){

    $query = 'SELECT * FROM users WHERE user_id = $1;';

    $params = [];
    $params[1] = $user_id;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on get user. ' . pg_last_error($connect));
    }
    $arr = result_to_array_obj($result);
    return user_from_sql($connect, $arr[0]);//TODO ничего не найдено
}

function user_from_sql($connect, $temp):User{
    $user = new User();
    $user->setId($temp->user_id);
    $user->setName($temp->name);
    $user->setUsername($temp->username);
    $user->setPassword($temp->password);
    $user->setGender($temp->gender == 'female' ? Gender::Female : Gender::Male);
    $user->setEmail($temp->email);
    $user->setBirthDate($temp->birth_date);
    $user->setAvatarLink($temp->avatar_link);
    return $user;
}

function edit_user($connect, User $user){
    $query = 'UPDATE users SET
        name = $1,
        birth_date = $2,
        username = $3,
        email  = $4,
        gender = $5
        WHERE user_id = $6;';
    //--password = $5,
    $params = [];

    $params[1] = $user->getName();
    $params[2] = $user->getBirthDate();
    $params[3] = $user->getUsername();
    $params[4] = $user->getEmail();
    $params[5] = $user->getGender() == Gender::Male?'male':'female';
    $params[6] = $user->getId();

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on edit profile. ' . pg_last_error($connect));
    }
}

function user_id_by_username($connect, string $username):string
{
    $query = 'SELECT user_id FROM users WHERE username = $1;';

    $params = [];
    $params[1] = $username;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
    return result_to_array_obj($result)[0]->user_id;
}

function add_jwt_by_username($connect, string $username, string $time, string $db_fire):void
{
    $query = 'INSERT INTO jwt_tokens(token, create_date, user_id) VALUES ($1, $2, $3)';

    $params = [];
    $params[1] = $db_fire;
    $params[2] = $time;
    $params[3] = user_id_by_username($connect, $username);

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
}

function delete_all_jwt_by_username($connect, string $username):void
{
    $query = 'DELETE FROM jwt_tokens WHERE user_id = $1';

    $params = [];
    $params[1] = user_id_by_username($connect, $username);

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
}

function delete_jwt_by($connect, string $db_fire):void
{
    $query = 'DELETE FROM jwt_tokens WHERE token = $1';

    $params = [];
    $params[1] = $db_fire;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
}

function user_id_by_jwt($connect, string $db_fire):string|null//TODO null
{
    $query = 'SELECT user_id FROM jwt_tokens WHERE token = $1';

    $params = [];
    $params[1] = $db_fire;

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
    return result_to_array_obj($result)[0]->user_id;
}

function username_by_jwt($connect, string $db_fire):string|null
{
    $query = 'SELECT username FROM users WHERE user_id = $1';

    $params = [];
    $params[1] = user_id_by_jwt($connect, $db_fire);

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
    return result_to_array_obj($result)[0]->username;
}

function count_of_films($connect):int{
    $query = 'SELECT COUNT(movie_id) FROM movie';

    $params = [];

    $result = pg_query_params($connect, $query, $params);

    if(!$result)
    {
        log_err('DB query error on find user. ' . pg_last_error($connect));
        throw DBErrorException();
    }
    return result_to_array_obj($result)[0]->count;
}
