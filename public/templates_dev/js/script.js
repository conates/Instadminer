	var SITE_URL = $('body').attr('data-site-url');
	var app = {
		event : function()
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
						html += '<div class="col-xs-6 col-sm-3 placeholder">';
							html += '<img src="'+object.images.low_resolution.url+'" class="img-responsive" alt="Generic placeholder thumbnail">';
							html += '<h4>'+object.user.username+'</h4>';
							html += '<span class="text-muted">'+object.caption.text+'</span>';
						html += '</div>';
					});
					$('.object_instagram').empty().html(html);
				})
				.fail(function(data) {
					console.log("error");
				});
				return false;
			});
		}
	}
	$(document).ready(function(){
		app.event();
	});