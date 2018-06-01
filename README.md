# Blog-in-Symfony-4

use composer to clone repository:

git clone git@github.com:mord1mer/Blog-in-Symfony-4.git

next in folder project run : composer install

next configure database connection to database (file .env) in line:

DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name

next create database with command:

php bin/console doctrine:database:create and run migrations 

php bin/console doctrine:migrations:migrate

at the end run : php bin/console doctrine:fixtures:load

to create fake data and user admin

login: gregory
passwword: tajne
