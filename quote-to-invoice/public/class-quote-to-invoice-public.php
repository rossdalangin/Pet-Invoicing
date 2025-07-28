<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Quote_To_Invoice
 * @subpackage Quote_To_Invoice/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Quote_To_Invoice
 * @subpackage Quote_To_Invoice/public
 * @author     Your Name <email@example.com>
 */
class Quote_To_Invoice_Public {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/quote-to-invoice-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/quote-to-invoice-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the [quote_request_form] shortcode.
	 *
	 * @since    1.0.0
	 */
	public function register_shortcodes() {
		add_shortcode( 'quote_request_form', array( $this, 'quote_request_form' ) );
		add_shortcode( 'customer_quotes', array( $this, 'customer_quotes_shortcode' ) );
		add_shortcode( 'customer_orders', array( $this, 'customer_orders_shortcode' ) );
	}

	/**
	 * The quote request form.
	 *
	 * @since    1.0.0
	 */
	public function quote_request_form() {
		ob_start();
		include_once QTI_PLUGIN_DIR . 'public/partials/quote-request-form.php';
		return ob_get_clean();
	}

	/**
	 * Process the quote request form submission.
	 *
	 * @since    1.0.0
	 */
	public function process_quote_request() {
		if ( isset( $_POST['submit_quote_request'] ) ) {
			// Sanitize and validate the form data.
			$first_name = sanitize_text_field( $_POST['first_name'] );
			$last_name = sanitize_text_field( $_POST['last_name'] );
			$email = sanitize_email( $_POST['email'] );
			$phone = sanitize_text_field( $_POST['phone'] );
			$address = sanitize_text_field( $_POST['address'] );
			$city = sanitize_text_field( $_POST['city'] );
			$state = sanitize_text_field( $_POST['state'] );
			$zip = sanitize_text_field( $_POST['zip'] );
			$pet_name = sanitize_text_field( $_POST['pet_name'] );
			$pet_type = sanitize_text_field( $_POST['pet_type'] );
			$pet_breed = sanitize_text_field( $_POST['pet_breed'] );
			$pet_age = intval( $_POST['pet_age'] );
			$pet_weight = floatval( $_POST['pet_weight'] );
			$origin_airport = sanitize_text_field( $_POST['origin_airport'] );
			$destination_airport = sanitize_text_field( $_POST['destination_airport'] );
			$flight_date = sanitize_text_field( $_POST['flight_date'] );

			// Create a new customer.
			global $wpdb;
			$user_id = email_exists( $email );
			if ( ! $user_id ) {
				$password = wp_generate_password();
				$user_id = wp_create_user( $email, $password, $email );
				wp_new_user_notification( $user_id, null, 'both' );
			}
			$user = get_user_by( 'id', $user_id );
			$user->add_role( 'qti_customer' );

			$table_name = $wpdb->prefix . 'qti_customers';
			$wpdb->insert(
				$table_name,
				array(
					'user_id'    => $user_id,
					'first_name' => $first_name,
					'last_name'  => $last_name,
					'email'      => $email,
					'phone'      => $phone,
					'address'    => $address,
					'city'       => $city,
					'state'      => $state,
					'zip'        => $zip,
					'created_at' => current_time( 'mysql' ),
				)
			);
			$customer_id = $wpdb->insert_id;

			// Create a new quote.
			$quote_id = wp_insert_post( array(
				'post_title'  => 'Quote for ' . $first_name . ' ' . $last_name,
				'post_status' => 'publish',
				'post_type'   => 'qti_quote',
			) );

			$table_name = $wpdb->prefix . 'qti_quotes';
			$wpdb->insert(
				$table_name,
				array(
					'id'                  => $quote_id,
					'customer_id'         => $customer_id,
					'pet_name'            => $pet_name,
					'pet_type'            => $pet_type,
					'pet_breed'           => $pet_breed,
					'pet_age'             => $pet_age,
					'pet_weight'          => $pet_weight,
					'origin_airport'      => $origin_airport,
					'destination_airport' => $destination_airport,
					'flight_date'         => $flight_date,
					'created_at'          => current_time( 'mysql' ),
				)
			);

			// Trigger the new quote action.
			// do_action( 'qti_new_quote', $quote_id );

			// Redirect to a success page.
			wp_redirect( home_url( '/quote-submitted/' ) );
			exit;
		}
	}

