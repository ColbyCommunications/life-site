<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.neilarnold.com
 * @since      1.0.0
 *
 * @package    Colby_Clubs
 * @subpackage Colby_Clubs/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Colby_Clubs
 * @subpackage Colby_Clubs/public
 * @author     Neil P. Arnold <neilparnold@gmail.com>
 */
class Colby_Clubs_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_register_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/colby-clubs-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		$data_in = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'rest_url' => get_rest_url( null, 'wp/v2/clubs' ),
		);
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/colby-clubs-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( $this->plugin_name, 'data_in', $data_in );
	}

	public function register_shortcodes() {
		add_shortcode( 'display_clubs_js', array( $this, 'shortcode_display_clubs_js' ) );
		add_shortcode( 'display_clubs', array( $this, 'shortcode_display_clubs' ) );
	}

	public function shortcode_display_clubs( $atts ) {
		$pagination  = '';
		$summary     = '';
		$search_args = Colby_Clubs_Admin::get_search_args();
		$posts       = Colby_Clubs_Admin::get_all( $search_args, $pagination, $summary );

		// wp_enqueue_script( $this->plugin_name );
		wp_enqueue_style( $this->plugin_name );

		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/display_clubs.php';
		return ob_get_clean();
	}

	public function shortcode_display_clubs_js( $atts ) {
		wp_enqueue_script( $this->plugin_name );
		wp_enqueue_style( $this->plugin_name );
		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/display_clubs_js.php';
		return ob_get_clean();
	}

	/**
	 * Displays the catagories as a clickable UL/LI structure for the JS feed.
	 *
	 * @return string HTML for the list.
	 */
	public static function display_category_list() {
		$html  = sprintf( '<li><a href="?term_id=%d" data-term="%d">%s</a></li>', '', '', 'All Categories' );
		$terms = get_terms( [ 'taxonomy' => 'cc_club_tax' ] );
		foreach ( $terms as $term ) {
			$html .= sprintf( '<li><a href="?term_id=%d" data-term="%d" rel="nofollow">%s</a></li>', $term->term_id, $term->term_id, $term->name );
		}

		$html = '<ul>' . $html . '</ul>';

		return wp_kses_post( $html );
	}

}
