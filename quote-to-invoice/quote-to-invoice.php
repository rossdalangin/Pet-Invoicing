<?php
/**
 * Plugin Name: Quote to Invoice
 * Plugin URI: https://example.com/
 * Description: A custom quote-to-invoice system for a pet travel company.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com/
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: quote-to-invoice
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
function activate_quote_to_invoice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quote-to-invoice-activator.php';
	Quote_To_Invoice_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_quote_to_invoice() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-quote-to-invoice-deactivator.php';
	Quote_To_Invoice_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_quote_to_invoice' );
register_deactivation_hook( __FILE__, 'deactivate_quote_to_invoice' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-quote-to-invoice.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_quote_to_invoice() {

	$plugin = new Quote_To_Invoice();
	$plugin->run();

}
run_quote_to_invoice();
