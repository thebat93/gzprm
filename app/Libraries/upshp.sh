#!/bin/bash
gsrv="/var/www/laravel/laravel/public/geoportal"
cd $gsrv/$2/$1
7z x usrshp.zip
rm $gsrv/$2/$1/usrshp.zip
a=`find *.shp`
c="$gsrv/$2/$1/$a"
ogr2ogr -append -f "PostgreSQL" PG:"host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade" $c -t_srs "EPSG:4326" -nlt MULTIPOLYGON -nln orders
