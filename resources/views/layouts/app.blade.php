<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Газпром Космические Системы @yield('title')</title>

    <!-- Fonts -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">-->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">-->
      
    <!-- Styles -->
    <link href="css/ol.css" rel="stylesheet">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.1.1/ol.css" type="text/css">-->
    <!-- <link href="css/ol3gm.css" rel="stylesheet">-->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet">-->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/ol3-layerswitcher.css">-->
    <!--<link href="css/ol3-geocoder.css" rel="stylesheet">--><link href="//cdn.jsdelivr.net/openlayers.geocoder/latest/ol3-geocoder.min.css" rel="stylesheet">
    <!--<link href="css/controlbar.css" rel="stylesheet">-->
    <!-- <link rel="stylesheet" href="css/ol3-sidebar.css">-->
    <!-- <link rel="stylesheet" href="css/ol3-loadingpanel.css">-->
    <link href="//cdn.jsdelivr.net/openlayers.contextmenu/latest/ol3-contextmenu.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
             
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- <script src="js/bootstrap.min.js"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyBuB_lMHU58mDPchdE3Y40RggBHUXaf6iU"></script>-->
    <!-- <script src="js/ol3gm.js"></script>-->
    <script src="js/ol.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.1.1/ol.js"></script>-->
    <script src="js/ol3-layerswitcher.js"></script>
    <!--<script src="js/ol3-geocoder.js"></script>-->  <script src="//cdn.jsdelivr.net/openlayers.geocoder/latest/ol3-geocoder.js"></script>
    <script src="//cdn.jsdelivr.net/openlayers.contextmenu/latest/ol3-contextmenu.js"></script>
    <!--<script src="js/transforminteraction.js"></script>-->
    <!--<script src="js/buttoncontrol.js"></script>-->
    <!--<script src="js/controlbar.js"></script>-->
    <!-- <script src="js/ol3-sidebar.min.js"></script>-->
    <!-- <script src="js/ol3-loadingpanel.js"></script>-->
    <!--<script src="js/togglecontrol.js"></script>-->
    <script src="http://momentjs.com/downloads/moment-with-locales.js"></script>
    <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>

    <style>
.activepanel {
    display:block;         
    }
html, body {
height: 100%;
}#map {
    height: 90%;
}
.nonactivepanel {
    display:none;         
    }
.spinner {
  width: 100px;
}
.spinner input {
  text-align: right;
}
.input-group-btn-vertical {
  position: relative;
  white-space: nowrap;
  width: 1%;
  vertical-align: middle;
  display: table-cell;
}
.input-group-btn-vertical > .btn {
  display: block;
  float: none;
  width: 100%;
  max-width: 100%;
  padding: 8px;
  margin-left: -1px;
  position: relative;
  border-radius: 0;
}
.input-group-btn-vertical > .btn:first-child {
  border-top-right-radius: 4px;
}
.input-group-btn-vertical > .btn:last-child {
  margin-top: -2px;
  border-bottom-right-radius: 4px;
}
.input-group-btn-vertical i{
  position: absolute;
  top: 0;
  left: 4px;
}
.navbtn {
	font-size:30px;
	cursor:pointer;
	position:relative;
	top:90px;
	z-index:1;
	color: #000000;
 	left:10px;
	padding: 5px;
	}

.sidenav {
    min-height:60%;
    max-height:85%;/*height: 100%;*/ /* 100% Full-height */
    width: 0; /* 0 width - change this with JavaScript */
    position: fixed; /* Stay in place */
    z-index: 2; /* Stay on top */
    top: 120px;
    left: 10px;
    background-color: #FFFFFF; /* white*/
    overflow-x: hidden; /* Disable horizontal scroll */
    padding-top: 20px; /* Place content 60px from the top */
    transition: width 0.5s ease; /* 0.5 second transition effect to slide in the sidenav */
}

.nav li, a#ProductInfo, a#eyebtn, a#add2cartbtn{
cursor: pointer;
}

/* The navigation menu links */
.sidenav a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 15px;
    color: #818181;
    display: block;
    transition: 0.3s
}

/* When you mouse over the navigation links, change their color */
.sidenav a:hover, .offcanvas a:focus{
    color: #000000;
}

/* Position and style the close button (top right corner) */
.sidenav .closebtn {
    position: absolute;
    top: 0;
    right: 15px;
    font-size: 36px;
    margin-left: 50px;
}

  .navbar-nav a {
padding-top: 25px !important;
  }

.nav-tabs {
font-size:15px;
}

