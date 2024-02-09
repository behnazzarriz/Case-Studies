## Behnaz Zarriz

# Project Setup

## Installation
- composer install

## Database Setup
```sh
php bin/console doctrine:database:create
```

## Create all tables:
```sh
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

## Seed Database with Fixtures
- Before accessing the admin panel, you need to load fixtures. This includes a user with admin privileges.
```sh
php bin/console doctrine:fixtures:load
```
- Fixture Information
    - Redakteur or (user  with ROLE_ADMIN)
    -     Email: test@gmail.com
    -     Password: test123


## Admin Panel
- I have considered Editor as a User with Role-admin
- Customer(Kunde) and case studies can only be created, edited and deleted in the Admin palette, so Redakteur (user with ROLE_ADMIN) must log in
- In the admin panel you can add new Redakteur as admins


## Homepage
- Here only all Customers with his case studies are shown, but only Castumers(Kunden) whose status is true