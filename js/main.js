$(document).ready(function() {

	$('.view-aimagen').click(function(){
           // alert('holaaaa');
		var title=$(this).attr('rel');
                var alto = $(this).attr('alto');
		$.fancybox.showActivity();
		$.ajax({
			type: 'POST',
			cache: false,
			url: $(this).attr('href'),
			data: $('.view-aimagen').serializeArray(),
			success: function(data){
				$.fancybox(data, {
					'title': title,
					'titlePosition': 'inside',
					'titleFormat': function(title, currentArray, currentIndex, currentOpts) {
						return '<div id="tip7-title"><span><a href="javascript:;" onclick="$.fancybox.close();">Cerrar</a><br/></span>' + (title && title.length ? '<b>' + title + '</b>' : '' ) + '</div>';
					},
					'showCloseButton': true,
					'autoDimensions': false,
					'width': 950,
					'height': alto,
					'onComplete':function(){
						$('#fancybox-inner').scrollTop(0);
					}
				});
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				$.fancybox('<div class="error">'+XMLHttpRequest.responseText+'</div>');
			}
		});
		return false;
	});

	$('#fancybox-inner .close-code').live('click', function(){
		$.fancybox.close();
		return false;
	});
});