.tab-content{
padding: 5px;
}
/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
/*#main {
    transition: margin-left .5s;
    padding: 20px;
}*/

   .shadow {
    background: #FFFFFF; /* Цвет фона */
    box-shadow: 0 0 5px rgba(0,0,0,0.5); /* Параметры тени */

   }

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
        /*#myPopoverContent {display: none;}*/

body {
     font-family: 'FontAwesome','Roboto','Lato';
	}

.ol-control button{
	width: 30px !important;
	height: 30px !important;
}

.gcd-txt-container,
.gcd-txt-control {
	left:5px !important; 
	height:2.5em !important;
	width:15em !important;
}

.gcd-txt-result {
    top:3em !important;
    z-index:3 !important;
}

.fa-btn {
margin-right: 6px;
}

.sidebar.collapsed{
    top: 70px;
    }

.navbar-inner {
    /*height: 90px*/
    /*min-height: 90px*/
    }

.layer-switcher.shown.ol-control:hover {
    background-color: transparent;
}

.ol-zoom {
     left: unset;
     right: 8px;
     top: 60px;
}

.ol-zoom .ol-zoom-out {
  margin-top: 204px;
}

.ol-zoomslider {
  background-color: transparent;
  top: 2.3em;
  left: unset;
  right: 8px;
  top: 93px;
}

.ol-touch .ol-zoom .ol-zoom-out { 
  margin-top: 212px;
}
.ol-touch .ol-zoomslider {
  top: 2.75em;
}

.ol-zoom-in.ol-has-tooltip:hover [role=tooltip],
.ol-zoom-in.ol-has-tooltip:focus [role=tooltip] {
  top: 3px;
}

.ol-zoom-out.ol-has-tooltip:hover [role=tooltip],
.ol-zoom-out.ol-has-tooltip:focus [role=tooltip] {
  top: 232px;
}

/*
.ol-zoom {
    position: absolute;
    bottom: 2em; 
    height: 20em;
    right: 0.5em;
    left: auto;
    top: auto;
}

.ol-zoom-in {
    position: relative;
    top: -280px; 


}

.ol-zoom-out {
    position: relative;
    top: -73px; 
}

.ol-zoomslider {
        right: 0.7em;
        left:auto;
        width:30px;
        bottom: auto; 
        top: 6.5em;
        background-color: rgba(0, 60, 136, .4);
    }

.ol-zoomslider button {
    right: 0.2em;
    }

.ol-zoomslider-thumb {
       right: 1px;
    }*/

 /*   
    .ol-zoomslider:hover {
        background-color: rgba(0, 60, 136, .6);
    }
    
    .ol-zoomslider button {
        background-color: rgba(255, 255, 255, .8);
    }
    
    .ol-zoomslider button:hover {
        background-color: rgba(255, 255, 255, 1);
    }*/

.layer-switcher {
    position: absolute;
    top: 3em;
    right: 0.7em;
    text-align: left;
}

.layer-switcher.shown {
    top: 1em;
}

.layer-switcher .panel {
    padding: 0 1em 0 0;
    margin: 0;
    border: 4px solid #eee;
    border-radius: 4px;
    background-color: white;
    display: none;
    max-height: 100%;
    overflow-y: auto;
}

.layer-switcher.shown .panel {
    display: block;
}

