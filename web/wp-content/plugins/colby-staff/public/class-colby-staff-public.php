<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.neilarnold.com
 * @since      1.0.0
 *
 * @package    Colby_Staff
 * @subpackage Colby_Staff/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Colby_Staff
 * @subpackage Colby_Staff/public
 * @author     Neil P. Arnold <neilparnold@gmail.com>
 */
class Colby_Staff_Public {

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
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/colby-staff-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/colby-staff-public.js', array( 'jquery' ), $this->version, false );
	}

	public function register_shortcodes() {
		add_shortcode( 'display_staff', array( $this, 'shortcode_display_staff' ) );
	}

	public function shortcode_display_staff( $atts ) {
		$pagination  = '';
		$summary     = '';
		$search_args = Colby_Staff_Admin::get_search_args();
		$posts       = Colby_Staff_Admin::get_all( $search_args, $pagination, $summary );

		// wp_enqueue_script( $this->plugin_name );
		wp_enqueue_style( $this->plugin_name );

		ob_start();
		require_once plugin_dir_path( __FILE__ ) . 'partials/display_staff.php';
		return ob_get_clean();
	}

}
