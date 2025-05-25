jQuery(function($){
	$('body').on('click', '.loadmore button', function() {
 
		var button = $(this);
		var data = {
			'action': 'magazine_newspaper_loadmore',
			'page' : magazine_newspaper_loadmore_params.current_page,
			'cat' : magazine_newspaper_loadmore_params.cat,
			'view' : button.attr('view'),
		};
 
		$.ajax({
			url : magazine_newspaper_loadmore_params.ajaxurl,
			data : data,
			type : 'POST',
			beforeSend : function ( xhr ) {
				button.text('Loading...');
			},
			success : function( data ) {
				if( data ) { 
					$( 'div.flex-table.view' ).append(data);
					button.text( 'More Posts' );
					magazine_newspaper_loadmore_params.current_page++;
 
					if ( magazine_newspaper_loadmore_params.current_page == magazine_newspaper_loadmore_params.max_page ) { 
						button.remove();
					}
				} else {
					button.remove();
				}
			}
		});
	});
});