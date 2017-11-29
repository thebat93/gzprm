<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use DB;
use App\Product;
use App\Order;
use App\User;
use Auth;
use Session;
use Storage;

class HomeController extends Controller
{
public function __construct()
{
//  $this->middleware('auth');
}
public function geo()
{
return view('geoportal');
}

public function home()
    {
    return view('geoportal');
    }

public function cart() {
	return redirect('shop');
	}
        
    public function download($id)
    {
        $id_snapshot = Order::where('id', $id)->firstOrFail()->id_snapshot;
        $product = Product::where('id', $id_snapshot)->firstOrFail();
        $filename = $product->imgname;
    	$myFile = public_path("geoportal/Archive/$filename");
    	return response()->download($myFile);

    }
    
// ТЕСТОВАЯ ФУНКЦИЯ КОНТРОЛЛЕРА //////////////////////////////
public function test (Request $request) {

    $user = User::find(3);

$order = Order::find(34);
//echo $order->created_at;
//echo $order->user->name;

echo $user->orders;
//$orders=$user->orders;
//echo $orders->where('id', 34)->first()->created_at;

////foreach ($orders as $order) {
//    echo $order;
//}


    
//
//                $dbconn = pg_connect("host=192.168.255.193 dbname=postgres user=zsumo password=pcevj");
//        $query = 'SELECT id, id_firepoint, center_f_x, center_f_y FROM threat_own';  
//        $result = pg_query($query);
//        $val = pg_fetch_all($result);
//        pg_close($dbconn);
//        return $val[0]['id'];
    
    
    
//function getimg ($width,$height,$bbox,$output) {
//    $arrContextOptions=array(
//    "ssl"=>array(
//        "verify_peer"=>false,
//        "verify_peer_name"=>false,
//    ),
//);
//$input = "https://fire-rs.gazprom-spacesystems.ru/proxy_gazcom_rs/geoserver/GSS/wms?LAYERS=GSS:Russia,GSS:zone_notif,GSS:tube,GSS:firepoint_group&TRANSPARENT=false&format=image/png&SERVICE=WMS&VERSION=1.1.1&REQUEST=GetMap&SRS=EPSG:3857&BBOX=$bbox&WIDTH=$width&HEIGHT=$height";
//file_put_contents($output, file_get_contents($input, false, stream_context_create($arrContextOptions)));
//}
//$width='900';
//$height='600';
//$bbox='5635549.220625,7514065.6275,6261721.35625,8140237.763125';
//$path='/var/www/laravel/laravel/public/';
//$filename='map.jpg';
//$output = $path.$filename;
//getimg($width,$height,$bbox,$output);

////$url = "http://admin:geoserver@192.168.255.140:8080/geoserver/rest/layers.json";
//$url="http://192.168.255.140:8080/geoserver/ows?service=WFS&request=GetFeature&version=1.1.0&typeName=users:orders&Filter=<Filter><PropertyIsEqualTo><PropertyName>user_id</PropertyName><Literal>3</Literal></PropertyIsEqualTo></Filter>&outputFormat=json";
////$ch = curl_init($url);
//////curl_setopt($ch, CURLOPT_URL,$url);
//////curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);   
////$result = curl_exec($ch);  
////curl_close($ch);
//////var_dump(json_decode($result, true));
//$result = file_get_contents($url);
////$result = json_decode($result, true);
////echo $result;
////$result=json_encode($result);
//echo $result;
//print_r( json_decode($result));
//        $allLayers="";
//        foreach ($result['layers']['layer'] as $value) {
//   
//            //echo $value['name'];
//
//            if ($value['name'] == 'archive' || $value['name'] == 'orders'){
//            }
//            else
//                {
//            $allLayers=$allLayers.'users:'.$value['name'].',';
//            }
//
//            }
//            $allLayers=substr($allLayers, 0, -1);
//            echo "'".$allLayers."'";
//$orders = Order::all();
//        $areas = DB::table('ordersgeometry')->first();
//        echo $areas->measuretoo;
//        foreach ($areas as $area) {
//        echo $area->meausuretoo;
//        echo $area->wkb_geometry;
//}
		//$user=Auth::user();
                //$orders = Order::where('user_id', '=', $user->id)->get();
                
    //print_r($orders);
//    $request->session()->put('key', 'value');
//    $data = $request->session()->all();
//    print_r($data);
//    $value = $request->session()->get('old');
    //$request->session()->flash('alert-success', 'User was successful added!');
    //return $value;
    //return view("/welcome");

            //$imgname = DB::table('archive')->where('id', '91')->value('imgname');
//echo $imgname;
//foreach ($orders as $order) {
//    echo $order->id;
//}
//print_r($orders);
//        $folder = '222222';
//        echo $folder;
//        $contents='123';
//        //Storage::MakeDirectory('test');
//        //Storage::put('test/file.txt', $contents);
//        $date = date("Y.m.d_H:i:s");
//        Storage::MakeDirectory("$folder/$contents");
//        echo public_path('geoportal');
}
//////////////////////////////////////////////////////////////
//public function getinfo($id) {
//$sd = DB::table('archive')->where('id', '=', $id)->first();
//return view('modalinfo', ['sd' => $sd])->render();
//}
    public function getinfo($id)
    {
        $product = Product::where('id', $id)->firstOrFail();
        //return $product->slug;//
	return view('modalinfo')->with(['product' => $product]);
    }
    
    public function entrcoords()
    {
	return view('modalcoords');
    }

    public function fillcoords(Request $request)
    {
	$array = $request->all();
	$num = count($array)-1;
	$num = $num/2;
	for ($i=1;$i<=$num;$i++) {
	$long="long".$i;
	$lat="lat".$i;
	$coords[$i] = $array[$long].", ".$array[$lat];
	}
	$array="ARRAY[";
	for ($i=1;$i<=$num;$i++){
	$array=$array."ST_SetSRID(ST_MakePoint(".$coords[$i]."),4326),";
	}
	$array = substr($array, 0, -1);
	$array = $array."]";
	$query = "INSERT INTO orders (geometry) VALUES (ST_MakePolygon(ST_MakeLine(".$array.")))";
	DB::insert($query);
    }



}
