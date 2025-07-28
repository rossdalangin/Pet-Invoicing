<?php
global $wpdb;

$current_user = wp_get_current_user();
$customer = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}qti_customers WHERE user_id = %d", $current_user->ID ) );

if ( $customer ) {
	$orders = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}qti_orders WHERE customer_id = %d", $customer->id ) );

	if ( $orders ) {
		?>
		<table class="shop_table">
			<thead>
				<tr>
					<th><?php _e( 'Order ID', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Date', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Total', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Payment Status', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Order Status', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Actions', 'quote-to-invoice' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $orders as $order ) : ?>
					<tr>
						<td>#<?php echo $order->id; ?></td>
						<td><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->created_at ) ); ?></td>
						<td>$<?php echo number_format( $order->order_total, 2 ); ?></td>
						<td><?php echo $order->payment_status; ?></td>
						<td><?php echo $order->order_status; ?></td>
						<td>
							<a href="<?php echo esc_url( add_query_arg( array( 'view_order' => $order->id ) ) ); ?>" class="button"><?php _e( 'View', 'quote-to-invoice' ); ?></a>
							<?php if ( $order->payment_status === 'pending' ) : ?>
								<a href="<?php echo esc_url( add_query_arg( array( 'pay_for_order' => $order->id ) ) ); ?>" class="button"><?php _e( 'Pay', 'quote-to-invoice' ); ?></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	} else {
		echo '<p>' . __( 'You have no orders.', 'quote-to-invoice' ) . '</p>';
	}
}
