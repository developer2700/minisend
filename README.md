# ![MiniSend Rest](minisend.png)
> ### MiniSend App with Laravel7 (CRUD, advanced patterns and more).

----------

# Getting started
Project demo is available at https://minisend.mohammadghamari.mtcdevserver4.com
                                     
## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/7.x/installation)


Clone the repository

    git clone git@github.com:developer2700/minisend.git

Switch to the repo folder

    cd minisend

Install all the dependencies using composer

    composer install

edit the env file and make the required configuration changes for database setting

    nano .env 

Generate a new application key

    php artisan key:generate

Generate a new JWT authentication secret key (optional)

    php artisan jwt:secret

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

Running the tests  

    php artisan test

**TL;DR command list**

    git clone git@github.com:developer2700/minisend.git
    cd minisend
    composer install
    nano .env 
    php artisan key:generate
    php artisan jwt:secret 
    
**Make sure you set the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes emails. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeds/DummyDataSeeder.php

Run the database seeder, and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh

# Code overview

## Dependencies

- [jwt-auth](https://github.com/tymondesigns/jwt-auth) - For authentication using JSON Web Tokens

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers/Api` - Contains all the api controllers
- `app/Http/Repositories` - Repository and interfaces
- `app/Http/Middleware` - Contains the JWT auth middleware (not used in this version)
- `app/Http/Requests/Api` - Contains all the api form requests
- `app/Classes/Filters` - Contains the query filters used for filtering api requests
- `app/Classes/Paginate` - Contains the pagination class used to paginate the result
- `app/Classes/Transformers` - Contains all the data transformers
- `config` - Contains all the application configuration files
- `database/factories` - Contains the model factory for all the models
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `routes` - Contains all the api routes defined in api.php file
- `tests` - Contains all the application tests
- `tests/Feature/Api` - Contains all the api tests

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://127.0.0.1:8000/api/emails
    http://127.0.0.1:8000/api/emails/1

Request headers

| **Required** 	| **Key**              	| **Value**            	|
|----------	|------------------	|------------------	|
| Yes      	| Content-Type     	| application/json 	|
| Yes      	| X-Requested-With 	| XMLHttpRequest   	|
| Optional 	| Authorization    	| Bearer {JWT}      	|

----------
 
# Authentication(not used in this version but i always install and configure it)
 
This application use JSON Web Token (JWT) to handle authentication. The token is passed with each request using the `Authorization` header with `Bearer` scheme. The JWT authentication middleware handles the validation and authentication of the token. Please check the following sources to learn more about JWT.
 
- https://jwt.io/introduction/
- https://self-issued.info/docs/draft-ietf-oauth-json-web-token.html

----------

# Cross-Origin Resource Sharing (CORS)
 
as Laravel version 7 started has CORS enabled by default on all API endpoints. 
- https://developer.mozilla.org/en-US/docs/Web/HTTP/Access_control_CORS
- https://en.wikipedia.org/wiki/Cross-origin_resource_sharing
- https://www.w3.org/TR/cors
