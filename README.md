## Code Challenge
    This challenge requires you to create an API that will import data from a third party API
and be able to display it. This challenge should demonstrate how you structure your
code and apply any appropriate design patterns. Please read through everything before
starting.

## Features:
    ● Import customers from a 3rd party data provider and save to the database.
    ● Display a list of customers from the database.
    ● Select and display details of a single customer from the database.

## Framework
    • Use Laravel or Symfony to write the following backend services in a single
project.

## Techstack
 - PHP 8.2
 - composer 2
 - node 22


## installation
 - clone the repo
 - composer install
 - cp .env.example .env
 - edit .env
       - DB_DATABASE="your databse name"
       - DB_PASSWORD=your database password
 -  php artisan customers:import

 ## API
   - GET /customers (retrieve the list of all customers from the database.)
   - GET /customers/{customerId}  (retrieve more details of a single customer.
The response should contain)

## command to save in database 
      - php aritsan db:seed
        or
      - php artisan customers:import

## test
    - php artisan test

## test result sample
![image](https://github.com/user-attachments/assets/587e2365-e767-44c6-8316-44d5597ae77d)

Thankyou !
