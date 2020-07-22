## About
Assessment-MVC is a small PHP MVC Framework developed as a fun assessment. 
I personally might just continue adding to it after.

## Requirements
- PHP 7.4 
- Composer 
- MariaDB
- Apache
## Installation
You can download the Assessment-MVC source directly from Git clone:
```
cd /var/www/html
git clone https://github.com/xlordt/Assessment-MVC.git
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

Example: http://mylocalprojects-fs.com/users (gets all users)
Example: http://mylocalprojects-fs.com/user/1 (gets a specific user)
```
You can use AMVC with the following tools: postman, insomnia, or a browser to access any route.

A Postman import file "AssessmentMVC.postman_collection.json" has been added to the project for testing.