.layer-switcher button {
    position: absolute;
    right:0;
    bottom: 0px;
    width: 35px;
    height: 35px;
    background-image: url('data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAMAAABEpIrGAAACE1BMVEX///8A//8AgICA//8AVVVAQID///8rVVVJtttgv98nTmJ2xNgkW1ttyNsmWWZmzNZYxM4gWGgeU2JmzNNr0N1Rwc0eU2VXxdEhV2JqytQeVmMhVmNoydUfVGUgVGQfVGQfVmVqy9hqy9dWw9AfVWRpydVry9YhVmMgVGNUw9BrytchVWRexdGw294gVWQgVmUhVWPd4N6HoaZsy9cfVmQgVGRrytZsy9cgVWQgVWMgVWRsy9YfVWNsy9YgVWVty9YgVWVry9UgVWRsy9Zsy9UfVWRsy9YgVWVty9YgVWRty9Vsy9aM09sgVWRTws/AzM0gVWRtzNYgVWRuy9Zsy9cgVWRGcHxty9bb5ORbxdEgVWRty9bn6OZTws9mydRfxtLX3Nva5eRix9NFcXxOd4JPeINQeIMiVmVUws9Vws9Vw9BXw9BYxNBaxNBbxNBcxdJexdElWWgmWmhjyNRlx9IqXGtoipNpytVqytVryNNrytZsjZUuX210k5t1y9R2zNR3y9V4lp57zth9zdaAnKOGoaeK0NiNpquV09mesrag1tuitbmj1tuj19uktrqr2d2svcCu2d2xwMO63N+7x8nA3uDC3uDFz9DK4eHL4eLN4eIyYnDX5OM5Z3Tb397e4uDf4uHf5uXi5ePi5+Xj5+Xk5+Xm5+Xm6OY6aHXQ19fT4+NfhI1Ww89gx9Nhx9Nsy9ZWw9Dpj2abAAAAWnRSTlMAAQICAwQEBgcIDQ0ODhQZGiAiIyYpKywvNTs+QklPUlNUWWJjaGt0dnd+hIWFh4mNjZCSm6CpsbW2t7nDzNDT1dje5efr7PHy9PT29/j4+Pn5+vr8/f39/f6DPtKwAAABTklEQVR4Xr3QVWPbMBSAUTVFZmZmhhSXMjNvkhwqMzMzMzPDeD+xASvObKePPa+ffHVl8PlsnE0+qPpBuQjVJjno6pZpSKXYl7/bZyFaQxhf98hHDKEppwdWIW1frFnrxSOWHFfWesSEWC6R/P4zOFrix3TzDFLlXRTR8c0fEEJ1/itpo7SVO9Jdr1DVxZ0USyjZsEY5vZfiiAC0UoTGOrm9PZLuRl8X+Dq1HQtoFbJZbv61i+Poblh/97TC7n0neCcK0ETNUrz1/xPHf+DNAW9Ac6t8O8WH3Vp98f5lCaYKAOFZMLyHL4Y0fe319idMNgMMp+zWVSybUed/+/h7I4wRAG1W6XDy4XmjR9HnzvDRZXUAYDFOhC1S/Hh+fIXxen+eO+AKqbs+wAo30zDTDvDxKoJN88sjUzDFAvBzEUGFsnADoIvAJzoh2BZ8sner+Ke/vwECuQAAAABJRU5ErkJggg==') /*logo.png*/;
    background-repeat: no-repeat;
    background-position: 0px;
    background-color: white;
    border: none;
}

.layer-switcher.shown button {
    display: none;
}

.layer-switcher button:focus, .layer-switcher button:hover {
    background-color: white;
}

.layer-switcher ul {
    padding-left: 1em;
    list-style: none;
}

.layer-switcher li.group {
    padding-top: 5px;
}

.layer-switcher li.group > label {
    font-weight: bold;
}

.layer-switcher li.layer {
    display: table;
}


.layer-switcher li.layer label, .layer-switcher li.layer input {
    display: table-cell;
    vertical-align: sub;
}

.layer-switcher input {
    margin: 4px;
}

.layer-switcher.touch ::-webkit-scrollbar {
    width: 4px;
}

.layer-switcher.touch ::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    border-radius: 10px;
}

.layer-switcher.touch ::-webkit-scrollbar-thumb {
    border-radius: 10px;
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.5);
}

.tooltip {
        position: relative;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 4px;
        color: white;
        padding: 4px 8px;
        opacity: 0.7;
        white-space: nowrap;
      }

      .tooltip-measure {
        opacity: 1;
        font-weight: bold;
      }

      .tooltip-static {
        background-color: #ffcc33;
        color: black;
        border: 1px solid white;
      }

      .tooltip-measure:before,
      .tooltip-static:before {
        border-top: 6px solid rgba(0, 0, 0, 0.5);
        border-right: 6px solid transparent;
        border-left: 6px solid transparent;
        content: "";
        position: absolute;
        bottom: -6px;
        margin-left: -7px;
        left: 50%;
      }

      .tooltip-static:before {
        border-top-color: #ffcc33;
      }

