<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Quote_To_Invoice
 * @subpackage Quote_To_Invoice/includes
 * @author     Your Name <email@example.com>
 */
class Quote_To_Invoice_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		self::create_tables();
		self::add_roles();
		self::create_pages();
	}

	/**
	 * Create the custom database tables.
	 *
	 * @since    1.0.0
	 */
	public static function create_tables() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		$table_name = $wpdb->prefix . 'qti_quotes';
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			customer_id mediumint(9) NOT NULL,
			pet_name varchar(255) NOT NULL,
			pet_type varchar(255) NOT NULL,
			pet_breed varchar(255) NOT NULL,
			pet_age tinyint(4) NOT NULL,
			pet_weight decimal(5,2) NOT NULL,
			origin_airport varchar(255) NOT NULL,
			destination_airport varchar(255) NOT NULL,
			flight_date date NOT NULL,
			quote_total decimal(10,2) NOT NULL,
			status varchar(255) NOT NULL DEFAULT 'pending',
			created_at datetime NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		$table_name = $wpdb->prefix . 'qti_orders';
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			quote_id mediumint(9) NOT NULL,
			customer_id mediumint(9) NOT NULL,
			nanny_id mediumint(9) NOT NULL,
			order_total decimal(10,2) NOT NULL,
			payment_status varchar(255) NOT NULL DEFAULT 'pending',
			order_status varchar(255) NOT NULL DEFAULT 'pending',
			created_at datetime NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );

		$table_name = $wpdb->prefix . 'qti_customers';
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			first_name varchar(255) NOT NULL,
			last_name varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			phone varchar(255) NOT NULL,
			address varchar(255) NOT NULL,
			city varchar(255) NOT NULL,
			state varchar(255) NOT NULL,
			zip varchar(255) NOT NULL,
			created_at datetime NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );

		$table_name = $wpdb->prefix . 'qti_nannies';
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			first_name varchar(255) NOT NULL,
			last_name varchar(255) NOT NULL,
			email varchar(255) NOT NULL,
			phone varchar(255) NOT NULL,
			created_at datetime NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );

		$table_name = $wpdb->prefix . 'qti_order_notes';
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			order_id mediumint(9) NOT NULL,
			note text NOT NULL,
			created_at datetime NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );

		$table_name = $wpdb->prefix . 'qti_order_files';
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			order_id mediumint(9) NOT NULL,
			file_name varchar(255) NOT NULL,
			file_url varchar(255) NOT NULL,
			created_at datetime NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";
		dbDelta( $sql );
	}

	/**
	 * Add the custom user roles.
	 *
	 * @since    1.0.0
	 */
	public static function add_roles() {
		add_role( 'qti_customer', __( 'Customer', 'quote-to-invoice' ), array( 'read' => true ) );
		add_role( 'qti_nanny', __( 'Nanny', 'quote-to-invoice' ), array( 'read' => true, 'edit_posts' => true ) );
		add_role( 'qti_coordinator', __( 'Coordinator', 'quote-to-invoice' ), array( 'read' => true, 'edit_posts' => true, 'publish_posts' => true, 'delete_posts' => true ) );
	}

	/**
	 * Create the "Quote Submitted" page.
	 *
	 * @since    1.0.0
	 */
	public static function create_pages() {
		$page_title = 'Quote Submitted';
		$page_content = 'Thank you for your quote request. We will get back to you shortly.';

		$query = new WP_Query( array(
			'post_type'              => 'page',
			'title'                  => $page_title,
			'post_status'            => 'publish',
			'posts_per_page'         => 1,
			'no_found_rows'          => true,
			'ignore_sticky_posts'    => true,
			'update_post_term_cache' => false,
			'update_post_meta_cache' => false,
			'orderby'                => 'post_date ID',
			'order'                  => 'ASC',
		) );

		if ( ! $query->have_posts() ) {
			$page_id = wp_insert_post( array(
				'post_title'   => $page_title,
				'post_content' => $page_content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			) );
		}

		$page_title = 'Customer Dashboard';
		$page_content = '[customer_dashboard]';
		$page = get_page_by_title( $page_title );

		if ( ! $page ) {
			$page_id = wp_insert_post( array(
				'post_title'   => $page_title,
				'post_content' => $page_content,
				'post_status'  => 'publish',
				'post_type'    => 'page',
			) );
			add_post_meta( $page_id, '_wp_page_template', 'template-customer-dashboard.php' );
		}
	}

}
