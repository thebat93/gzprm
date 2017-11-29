#!/bin/bash
gsrv="/var/www/laravel/laravel/public/geoportal"
user=$2
table="orders"
path="$gsrv/$user/$user.geojson"
destination="$gsrv/$user/$1/usrshp.shp"
ogr2ogr -f "ESRI Shapefile" $destination $path
ogr2ogr -append -f "PostgreSQL" PG:"host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade" $destination -t_srs "EPSG:4326" -nlt POLYGON -nln $table

