## About Dator

Dator is an application to find your partner or friends.

Abilities/ User can:

- Log In or Register in app.
- Create Profile.
- Has 100 swipes of random people in app with free trial.
- Premium has endless amount of swipes.
- Like another people and match if another person also liked them.
- Update their info for Log In or Profile page.
- Any time upgrade membership to Premium.


## Examples of API requests

http:localhost/api/login_register_user : (GET)

{
    "email": ".....",
    "password": "....."
}

http:localhost/api/create_profile/{id} : (GET)

{
    "image": "https://....",
    "user_id": {id},
    "name": "...",
    "age": ...,
    "gender": "...",
    "phone": "...",
    "search_purpose": "...",
    "city": "...",    
    "hobbies": "..."
}

http:localhost/api/create_membership/{id} : (POST)

{
    "user_id": {id},
    "membership": "...",
    "swipes_amount": ...,
    "start_date": "..."
}

http:localhost/api/update_user/{id} : (PUT)

{
    "email": "...",
    "password": "..."
}

http:localhost/api/update_profile/{id} : (PUT)

{
    "image": "https://....",
    "user_id": {id},
    "name": "...",
    "age": ...,
    "gender": "...",
    "phone": "...",
    "search_purpose": "...",
    "city": "...",    
    "hobbies": "..."
}

http:localhost/api/update_membership/{id} : (PUT)

{
    "user_id": {id},
    "membership": "...",
    "swipes_amount": ...,
    "start_date": "..."
}

http:localhost/api/profiles/{id}/like : (GET)

{
    "user_liked_id": {id},
    "liked_user_id": {id}
}

http:localhost/api/get_user_info/{id} : (POST)

http:localhost/api/profiles/{id}/user_id_likes : (GET)


### Each request user can make via apps, such as Postman or another one, that can send requests.

To make API work, just input in root apps directory in Terminal:

- php artisan serve

### To make migrations input in Terminal:

- php artisan migrate
