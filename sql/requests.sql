INSERT INTO users(name, birth_date, username, email, password, gender, user_role)
VALUES ('21', '2022-11-11', 'q', 'fox40802@gmail.com', '1', 'female', 'admin');

INSERT INTO jwt_tokens(token, create_date, user_id) VALUES ('110', '2022-01-10', '7afb952e-e06b-4224-98e4-f107926aad05');

DELETE FROM jwt_tokens WHERE token = '10';

SELECT * FROM favorites
    WHERE user_id = '';

INSERT INTO favorites(user_id, movie_id) VALUES ();

DELETE FROM favorites WHERE user_id = '' AND movie_id = '';

SELECT * FROM movie;

SELECT * FROM movie WHERE movie_id = '';

SELECT * FROM users WHERE user_id = '';

UPDATE users SET
    name = '',
    birth_date = '',
    username = '',
    email  = '',
    password = '',
    gender = 'male'
    WHERE user_id = '';

INSERT INTO review(user_id, movie_id, rating, is_anonymous, create_date_time) VALUES
    ('', '', 3, false, '1010-10-10');

DELETE FROM review WHERE review_id = '';

UPDATE review
    SET rating = 1,
    review_text = '',
    is_anonymous = 1
    WHERE review_id = '';

SELECT movie_id FROM favorites WHERE user_id = '';

SELECT * FROM movie WHERE movie_id IN (SELECT movie_id FROM favorites WHERE user_id = '');

SELECT genre_id FROM movie_genres WHERE movie_id = '';

SELECT * FROM genre WHERE genre_id IN (SELECT genre_id FROM movie_genres WHERE movie_id = '');

SELECT * FROM review WHERE movie_id = '';

INSERT INTO favorites(user_id, movie_id) VALUES ('', '');

DELETE FROM favorites WHERE movie_id = '' AND user_id = '';

INSERT INTO review(user_id, movie_id, rating, is_anonymous, create_date_time) VALUES ($1, $2, $3, $4, $5);

DELETE FROM review WHERE review_id = $1;

SELECT * FROM users WHERE user_id = $1;

INSERT INTO jwt_tokens(token, create_date, user_id) VALUES ()