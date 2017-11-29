    $('.modal-body').on('click', '#add2cartbtn', function () {
        var token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
	type: 'POST',
  	async: true,
  	url: '/cart',
  	data : {id:"{{ $product->id }}",name:"{{ $product->imgname }}",price:"{{ $product->price }}",_token:token},
  	success: function(data) {
  }
});
});
