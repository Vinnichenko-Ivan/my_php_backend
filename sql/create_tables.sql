CREATE TABLE IF NOT EXISTS genre
(
    genre_id UUID DEFAULT uuid_generate_v4(),
    name TEXT,
    PRIMARY KEY (genre_id)
);

CREATE TABLE IF NOT EXISTS movie
(
    movie_id UUID DEFAULT uuid_generate_v4(),
    name TEXT,
    poster TEXT,
    description TEXT,
    year INT,
    country TEXT,
    time INT,
    tagline TEXT,
    director TEXT,
    budget INT,
    fees INT,
    age_limit INT,
    PRIMARY KEY (movie_id)
);

CREATE TABLE IF NOT EXISTS movie_films
(
    movie_id UUID,
    genre_id UUID,
    FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
    FOREIGN KEY (genre_id) REFERENCES genre(genre_id),
    UNIQUE (movie_id, genre_id)
);

CREATE TYPE gender AS ENUM ('male', 'female');

CREATE TABLE IF NOT EXISTS users
(
    user_id UUID DEFAULT uuid_generate_v4(),
    name TEXT,
    birth_date DATE,
    username TEXT,
    email TEXT CHECK (email ~ '^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$' ),
    password TEXT,
    gender gender,
    PRIMARY KEY (user_id),
    UNIQUE (username),
    UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS favorites
(
    user_id UUID,
    movie_id UUID,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
    UNIQUE (user_id, movie_id)
);

CREATE TABLE IF NOT EXISTS review
(
    review_id UUID DEFAULT uuid_generate_v4(),
    user_id UUID,
    movie_id UUID,
    rating INT CHECK ( rating <= 10 AND rating >= 1 ),
    is_anonymous BOOLEAN,
    create_date_time DATE,
    PRIMARY KEY (review_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
    UNIQUE (user_id, movie_id)
);

CREATE TABLE IF NOT EXISTS jwt_tokens
(
    token TEXT,
    create_date DATE,
    user_id UUID,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    UNIQUE (token)
)


