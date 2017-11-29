        <div class="row">
<form class="form-horizontal" role="form" method="POST" action="javascript:void(null);" id='formcoords'>
                        {{ csrf_field() }}
<TABLE BORDER="0" id="tblData">
  <thead>
  <TR><TD></TD><TH>Long</TH><TH>Lat</TH></TR>
  </thead>
  <tbody>
  <TR>
    <TH>Координата 1</TH>
    <TD>
      <INPUT TYPE="TEXT" NAME="long1" SIZE="5">
    </TD>
    <TD>
      <INPUT TYPE="TEXT" NAME="lat1" SIZE="5">
    </TD>
  </TR>
    <TR>
    <TH>Координата 2</TH>
    <TD>
      <INPUT TYPE="TEXT" NAME="long2" SIZE="5">
    </TD>
    <TD>
      <INPUT TYPE="TEXT" NAME="lat2" SIZE="5">
    </TD>
  </TR>
    <TR>
    <TH>Координата 3</TH>
    <TD>
      <INPUT TYPE="TEXT" NAME="long3" SIZE="5">
    </TD>
    <TD>
      <INPUT TYPE="TEXT" NAME="lat3" SIZE="5">
    </TD>
  </TR>
    <TR>
    <TH>Координата 4</TH>
    <TD>
      <INPUT TYPE="TEXT" NAME="long4" SIZE="5">
    </TD>
    <TD>
      <INPUT TYPE="TEXT" NAME="lat4" SIZE="5">
    </TD>
  </TR>
  </tbody>
</TABLE>
<button id='btnAdd' type='button'>Add Row</button>
<P><button type='submit' id='submitcoords'>Submit</button></P>
</form>
<div id="myAlert" class="alert alert-warning" style='display: none;'>
    <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Ошибка при заполнении полей</strong>
</div>            
        </div>
<script>
    var i=4;
$(function(){
	$("#btnAdd").bind("click", Add);
});

function isEveryInputFilled() {
    var allFilled = true;

    $('#formcoords input').each(function() {
        if ($(this).val() == '') {
            allFilled = false;
            return false; // we've found a non-empty one, so stop iterating
        }
    });

    return allFilled;
}
    function Add(){
        i=i+1;
	$("#tblData tbody").append(
"<tr><TH>Координата "+i+"</TH><TD><INPUT TYPE='TEXT' NAME='long"+i+"' SIZE='5'></TD><TD><INPUT TYPE='TEXT' NAME='lat"+i+"' SIZE='5'></TD><td><button class='btnDel' type='button'>×</button></td></tr>"
	//<!--<td><img src='images/disk.png' class='btnSave'><img src='images/delete.png' class='btnDelete'/></td>-->
);	
		//$("#btnDel").bind("click", Delete);
}; 
//function Delete(){
$('#tblData').on('click', '.btnDel', function () {
var par = $(this).parent().parent(); //tr
par.remove();
});
$( "#formcoords" ).submit(function( event ) {
//$('.modal-body').on('click', '#submitcoords', function (event) {
    var result = isEveryInputFilled();
    if ( !result) {
    //if($("#formcoords input:empty").length == 0) {
        $("#myAlert").fadeIn();
        event.preventDefault();
    } else {
        $.ajax({
        type: 'POST',
        async: true,
        url: '/fillcoords',
        data : $( "#formcoords" ).serializeArray(),
        success: function(data) {
        
  }
});
    }}
        
);
</script>