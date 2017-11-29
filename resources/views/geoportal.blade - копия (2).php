@extends('layouts.app')
@section('title', ' - Главная')
@section('content') 

<?php 
$user_id=$user->id;
?>
<!--Карта-->
<div id="map" class="map"><i class="fa fa-bars shadow navbtn" aria-hidden="true" onclick="openNav()"></i>
@section('sidebar')
<div class="flash-message">
      @if(Session::has('alert-success'))

      <p class="alert-success">{{ Session::get('alert-success') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif

  </div> <!-- end .flash-message -->
  <!--Боковая панель-->
<div id="mySidenav" class="sidenav shadow">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <div class="content tab-content" id="panelcontent">
        <div id="panel1content" class="nonactivepanel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    {{ trans('geoportal.archive') }}
                </h4>
            </div>
            <div class="panel-group" id="collapse-group" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#collapse-group" href="#el1">{{ trans('geoportal.aoi') }}</a>
                        </h4>
                    </div>
                    <div id="el1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            
                            <a href="#" id="ImageID" class="actionbtn">{{ trans('geoportal.entrid') }}</a>
                            <a href="#" class="actionbtn" data-toggle='modal' id='entrcoords' data-target-id='1' data-target='#modalinfo'>{{ trans('geoportal.entrcoords') }}</a>
                            <a href="#" id="Polygon" class="actionbtn"><span class="glyphicons glyphicons-vector-path-polygon"></span>{{ trans('geoportal.polygon') }}</a>
                            <a href="#" id="Box" class="actionbtn"><i class="fa fa-btn fa-square-o" aria-hidden="true"></i>{{ trans('geoportal.rectangle') }}</a>
                            <a href="#" id="Circle" class="actionbtn"><i class="fa fa-btn fa-circle-o" aria-hidden="true"></i>{{ trans('geoportal.circle') }}</a>
                            <a href="#" id="File" class="actionbtn" data-toggle="modal" data-target="#FileModal"><i class="fa fa-btn fa-file-o" aria-hidden="true"></i>{{ trans('geoportal.import') }}</a>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#collapse-group" href="#el2">{{ trans('geoportal.params') }}</a>
                        </h4>
                    </div>
                    <div id="el2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    Диапазон поиска
                                </h4>
                            </div>
                            <div>
                                <div class="form-group"><div class='col-md-3'><label for="startdate">Начало</label></div>
                                    <div class='input-group date col-md-6' id='datetimepicker6'>
                                        <input type='text' class="form-control" id="startdate" name="startdate"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="form-group"><div class='col-md-3'><label for="startdate">Конец</label></div>
                                    <div class='input-group date col-md-6' id='datetimepicker7'>
                                        <input type='text' class="form-control" id="startdate" name="startdate"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                    </div>
                </div>
            </div>
            <!-- <button class="btn btn-primary btn-block disabled" id="findbtn" onclick="getintersect(); return false;">Найти снимки</button> -->
            <button class="btn btn-primary btn-block disabled" id="findbtn">Найти снимки</button>
            <div id="archivetbl" style="padding-top: 3em"></div>    
        </div>
        </div>
        <div id="panel2content" class="nonactivepanel">
            <div class="panel-heading">
                <h4 class="panel-title">
                    {{ trans('geoportal.order') }}
                </h4>
            </div>
            <div class="panel-group" id="collapse-group" >
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#collapse-group" href="#el1">{{ trans('geoportal.aoi') }}</a>
                        </h4>
                    </div>
                    <div id="el1" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <a href="#" id="ImageID" class="actionbtn">{{ trans('geoportal.entrid') }}</a>
                            <a href="#" id="ImageID" class="actionbtn">{{ trans('geoportal.entrcoords') }}</a>
                            <a href="#" id="Polygon" class="actionbtn"><span class="glyphicons glyphicons-vector-path-polygon"></span>{{ trans('geoportal.polygon') }}</a>
                            <a href="#" id="Box" class="actionbtn"><i class="fa fa-btn fa-square-o" aria-hidden="true"></i>{{ trans('geoportal.rectangle') }}</a>
                            <a href="#" id="Circle" class="actionbtn"><i class="fa fa-btn fa-circle-o" aria-hidden="true"></i>{{ trans('geoportal.circle') }}</a>
                            <a href="#" id="File" class="actionbtn" data-toggle="modal" data-target="#FileModal"><i class="fa fa-btn fa-file-o" aria-hidden="true"></i>{{ trans('geoportal.import') }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <button type = "button" class = "btn btn-primary" onclick="getshp(); return false;">{{ trans('geoportal.svarea') }}</button>
        </div>
    </div>
    <div id="panel3content" class="nonactivepanel">
        <div class="panel-heading">
            <h4 class="panel-title">
                Ваши заказы
            </h4>
        </div>
        <div id="myPopoverContent">
            <table id="example" class = "table table-striped table-hover table-bordered">
                <thead>
                    <tr><th>ID</th><th>Состояние</th><th>Площадь</th></tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                <tr>
                <td>{{ $order->id }}</td><td>{{ $order->state }}</td><td>{{ $order->area }} km<sup>2</sup></td>
                </tr>    
                @endforeach
                </tbody></table>
        </div>
    </div>    
    <div id="panel4content" class="activepanel">
        <div class="panel-heading">
            <h4 class="panel-title">
                Дефолтная панель
            </h4>
        </div>

    </div>
</div>
</div>

<!-- Add all page content inside this div if you want the side nav to push page content to the right (not used if you only want the &#9776;sidenav to sit on top of the page -->
<!-- <div id="main"></div>-->
<!--<div><label class="actinteraction"></label></div>-->
<!-- Use any element to open the sidenav -->
</div>
@show
<!--Попап-->
<div id="popup" class="ol-popup">
    <a href="#" id="popup-closer" class="ol-popup-closer">
        <span class="glyphicon glyphicon-remove"></span></a>
    <div id="popup-content"></div>
</div>
<!--Модальное окно для загрузки файла-->
<div id="FileModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title">{{ trans('geoportal.sndshp') }}</h4>
            </div>
            <div class="modal-body">
                <form role="form" enctype="multipart/form-data" id="upload_form" action="" method="POST">
                    <div class="form-group">
                        <input name='usrshp'  id='usrshp' type="file">
                        <p class="help-block">Файл должен быть в архиве</p>
                    </div>
                    <button class = "btn btn-primary upshp" onclick="upshp(); return false;">{{ trans('geoportal.sndshpbtn') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Модальное окно с изменяемым контентом-->
<div id='modalinfo' class='modal fade' tabindex='-1'>
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
//////////////////////////////////////////////////////////
//Определение числа продуктов в корзине
    $.get('/shownum', function(data) {
        $('#cartnum').html("<i class='fa fa-btn fa-shopping-cart' aria-hidden='true'></i>Cart ("+data+")");
    });
var endofdraw=false;
var empty = true;
var table = $('#example').DataTable();
var activepanel;
function openNav() {
    document.getElementById("mySidenav").style.width = "55%";
}

/* Set the width of the side navigation to 0 */
function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    //$('#mySidenav').fadeOut(1000);
}    
//////////////////////////////////////////////////////////
//Календарь
  $(function () {
        $('#datetimepicker6').datetimepicker({
        locale:"{{ $locale }}",
        showTodayButton: true,
        allowInputToggle: true,
        showClear: true,
        //defaultDate:
        //useCurrent:true,
        widgetPositioning: {horizontal: 'right', vertical: 'bottom'}
        });

        $('#datetimepicker7').datetimepicker({
            locale:"{{ $locale }}",
            showTodayButton: true,
            showClear: true,
            allowInputToggle: true,
            widgetPositioning: {horizontal: 'right', vertical: 'bottom'},
            useCurrent: true //Important! See issue #1075
        });
        $("#datetimepicker6").on("dp.change", function (e) {
            $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
        });
        $("#datetimepicker7").on("dp.change", function (e) {
            $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
        });
        //defaultDate()
        //alert($('#datetimepicker7').data("DateTimePicker").useCurrent());
  });

//////////////////////////////////////////////////////////
//Подложка
      var goodmap = new ol.source.TileJSON({
        url: 'https://api.tiles.mapbox.com/v3/mapbox.world-bright.json?secure',
        crossOrigin: 'anonymous'
      });	

//////////////////////////////////////////////////////////
//Снимок    
      var geotiff = new ol.layer.Image({
        title: 'Satellite Image',
        source: new ol.source.ImageWMS({
          url: 'http://192.168.255.140:8080/geoserver/users/wms',
          imageLoadFunction: function(image, src) {
            $.get('/gettiffs', function(data) {
            if (activepanel !== '#panel1content') {
            src=src.replace("http://192.168.255.140:8080/geoserver/users/wms?","http://192.168.255.140:8080/geoserver/users/wms?LAYERS="+data+"&");
            }
            image.getImage().src = src;
            });
          }
         })
      });

//////////////////////////////////////////////////////////
//Подложка OpenStreetMaps
      var osm = new ol.layer.Tile({
          title: 'OSM',
          type: 'base',
          source: new ol.source.OSM()
        });
        
//////////////////////////////////////////////////////////
//Фичеры
      var features = new ol.Collection();
      var source = new ol.source.Vector({
          features: features
      });
      
/////////////////////////////////////////////////////////////
//Слой пользователя для рисования
      var vector = new ol.layer.Vector({
        title: '',
        source: source,
        style: getStyle
      });

/////////////////////////////////////////////////////////////
//Слой пользователя с заказами
      var green = [0,255,0,0.5];
      var yellow = [255,255,0,0.5];
      var red = [255,0,0,0.5];
      var stateLevels = {
        '1': red,
        '2': yellow,
        '3': green
      };
      var defaultStyle = new ol.style.Style({
        fill: new ol.style.Fill({
          color: [250,250,250,1]
        }),
        stroke: new ol.style.Stroke({
          color: '#000000',
          width: 3
        })
      });
        var styleCache = {};

        var user_source = new ol.source.Vector({
                url:'/getusrlayer',
                format: new ol.format.GeoJSON()
            });
        
        var user_layer = new ol.layer.Vector({
            title: '',
            source: user_source,
            visible: false,
            style: styleFunction
            });
        function styleFunction(feature,resolution) {
        var level = feature.get('state');
        if (!level || !stateLevels[level]) {
          return [defaultStyle];
        }
        if (!styleCache[level]) {
          styleCache[level] = new ol.style.Style({
            fill: new ol.style.Fill({
              color: stateLevels[level]
            }),
            stroke: new ol.style.Stroke({
          color: '#000000',
          width: 3
          })
        })}
        return [styleCache[level]];    
        } 
        
//////////////////////////////////////////////////////////
//Архивный слой
        var archive_src = new ol.source.Vector({
            url:"http://192.168.255.140:8080/geoserver/ows?service=WFS&request=GetFeature&version=1.1.0&typeName=users:archive&outputFormat=json",
            format: new ol.format.GeoJSON()
            });
        var archive_layer = new ol.layer.Vector({
            title: '',
            source: archive_src,
            visible: false
            });

//////////////////////////////////////////////////////////
// Перезагрузка слоев при переключении вкладок
function refreshSelectedLayer(layer) {
  //var now = Date.now();
  var source = layer.getSource();
  var format = new ol.format.GeoJSON();
  var url = 'http://192.168.255.140:8080/geoserver/ows?service=WFS&request=GetFeature&version=1.1.0&typeName=users:archive&outputFormat=json';//t=' + now;
  fetch(url).then(function(response) {
      return response.json();
    }).then(function(json) {
      //alert('parsed json');
      source.clear(); // if this is not enough try yours
      var features = format.readFeatures(json, {
        featureProjection: 'EPSG:3857'
      });
      source.addFeatures(features);
    }).catch(function(ex) {
      console.log('parsing failed', ex);
    });
}
    var newlayer = new ol.layer.Vector({ 
        source : new ol.source.Vector()
        });
    
//////////////////////////////////////////////////////////
//Определение позиции мышки
    var mousePositionControl = new ol.control.MousePosition ({
        // используется градусная проекция
        projection: 'EPSG:4326',
        // переопределяем функцию вывода координат
        coordinateFormat: function(coordinate) {
            // сначала широта, потом долгота и ограничиваем до 5 знаков после запятой
            return ol.coordinate.format(coordinate, '{y}, {x}', 4);
        }
    });

//////////////////////////////////////////////////////////
//Определение объектов попапа
      var container = document.getElementById('popup');
      var content = document.getElementById('popup-content');
      var closer = document.getElementById('popup-closer');

//////////////////////////////////////////////////////////
//Попап
    var overlay = new ol.Overlay ({
        title: 'Попап',
        element: container,
        autoPan: true,
        autoPanAnimation: {
          duration: 250
        }
        });     

      ///////////////////////////////////////
      //Спрятать попап
      closer.onclick = function() {
        overlay.setPosition(undefined);
        closer.blur();
        $('.success').removeClass('success');
        table.search( '' ).columns().search( '' ).draw();
//        var table = document.getElementById('myPopoverContent');
//        var tr = table.getElementsByTagName("tr");
//        for (i = 0; i < tr.length; i++) {
//                        tr[i].style.display = "";
//                        } 
        return false;
      };

      //////////////////////////////////////
      //Спрятать попап по эскейпу и Перестать рисовать по эскейпу
      $(document).keydown(function(event){
      if (event.which==27){
        map.removeInteraction(draw);
        eraser();
        $(closer).trigger( "onclick" );
        //checker(endofdraw,empty);
        return false;
      };
      });

///////////////////////////////////////////
//Овервью
      var overviewMapControl = new ol.control.OverviewMap({
        collapseLabel: '\uf152',
        label: '\uf191',
        className: 'ol-overviewmap ol-custom-overviewmap'
      });

///////////////////////////////////////////
//Слайдер
      var controlZoom = new ol.control.ZoomSlider({
        className: 'ol-zoomslider',  
        duration: 300
      });

////////////////////////////////////////////////////
//Вид
        var view = new ol.View({
          extent: ol.proj.get("EPSG:3857").getExtent(),
          center: [0, 0],
          zoom: 2
        });

////////////////////////////////////////////////////
//Настройка карты 
    var map = new ol.Map({
//        interactions: olgm.interaction.defaults(),
        controls: ol.control.defaults().extend([
            controlZoom,//new ol.control.ZoomSlider(),
            overviewMapControl,
            mousePositionControl,
            new ol.control.ScaleLine({
                minWidth:100
            })
   	    ]),
        layers: [osm, 
//        new olgm.layer.Google({
//        title: 'Google Maps',
//        type: 'base',
//        combine: true 
//        }),
            // new ol.layer.Tile({
            //     title: 'Подложка',
            //     type: 'base',
            //     source: goodmap
            // }),
            geotiff, archive_layer, user_layer, vector],
        overlays: [overlay],
        target: 'map',
        view: view
        });

//var olGM = new olgm.OLGoogleMaps({map: map}); // map is the ol.Map instance
//olGM.activate();

////////////////////////////////////////////////////
//Настройки геокодера
var geocoder = new Geocoder('nominatim', {
    provider: 'osm',
    targetType: 'text-input',
    lang: "{{ $locale }}",
    placeholder: 'Найти объект',
    limit: 5,
    keepOpen: true
});
//Добавляем контрол
map.addControl(geocoder);
//Событие при отработке геокодера
geocoder.on('addresschosen', function(evt){
  //var feature = evt.feature,
      coord = evt.coordinate,
      address = evt.address;
  content.innerHTML = '<p>'+ address.formatted +'</p>';
  overlay.setPosition(coord);
});

//////////////////////////////////////////////////////////
//Настройки выпадающего меню
    center = function(obj, foo){
      var pan = ol.animation.pan({
        duration: 100,
        source: view.getCenter()
      });
      map.beforeRender(pan);
      view.setCenter(obj.coordinate);
    };
        url_marker = '//cdn.rawgit.com/jonataswalker/ol3-contextmenu' +
      '/master/examples/img/pin_drop.png';
        url_center = '//cdn.rawgit.com/jonataswalker/ol3-contextmenu' +
      '/master/examples/img/center.png';
    marker = function(obj){
      var coord4326 = ol.proj.transform(obj.coordinate, 'EPSG:3857', 'EPSG:4326'),
        template = 'Coordinate is ({y} | {x})',
        iconStyle = new ol.style.Style({
          image: new ol.style.Icon({ scale: .6, src: url_marker }),
          text: new ol.style.Text({
            offsetY: 25,
            text: ol.coordinate.format(coord4326, template, 2),
            font: '15px Open Sans,sans-serif',
            fill: new ol.style.Fill({ color: '#111' }),
            stroke: new ol.style.Stroke({ color: '#eee', width: 2 })
          })
        }),
        feature = new ol.Feature({
          type: 'removable',
          geometry: new ol.geom.Point(obj.coordinate)
        });
      feature.setStyle(iconStyle);
      vector.getSource().addFeature(feature);
    };
    contextmenu_items=[
    {
      text: 'Ввести ID',
      font:"16px FontAwesome",
      callback:  function(){}
    },
    {
      text: 'Ввести координаты',
      font:"16px FontAwesome",
      callback:  function(){}
    },
    {
      text: 'Нарисовать полигон',
      font:"16px FontAwesome",
      callback:  function(){addInteraction('Polygon');}
    },
    {
      text: 'Нарисовать прямоугольник',
      font:"16px FontAwesome",
      callback:  function(){addInteraction('Box');}
    },
    {
      text: 'Нарисовать круг',
      font:"16px FontAwesome",
      callback:  function(){addInteraction('Circle');}
    },
    {
      text:'Импорт из файла',
      font:"16px FontAwesome",
      callback:  upshp
    },
    {
      text: 'Center map here',
      callback: center,
      icon: url_center
    },
    {
      text: 'Add a Marker',
      icon: url_marker,
      callback: marker
    },
    '-' // this is a separator
    ];
var contextmenu = new ContextMenu({
  width: 170,
  defaultItems: true, // defaultItems are (for now) Zoom In/Zoom Out
  items: contextmenu_items
});
map.addControl(contextmenu);
 var removeMarker = function (obj) {
    vector.getSource().removeFeature(obj.data.marker);
  };
  var removeMarkerItem = {
    text: 'Remove this Marker',
    icon: url_marker,
    callback: removeMarker
  };
  
  contextmenu.on('open', function(evt){
    var feature = map.forEachFeatureAtPixel(evt.pixel, function (ft, l) {
      return ft;
    });

    if (feature && feature.get('type') == 'removable') {
      contextmenu.clear();
      removeMarkerItem.data = { marker: feature };
      contextmenu.push(removeMarkerItem);
      
    } else {
      contextmenu.clear();
      contextmenu.extend(contextmenu_items);
      contextmenu.extend(contextmenu.getDefaultItems());
    }
  });

//////////////////////////////////////////////////////////
//Настройки свитчера
    var layerSwitcher = new ol.control.LayerSwitcher({
        tipLabel: 'Legend' // Optional label for button
        });
    map.addControl(layerSwitcher);

//////////////////////////////////////////////////////////
      var wgs84Sphere = new ol.Sphere(6378137);
      var sketch;
      var helpTooltipElement;
      var helpTooltip;
      var helpMsg;
      var measureTooltipElement;
      var measureTooltip;
      var continuePolygonMsg = 'Нажмите чтобы продолжить рисовать полигон';
      var continueLineMsg = 'Click to continue drawing the line';
      var getFeaturesMsg = 'Нажмите чтобы узнать подробности';
      var measuring;
//      createMeasureTooltip();
      createHelpTooltip();
      
/////////////////////////////////////////
//Обработчки движения мышки
      var pointerMoveHandler = function(evt) {        
        if (evt.dragging) {
          return;
        }
        var pixel = map.getEventPixel(evt.originalEvent);
        // var hit = map.forEachFeatureAtPixel(pixel, function() {
        //     return true;
        // });
        map.getTargetElement().style.cursor = map.hasFeatureAtPixel(pixel) ? 'pointer' : '';
        //map.getTargetElement().style.cursor = hit ? 'pointer' : '';
        if (activepanel == '#panel3content') {
            changecolor(pixel);
        }     
       if (sketch) {
         var geom = (sketch.getGeometry());
         if (geom instanceof ol.geom.Polygon) {
           changemsg(continuePolygonMsg);
         } else if (geom instanceof ol.geom.LineString) {
           helpMsg = continueLineMsg;
         }
       }        
       //helpTooltipElement.innerHTML = helpMsg;
       helpTooltip.setPosition(evt.coordinate);
       helpTooltipElement.classList.remove('hidden');
      };
      map.on('pointermove', pointerMoveHandler);

      function changemsg(msg) {
        helpTooltipElement.innerHTML = msg;
      };

/////////////////////////////////////////
//Смена цвета фичера при наводке мышкой      
      var highlight;
      function changecolor(pixel) {
        var feature = map.forEachFeatureAtPixel(pixel, function(feature) {
            return feature;
        });
        if (feature !== highlight) {
          if (highlight) {
            featureOverlay.getSource().removeFeature(highlight);
          }
          if (feature) {
            featureOverlay.getSource().addFeature(feature);
          }
          highlight = feature;
        }
      };

//////////////////////////////////////////////////////////      
      var draw; // global so we can remove it later
////////////////////////////////////////////////////////////
//Вывод результата - длина
      // var formatLength = function(line) {
      //   var length;
      //     var coordinates = line.getCoordinates();
      //     length = 0;
      //     var sourceProj = map.getView().getProjection();
      //     for (var i = 0, ii = coordinates.length - 1; i < ii; ++i) {
      //       var c1 = ol.proj.transform(coordinates[i], sourceProj, 'EPSG:4326');
      //       var c2 = ol.proj.transform(coordinates[i + 1], sourceProj, 'EPSG:4326');
      //       length += wgs84Sphere.haversineDistance(c1, c2);
      //     }
      //   var output;
      //   if (length > 100) {
      //     output = (Math.round(length / 1000 * 100) / 100) +
      //         ' ' + 'km';
      //   } else {
      //     output = (Math.round(length * 100) / 100) +
      //         ' ' + 'm';
      //   }
      //   return output;
      // };

////////////////////////////////////////////////////////////
//Вывод результата - площадь
      var formatArea = function(polygon) {
        var area;
          var sourceProj = map.getView().getProjection();
          var geom = (polygon.clone().transform(
              sourceProj, 'EPSG:4326'));
          var coordinates = geom.getLinearRing(0).getCoordinates();
          area = Math.abs(wgs84Sphere.geodesicArea(coordinates));

        var output;
        if (area > 10000) {
          output = (Math.round(area / 1000000 * 100) / 100) +
              ' ' + 'km<sup>2</sup>';
        } else {
          output = (Math.round(area * 100) / 100) +
              ' ' + 'm<sup>2</sup>';
        }
        return output;
      };

////////////////////////////////////////////////////////////
//Creates a new help tooltip
      function createHelpTooltip() {
        if (helpTooltipElement) {
          helpTooltipElement.parentNode.removeChild(helpTooltipElement);
        }
        helpTooltipElement = document.createElement('div');
        helpTooltipElement.className = 'tooltip hidden';
        helpTooltip = new ol.Overlay({
          element: helpTooltipElement,
          offset: [15, 0],
          positioning: 'center-left'
        });   
        map.addOverlay(helpTooltip);
      }

////////////////////////////////////////////////////////////
//Creates a new measure tooltip
      function createMeasureTooltip() {
       // if (measureTooltipElement) {
       //   measureTooltipElement.parentNode.removeChild(measureTooltipElement);
       // }
        measureTooltipElement = document.createElement('div');
        measureTooltipElement.className = 'tooltip tooltip-measure';
        measureTooltip = new ol.Overlay({
          element: measureTooltipElement,
          offset: [0, -15],
          positioning: 'bottom-center'
        });
        map.addOverlay(measureTooltip);
      }
        function deleteMeasureTooltip() {
            measureTooltipElement.parentNode.removeChild(measureTooltipElement);
        }

////////////////////////////////////////////////////////////
////Обозначение состояний
    function stateName(a) {
        if (a=='3'){
            return "Съемка возможна";    
            }
        if (a=='2'){
            return "Определяется возможность съемки";    
            }
        if (a=='1'){
            return "Съемка невозможна";    
            }
        }

////////////////////////////////////////////////////////////
////Убираем подсказки у мышки при выходе за пределы карты
      // map.getViewport().addEventListener('mouseout', function() {
      //   helpTooltipElement.classList.add('hidden');
      // });

////////////////////////////////////////////////// 
////Оверлей для выбранных фичеров       
        var featureOverlay = new ol.layer.Vector({
            source: new ol.source.Vector(),
            map: map,
            style: new ol.style.Style({
            stroke: new ol.style.Stroke({
                color: '#f00',
                width: 6
            }),
            fill: new ol.style.Fill({
                color: 'rgba(0,0,0,0.1)'
                })
            })
        });

////////////////////////////////////////////////// 
////Невидимый стиль
        // var hiddenStyle = new ol.style.Style({
        //   stroke: new ol.style.Stroke({
        //     color: [0,0,0,0]
        //   }),
        //   fill: new ol.style.Fill({
        //     color: [0,0,0,0]
        //   })
        // });

//////////////////////////////////////////////////
// Interacton "Click"
      var selectClick = new ol.interaction.Select({
        condition: ol.events.condition.click,
        layers: [user_layer, archive_layer, newlayer, vector],
        multi: true,
        style: new ol.style.Style({
          stroke: new ol.style.Stroke({
            color: '#f00',
            width: 6
          }),
          fill: new ol.style.Fill({
            color: 'rgba(0,0,0,0.1)'
          })
        })
      });     

//////////////////////////////////////////////////
////Выбор типа фигуры
    var action;
    $('body').on('click','.actionbtn', function(event) {
        changemsg('Нажмите чтобы начать рисовать');
        var id = event.target.id;
        $('#'+id).button('toggle');
        // Remove previous interaction
        //map.removeInteraction(modify);
        map.removeInteraction(draw);
        // Update active interaction
        switch(event.target.id) {
            // case "File":
            // break;
            case "Box":
                action = "Box";
                addInteraction(action);
                break;
            case "Polygon":
                action = "Polygon";
                addInteraction(action);
                break;
            case "Circle":
                action = "Circle";
                addInteraction(action);
                break;
            // case "PlaceName":
            //     break;
            // case "Transform":
            //     break;
                    default:
                        break;
                }
            });

function controlDoubleClickZoom(active){
    //Find double click interaction
    var interactions = map.getInteractions();
    for (var i = 0; i < interactions.getLength(); i++) {
        var interaction = interactions.item(i);                          
        if (interaction instanceof ol.interaction.DoubleClickZoom) {
            interaction.setActive(active);
        }
    }
}
//////////////////////////////////////////////////  
//Рисовалка
    var draw; // global so we can remove it later
    function addInteraction(action) {
        if (action!='None') {
            var value = action;
            }
        if (measuring) {
            value = 'LineString';
            }
        if (value) {
        var geometryFunction, maxPoints;
            //Если выбран полигон
            if (value === 'Polygon') {
                value = 'Polygon';
                }
            //Если выбран прямоугольник
            else if (value === 'Box') {
                        value = 'Circle';
                        geometryFunction = ol.interaction.Draw.createBox();       
                    }
            //Если выбран круг
            else if (value === 'Circle') {
                value = 'Circle';
                geometryFunction = function(coordinates, geometry) {
                    if (!geometry) {
                        geometry = new ol.geom.Polygon(null);
                    }
                    var center = coordinates[0];
                    var last = coordinates[1];
                    var dx = center[0] - last[0];
                    var dy = center[1] - last[1];
                    var radius = Math.sqrt(dx * dx + dy * dy);
                    var circle = ol.geom.Polygon.circular(wgs84Sphere, ol.proj.toLonLat(center), radius);
                    circle.transform('EPSG:4326', 'EPSG:3857');
                    geometry.setCoordinates(circle.getCoordinates());
                    return geometry;
                    }
                }
        draw = new ol.interaction.Draw({
            features:features,
            type: value,
            geometryFunction: geometryFunction,
            // maxPoints: maxPoints
            });
        map.addInteraction(draw);                                   
        var listener;
        draw.on('drawstart', function(evt) {
            map.removeInteraction(modify);
            createMeasureTooltip();
            sketch = evt.feature;              
            var tooltipCoord = evt.coordinate;
            listener = sketch.getGeometry().on('change', function(evt) {
                var geom = evt.target;
                var output;
                 if (geom instanceof ol.geom.Polygon) {
                    output = formatArea(geom);
                    tooltipCoord = geom.getInteriorPoint().getCoordinates();
                } 
                // else if (geom instanceof ol.geom.LineString) {
                // else if (geom instanceof ol.geom.Circle) {
                //     var sourceProj = map.getView().getProjection();
                //     var c1 = ol.proj.transform(geom.getFirstCoordinate(), sourceProj, 'EPSG:4326');
                //     var c2 = ol.proj.transform(geom.getLastCoordinate(), sourceProj, 'EPSG:4326');
                //     var radius = wgs84Sphere.haversineDistance(c1, c2);
                //     var area = Math.abs(Math.PI*radius*radius);
                //     var output;
                //     if (area > 10000) {
                //         output = (Math.round(area / 1000000 * 100) / 100) + ' ' + 'km<sup>2</sup>';
                //     }
                //     else {
                //         output = (Math.round(area * 100) / 100) + ' ' + 'm<sup>2</sup>';
                //     }
                // tooltipCoord = geom.getCenter();
                // //     output = formatLength(geom);
                // //     tooltipCoord = geom.getLastCoordinate();
                // }                
                measureTooltipElement.innerHTML = output;
                measureTooltip.setPosition(tooltipCoord);
                });
            }, this);
        draw.on('drawend',function(evt) {
              controlDoubleClickZoom(false);
              //Delay execution of activation of double click zoom function
              setTimeout(function(){controlDoubleClickZoom(true);},251); 
              //map.addInteraction(interaction);
              //setHandleStyle();
              $('#findbtn').removeClass('disabled');
              $('#findbtn').on('click', getintersect); //bind myFunc
              action='None';
              map.addInteraction(selectClick);
              map.addInteraction(modify);
              //evt.feature.set('measureTooltip', (String(measureTooltipElement.innerHTML)).split(' ')[0]);//measureTooltip);
              //measureTooltipElement.className = 'tooltip tooltip-static';
              //measureTooltip.setOffset([0, -7]);
              sketch = null;
              //measureTooltipElement = null;
              //createMeasureTooltip();
              ol.Observable.unByKey(listener);
              endofdraw=true;
              //checker(endofdraw,empty);
              deleteMeasureTooltip();
              map.removeInteraction(draw);
              //measureTooltipElement.classList.add('hidden');
                // overlay.setPosition(undefined);
                // closer.blur();
            }, this);
        }
    //createMeasureTooltip();
        }
        //}
//////////////////////////////////////////////////
//Изменение фичеров
    var modify = new ol.interaction.Modify({
        features: selectClick.getFeatures()//features////////////////////
    });
      //map.addInteraction(modify);
		function getStyle(feature){
                return [ new ol.style.Style({	
                    image: new ol.style.RegularShape({
                        fill: new ol.style.Fill({color: [0,0,255,0.4]}),
                        stroke: new ol.style.Stroke({color: [255,255,255,1],width: 1}),
                        //stroke: new ol.style.Stroke({color: [0,0,255,1],width: 1}),
                        radius: 10,
                        points: 3,
                        angle: feature.get('angle')||0
                        }),
                    fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 255, 0.2)'
                    }),
                    stroke: new ol.style.Stroke({
                    color: '#ffcc33',
                    width: 2
                    })
                })];
                }
		
		// function setHandleStyle(){	
  //                   if (!interaction instanceof ol.interaction.Transform) return;
  //                   // Style the rotate handle
  //                   var circle = new ol.style.RegularShape({
		// 	fill: new ol.style.Fill({color:[255,255,255,0.01]}),
		// 	stroke: new ol.style.Stroke({width:1, color:[0,0,0,0.01]}),
		// 	radius: 8,
		// 	points: 10
		// 	});
  //                   interaction.setStyle('rotate',
		// 	new ol.style.Style({	
  //                           text: new ol.style.Text({	
  //                               text:'\uf0e2', 
		// 		font:"16px FontAwesome",
		// 		textAlign: "left",
		// 		fill: new ol.style.Fill({color:'red'})
  //                           }),
  //                           image: circle
		// 	}));
  //                   //Center of rotation
  //                   interaction.setStyle ('rotate0',
		// 	new ol.style.Style({	
  //                           text: new ol.style.Text ({	
  //                               text:'\uf0e2', 
  //                               font:"20px FontAwesome",
		// 		fill: new ol.style.Fill({ color:[255,255,255,0.8] }),
		// 		stroke: new ol.style.Stroke({ width:2, color:'red' })
  //                           }),
		// 	}));
  //                   // Style the move handle
  //                   interaction.setStyle('translate',
		// 	new ol.style.Style({	
  //                           text: new ol.style.Text ({	
  //                               text:'\uf047', 
		// 		font:"20px FontAwesome", 
		// 		fill: new ol.style.Fill({ color:[255,255,255,0.8] }),
		// 		stroke: new ol.style.Stroke({ width:2, color:'red' })
  //                           })
		// 	}));
  //                   interaction.setStyle('scaleh1', 
		// 	new ol.style.Style({	
  //                           text: new ol.style.Text ({	
  //                               text:'\uf07d', 
		// 		font:"bold 20px FontAwesome", 
		// 		fill: new ol.style.Fill({ color:[255,255,255,0.8] }),
  //                               stroke: new ol.style.Stroke({ width:2, color:'red' })
  //                           })
		// 	}));
  //                   interaction.style.scaleh3 = interaction.style.scaleh1;
  //                   interaction.setStyle('scalev',
		// 	new ol.style.Style({	
  //                           text: new ol.style.Text ({	
  //                               text: '\uf07e', 
  //                               font: "bold 20px Fontawesome", 
		// 		fill: new ol.style.Fill({ color:[255,255,255,0.8] }),
		// 		stroke: new ol.style.Stroke({ width:2, color:'red' })
		// 						})
		// 				}));
  //                   interaction.style.scalev2 = interaction.style.scalev;
  //                   // Refresh
  //                   interaction.set('translate', interaction.get('translate'));
		// }
		// var interaction = new ol.interaction.Transform (
		// 	{
  //                           features:features,
  //                           translateFeature: false,
		// 		scale: true,
		// 		rotate: true,
		// 		translate: true,
		// 		stretch: true
		// 	});
		
		// // Style handles
		// //setHandleStyle();
		// // Events handlers
		// var startangle = 0;
		// var d=[0,0];
		// interaction.on (['rotatestart','translatestart'], function(e)
		// 	{	// Rotation
		// 		startangle = e.feature.get('angle')||0;
		// 		// Translation
		// 		d=[0,0];
		// 	});
		// interaction.on('rotating', function (e)
		// 	{ 
		// 		// Set angle attribute to be used on style !
		// 		e.feature.set('angle', startangle - e.angle);
		// 	});
		// interaction.on('translating', function (e)
		// 	{	d[0]+=e.delta[0];
		// 		d[1]+=e.delta[1];
		// 	});
        
//////////////////////////////////////////////////
//Активация кнопок поиска снимков  
    // $("#datetimepicker6,#datetimepicker7").on("dp.change", function (e) {
    //     $('input[name="startdate"], input[name="enddate"]').each(function() {
    //         if ($(this).val() == '') {
    //             empty = true;
    //         } 
    //         else {
    //             empty = false
    //         }           
    //     });
    //     checker(endofdraw,empty);
    //     });

    //     function checker(endofdraw,empty) {
    //     if (empty==false && endofdraw==true) {
    //         $('#findbtn').removeClass('disabled');
    //     }
    //     else {
    //         $('#findbtn').addClass('disabled');
    //     }};

//////////////////////////////////////////////////
//Выделение слоев при выборе строки в таблице снимков пользователя
    $('#example tbody').on('click', 'tr', function () {
        $('.success').removeClass('success');
        $(this).addClass("success");
        var id = $('td',this).html();
        id="orders."+id;
        feature = user_source.getFeatureById(id);
        selectClick.getFeatures().clear();
        selectClick.getFeatures().push(feature);
    });

//////////////////////////////////////////////////
//Выделение слоев при выборе строки в таблице архивных снимков
    $('#archivetbl').on('click', 'tr', function () {
        $('.success').removeClass('success');
        $(this).addClass("success");
            var id = $('td:eq(1)',this).html();
            id="archive."+id;
            var feature = archive_src.getFeatureById(id);
            selectClick.getFeatures().clear();
            selectClick.getFeatures().push(feature);
    });

//////////////////////////////////////////////////  
//Получить пересечения
function getintersect(){
    var writer = new ol.format.GeoJSON();
    var geojsonStr = writer.writeFeatures(source.getFeatures());
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: 'POST',
        async: true,
        url: '/intersect',
        data : {geojsonStr:geojsonStr,_token:token},
        success: function(data) {
            map.removeInteraction(modify);
            if (data=='false') {
                $("#archivetbl").empty();
                $('#archivetbl').append('<div class="alert alert-danger alert-dismissable" style="text-align: center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Снимки не найдены</div>');
            } 
            else {
        //Отобразить найденные снимки в таблице  
            archive_layer.setVisible(true); 
            $("#archivetbl").empty();
            var table = $('<table/>').attr("id", "arctbl").addClass("table table-hover table-striped table-bordered").attr("cellspacing", "0").attr("width", "100%");
            var row = $('<thead><tr><th>Номер</th><th>ID</th><th>Имя снимка</th><th>Дата</th><th>Функции</th></tr></thead><tbody>');
            table.append(row);
            data=JSON.parse(data);
            var number = data.length;
            for(var i=0; i < number; i++){   
                var tr = $('<tr/>');
                table.append(tr);  
                var num = data[i]["id"];
                var activefeature = archive_src.getFeatureById('archive.'+num);
                newlayer.getSource().addFeature(activefeature);
                tr.append("<td>"+(i+1)+"</td><td id='colid'>"+num+"</td><td id='imgname'>"+activefeature.get('imgname')+"</td><td>"+activefeature.get('time')+"</td><td><a data-toggle='modal' id='infobtn' data-target-id='1' data-target='#modalinfo'><i class='fa fa-shopping-cart'></i></a><a id='eyebtn'><i class='fa fa-eye unclicked'></i></a></td>") 
            }
            var row = $('</tbody>');
            table.append(row);
            $('#archivetbl').append(table);  
            $('#arctbl').dataTable();
            newlayer.setStyle(archive_layer.getStyle()); // set the same style to the tmp layer
            map.addLayer(newlayer);// add it to the map
            geotiff.getSource().updateParams(
                {'LAYERS': ''}
            );
    // }
    // for (var i=0;i<number;i++){
    //     var num = data[i]["id"];
    //     var activefeature = archive_src.getFeatureById('archive.'+num);
    //     newlayer.getSource().addFeature(activefeature);
    //     var row = $("<tr><td>"+(i+1)+"</td><td id='colid'>"+num+"</td><td id='imgname'>"+activefeature.get('imgname')+"</td><td>"+activefeature.get('time')+"</td><td><a data-toggle='modal' id='infobtn' data-target-id='1' data-target='#modalinfo'><i class='fa fa-shopping-cart'></i></a><a id='eyebtn'><i class='fa fa-eye unclicked'></i></a></td></tr>");
    //     table.append(row);
    //     }
    // var row = $('</tbody>');
    // table.append(row);
    //$('#archivetbl').append(table);

    //archive_layer.setVisible(false); // set the vector layer visibility to false
//    var table = document.getElementById('myPopoverContent');
//    var tr = table.getElementsByTagName("tr");
//    for (i = 1; i < tr.length; i++) {
//        td = tr[i].getElementsByTagName("td")[0].innerHTML;
//            if (td) {
//                if (filter.indexOf(td)>-1){
//                    tr[i].style.display = "";
//                    } 
//                else {
//                    tr[i].style.display = "none";
//                    }
//                }
//        }
  }}
});
};

