# Robust Otlob

## Installation
You need to install `composer` and`laravel` then execute the following:

- Clone this repository
- Run command `composer install`
- Rename `.env.example` to `.env` and add your environment variables in it.
- Run command `php artisan migrate`
- Run command `php artisan key:generate`
- Run command `php artisan passport:install` which will provide you with two OAuth clients. Save the Client ID and Client Secret for later use.

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
`GET /api/restaurants/{id}`

*Parameters*
No Parameters

*Permession Level*
Guest
***
**Edit restaurant with id={id}**

*Resquest*
`PUT /api/restaurants/{id}`

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
`DELETE /api/restaurants/{id}`

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
`GET /api/areas/{id}`

*Parameters*
No Parameters

*Permession Level*
Guest
***
**Edit area with id={id}**

*Resquest*
`PUT /api/areas/{id}`

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
`DELETE /api/areas/{id}`

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

**Retrieve All Orders**

*Resquest*
`GET /api/orders`

*Parameters*
No parameters

*Permession Level*
Super-user
***
**Add new order**

*Resquest*
`POST /api/orders`

*Parameters*
```
{
	menu_items: [menu_items],  // List of menu_items_ids
	quantity: [quantity], // Integer of integers
	shipping_address: 'order-shipping_address'
}
```
*Permession Level*
User
***
**Show order with id={id}**

*Resquest*
`GET /api/orders/{id}`

*Parameters*
No Parameters

*Permession Level*
Owner of order
***
**Edit order with id={id}**

*Resquest*
`PUT /api/orders/{id}`

*Parameters*
```
{
	menu_items: [menu_items],  // List of menu_items_ids
	quantity: [quantity], // List of Integers
	shipping_address: 'order-shipping_address'
}
```

*Permession Level*
Owner of order

***

**Delete order with id={id}**

*Resquest*
`DELETE /api/orders/{id}`

*Parameters*
No Parameters

*Permession Level*
Owner of order
***

**Submit order with id={id}**

*Resquest*
`POST /api/orders/{id}`

*Parameters*
No Parameters

*Permession Level*
Owner of order
***

**Edit item with id={item_id} of order with id={order_id}**

*Resquest*
`PUT orders/{order_id}/items/{item_id}`

*Parameters*
```
{
	quantity: quantity, // Integer
}
```
*Permession Level*
Owner of order
***

**Delete item with id={item_id} of order with id={order_id}**

*Resquest*
`DELETE orders/{order_id}/items/{item_id}`

*Parameters*
No Parameters

*Permession Level*
Owner of order
***

#### Cart

**Show cart for user with id={user_id}**

*Resquest*
`GET /api/users/{user_id}/cart`

*Parameters*
No Parameters

*Permession Level*
User
***

**Add item to cart for user with id={user_id}**

*Resquest*
`POST /api/users/{user_id}/cart/items/{item_id}`

*Parameters*
```
{
	quantity: quantity, // Integer
}
```

*Permession Level*
User
***

**Checkout items from cart for user with id={user_id}**

*Resquest*
`POST /api/users/{user_id}/cart/checkout`

*Parameters*
No Parameters

*Permession Level*
User
***

**Remove all items from cart for user with id={user_id}**

*Resquest*
`PUT /api/users/{user_id}/cart/empty`

*Parameters*
No Parameters

*Permession Level*
User
***

**Edit items in cart for user with id={user_id}**

*Resquest*
`PUT /api/users/{user_id}/cart`

*Parameters*
```
{
	menu_items: [menu_items],  // List of menu_items_ids
	quantity: [quantity], // List of Integers
}
```

*Permession Level*
User
***

**Edit item with id={item_id} in cart for user with id={user_id}**

*Resquest*
`PUT /api/users/{user_id}/cart/items/{item_id}`

*Parameters*
```
{
	quantity: [quantity], // List of Integers
}
```

*Permession Level*
User
***

**Delete item with id={item_id} in cart for user with id={user_id}**

*Resquest*
`DELETE /api/users/{user_id}/cart/items/{item_id}`

*Parameters*
No Parameters

*Permession Level*
User
***
