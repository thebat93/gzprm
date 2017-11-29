#!/bin/bash
file=$1
extension=${file##*.}
if [[ $extension = "txt" ]]
then
	cd /var/www/laravel/laravel/public/geoportal/KUP/in
	value=$(<$file)
	cd /var/www/laravel/laravel/
	php artisan kupresponse --content="$value"
 	cd /var/www/laravel/laravel/public/geoportal/KUP/in
	rm $file
fi

