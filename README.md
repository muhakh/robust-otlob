# Robust Otlob

## Installation
You need to install `composer` and`laravel` then execute the following:

- Clone this repository
- Run command `composer install`
- Rename `.env.example` to `.env` and add your environment variables in it.
- Run command `php artisan migrate`

And now you have installed the application.

## Seeding data
Laravel provides a variety of helpful tools to make it easier to test database driven applications. One of them is seed classes.
To generate seed data, run command `php artisan migrate:refresh --seed` and this will remigrate and generate random data for testing.

## Consuming APIs

### Authentication
I used laravel passport extension to build the authentication system.
Although passport provides front-end API to generate clients and authenticate users, I didn't use it due to problems at my laptop with nodejs and npm.

To generate passport client you need to run the following command in the directory of the application:
`php artisan passport:client --password`
This command generates a Password Grant Client which gives you a client id and a secret key to ask for access tokens.

The application has a the built in auth. installed which enables you to create accounts and login.

Once you have the client's id and secret key, you can ask for access token for a particular user using the following API:
`POST /oauth/token`
```
Data{
	'grant_type' => 'password',
	'client_id' => 'client-id',
	'client_secret' => 'client-secret',
	'username' => 'person@mail.com',
	'password' => 'my-password',
	'scope' => '',
}
```
Once you have access token, you can consume the API allowed for a user.

* Note: A super-user has access to all actions in the system, but I forget to implement a way to make a user become a super-user. The only way is via database insertsion.

### Consuming

#### Restaurant

**Retrieve All Restaurant**

*Resquest*
`GET /api/restaurants`

*Parameters*
No parameters

*Permession Level*
Guest
***
**Add new restaurant**
*Resquest*
`POST /api/restaurants`

*Parameters*
```
{
	name: 'restaurants-name',
	manager_id: 'restaurants-manager-id'
}
```
*Permession Level*
Super-user
***
**Show restaurant with id={id}**
*Resquest*
`GET /api/restaurants{id}`

*Parameters*
No Parameters

*Permession Level*
Guest
***
**Edit restaurant with id={id}**
*Resquest*
`PUT /api/restaurants{id}`

*Parameters*
```
{
	name: 'restaurants-name',
	manager_id: 'restaurants-manager-id'
}
```

*Permession Level*
Manager

***

**Delete restaurant with id={id}**
*Resquest*
`DELETE /api/restaurants{id}`

*Parameters*
No Parameters

*Permession Level*
Manager
***
**Add area with id={area_id} to restaurant with id={restaurant}**
*Resquest*
`POST /api/restaurants/{restaurant_id}/area/{area_id}`

*Parameters*
No Parameters

*Permession Level*
Manager
***
**Delete area with id={area_id} from restaurant with id={restaurant}**
*Resquest*
`DELETE /api/restaurants/{restaurant_id}/area/{area_id}`

*Parameters*
No Parameters

*Permession Level*
Manager
#### Area
**Retrieve All Area**

*Resquest*
`GET /api/areas`

*Parameters*
No parameters

*Permession Level*
Guest
***
**Add new area**
*Resquest*
`POST /api/areas`

*Parameters*
```
{
	name: 'areas-name',
	city: 'city-name'
}
```
*Permession Level*
Super-user
***
**Show area with id={id}**
*Resquest*
`GET /api/areas{id}`

*Parameters*
No Parameters

*Permession Level*
Guest
***
**Edit area with id={id}**
*Resquest*
`PUT /api/areas{id}`

*Parameters*
```
{
	name: 'areas-name',
	city: 'city-name'
}
```

*Permession Level*
Super-user

***

**Delete area with id={id}**
*Resquest*
`DELETE /api/areas{id}`

*Parameters*
No Parameters

*Permession Level*
Super-user
***
#### Menus
**Add new menu item to restaurant with id={restaurant_id}**
*Resquest*
`POST /api/restaurants/{restaurant_id}/menu/items`

*Parameters*
```
{
	title :'item-title',
	description 'item-description':,
	price :'item-price',
}
```

*Permession Level*
Manager
***

**Edit menu item with id={item_id} of restaurant with id={restaurant_id}**
*Resquest*
`PUT /api/restaurants/{restaurant_id}/menu/items/{item_id}`

*Parameters*
```
{
	title :'item-title',
	description 'item-description':,
	price :'item-price',
}
```

*Permession Level*
Manager
***
**Delete menu item with id={item_id} of restaurant with id={restaurant_id}**
*Resquest*
`DELETE /api/restaurants/{restaurant_id}/menu/items/{item_id}`

*Parameters*
No Parameters

*Permession Level*
Manager
***
#### Orders

#### Cart
