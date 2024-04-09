# PHP tcg manager
A application with back-end framework created for a school project of the subject "Webtechnologie II"

------
## Installation

1. Download or clone the project using git
2. Create database schema
3. Create `.env` file using `.env.example`
4. Run `composer install`
5. Go to the `public` folder
6. Start the php server by using the command `php -S localhost:8000` 
7. Open the server in your browser

------
## User accounts
These are the basic user accounts for the three roles the application has

| Username    |        E-mail         | Password |     Role     |
| ----------- | --------------------- | -------- | ------------ |
| adminuser   | admin@gmail.com       | 123      | Admin        |
| user        | user@gmail.com        | 123      | User         |
| premiumuser | premiumuser@gmail.com | 123      | Premium user |

------
## Role permissions
Each role has different permissions on the application (Managing in the context below refers to the basic CRUD model (create, read, update, delete))

|     Role     |     Permissions                                                                                                                        | 
| ------------ | -------------------------------------------------------------------------------------------------------------------------------------- |
| Admin        | Admins are superusers on the application and can manage everything. They can manage users, cards, decks and sets                       |     
| User         | Users can search and view cards, and they can edit their profile. They also have the option to subscribe to premium                    |     
| Premium user | Premium users can do everything regular users can do with the bonus of being able to manage decks and add/remove cards to their decks. |     


