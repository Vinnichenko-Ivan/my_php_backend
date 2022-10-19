CREATE TABLE IF NOT EXISTS genre
(
    genre_id UUID DEFAULT uuid_generate_v4(),
    name TEXT NOT NULL,
    PRIMARY KEY (genre_id)
);

CREATE TABLE IF NOT EXISTS movie
(
    movie_id UUID DEFAULT uuid_generate_v4(),
    name TEXT NOT NULL,
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
    movie_id UUID NOT NULL,
    genre_id UUID NOT NULL,
    FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
    FOREIGN KEY (genre_id) REFERENCES genre(genre_id),
    UNIQUE (movie_id, genre_id)
);

CREATE TYPE gender AS ENUM ('male', 'female');

CREATE TYPE user_role AS ENUM ('user', 'admin', 'moderator');

CREATE TABLE IF NOT EXISTS users
(
    user_id UUID DEFAULT uuid_generate_v4(),
    name TEXT NOT NULL,
    birth_date DATE NOT NULL,
    username TEXT NOT NULL,
    email TEXT CHECK (email ~ '^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$' ),
    password TEXT NOT NULL,
    gender gender NOT NULL,
    user_role user_role NOT NULL,
    PRIMARY KEY (user_id),
    UNIQUE (username),
    UNIQUE (email)
);

CREATE TABLE IF NOT EXISTS favorites
(
    user_id UUID NOT NULL,
    movie_id UUID NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
    UNIQUE (user_id, movie_id)
);

CREATE TABLE IF NOT EXISTS review
(
    review_id UUID DEFAULT uuid_generate_v4(),
    user_id UUID NOT NULL,
    movie_id UUID NOT NULL,
    rating INT CHECK ( rating <= 10 AND rating >= 1 ),
    is_anonymous BOOLEAN NOT NULL,
    create_date_time DATE NOT NULL,
    PRIMARY KEY (review_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (movie_id) REFERENCES movie(movie_id),
    UNIQUE (user_id, movie_id)
);

CREATE TABLE IF NOT EXISTS jwt_tokens
(
    token TEXT NOT NULL,
    create_date DATE NOT NULL,
    user_id UUID NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    UNIQUE (token)
)


