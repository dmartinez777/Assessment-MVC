## About
Assessment-MVC is a small PHP MVC Framework developed as a fun assessment for a job interview. 
I personally might just continue adding to it after.

## Requirements
- PHP 7.4 
- Composer 
- MariaDB
- Apache or NGINX

## Installation
You can download the Assessment-MVC source directly from Git clone:
```
cd /var/www/html
git clone https://github.com/xlordt/Assessment-MVC.git
cd Assessment-MVC
composer install
php install.php (Currently Vagrant only, or please configure the install script).
``` 
Once you have downloaded all the source open .env in the main root directory and modify it accordingly by 
adding the sites & database information.
## Using Assessment-MVC
To use Assessment-MVC all you need is to access one of the following routes:
```
/
(get) /users
(get) /user/{id}

NOTE: content-type must be JSON for all post
(post) /user/create
(post) /user/update/{id}
(post) /user/delete

Example: http://testbox.test/users (gets all users)
Example: http://testbox.test/user/1 (gets a specific user)
```
You can use AMVC with the following tools: postman, insomnia, or a browser to access any route.
 ## Using POSTMAN
 A Postman import file "AssessmentMVC.postman_collection.json" contains a collection of routes for you to use.
