	var SITE_URL = $('body').attr('data-site-url');
	var app = {
		init : function()
		{
			app.search();

		},
		search: function()
		{
			$('#search').submit(function(event) {
				var formData = $(this).serialize();
				$.ajax({
					url: SITE_URL+'admin/get-data-instagram',
					type: 'GET',
					dataType: 'json',
					data: formData,
				})
				.done(function(data) {
					html = '';
					$.each(data.data, function(index, object) {
						html += '<div class="col-xs-6 col-sm-3 placeholder c_'+object.id+'">';
							html += '<a data-id="'+object.id+'" class="btn btn-success add-btn" href="http://google.cl" role="button">Agregar</a>';
							html += '<img src="'+object.images.low_resolution.url+'" class="img-responsive" alt="Generic placeholder thumbnail">';
							html += '<h4>'+object.user.username+'</h4>';
							html += '<span class="text-muted">'+object.caption.text+'</span>';
						html += '</div>';
					});
					$('.object_instagram').empty().html(html);
					$('.get-more').removeClass('hide');
					
					app.event.addBtn();

				})
				.fail(function(data) {
					console.log("error");
				});
				return false;
			});
		},
		addData : function (id)
		{
			$.ajax({
				url: SITE_URL+'admin/get-data-instagram-by-id/'+id,
				dataType: 'json',
			})
			.done(function() {
				$('.c_'+id).remove();
			})
			.fail(function() {
				alert("Ha ocurrido un error en guardar el elemento.");
			});
		}
	};
	app.event = {} ;
	app.event = {
		addBtn: function() {
			$('.add-btn').click(function(event) {
				event.preventDefault();
				var id = $(this).attr('data-id');
				app.addData(id);
			});
		}
	};
	$(document).ready(function(){
		app.init();
	});