

<div class="clubs_orgs" id="clubs_orgs">
	<?php
	require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/display_clubs_search.php';

	if ( ! empty( $summary ) ) : ?>
		<div class="clubs_orgs__summary">
			<p><?php echo wp_kses_post( $summary ); ?></p>
		</div>
	<?php endif; ?>

	<?php if ( ! empty( $posts ) ) : ?>
		<div class="clubs_orgs__results">

			<?php
			$index = 0;
			foreach ( $posts as $item ) {
				$link       = esc_url( get_permalink( $item->ID ) );
				$categories = get_the_terms( $item->ID, 'cc_club_tax' );
				$content    = apply_filters( 'the_content', $item->post_content );
				$image      = get_the_post_thumbnail( $item->ID, 'medium' );

				if ( empty( $image ) ) {
					// $image = sprintf('<img src="%s" alt="No Image" />', get_stylesheet_directory_uri() . '/images/no-image.jpg' );
					$image = sprintf('<img src="%s" alt="No Image" />', 'https://via.placeholder.com/300' );
				}

				echo '<div class="clubs_orgs__results__item">';
				echo sprintf( '<h3>%s</h3>', esc_html( $item->post_title ) );
				echo '<div class="text">' . $content . '</div>';
				echo '</div>';
			}
			?>
		</div>

		<div class="resources__pagination pagination">
			<?php echo wp_kses_post( $pagination ); ?>
		</div>
	<?php else: ?>

		<div class="resources_no-results not-found">
			No Items Found with your search criteria.
		</div>
	<?php endif; ?>

</div>
