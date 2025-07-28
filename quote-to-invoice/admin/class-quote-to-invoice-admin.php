<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Quote_To_Invoice
 * @subpackage Quote_To_Invoice/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Quote_To_Invoice
 * @subpackage Quote_To_Invoice/admin
 * @author     Your Name <email@example.com>
 */
class Quote_To_Invoice_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Quote_To_Invoice_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Quote_To_Invoice_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/quote-to-invoice-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Quote_To_Invoice_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Quote_To_Invoice_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/quote-to-invoice-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the custom post types.
	 *
	 * @since    1.0.0
	 */
	public function register_post_types() {
		$labels = array(
			'name'               => _x( 'Quotes', 'post type general name', 'quote-to-invoice' ),
			'singular_name'      => _x( 'Quote', 'post type singular name', 'quote-to-invoice' ),
			'menu_name'          => _x( 'Quotes', 'admin menu', 'quote-to-invoice' ),
			'name_admin_bar'     => _x( 'Quote', 'add new on admin bar', 'quote-to-invoice' ),
			'add_new'            => _x( 'Add New', 'quote', 'quote-to-invoice' ),
			'add_new_item'       => __( 'Add New Quote', 'quote-to-invoice' ),
			'new_item'           => __( 'New Quote', 'quote-to-invoice' ),
			'edit_item'          => __( 'Edit Quote', 'quote-to-invoice' ),
			'view_item'          => __( 'View Quote', 'quote-to-invoice' ),
			'all_items'          => __( 'All Quotes', 'quote-to-invoice' ),
			'search_items'       => __( 'Search Quotes', 'quote-to-invoice' ),
			'parent_item_colon'  => __( 'Parent Quotes:', 'quote-to-invoice' ),
			'not_found'          => __( 'No quotes found.', 'quote-to-invoice' ),
			'not_found_in_trash' => __( 'No quotes found in Trash.', 'quote-to-invoice' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'quote-to-invoice' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'quote' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( 'qti_quote', $args );

		$labels = array(
			'name'               => _x( 'Orders', 'post type general name', 'quote-to-invoice' ),
			'singular_name'      => _x( 'Order', 'post type singular name', 'quote-to-invoice' ),
			'menu_name'          => _x( 'Orders', 'admin menu', 'quote-to-invoice' ),
			'name_admin_bar'     => _x( 'Order', 'add new on admin bar', 'quote-to-invoice' ),
			'add_new'            => _x( 'Add New', 'order', 'quote-to-invoice' ),
			'add_new_item'       => __( 'Add New Order', 'quote-to-invoice' ),
			'new_item'           => __( 'New Order', 'quote-to-invoice' ),
			'edit_item'          => __( 'Edit Order', 'quote-to-invoice' ),
			'view_item'          => __( 'View Order', 'quote-to-invoice' ),
			'all_items'          => __( 'All Orders', 'quote-to-invoice' ),
			'search_items'       => __( 'Search Orders', 'quote-to-invoice' ),
			'parent_item_colon'  => __( 'Parent Orders:', 'quote-to-invoice' ),
			'not_found'          => __( 'No orders found.', 'quote-to-invoice' ),
			'not_found_in_trash' => __( 'No orders found in Trash.', 'quote-to-invoice' )
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'quote-to-invoice' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => 'quote-to-invoice',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'order' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
		);

		register_post_type( 'qti_order', $args );
	}

	/**
	 * Generate the quote total.
	 *
	 * @since    1.0.0
	 */
	public function generate_quote( $post_id, $post ) {
		if ( $post->post_type !== 'qti_quote' ) {
			return;
		}

		// Get the quote data.
		global $wpdb;
		$table_name = $wpdb->prefix . 'qti_quotes';
		$quote = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $post_id ) );

		// Get the distance between the origin and destination airports.
		$distance = $this->get_distance( $quote->origin_airport, $quote->destination_airport );

		// Calculate the quote total.
		$base_rate = 100;
		$rate_per_mile = 0.5;
		$weight_surcharge = $quote->pet_weight * 2;
		$quote_total = $base_rate + ( $distance * $rate_per_mile ) + $weight_surcharge;

		// Update the quote total in the database.
		$wpdb->update(
			$table_name,
			array(
				'quote_total' => $quote_total,
			),
			array(
				'id' => $post_id,
			)
		);
	}

	/**
	 * Get the distance between two airports.
	 *
	 * @since    1.0.0
	 */
	public function get_distance( $origin, $destination ) {
		// In a real application, you would use a service like the Google Maps Distance Matrix API to get the distance.
		// For this example, we'll just return a random number.
		return rand( 100, 1000 );
	}

	/**
	 * Add the menu page.
	 *
	 * @since    1.0.0
	 */
	public function add_menu_page() {
		add_menu_page(
			__( 'Quote to Invoice', 'quote-to-invoice' ),
			__( 'Quote to Invoice', 'quote-to-invoice' ),
			'manage_options',
			'quote-to-invoice',
			array( $this, 'display_admin_dashboard' ),
			'dashicons-text-page',
			25
		);
	}

	/**
	 * Display the admin dashboard.
	 *
	 * @since    1.0.0
	 */
	public function display_admin_dashboard() {
		require_once QTI_PLUGIN_DIR . 'admin/class-qti-quotes-list-table.php';
		require_once QTI_PLUGIN_DIR . 'admin/class-qti-orders-list-table.php';

		include_once QTI_PLUGIN_DIR . 'admin/partials/admin-dashboard.php';
	}

	/**
	 * Add the nanny meta box.
	 *
	 * @since    1.0.0
	 */
	public function add_nanny_meta_box() {
		add_meta_box(
			'qti_nanny_meta_box',
			__( 'Assign Nanny', 'quote-to-invoice' ),
			array( $this, 'display_nanny_meta_box' ),
			'qti_order',
			'side',
			'default'
		);
	}

	/**
	 * Display the nanny meta box.
	 *
	 * @since    1.0.0
	 */
	public function display_nanny_meta_box( $post ) {
		include_once QTI_PLUGIN_DIR . 'admin/partials/nanny-meta-box.php';
	}

	/**
	 * Save the nanny ID.
	 *
	 * @since    1.0.0
	 */
	public function save_nanny( $post_id ) {
		if ( isset( $_POST['qti_nanny_id'] ) ) {
			update_post_meta( $post_id, '_qti_nanny_id', sanitize_text_field( $_POST['qti_nanny_id'] ) );
		}
	}

	/**
	 * Add the invoice meta box.
	 *
	 * @since    1.0.0
	 */
	public function add_invoice_meta_box() {
		add_meta_box(
			'qti_invoice_meta_box',
			__( 'Invoice', 'quote-to-invoice' ),
			array( $this, 'display_invoice_meta_box' ),
			'qti_order',
			'side',
			'default'
		);
	}

	/**
	 * Display the invoice meta box.
	 *
	 * @since    1.0.0
	 */
	public function display_invoice_meta_box( $post ) {
		?>
		<p>
			<a href="<?php echo esc_url( add_query_arg( array( 'generate_invoice' => $post->ID ) ) ); ?>" class="button" target="_blank"><?php _e( 'Generate Invoice', 'quote-to-invoice' ); ?></a>
		</p>
		<?php
	}

}
