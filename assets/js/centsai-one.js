jQuery(function($){
	$('.centsai_one_loadmore').click(function(event){
		event.stopPropagation();
		//console.log('Loading');
		var max_pages = jQuery('input[name="max_pages"]').val();
		var button = $(this),
		    data = {
			'action':'centsai_one_more_posts',
			'page' : centsai_loadmore_params.current_page,
		};
		button.attr("disabled","disabled");
		var button_text = button.text();
		$.post({
			url : centsai_loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			dataType: 'json',
			//async: false,
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			complete: function(){
				
			},
			success : function( data ){
				//console.log(data);
				/*console.log('CurrentPage: '+centsai_loadmore_params.current_page);
				console.log('Total: '+max_pages);*/
				centsai_loadmore_params.current_page++;
				if(data){
					button.text(button_text);
					$('#centsai-one-ajax-content').append(data.data);
					if ( centsai_loadmore_params.current_page == data.max_pages ){
						jQuery('.centsai-one-pagination').css('display', 'none');
					}else{
						jQuery('.centsai-one-pagination').css('display', 'block');
						button.attr("disabled", false);
					}
					var maxHeight = 0;
					$("div.l-p-col").each(function(){
					   if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
					});
					$("div.l-p-col").height(maxHeight);
					centsai_equal_height();
				} else {
					jQuery('.centsai-one-pagination').css('display', 'none');
				}
			}
		});
	});
});


jQuery(document).ready(function(){
	centsai_equal_height();
});

function centsai_equal_height(){
	var maxHeight = 0;
	jQuery(".l-p-col").each(function(){
	   if (jQuery(this).height() > maxHeight) { maxHeight = jQuery(this).height(); }
	});
	jQuery(".l-p-col").height(maxHeight);
}