//////////////////////////////////////////////////  
//Отобразить снимок по нажатию кнопки с глазом
var archivelayers = [];
$(document).ready(function(){
    $('#archivetbl').on('click', '#eyebtn', function (e) {
        map.removeInteraction(modify);
        geotiff.setVisible(true);
        var row = $(e.target).closest("tr");
        var imgname = row.find("#imgname").text();
        imgname = imgname.slice(0, -4);
        if ($(e.target).hasClass( "unclicked" )) {
            $(e.target).toggleClass("unclicked clicked");
            archivelayers.push(imgname);
            var archiveparams=archivelayers.join(',');
            geotiff.getSource().updateParams(
                {'LAYERS': archiveparams,"time": Date.now()}
            );
        }   
        else if ($(e.target).hasClass( "clicked" )) {
            $(e.target).toggleClass("clicked unclicked");
            if (archivelayers.length<=1) {
                geotiff.setVisible(false);
                archivelayers = [];
                geotiff.getSource().updateParams(
                    {'LAYERS': ''}
                );
            }
            if (archivelayers.length>1) {
                archivelayers.splice(archivelayers.indexOf(imgname), 1);
                var archiveparams=archivelayers.join(',');
                geotiff.getSource().updateParams(
                    {'LAYERS': archiveparams,"time": Date.now()}
                );
            }
        }
    });
});

