## <div align="center"><u>Paynetics Task Documentation</u></div>

### Requirements:
- [PHP >= 8.2](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/download/)
- Database Server (MySQL, PostgresSQL, SQLite)
- [Laragon](https://laragon.org/download/index.html) (optional)
- Access to GitLab GreenRock repository
### Installation

#### PHPStorm:
- File -> Project from Version Control
- Version control: Git
- URL: https://github.com/GKatsarov/paynetics-task.git

#### Git:
- git clone https://github.com/GKatsarov/paynetics-task.git
- cd paynetics-task

#### Composer (must have walked through PHPStorm or Git installation):
- composer install
- cp .env.example .env
- set database credentials in .env file
- create the database in your database server
- php artisan key:generate
- php artisan migrate
- php artisan db:seed
- php artisan serve

### API Postman collection
- Copy Paynetics.postman_collection.json from root folder
- open postman
- import collection from file
- set environment variables:**HOST**