	/**
	 * Send new quote notifications.
	 *
	 * @since    1.0.0
	 */
	public function send_new_quote_notifications( $quote_id ) {
		// Get the quote data.
		global $wpdb;
		$table_name = $wpdb->prefix . 'qti_quotes';
		$quote      = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $quote_id ) );

		// Get the customer data.
		$table_name = $wpdb->prefix . 'qti_customers';
		$customer   = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $quote->customer_id ) );

		// Send the admin notification.
		$admin_email = get_option( 'admin_email' );
		$subject     = 'New Quote Request';
		$message     = 'A new quote has been requested. You can view it here: ' . admin_url( 'post.php?post=' . $quote_id . '&action=edit' );
		wp_mail( $admin_email, $subject, $message );

		// Send the customer notification.
		$subject = 'Your Quote Request';
		$message = 'Thank you for your quote request. We will get back to you shortly.';
		wp_mail( $customer->email, $subject, $message );
	}

	/**
	 * Register the page templates.
	 *
	 * @since    1.0.0
	 */
	public function register_page_templates( $templates ) {
		$templates['template-customer-dashboard.php'] = __( 'Customer Dashboard', 'quote-to-invoice' );

		return $templates;
	}

	/**
	 * Load the page template.
	 *
	 * @since    1.0.0
	 */
	public function load_page_template( $template ) {
		if ( get_page_template_slug() === 'template-customer-dashboard.php' ) {
			$template = QTI_PLUGIN_DIR . 'public/partials/template-customer-dashboard.php';
		}

		return $template;
	}

	/**
	 * The [customer_quotes] shortcode.
	 *
	 * @since    1.0.0
	 */
	public function customer_quotes_shortcode() {
		ob_start();
		include_once QTI_PLUGIN_DIR . 'public/partials/customer-quotes.php';

		return ob_get_clean();
	}

	/**
	 * The [customer_orders] shortcode.
	 *
	 * @since    1.0.0
	 */
	public function customer_orders_shortcode() {
		ob_start();
		include_once QTI_PLUGIN_DIR . 'public/partials/customer-orders.php';

		return ob_get_clean();
	}

	/**
	 * Process the payment.
	 *
	 * @since    1.0.0
	 */
	public function process_payment() {
		if ( isset( $_GET['pay_for_order'] ) ) {
			$order_id = intval( $_GET['pay_for_order'] );

			// Get the order data.
			global $wpdb;
			$table_name = $wpdb->prefix . 'qti_orders';
			$order      = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $order_id ) );

			// Set up the Stripe API.
			require_once QTI_PLUGIN_DIR . 'includes/stripe-php/init.php';
			\Stripe\Stripe::setApiKey( 'sk_test_YOUR_STRIPE_SECRET_KEY' );

			// Create the checkout session.
			$session = \Stripe\Checkout\Session::create(
				array(
					'payment_method_types' => array( 'card' ),
					'line_items'           => array(
						array(
							'price_data' => array(
								'currency'     => 'usd',
								'product_data' => array(
									'name' => 'Order #' . $order->id,
								),
								'unit_amount'  => $order->order_total * 100,
							),
							'quantity'   => 1,
						),
					),
					'mode'                 => 'payment',
					'success_url'          => add_query_arg( 'payment_success', 'true', get_permalink() ),
					'cancel_url'           => get_permalink(),
				)
			);

			// Redirect to the checkout page.
			wp_redirect( $session->url );
			exit;
		}
	}

	/**
	 * Generate the invoice.
	 *
	 * @since    1.0.0
	 */
	public function generate_invoice() {
		if ( isset( $_GET['generate_invoice'] ) ) {
			$order_id = intval( $_GET['generate_invoice'] );

			// Get the order data.
			global $wpdb;
			$table_name = $wpdb->prefix . 'qti_orders';
			$order      = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $order_id ) );

			// Get the customer data.
			$table_name = $wpdb->prefix . 'qti_customers';
			$customer   = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $order->customer_id ) );

			// Load the invoice template.
			include_once QTI_PLUGIN_DIR . 'public/partials/invoice-template.php';
			exit;
		}
	}
}
