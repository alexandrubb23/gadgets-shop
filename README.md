
# Gadgets Shopp

A small **osCommerce** gadgets application according to the request. This app is fully **OOP** and is **PSR2** compliant.

## Used Design Pattern

* AutoloadRegister
* Controller
* Route
* Facade

## Software needed in order to run the app

* [Nginx](https://www.nginx.com/) or [Apache](https://httpd.apache.org/)
* [PHP](http://php.net/docs.php) - 7.0.x
* [MySQL](https://www.mysql.com/)
* [PHP Composer](https://getcomposer.org/)

## Getting Started

In order to fetch the project on your local machine run the following command:

```
git init <project directory>
```

Cloning repository

```
git clone https://github.com/alexandrubb23/gadgets-shopp.git
```

### Prerequisites

Open your "cli" and run to install application dependencies, as follow:

```
composer install
```

* [Twig Symfony](https://twig.symfony.com/) - will be installed.

## Running application

### Doker

In order to run application inside a container run the following command:

```
docker build -t gadgets
```

```
docker run -p 3000:3000 gadgets
```

* **Access application in your browser** - http://localhost:3000


### Vagrant

You can use Homestead from Laravel Framework

* [Laravel](https://laravel.com/docs/5.6/homestead) - Homestead

**Please note that** - You should edit Homestead.yaml with your settings (e.g vhost; php version; etc.)

* **Access application in your browser** - http://yourdomain.com

## Authors

* **Alexandru Barbulescu** - [Alexandrubb23](https://github.com/alexandrubb23)



