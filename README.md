# Book Wise

Book Wise is a simple book management application that allows users to register books, rate them, and search through the collection.
All book entries are stored in a **MariaDB** database, and users can interact with the system through intuitive forms and basic search features.<br>

A lightweight migration system was implemented from scratch, along with custom validation for user input, ensuring data consistency without relying on external tools.<br>

The application follows a clean **MVC architecture**, built entirely with **pure PHP**, without frameworks or Composer packages, in order to deeply understand the underlying concepts of core PHP development.

<br>

<p align="center">
    <img alt="Hero Image" src="https://i.imgur.com/BF2RzpN.png" width="90%">
</p>

## Built With

![php-badge]
![mariadb-badge]
![tailwind-badge]

## Quick Start

### Requirements

* [PHP][php-download] (8.4)
* MariaDB or MySQL

### Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/matheushfp/books-app.git
    ```

2. Create the `.env` file and fill the necessary fields
    ```sh
   cp .env.example .env
    ```
   Fill the DB fields (required)


3. Run migrations
   ```sh
   php database/migrate.php
   ```

4. Run the Application
    ```sh
    php -S localhost:8000 -t public
   ```
Access the app at: http://localhost:8000

## Screenshots

<p align="center">
    <img alt="My Books Section Image" src="https://i.imgur.com/1qBvEMu.png" width="90%">
    <img alt="Review Book Section Image" src="https://i.imgur.com/tfbLuxk.png" width="90%">
</p>

<!-- Links -->
[php-download]: https://www.php.net/downloads.php

<!-- Badges -->
[php-badge]: https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white
[mariadb-badge]: https://img.shields.io/badge/MariaDB-003545?style=for-the-badge&logo=mariadb&logoColor=white
[tailwind-badge]: https://img.shields.io/badge/Tailwind-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white
