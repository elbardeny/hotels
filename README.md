## Overview
This is a restfull application to manage hotels through authenticated apis for basic crud operations

## Requirements
Docker and Docker-compose.

## Installation
- clone the project
- docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v $(pwd):/var/www/html \
  -w /var/www/html \
  laravelsail/php83-composer:latest \
  composer install --ignore-platform-reqs
- cp .env.example .env
- vendor/bin/sail sail up
- vendor/bin/sail migrate
- vendor/bin/sail db:seed

## Running the project
use these test credentials 
email : john_doe@test.com
password : 123456

for the login api and retrieve the token then use it in all the hotels apis in this postman collection :
[Postman Collection](https://api.postman.com/collections/5581934-d6b735fa-7585-4c36-9526-ce710c47ff49?access_key=PMAT-01HYANEV5X6192ENKVXVE01RCT)

## Feature Test
vendor/bin/sail test 
