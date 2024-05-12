## About Dator

Dator is an application to find your partner or friends.


## Examples of API requests

http://127.0.0.1:8000/api/login_register_user : (GET)

{
    "email": "john@gmal.co",
    "password": "123456789"
}

http://127.0.0.1:8000/api/create_profile/3 : (GET)

{
    "image": "https://www.example.com/image.jpg",
    "user_id": 1,
    "name": "Michael",
    "age": 23,
    "gender": "чоловік",
    "phone": "380111111",
    "search_purpose": "Друга",
    "city": "Харків",    
    "hobbies": "У вільний час я захоплююся малюванням та розробкою дизайну. Це моє хобі, що робить мене щасливою та задоволеною. Крім того, я люблю музику та танці - це моє спосіб виразити свої почуття та емоції. Веселі вечори я проводжу з друзями у кіно або на концертах, насолоджуючись моментами радості та веселощів."
}

http://127.0.0.1:8000/api/create_membership/1 : (POST)

{
    "user_id": 1,
    "membership": "free",
    "swipes_amount": 20,
    "start_date": "2024-05-12"
}

http://127.0.0.1:8000/api/update_user/1 : (PUT)

{
    "email": "michael@gmal.co",
    "password": "123456789"
}

http://127.0.0.1:8000/api/update_profile/1 : (PUT)

{
    "image": "https://www.example.com/image.jpg",
    "user_id": 1,
    "name": "Руслан",
    "age": 25,
    "gender": "чоловік",
    "phone": "380111111",
    "search_purpose": "Друга",
    "city": "Харків",    
    "hobbies": "У вільний час я захоплююся малюванням та розробкою дизайну. Це моє хобі, що робить мене щасливою та задоволеною. Крім того, я люблю музику та танці - це моє спосіб виразити свої почуття та емоції. Веселі вечори я проводжу з друзями у кіно або на концертах, насолоджуючись моментами радості та веселощів."
}

http://127.0.0.1:8000/api/update_membership/1 : (PUT)

{
    "user_id": 1,
    "membership": "free",
    "swipes_amount": 40,
    "start_date": "2024-05-12"
}

http://127.0.0.1:8000/api/profiles/2/like : (GET)

{
    "user_liked_id": 2,
    "liked_user_id": 1
}

http://127.0.0.1:8000/api/get_user_info/1 : (POST)

http://127.0.0.1:8000/api/profiles/3/user_id_likes : (GET)


### To make migrations input in Terminal:

php artisan migrate

If foreign key doesn't work then, try to add in PhpMyAdmin lines: 

ALTER TABLE membership
ADD CONSTRAINT fk_membership_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
ALTER TABLE profile
ADD CONSTRAINT fk_profile_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

Also fields user_id must be: NOT NULL, bigint(20), unsigned.