//////////////////////////////////////////////////  
//Получить вид модального окна
$(document).ready(function(){
    $("#modalinfo").on("show.bs.modal", function(e) {
        switch($(e.relatedTarget).attr('id')) {
        //Инфа о снимке
        case 'infobtn':
            $('#modalinfo h4').text('Информация о снимке');
            var row = $(e.relatedTarget).closest("tr");    // Find the row
            var id = row.find("#colid").text(); // Find the text
            $.get('/getinfo/' + id, function( data ) {
            $("#modalinfo .modal-body").html(data);
            });
        break;
        //Ввод координат
        case 'entrcoords':
            $('#modalinfo h4').text('Введите координаты');
            $.get('/entrcoords', function(data) {
            $("#modalinfo .modal-body").html(data);
            });
        break;
        }
    });
});

//////////////////////////////////////////////////  
//Функция обработки нарисованного шейпа
function getshp(){
    var writer = new ol.format.GeoJSON();
    var geojsonStr = writer.writeFeatures(source.getFeatures());
    var token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: 'POST',
        async: true,
        url: '/getshp',
        data : {geojsonStr:geojsonStr,_token:token},
        success: function(data) {
            //alert (data);
        }
    });
};

//////////////////////////////////////////////////
//Функция обновления контента в панели
function refreshpanel(activepanelnow) {
//closeNav();
    activepanel=activepanelnow;
    $(".activepanel").toggleClass('activepanel nonactivepanel');
    $(activepanel).toggleClass('nonactivepanel activepanel');
    //Заказы
    if (activepanel == '#panel3content') {
        selectClick.getFeatures().clear();
        $("#archivetbl").empty();
        user_layer.setVisible(true);
        vector.setVisible(false);
        geotiff.setVisible(false);
        archive_layer.setVisible(false); 
        newlayer.setVisible(false);
        map.addInteraction(selectClick);
        map.removeInteraction(draw);
        map.removeInteraction(modify);
        ////Событие - клик мышки       
        map.on('singleclick', function(evt) {
            var coordinate = evt.coordinate;
            var number=user_source.getFeaturesAtCoordinate(coordinate).length;
            var pixel = map.getEventPixel(evt.originalEvent);
            ////Убираем попап если нажали не на фичер
            var hit = map.hasFeatureAtPixel(pixel);
            if (!hit){
            $(closer).trigger("onclick");
            }
            ////Если нажали на фичер, то отображаем попап
            if (number>0){
                $("#popup-content").empty();
                var table = $('<table></table>').addClass('table');
                var row = $('<thead><tr><th>№</th><th>ID</th><th>Состояние</th></tr></thead><tbody>');
                table.append(row);
                var filter=[];
                for (var i=1;i<=number;i++){
                    var feature = user_source.getFeaturesAtCoordinate(coordinate)[i-1];
                    filter.push(feature.get('id'));
                    var row = $("<tr><td>"+i+"</td><td>"+filter[i-1]+"</td><td>"+stateName(feature.get('state'))+"</td></tr>");
                    table.append(row);
                    }
                var row = $('</tbody>');
                table.append(row);
                $('#popup-content').append(table);
                overlay.setPosition(coordinate);
                //Фильтруем результаты в таблице с заказами
                table = $('#example').dataTable();
                var keywords = filter;
                filter = '';
                for (var i=0; i<keywords.length; i++) {
                    filter = (filter!=='') ? filter+'|'+"^"+keywords[i]+"$" : "^"+keywords[i]+"$";   
                }
                table.fnFilter(filter, 0, true, false, true, true);
   }}
);
    }
    //Новый заказ
    if (activepanel == '#panel2content') {
        $("#archivetbl").empty();
        user_layer.setVisible(false);
        vector.setVisible(true);
        geotiff.setVisible(false);
        newlayer.setVisible(false);
        map.removeInteraction(selectClick);
    }
    //Архив
    if (activepanel == '#panel1content') {
        changemsg("Выберите один из вариантов слева");
        user_layer.setVisible(false);
        vector.setVisible(true);
        geotiff.setVisible(false);
        refreshSelectedLayer(archive_layer);
        //map.removeInteraction(selectClick);///////////
        //map.addInteraction(selectClick);////////////
        map.on('singleclick', function(evt) {
            alert('mistake');
            var coordinate = evt.coordinate;
            var number=archive_src.getFeaturesAtCoordinate(coordinate).length;
            var pixel = map.getEventPixel(evt.originalEvent);
            table = $('#arctbl').DataTable();
            var hit = map.hasFeatureAtPixel(pixel);
            ///если нажали не на фичер
            if (!hit){
                $('.success').removeClass('success');
                table.search( '' ).columns().search( '' ).draw();
                selectClick.getFeatures().clear();
            }
            ////Если нажали на фичер
            if (number>0){
                var filter=[];
                for (var i=0;i<number;i++){
                    var feature = archive_src.getFeaturesAtCoordinate(coordinate)[i];
                    filter.push(feature.get('id'));
                    }
                ////Фильтруем результаты в таблице
                table = $('#arctbl').dataTable();
                var keywords = filter;
                filter = '';
                for (var i=0; i<keywords.length; i++) {
                    filter = (filter!=='') ? filter+'|'+"^"+keywords[i]+"$" : "^"+keywords[i]+"$";
                }
                table.fnFilter(filter, 1, true, false, true, true);
   }}
);
    }

    openNav();
};

////////////////////////////////////////////////// 
//Функция обработки загруженного шейпа
function upshp(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    var formData = new FormData();
    formData.append('file', $('input[type=file]')[0].files[0]);
    $.ajax ({
      url:'/upshp',
      data:formData,
      async:true,
      type:'POST',
      processData: false,
      contentType: false,
      success:function(data){
        $('.results').html(data);
      }
    });
};
    </script>
@endsection
