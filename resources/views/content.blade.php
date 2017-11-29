<!DOCTYPE html>
<html lang="en">
<head>
    <!--<meta charset="utf-8">-->
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Составитель запросов</title>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style>
.hide {
  display: none;
}
    </style>
</head>
<body>


    <div class="container-fluid">
    <div class='row'>
<div class="form-group col-md-8">
  <label for="query">Напишите запрос:</label>
  <textarea class="form-control" rows="9" id="query"></textarea>
  </div>

  <div class="form-group col-md-2">
<div>
  <label for="host">Хост:</label>
  <input type="text" class="form-control" id="host" value='192.168.255.140'>
  </div>
  <div>
    <label for="user">Пользователь:</label>
  <input type="text" class="form-control" id="user" value='admin_kvp'>
  </div>
  <div>
    <label for="pass">Пароль:</label>
  <input type="password" class="form-control" id="pass" value='blockade'>
  </div>
  <div class="hide" id="dbdiv">
    <label for="database">Выбрать БД:</label>
    <select class="form-control" id="database"></select>
  </div>
<button type = "button" id="buttondb" class = "btn btn-primary" onclick="getdb(); return false;">Получить список БД</button>
<div class="checkbox">
  <label><input type="checkbox" checked id='hidemsg'>Показать сервисные сообщения</label>
</div>
</div>
<div class="form-group col-md-2">
  <label for="chosenfile">Выбрать файл:</label>
  <select class="form-control" id="chosenfile">
  <?php
$dir    = 'sql';
$files = preg_grep('/^([^.])/',scandir($dir));
foreach ($files as $file) {
  echo "<option>$file</option>";
}
?>
  </select>
<button type = "button" class = "btn btn-primary" onclick="upquery(); return false;">Загрузить из файла</button>
<button type = "button" class = "btn btn-primary" onclick="del(); return false;">Удалить файл</button>   
  <div class='form-group '>
    <label for="pass">Имя файла:</label>
  <input type="text" class="form-control" id="name" value='test'>
  </div>
<button type = "button" class = "btn btn-primary" onclick="svquery(); return false;">Сохранить запрос</button>
</div>
</div>
<div class='row'>
<!--   <div class='form-group'> -->
    <label class="col-md-1" for="params">Параметры:</label>
  <input class="col-md-2" type="text" class="form-control" id="params">
<!--   </div> -->
<button type = "button" class = "btn btn-primary col-md-2 col-md-push-1" onclick="query(); return false;">Запрос</button>
</div>
</div>

<div id='result' class='row' style="margin-top: 10px;"></div>
</body>
</html>
            <script>
    var hidemsg = 1;
$("#hidemsg").change(function() {
    if(this.checked) {
        hidemsg = 1;
    }
    else {
        hidemsg = 0;
    }
});
    function query(){
    var token = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
      type: "GET",
      url: "/query",
      //dataType: "html",
      data : {query:$('#query').val(),user:$('#user').val(),host:$('#host').val(),pass:$('#pass').val(),db:$('#database option:selected').val(),_token:token, params:$('#params').val(), hidemessage:hidemsg},
      //dataType: "json",
      success: function(data){
        //data = JSON.stringify(data);
        $("#result").html(data);
      },
      error: function(error){
        if(error.responseJSON){
        //var eee = JSON.parse(error);
        //alert(JSON.stringify(error));//["message"]);
        //alert(error["response"])
        var errors = error.responseJSON.error.message;
        errors = JSON.stringify(errors);
        //alert (errors);
        //alert(errors["success"]);
        $("#result").html(errors);}
        else{
            $("#result").html(error);
        }
      },
      beforeSend: function(request){
        //alert(request.url);
      }

    });
    };
	   function svquery(){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/writefile",
      data : {query:$('#query').val(),name:$('#name').val(),_token:token},
      success: function(data){
      $('#chosenfile').append($("<option></option>").text(data)); 
      }

    });
    };
       function upquery(){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/upquery",
      data : {file:$( "#chosenfile option:selected" ).text(),_token:token},
      success: function(data){
        $('#query').val(data);

      }
    });
    };
    function del(){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/del",
      data : {file:$( "#chosenfile option:selected" ).text(),_token:token},
      success: function(data){
      $("#chosenfile option:selected").remove();
      }
    });
    };
    //$("body").on("click", "#buttondb", function() {
      function getdb(){
    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
      type: "POST",
      url: "/getdb",
      data : {user:$('#user').val(),host:$('#host').val(),pass:$('#pass').val(),_token:token},
      success: function(data){
      $("#buttondb").addClass('hide');
      $("#dbdiv").removeClass('hide');
      //alert(data);
      //alert(JSON.parse(data));
      //$('#database').append($('<option></option>')).text('gbdfaaf');
      data = JSON.parse(data);
      //alert((JSON.parse(data))[0]['datname']);
      for (var i = 0; i < data.length; i++) {
        //alert(data[i]['datname']);
      //$('#database').append($('<option></option>').text('gbdfaaf');
      $("#database").append($("<option></option>").text(data[i]['datname']));//text(data[i]['datname']);
      }
      }
    });
    };
    </script>
