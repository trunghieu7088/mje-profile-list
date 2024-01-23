<?php

/**
 *
 * @link              https://www.enginethemes.com
 * @since             1.0.0
 * @package           Mje_Profiles_List
 *
 * @wordpress-plugin
 * Plugin Name:       MjE Profile List
 * Plugin URI:        https://enginethemes.com
 * Description:       an MjE plugin to add the profile list block to homepage
 * Version:           1.0.0
 * Author:            EngineThemes
 * Author URI:        https://www.enginethemes.com/
 * License:           GPL-2.0+
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mje-profiles-list
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}


define('MJE_PROFILES_LIST_VERSION', '1.0.0');

//custom code
define('MJE_PROFILES_LIST_PATH', dirname(__FILE__));
define('MJE_PROFILES_LIST_URL', plugin_dir_url(__FILE__));

//end

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mje-profiles-list-activator.php
 */
function activate_mje_profiles_list()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-mje-profiles-list-activator.php';
	Mje_Profiles_List_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mje-profiles-list-deactivator.php
 */
function deactivate_mje_profiles_list()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-mje-profiles-list-deactivator.php';
	Mje_Profiles_List_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_mje_profiles_list');
register_deactivation_hook(__FILE__, 'deactivate_mje_profiles_list');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-mje-profiles-list.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mje_profiles_list()
{

	$plugin = new Mje_Profiles_List();
	$plugin->run();
}
run_mje_profiles_list();

//custom code
function require_custom_subscription_mje_files()
{
	require_once MJE_PROFILES_LIST_PATH . '/includes/functions.php';
	require_once MJE_PROFILES_LIST_PATH . '/admin/settings.php';
}
add_action('after_setup_theme', 'require_custom_subscription_mje_files'); 
//end