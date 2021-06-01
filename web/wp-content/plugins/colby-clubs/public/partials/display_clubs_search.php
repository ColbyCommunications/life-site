<?php

$keywords   = isset( $search_args['keywords'] ) ? wp_unslash( $search_args['keywords'] ) : '';
$categories = get_terms( [ 'taxonomy' => 'cc_club_tax' ] );

?>

<div class="search-form-container" id="results">
	<h3>SEARCH:</h3>
	<form role="search" action="#results" method="get" class="search-form" >
		<div class="search-form__input keywords">
			<label for="keywords" class="screen-reader-text">Keywords</label>
			<input id="keywords" type="text" name="keywords" class="keywords" value="<?php echo esc_html( $keywords ); ?>" placeholder="By Title, or Keyword" />
		</div>
		<div class="search-form__input">
			<label for="category" class="screen-reader-text">Category</label>
			<select id="category" name="category">
				<?php echo Colby_Clubs_Admin::terms_as_options( $categories, 'Select A Category...', $search_args['category'] ); ?>
			</select>
		</div>
		<div class="search-form__input">
			<input type="submit" name="submit" value="Search" />
		</div>
		<input type="hidden" name="paged" value="1" />
	</form>
</div>
