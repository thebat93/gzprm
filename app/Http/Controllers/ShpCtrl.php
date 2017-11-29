<?php
namespace App\Http\Controllers;
use App\Http\Requests;
//use Illuminate\Http\Request;
use Auth;
use File;
use SSH;
use DB;
use Storage;
use App\Order;
use App\GeoserverWrapper;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class ShpCtrl extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
  public function getname(Request $request)
  {
$url = $request->url();
$name = $request->input('name');
$username = $request->old('name');
$value = $request->cookie('name');
//$name = Request::input('name');
//$name = $request->input('name');
    return ($value);
  }
  
    public function getshp(Request $request)
    {
        //$user=Auth::user()->email;
        $gsrv=public_path('geoportal');//"/var/www/laravel/laravel/public/geoportal";
        //$date = date("Y.m.d");
        $order = new Order;
        $order->state = 2;
        $order->satellite = $request->input('satellite');
        $order->start_time = $request->input('start_time');
        $order->end_time = $request->input('end_time');
        $order->angle_sun = $request->input('angle_sun');
        $order->angle_nadir = $request->input('angle_nadir');
        $order->cloud = $request->input('cloud');
        $order->level = $request->input('level');
        $order->user_id = Auth::user()->id;
        $order->save();
        $id = $order->id;
        Storage::MakeDirectory("Orders/$id");
        //Пишем строку геоджейсон
        $text = $request->input('geojsonStr');
        //$dir = "$gsrv/Orders/$id";//"geoportal/$user";
        //$file_path="$dir/$id.geojson";
        Storage::put("Orders/$id/$id.geojson", $text);
        $destination = "$gsrv/Orders/$id";
        //Запускаем bash-скрипт
        $commands = [
            "gsrv='$gsrv'",
            "id='$id'",
            "table='ordersgeometry'",
            'path="$gsrv/Orders/$id/$id.geojson"',
            'destination="$gsrv/Orders/$id/$id.shp"',
            'echo pcevj | sudo -S ogr2ogr -f "ESRI Shapefile" $destination $path',
            'echo pcevj | sudo -S ogr2ogr -append -overwrite -f "PostgreSQL" PG:"host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade" $destination -t_srs "EPSG:4326" -nlt GEOMETRY -nln $table'
        ];
        SSH::run($commands, function( $line ) {
        // display output of command, by line
        //echo $line;
        } );
        $query = "UPDATE ordersgeometry SET wkb_geometry = ST_Collect(ARRAY(SELECT wkb_geometry from ordersgeometry )) where ogc_fid =(SELECT max(ogc_fid) FROM ordersgeometry);";
        DB::update($query);
        $query = "DELETE FROM ordersgeometry WHERE ogc_fid !=(SELECT max(ogc_fid) FROM ordersgeometry);";
        DB::delete($query);
        Storage::delete("Orders/$id/$id.geojson");
        $area = DB::table('ordersgeometry')->first();
        //$order->area = $area->measuretoo;
        DB::table('orders')->where('id', $id)->update(['geometry' => $area->wkb_geometry,'link' => $destination]);
        
        $order = Order::orderBy('created_at', 'desc')->first();
        $ordername = "KUP/out/$order->id.txt";
        $contents = "ID: $order->id\n
ARCHIVE: NO\n
USER ID: $order->user_id\n
GEOMETRY: $order->geometry\n
START TIME: $order->start_time\n
END TIME: $order->end_time\n
ANGLE SUN: $order->angle_sun\n
ANGLE NADIR: $order->angle_nadir\n
CLOUD: $order->cloud\n
LEVEL: $order->level\n
CREATED AT: $order->created_at\n";
        Storage::put($ordername, $contents);

        Storage::copy("Orders/$id/$id.shp", "KUP/out/$id.shp");
        Storage::copy("Orders/$id/$id.dbf", "KUP/out/$id.dbf");
        Storage::copy("Orders/$id/$id.prj", "KUP/out/$id.prj");
        Storage::copy("Orders/$id/$id.shx", "KUP/out/$id.shx");
        
        //Сделать редирект
        //$request->session()->flash('alert-success', 'Заказ упешно создан!');
        //return view('geoportal');
        //return redirect('/');
        //return redirect('/')->withSuccessMessage('Заказ упешно создан!');
        //return redirect()->to('/')->with('status', 'Заказ упешно создан!');
//$text = $_POST['geojsonStr'];
//        //Создаем папку пользователя если она не существует
        //if(!is_dir($dir)) mkdir($dir); 
        //        //$fp = fopen($file_path, "w");
        //fwrite($fp, $text);
        //fclose($fp);
        //mkdir("$dir/$date");
        //        //$run = app_path() . "/Libraries/getshp.sh $date $user";
        //                //exec($run);
//        $dbconn = pg_connect("host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade");
//        //Добавляем линк
//        $query = "UPDATE orders SET link='$destination' WHERE id IN(SELECT max(id) FROM orders);";
//        pg_query($query);
//        //Добавляем в параметры имя пользователя
//        $query = "UPDATE orders SET name='$user' WHERE id IN(SELECT max(id) FROM orders);";
//        pg_query($query);
//        //Объединяем строки если фигур было несколько
//        // $query = "UPDATE order_$user SET geometry = ST_Collect(ARRAY(SELECT geometry from order_$user where link is null OR id = (SELECT max(id) from order_$user))) where id =(SELECT max(id) FROM order_$user);";
//        // pg_query($query);
//        // //Удаляем лишние строки
//        // $query = "DELETE FROM order_$user WHERE link is NULL;";
//        $query = "UPDATE orders SET geometry = ST_Collect(ARRAY(SELECT geometry from orders where link is null OR id = (SELECT max(id) from orders))) where id =(SELECT max(id) FROM orders);";
//        pg_query($query);
//        //Удаляем лишние строки
//        $query = "DELETE FROM orders WHERE link is NULL;";
//        pg_query($query);
//        /*$query = "SELECT max(id) FROM order_$user;";
//        $result = pg_query($query);
//        $val = pg_fetch_all($result);
//        $number=$val[0]['max'];
//        */
//        pg_close($dbconn);
        //$geoserver->createPostGISDataStore('order_igor', 'users', 'kvp', 'admin_kvp', 'blockade', 'localhost', '5432'); 
        //$geoserver->createLayerSRS('order_igor', 'users', 'EPSG:3857', 'order_igor');
        //$run = app_path() . "/changestyle.sh $user";
        //exec($run);*/
    }
    
    public function upshp(Request $request)
    {
    $user=Auth::user()->email;
    $gsrv=public_path('geoportal');
    $date = date("Y.m.d_H:i:s");
    Storage::MakeDirectory("$user/$date");
    if ($request->hasFile('file')) {
        if ($request->file('file')->isValid()) {
                echo "Файл загружен";
                //$dir = "geoportal/$user";
                //Создаем папку пользователя если она не существует
//                if (!is_dir($dir))
//                    mkdir($dir);
//                mkdir("$dir/$date");
                $file = $request->file('file');
                $file->move("geoportal/$user/$date", "usrshp.zip");
                $destination = "$gsrv/$user/$date";
                //$run = app_path() . "/Libraries/upshp.sh $date $user";
                //exec($run);
                $commands = [
                    "gsrv='$gsrv'",
                    "table='ordersgeometry'",
                    "cd '$destination'",
                    "7z x usrshp.zip",
                    "rm '$destination'/usrshp.zip",
                    "a=`find *.shp`",
                    'c="'.$destination.'/$a"',
                    'echo pcevj | sudo -S ogr2ogr -append -overwrite -f "PostgreSQL" PG:"host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade" $c -t_srs "EPSG:4326" -nlt GEOMETRY -nln $table'
                    ];
                SSH::run($commands);
                //$dbconn = pg_connect("host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade");
                //$query = "UPDATE orders SET link='$destination' WHERE id IN(SELECT max(id) FROM orders);";
                //pg_query($query);
                //$query = "UPDATE orders SET name='$user' WHERE id IN(SELECT max(id) FROM orders);";
                //pg_query($query);
//Объединяем строки если фигур было несколько
                //$query = "UPDATE orders SET geometry = ST_Collect(ARRAY(SELECT geometry from orders where link is null OR id = (SELECT max(id) from orders))) where id =(SELECT max(id) FROM orders);";
                //pg_query($query);
//Удаляем лишние строки
                //$query = "DELETE FROM orders WHERE link is NULL;";
                //pg_query($query);
                //pg_close($dbconn);
                $query = "UPDATE ordersgeometry SET wkb_geometry = ST_Collect(ARRAY(SELECT wkb_geometry from ordersgeometry )) where ogc_fid =(SELECT max(ogc_fid) FROM ordersgeometry);";
                DB::update($query);
                $query = "DELETE FROM ordersgeometry WHERE ogc_fid !=(SELECT max(ogc_fid) FROM ordersgeometry);";
                DB::delete($query);
                $area = DB::table('ordersgeometry')->first();
                $order = new Order;
                $order->state = 2;
                $order->link = $destination;
                $order->user_id = Auth::user()->id;
                $order->geometry = $area->wkb_geometry;
                $order->save();
            }
    }
    }

    public function intersect(Request $request)
    {
        $text = $request->input('geojsonStr');
        $startdate = $request->input('startdate');
        $enddate = $request->input('enddate');
        $dbconn = pg_connect("host=192.168.255.140 dbname=kvp user=admin_kvp password=blockade");
        $query = "CREATE TEMP TABLE gjson(location json, geom geometry);";
        pg_query($query);
        $query = "INSERT INTO gjson VALUES('$text');";
        pg_query($query);
        $query = "UPDATE gjson SET geom =(
        WITH data AS (SELECT gjson.location::json AS fc FROM gjson )
        SELECT ST_GeomFromGeoJSON(feat->>'geometry')
        FROM (SELECT json_array_elements(fc->'features') AS feat FROM data)   
        AS f);";
        pg_query($query);
        if (isset($startdate) AND isset($enddate)) {
        $query = "SELECT p.id FROM archive AS p, gjson AS n WHERE ST_Intersects(ST_SetSRID(p.geometry,4326), ST_SetSRID(n.geom,4326)) AND time >= '$startdate' AND time <= '$enddate';";
        }
        else {
        $query = "SELECT p.id FROM archive AS p, gjson AS n WHERE ST_Intersects(ST_SetSRID(p.geometry,4326), ST_SetSRID(n.geom,4326));";    
        }
        $result = pg_query($query);
        $val = pg_fetch_all($result);
        pg_close($dbconn);
        echo json_encode($val);
    }

    public function getusrlayer () {
        $user=Auth::user()->id;
        $url="http://192.168.255.140:8080/geoserver/ows?service=WFS&request=GetFeature&version=1.1.0&typeName=users:orders&Filter=<Filter><PropertyIsEqualTo><PropertyName>user_id</PropertyName><Literal>$user</Literal></PropertyIsEqualTo></Filter>&outputFormat=json";
        $result = file_get_contents($url);
        echo $result;
    }
        public function gettiffs()
    {
//        $geoserver = new GeoserverWrapper('http://192.168.255.140:8080/geoserver/','admin', 'geoserver');
//        $layers=$geoserver->listAllLayers();
//        $allLayers="";
//        foreach ($layers->layers->layer as $value) {
//   
//            if ($value->name == 'archive' || $value->name == 'orders'){
//            }else{
//            $allLayers=$allLayers.'users:'.$value->name.',';
//            }
//
//            }
//            $allLayers=substr($allLayers, 0, -1);
//            echo "'".$allLayers."'";
            $url = "http://admin:geoserver@192.168.255.140:8080/geoserver/rest/layers.json";

$result = file_get_contents($url);
$result = json_decode($result, true);

        $allLayers="";
        foreach ($result['layers']['layer'] as $value) {
            if ($value['name'] == 'archive' || $value['name'] == 'orders'){
            }
            else
                {
            $allLayers=$allLayers.'users:'.$value['name'].',';
            }

            }
            $allLayers=substr($allLayers, 0, -1);
            echo $allLayers;
            //echo "'".$allLayers."'";
    }
}
