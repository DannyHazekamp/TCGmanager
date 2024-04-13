# PHP TCG manager
A application with back-end framework created for a school project of the subject "Webtechnologie II"

------
## Installation

1. Download or clone the project using git
2. Create the `.env` file using `.env.example`
3. Run `composer install`
4. Go to the `public` folder and run `php -S localhost:8000` or run `php -S localhost:8000 -t public` in the root folder 
5. Open the server in your browser

------
## User accounts
These are the basic user accounts for the three roles the application has

| Username    |        E-mail         | Password    |     Role     |
| ----------- | --------------------- | ----------- | ------------ |
| adminuser   | admin@gmail.com       | 123456      | Admin        |
| user        | user@gmail.com        | 123456      | User         |
| premiumuser | premiumuser@gmail.com | 123456      | Premium user |

------
## Role permissions
Each role has different permissions on the application (Managing in the context below refers to the basic CRUD model (create, read, update, delete))

|     Role     |     Permissions                                                                                                                        | 
| ------------ | -------------------------------------------------------------------------------------------------------------------------------------- |
| Admin        | Admins are superusers on the application and can manage everything. They can manage users, cards, decks and sets                       |     
| User         | Users can search and view cards/sets, and they can edit their profile. They also have the option to subscribe to premium               |     
| Premium user | Premium users can do everything regular users can do with the bonus of being able to manage decks and add/remove cards to their decks. |     

## Roles disclaimer
If the roles for some reason are missing use the following query on the sqlite webtech.db table:

INSERT INTO roles (role_id, name) VALUES (1, 'admin'), (2, 'user'), (3, 'premium_user'); 
