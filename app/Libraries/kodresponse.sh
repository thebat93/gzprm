#!/bin/bash
file=$1
extension=${file##*.}
if [[ $extension = "txt" ]]
then
	cd /var/www/laravel/laravel/public/geoportal/KOD/in
	value=$(<$file)
	cd /var/www/laravel/laravel/
	php artisan kodresponse --content="$value"
 	cd /var/www/laravel/laravel/public/geoportal/KOD/in
	rm $file
fi

