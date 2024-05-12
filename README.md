## About Dator

Dator is an application to find your partner or friends.


## Examples of API requests

http://localhost/api/create_user :

{
    "name": "Emily",
    "full_name": "Emily Davis",
    "email": "Emily@gmal.co",
    "phone_number": "384444444",
    "password": "123456789"
}

http://localhost/api/create_profile :

{
    "image": "https://www.example.com/image.jpg",
    "user_id": 4,
    "age": 23,
    "gender": "жінка",
    "city": "Харків",
    "about_info": "Привіт! Мене звати Емілі і я мрію змінити світ своєю творчістю. Я відкрита та дружня особистість зі склонністю до мистецтва. Моїм гаслом у житті є 'Живи кожен момент'. Я вірю у справжні дружні стосунки і віддана своїм мріям та цілям",
    "hobbies": "У вільний час я захоплююся малюванням та розробкою дизайну. Це моє хобі, що робить мене щасливою та задоволеною. Крім того, я люблю музику та танці - це моє спосіб виразити свої почуття та емоції. Веселі вечори я проводжу з друзями у кіно або на концертах, насолоджуючись моментами радості та веселощів."
}

http://localhost/api/create_membership :

{
    "user_id": 1,
    "membership": "free",
    "swipes_amount": 20,
    "start_date": "2024-05-12"
}

http://localhost/api/update_user/{id} :

{
    "name": "Michael",
    "full_name": "Michael Brown",
    "email": "michael@gmal.co",
    "phone_number": "383333333",
    "password": "123456789"
}

http://localhost/api/update_profile/{id} :

{
    "image": "https://www.example.com/image.jpg",
    "user_id": 1,
    "age": 25,
    "gender": "чоловік",
    "city": "Kyiv",
    "about_info": "Привіт! Мене звати John і я веб-розробник зі страстью до створення креативних та інноваційних веб-додатків.",
    "hobbies": "У вільний час я великий прихильник подорожей та фотографування. Завжди радий відкривати нові місця та ділитися своїми враженнями з подорожей з друзями. Також люблю грати на гітарі, що допомагає мені розслабитися та відпочити від робочих буднів."
}

http://localhost/api/update_membership/{id} :

{
    "user_id": 1,
    "membership": "free",
    "swipes_amount": 40,
    "start_date": "2024-05-12"
}

### To make migrations input in Terminal:

php artisan migrate

If foreign key doesn't work then, try to add in PhpMyAdmin lines: 

ALTER TABLE membership
ADD CONSTRAINT fk_membership_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;
ALTER TABLE profile
ADD CONSTRAINT fk_profile_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE;

Also fields user_id must be: NOT NULL, bigint(20), unsigned.

