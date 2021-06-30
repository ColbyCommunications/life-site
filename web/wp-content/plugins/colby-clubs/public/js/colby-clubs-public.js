(function( $ ) {
	'use strict';

	load_results();
	
	var timer, delay = 500;
	$('#club_search').bind('input', function(e) {
		var _this = $(this);
		clearTimeout(timer);
		timer = setTimeout(function() {
			load_results();
		}, delay );
	});

	$('.clubs-orgs__filter__cats a').bind( 'click', function(e) {
		e.preventDefault();
		$('.clubs-orgs__filter__cats a').removeClass('selected');
		$(this).addClass('selected');
		let id = $(this).data('term');
		window.location.hash = id;
		load_results();
	});

	$('.pagination').on( 'click', 'a', function(e) {
		e.preventDefault();
		$('.pagination a').removeClass('selected');
		$(this).addClass('selected');
		let page = $(this).data('page');
		load_results( page );
	});

	function load_results( page ) {
		const urlParams = new URLSearchParams(window.location.search);
		let search = $("#club_search").val(),
			cc_club_tax = parseInt( window.location.hash.replace(/\#/, '') ),
			$loading    = $('#club_loading'),
			$results    = $('#club_results'),
			$no_results = $('#club_noresults'),
			$pagination = $('#club_pagination'),
			per_page    = 10,
			data        = {};
		$no_results.hide();
		$results.hide();
		$loading.fadeIn();
		$pagination.hide();

		if ( ! isNaN( cc_club_tax ) && ( cc_club_tax != 0 ) ) {
			data['cc_club_tax'] = cc_club_tax;
		}
		if ( search ) {
			data['search'] = search;
		};

		data['per_page'] = per_page;
		data['page'] = ( page ? page : 1 );
		data['orderby'] = 'title';
		data['order'] = 'asc';

		let jqXHR = $.ajax({
			dataType : 'json',
			url : data_in.rest_url,
			method : 'GET',
			data : data,
		}).done(function(response, textStatus, xhr){
			$loading.hide();
			let count = Object.keys(response).length;
			if ( count > 0 ) {
				$results.text('').show(); // clear it out.
				$.each( response, function( index, object ) { 
					let output = '';
					output = '<div class="item">';
					output += '<h3>' + object.title.rendered + '</h3>';
					output += '<div class="content">' + object.content.rendered + '</div>';
					output += '</div>';
					$(output).hide().appendTo($results).fadeIn();
				});
				display_pagination( xhr, page, $pagination );
			} else {
				$no_results.fadeIn();
			}
		}).fail(function(response){
			// Show error message
			console.log( 'fail', response );
			alert( response.responseJSON.message );
		}).always(function(){
			// e.g. Remove 'loading' class.
			// console.log("always");
		});

		
	}

	function display_pagination( xhr, page, $pagination )	 {
		let rows  = xhr.getResponseHeader( 'X-WP-Total' ),
			pages = xhr.getResponseHeader( 'X-WP-TotalPages' ),
			html  = '',
			selected = '';
		
		page = ( page ? page : 1 );
		html = '';
		if ( pages > 1 ) {
			for (let i = 0; i < pages; i++) {
				selected = ( page == i+1 ) ? ' class="selected"' : '';
				html += '<li><a href="#" data-page="' + (i+1) + '"' + selected + '>' + (i+1) + '</a></li>';
			}
			html = '<ul class="page-numbers">' + html + '</ul>';	
			$pagination.html(html).fadeIn();
		}
	}

})( jQuery );
