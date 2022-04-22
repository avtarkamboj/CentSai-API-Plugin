jQuery(function($){
	$('.c1-sync-now').click(function(event){
		event.stopPropagation();
		var button = $(this),
		    data = {
			'action':'centsai_one_sync_posts',
			'page' : centsai_loadmore_params.current_page,
		};
		button.css("pointer-events", "none");
		//button.off('click');
		var button_text = button.text();
		$.post({
			url : centsai_loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			dataType: 'json',
			//async: false,
			beforeSend : function ( xhr ) {
				button.text('Syncing...');
				$('.c1-s-status').html('...');
				$('.c1-last-s').html('...');
			},
			complete: function(){
				
			},
			success : function( data ){
				console.log(data);
				/*console.log('CurrentPage: '+centsai_loadmore_params.current_page);
				console.log('Total: '+max_pages);*/
				centsai_loadmore_params.current_page++;
				if(data){
					button.text(button_text);
					$('.c1-s-status').html(data.status);
					$('.c1-last-s').html(data.date);
				} else {
					jQuery('.centsai-one-pagination').css('display', 'none');
				}
				button.css("pointer-events", "auto");
			}
		});
	});
});