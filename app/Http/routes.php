<?php
//use Request;
//use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
//use App;
use App\Http\Controllers;
use App\Order;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::group(['middleware' => ['web']], function () {
Route::auth();
Route::group(['middleware' => ['auth']], function () {
	Route::get('/', function() {
	        $user = Auth::user();
        	$orders=$user->orders;
		$locale = App::getLocale();
		foreach ($orders as $order){
		switch ($order->state) {
                case 3:
		    $order->state="Доступно для скачивания";
                    break;
                case 2:
		    $order->state="Определяется возможность съемки";
                    break;
                case 1:
	            $order->state="Съемка невозможна";
                    break;
		}
		}
		return view('geoportal', ['user' => $user,'locale' => $locale, 'orders' => $orders]);
	})->name('home');
	Route::get('/checkout', 'CartController@checkout');
	Route::get('/orders', 'OrderController@index');
	Route::get('order/{orderId}', 'OrderController@viewOrder');
	Route::get('download/{image}', 'HomeController@download');
	Route::post('/getshp', 'ShpCtrl@getshp');
	Route::post('/upshp', 'ShpCtrl@upshp');
	Route::post('/intersect', 'ShpCtrl@intersect');
	Route::post('/fillcoords','HomeController@fillcoords');
	Route::get('/getinfo/{id}','HomeController@getinfo');
	Route::get('/entrcoords','HomeController@entrcoords');
	Route::get('/shownum','CartController@shownum');
	Route::get('/gettiffs','ShpCtrl@gettiffs');
	Route::get('/getusrlayer','ShpCtrl@getusrlayer');
	Route::get('/test','HomeController@test');
//$sd = DB::table('archive')->where('id', '=', $id)->first();
//return view('modalinfo', ['sd' => $sd])->render();
//});
/*        Route::get('/link',function() {
	  return response()->json(['name' => 'Abigail', 'state' => 'CA']);
	});*/    
    //Корзина
    Route::resource('shop', 'ProductController', ['only' => ['index', 'show']]);
    Route::post('/cart/{id}','CartController@update');
    Route::resource('cart', 'CartController');
    Route::delete('emptyCart', 'CartController@emptyCart');
    ////////////////////////////////////////////////////////////////////
	});
    //Смена языка
    Route::get('setlocale/{locale}', function ($locale) {
    		if (in_array($locale, \Config::get('app.locales'))) {
    			Session::put('locale', $locale);
		}
		return redirect()->back();
		});

//});
