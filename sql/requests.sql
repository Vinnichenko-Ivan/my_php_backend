INSERT INTO jwt_tokens(token, create_date, user_id) VALUES ('10', '2022-01-10', '7afb952e-e06b-4224-98e4-f107926aad05');

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
    is_anonymous = 1
    WHERE review_id = '';