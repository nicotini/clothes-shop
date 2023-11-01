<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Setup a project
1. Clone clothes-shop repo for this project locally (using SSH git@github.com:nicotini/clothes-shop.git)
2. Install Composer Dependencies
3. Create an empty database for our application
4. In the .env file, add database information to allow Laravel to connect to the database
5. Migrate the database
6. Seed the database

This is a part of a e-commerce app developed using php framework Laravel. I developed a catalog, a cart and orders for this app. Then I implemented json api for it. The catalog consists of category trees (nesting 3) and products. Product has the following fields: name, desc, slug, category_id, price, quantity. The product attributes have their own table. And I implemented  dynamic filters with these product attributes.

Both authorized and unauthorized users can interact with the cart and place orders. The orders have to contain the customer's contact info, as well as a list of purchased items.For authorized users, contact information should be pulled from the profile automatically. The API support the Sanctum authrization.
The API documentation.

