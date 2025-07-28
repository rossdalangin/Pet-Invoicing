<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class QTI_Orders_List_Table extends WP_List_Table {

	public function __construct() {
		parent::__construct( array(
			'singular' => 'order',
			'plural'   => 'orders',
			'ajax'     => false
		) );
	}

	public function get_columns() {
		return array(
			'cb'             => '<input type="checkbox" />',
			'id'             => __( 'ID', 'quote-to-invoice' ),
			'customer'       => __( 'Customer', 'quote-to-invoice' ),
			'nanny'          => __( 'Nanny', 'quote-to-invoice' ),
			'total'          => __( 'Total', 'quote-to-invoice' ),
			'payment_status' => __( 'Payment Status', 'quote-to-invoice' ),
			'order_status'   => __( 'Order Status', 'quote-to-invoice' ),
			'actions'        => __( 'Actions', 'quote-to-invoice' ),
		);
	}

	public function prepare_items() {
		global $wpdb;

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = array();
		$this->_column_headers = array( $columns, $hidden, $sortable );

		$this->items = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}qti_orders" );
	}

	public function column_default( $item, $column_name ) {
		switch ( $column_name ) {
			case 'id':
				return $item->id;
			case 'customer':
				global $wpdb;
				$customer = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}qti_customers WHERE id = %d", $item->customer_id ) );
				return $customer->first_name . ' ' . $customer->last_name;
			case 'nanny':
				global $wpdb;
				$nanny = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}qti_nannies WHERE id = %d", $item->nanny_id ) );
				return $nanny ? $nanny->first_name . ' ' . $nanny->last_name : 'N/A';
			case 'total':
				return '$' . number_format( $item->order_total, 2 );
			case 'payment_status':
				return $item->payment_status;
			case 'order_status':
				return $item->order_status;
			case 'actions':
				return '<a href="' . admin_url( 'post.php?post=' . $item->id . '&action=edit' ) . '">' . __( 'View', 'quote-to-invoice' ) . '</a>';
			default:
				return print_r( $item, true );
		}
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="order[]" value="%s" />', $item->id
		);
	}
}
