#!/bin/bash
timestamp() {
  date +"%Y-%m-%d %H:%M:%S"
}
archive="/var/www/laravel/laravel/public/geoportal/Archive"
file=$1
extension=${file##*.}
if [[ $extension = "tif" ]]
then
	table="archive"
	cd $archive
	gdalwarp -dstalpha -srcnodata 0 $1 $archive/tmp/warp.tif
	gdal_polygonize.py -b 2 $archive/tmp/warp.tif -f "ESRI Shapefile" $archive/tmp/output.shp
	destination="$archive/tmp/output.shp"
	ogrinfo $destination -sql "ALTER TABLE output ADD COLUMN imgname VARCHAR"
	ogrinfo $destination -dialect SQLite -sql "UPDATE output SET imgname='$file'"
        ogrinfo $destination -sql "ALTER TABLE output ADD COLUMN time DATETIMESTAMP"
        ogrinfo $destination -dialect SQLite -sql "UPDATE output SET time='$(timestamp)'"
	ogr2ogr -append -f "PostgreSQL" PG:"host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade" $destination -t_srs "EPSG:3857" -nlt geometry -nln $table
	PGPASSWORD=blockade psql -U admin_kvp -d kvp -h 192.168.255.140 -c "UPDATE archive SET geometry = ST_Collect(ARRAY(SELECT geometry FROM archive WHERE imgname='$file')) WHERE id =(SELECT max(id) FROM archive);"
	PGPASSWORD=blockade psql -U admin_kvp -d kvp -h 192.168.255.140 -c "DELETE FROM archive WHERE id NOT IN(SELECT max(id) FROM archive) AND id IN (SELECT id FROM archive WHERE imgname='$file');"
	rm $archive/tmp/warp.tif
	rm $archive/tmp/warp.tif.aux.xml
	rm $archive/tmp/output.shp
	rm $archive/tmp/output.shx
	rm $archive/tmp/output.dbf
	rm $archive/tmp/output.prj
fi
