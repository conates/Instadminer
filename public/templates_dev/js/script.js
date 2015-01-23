	var SITE_URL = $('body').attr('data-site-url');
	var app = {
		init : function()
		{
			app.search();
			app.event.deleteBtn();

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
					$('.get-more').removeClass('hide').find('a').attr('last-url', data.pagination.next_url);
					
					app.event.addBtn();

				})
				.fail(function(data) {
					console.log("error");
				});
				return false;
			});
		},
		addData : function (element)
		{
			var id = element.attr('data-id');
			$.ajax({
				url: SITE_URL+'admin/get-data-instagram-by-id',
				dataType: 'json',
				data: {id: id},
			})
			.done(function() {
				element.parent().remove();
			})
			.fail(function() {
				alert("Ha ocurrido un error en guardar el elemento.");
			});
		},
		deleteData : function (element)
		{
			var id = element.attr('data-id');
			$.ajax({
				url: SITE_URL+'admin/delete',
				dataType: 'json',
				data: {id: id},
			})
			.done(function(result) {
				if (result) {
					element.parents('tr').remove();
				}else{
					alert('Ha ocurrido un problema en eliminar el elemento.')
				};
			})
			.fail(function() {
				return false;
			});
			
		}
	};
	app.event = {} ;
	app.event = {
		addBtn: function() {
			$('.add-btn').click(function(event) {
				event.preventDefault();
				var e = $(this);
				app.addData(e);
			});
		},
		getMoreDataInstagram: function(){
			
		},
		deleteBtn: function(){
			$('.btn-delete').click(function(event) {
				event.preventDefault();
				var e = $(this);
				app.deleteData(e);

			});
		}
	};
	$(document).ready(function(){
		app.init();
	});		
