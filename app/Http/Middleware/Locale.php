<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Config;
//use Illuminate\Support\Facades\Session;
use Session;

class Locale {
    public function handle($request, Closure $next)
    {

//        if(!Session::has('locale'))
//        {
//           Session::put('locale', Config::get('app.locale'));
//        }

       // App::setLocale(Session::get('locale'));

      //  return $next($request);

        $raw_locale = Session::get('locale');     # Если пользователь уже был на нашем сайте, 
                                                  # то в сессии будет значение выбранного им языка.
	$txt=Session::get('locale');
        if (in_array($raw_locale, Config::get('app.locales'))) {  # Проверяем, что у пользователя в сессии установлен доступный язык 
           $locale = $raw_locale;                                # (а не кака-ибудь бяка) 
        }                                                         # И присваиваем значение переменной $locale.
        else $locale = Config::get('app.locale');                 # В ином случае присваиваем ей язык по умолчанию

	App::setLocale($locale);                                  # Устанавливаем локаль приложения
        return $next($request);                                   # И позволяем приложению работать дальше
    }
}
