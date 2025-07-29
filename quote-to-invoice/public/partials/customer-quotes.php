<?php
global $wpdb;

$current_user = wp_get_current_user();
$customer = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}qti_customers WHERE user_id = %d", $current_user->ID ) );

if ( $customer ) {
	$quotes = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}qti_quotes WHERE customer_id = %d", $customer->id ) );

	if ( $quotes ) {
		?>
		<table class="shop_table">
			<thead>
				<tr>
					<th><?php _e( 'Quote ID', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Pet Name', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Flight Date', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Total', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Status', 'quote-to-invoice' ); ?></th>
					<th><?php _e( 'Actions', 'quote-to-invoice' ); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $quotes as $quote ) : ?>
					<tr>
						<td>#<?php echo $quote->id; ?></td>
						<td><?php echo $quote->pet_name; ?></td>
						<td><?php echo $quote->flight_date; ?></td>
						<td>$<?php echo number_format( $quote->quote_total, 2 ); ?></td>
						<td><?php echo $quote->status; ?></td>
						<td>
							<a href="<?php echo esc_url( add_query_arg( array( 'view_quote' => $quote->id ), get_permalink( get_page_by_path( 'customer-dashboard' ) ) ) ); ?>" class="button"><?php _e( 'View', 'quote-to-invoice' ); ?></a>
							<?php if ( $quote->status === 'pending' ) : ?>
								<a href="<?php echo esc_url( add_query_arg( array( 'accept_quote' => $quote->id ), get_permalink( get_page_by_path( 'customer-dashboard' ) ) ) ); ?>" class="button"><?php _e( 'Accept', 'quote-to-invoice' ); ?></a>
							<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<?php
	} else {
		echo '<p>' . __( 'You have no quotes.', 'quote-to-invoice' ) . '</p>';
	}
}
