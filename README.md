# API Service Course w/ Laravel

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Installing

Clone the Repository and run

```sh
$ composer install
$ ./env-generator
$ php artisan key:generate
$ php artisan serve
```

Create database dbcourse and run

```sh
$ php artisan migrate
```

## Deployment

Preparation login into your server first, and then clone repo and run 

```sh
$ composer install
$ ./env-generator-prod.sh
$ php artisan key:generate
$ sudo chown -R $USER:www-data storage
$ sudo chown -R $USER:www-data bootstrap/cache
$ chmod -R 775 storage
$ chmod -R 775 bootstrap/cache
$ sudo chmod 777 deploy.sh
```

And already set! Deploy or CD (continues delivery) simply run from local development

```sh
$ git add .
$ git commit -m "commit message"
$ git push origin master
```

### API Doc

Instructions on how to use them in your own application.

| Function | Method | Endpoint |
| ------ | ------ | ------ |
| Add Mentor | POST | api-service-course.cowik.tech/api/mentors |
| Update Mentor | PUT | api-service-course.cowik.tech/api/mentors/:id |
| Get List Mentor | GET | api-service-course.cowik.tech/api/mentors |
| Get Mentor | GET | api-service-course.cowik.tech/api/mentors/:id |
| Delete Mentor | DELETE | api-service-course.cowik.tech/api/mentors/:id |
| Add Course | POST | api-service-course.cowik.tech/api/courses |
| Update Course | PUT | api-service-course.cowik.tech/api/courses |
| Get List Course | GET | api-service-course.cowik.tech/api/courses |
| Get Course | GET | api-service-course.cowik.tech/api/courses/:id |
| Delete Course | DELETE | api-service-course.cowik.tech/api/courses/:id |
| Add Chapter | POST | api-service-course.cowik.tech/api/chapters |
| Update Chapter | PUT | api-service-course.cowik.tech/api/chapters/:id |
| Get List Chapter | GET | api-service-course.cowik.tech/api/chapters |
| Get Chapter | GET | api-service-course.cowik.tech/api/chapters/:id |
| Delete Chapter | DELETE | api-service-course.cowik.tech/api/chapters/:id |
| Add Lesson | POST | api-service-course.cowik.tech/api/lessons |
| Update Lesson | PUT | api-service-course.cowik.tech/api/lessons/:id |
| Get List Lesson | GET | api-service-course.cowik.tech/api/lessons |
| Get Lesosn | GET | api-service-course.cowik.tech/api/lessons/:id |
| Delete Lesson | DELETE | api-service-course.cowik.tech/api/lessons/:id |
| Add Image Course | POST | api-service-course.cowik.tech/api/imagecourses |
| Delete Image Course | DELETE | api-service-course.cowik.tech/api/imagecourses/:id |
| Add My Course | POST | api-service-course.cowik.tech/api/mycourses |
| Add My Course Premium | POST | api-service-course.cowik.tech/api/mycourses/premium |
| Get List My Course | GET | api-service-course.cowik.tech/api/mycourses |
| Add Review | POST | api-service-course.cowik.tech/api/reviews |
| Update Review | PUT | api-service-course.cowik.tech/api/reviews/:id |
| Delete Review | DELETE | api-service-course.cowik.tech/api/reviews/:id |

## Depedencies

- [Laravel 7](https://laravel.com/docs/7.x)
- [PostgreSql](https://www.postgresql.org/)
- [PHP 7.4](https://www.php.net/releases/7_4_0.php)
- [Github Action](https://docs.github.com/en/actions)
- [Google Cloud Platform](https://cloud.google.com/)