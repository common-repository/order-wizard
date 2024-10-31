<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.orderwizard.co.uk
 * @since      1.0.0
 *
 * @package    Orderwizard
 * @subpackage Orderwizard/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Orderwizard
 * @subpackage Orderwizard/public
 * @author     Arbutus Ridge <info@orderwizard.co.uk>
 */
class Orderwizard_Public {

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

	// This is the function called by the short code [owbooking]
	// If there is a key then it will attempt to show the booking widget
	public function owbooking_function() {

			$orderwizard_key = get_option('orderwizard_key');

			if($orderwizard_key!=""){


				echo '<owbooking key="'.$orderwizard_key.'"></owbooking>';

				wp_enqueue_script( "orderwizard_booking", "https://orderwizard.net/appfiles/ow-booking/widget.js", array(), '1.0.0', true );	

			}

	}


	// This is the function called by the short code [owtakeaway]
	// If there is a key then it will attempt to show the takeaway widget
	public function owtakeaway_function() {

			$content="";
			$orderwizard_key = get_option('orderwizard_key');

			if($orderwizard_key!=""){

				echo '<ow-takeaway key="'.$orderwizard_key.'" device="mobile">Loading</ow-takeaway>';
				
				wp_enqueue_script( "orderwizard_booking", "https://orderwizard.net/appfiles/ow-takeaway/wordpress-widget.js", array(), '1.0.0', true );	

			}

	}		



}


