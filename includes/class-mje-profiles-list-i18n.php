<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://enginethemes.com
 * @since      1.0.0
 *
 * @package    Mje_Profiles_List
 * @subpackage Mje_Profiles_List/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mje_Profiles_List
 * @subpackage Mje_Profiles_List/includes
 * @author     EngineThemes <support@enginethemes.com>
 */
class Mje_Profiles_List_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mje-profiles-list',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