/*.map {
height: 100%;
width: 100%;
border-radius: 5px;
border: 0.2em solid #209CA6;
}*/
        .ol-zoom-extent {
          right: 0.6em;
          left:unset;
          bottom: 7em;    
          top: unset;
        }
    /* настраиваем обзорную карту */
      .ol-custom-overviewmap,
      .ol-custom-overviewmap.ol-uncollapsible {
          right: 0.6em;
          left:unset;
          bottom: 4.5em;z-index: 9999;
      }

      .ol-custom-overviewmap:not(.ol-collapsed)  {
        border: 1px solid black;
      }

      .ol-custom-overviewmap .ol-overviewmap-map {
        border: none;
        width: 300px;
      }
 
        .ol-attribution {
        bottom: 2em !important; 
	right: 0.6em;
        }
 
        .ol-scale-line {
        }

        .ol-mouse-position {
        background-color: rgba(0, 60, 136, .4);
        border-radius: 4px;
        color: #eee;
        padding: 1px 5px;
        right: 10px;
        left: unset;
        bottom: 5px;
        top: unset;
    }

     .ol-popup {
        position: absolute;
        background-color: white;
        -webkit-filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        filter: drop-shadow(0 1px 4px rgba(0,0,0,0.2));
        padding: 15px;
        border-radius: 10px;
        border: 1px solid #cccccc;
        bottom: 12px;
        left: -50px;
        min-width: 300px;
      }

      .ol-popup:after, .ol-popup:before {
        top: 100%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
      }

      .ol-popup:after {
        border-top-color: white;
        border-width: 10px;
        left: 48px;
        margin-left: -10px;
      }

      .ol-popup:before {
        border-top-color: #cccccc;
        border-width: 11px;
        left: 48px;
        margin-left: -11px;
      }

      .ol-popup-closer {
        text-decoration: none;
        position: absolute;
        top: 2px;
        right: 8px;
      }

      .navbar-offset { 
        margin-top: 30px; 
        }

    </style>
<link rel="icon" href="http://www.gazprom-spacesystems.ru/upload/favicon.ico" type="image/x-icon" class="img-rounded">

</head>
<body id="app-layout">
    <div class="container">
    <!-- <nav class="navbar navbar-default navbar-static-top">-->
    <nav class="navbar navbar-fixed-top navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Branding Image -->
                @if(App::getLocale()=='ru')
                <a href="{{ url('/') }}"><img src="http://kosmos.gazprom.ru/d/settingsgeneral/01/1/044_1-2-2-converted-web-smaller.png"></a>
                @else
                <a href="{{ url('/') }}"><img width='140px' height='69px' src="https://www.realwire.com/preview_writeitfiles/GSS%20logo_image_en.jpg"></a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Authentication Links -->
                   @if (Auth::guest())
                        <ul class="nav  navbar-left">
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                        </ul>
                    @else
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-left">
                <li class="{{ set_active('home') }}"><a href="{{ url('/') }}"><i class="fa fa-btn fa-home"></i>{{ trans('app.home') }}</a></li>
                <li><a href="{{ url('/') }}" onclick="refreshpanel('#panel1content'); return false;"><i class="fa fa-btn fa-archive" aria-hidden="true"></i>{{ trans('geoportal.archive') }}</a></li>
                <li><a href="{{ url('/') }}" onclick="refreshpanel('#panel2content'); return false;"><i class="fa fa-btn fa-camera" aria-hidden="true"></i>{{ trans('geoportal.order') }}</a></li>
                <li><a href="{{ url('/') }}" onclick="refreshpanel('#panel3content'); return false;"><i class="fa fa-btn fa-briefcase" aria-hidden="true"></i>{{ trans('app.orders') }}</a></li>
                <li class="{{ set_active('orders') }}"><a href="{{ url('/orders') }}"><i class="fa fa-btn fa-user-circle"></i>{{ trans('app.profile') }}</a></li>
                <!--<li><a href="{{ url('/') }}"><i class="fa fa-btn fa-rss" aria-hidden="true"></i>{{ trans('geoportal.news') }}</a></li>-->
                <!--<li><a href="{{ url('/') }}"><i class="fa fa-btn fa-question-circle" aria-hidden="true"></i>{{ trans('geoportal.help') }}</a></li>-->
                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>{{ trans('app.logout') }}</a></li>
                </ul>
 
                @endif
                    <ul class="nav navbar-nav navbar-right" style="padding-right:10px">
                    @if (!Auth::guest())
                    <li><a id='cartnum' href='{{ url('/cart') }}'></a></li>
                    @endif
                    <li style="padding-top:10px"><p><a href="/setlocale/ru"><img src="/img/flag_ru.png" alt="Русский язык"></a></p>
                    <p><a href="/setlocale/en"><img src="/img/flag_us.png" alt="Английский язык"></a></p></li>

                    </ul>
            </div>
            </div>
    </nav>
    </div>
    <div class="navbar-offset"></div>
    @yield('content')

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<script>
    $.get('/shownum', function(data) {
        $('#cartnum').html("<i class='fa fa-btn fa-shopping-cart' aria-hidden='true'></i>{{ trans('geoportal.cart') }} ("+data+")");
    });
</script>
</body>
</html>
