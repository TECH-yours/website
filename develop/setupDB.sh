#!/bin/bash
php artisan migrate:refresh
php artisan db:seed --class="RefAllgericSeeder"
php artisan db:seed --class="RefCategorySeeder"
php artisan db:seed --class="restaurantSeeder"
php artisan db:seed --class="MealsSeeder"
php artisan db:seed --class="AllgericSeeder"