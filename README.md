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

### To Log In or Registration user USE:

> (GET) http:localhost/api/login_register_user : 

```json
{
    "email": ".....",
    "password": "....."
}

```

### To create users profile USE:
> (GET) http:localhost/api/create_profile/{id} :

````json
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
````
### To create users membership USE:

>  (POST) http:localhost/api/create_membership/{id} :

```json
{
    "user_id": {id},
    "membership": "...",
    "swipes_amount": ...,
    "start_date": "..."
}
```
### To update user USE:

>  (PUT) http:localhost/api/update_user/{id} :

```json
{
    "email": "...",
    "password": "..."
}
```
### To update users profile USE:

>  (PUT) http:localhost/api/update_profile/{id} :

```json
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
```
### To update users membership USE:
> (PUT) http:localhost/api/update_membership/{id} :

```json
{
    "user_id": {id},
    "membership": "...",
    "swipes_amount": ...,
    "start_date": "..."
}
```
### To like another user USE:
> (GET) http:localhost/api/profiles/{id}/like :

```json
{
    "user_liked_id": {id},
    "liked_user_id": {id}
}
```
### To get information about another user USE:

>  (POST) http:localhost/api/get_user_info/{id}

### To get users mutual likes USE:

>  (GET) http:localhost/api/profiles/{id}/user_id_likes

### To get random profiles USE:

> (POST) http:localhost/api/get_profiles


### Each request user can make via apps, such as Postman or another one, that can send requests.

To make API work, just input in root apps directory in Terminal:

- php artisan serve

### To make migrations input in Terminal:

- php artisan migrate
