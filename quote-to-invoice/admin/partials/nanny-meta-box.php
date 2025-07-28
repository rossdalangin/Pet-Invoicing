<?php
global $wpdb;

$nannies = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}qti_nannies" );
$assigned_nanny = get_post_meta( $post->ID, '_qti_nanny_id', true );

?>
<p>
	<label for="qti_nanny_id"><?php _e( 'Select a Nanny', 'quote-to-invoice' ); ?></label>
	<select name="qti_nanny_id" id="qti_nanny_id">
		<option value=""><?php _e( 'Select a Nanny', 'quote-to-invoice' ); ?></option>
		<?php foreach ( $nannies as $nanny ) : ?>
			<option value="<?php echo $nanny->id; ?>" <?php selected( $assigned_nanny, $nanny->id ); ?>><?php echo $nanny->first_name . ' ' . $nanny->last_name; ?></option>
		<?php endforeach; ?>
	</select>
</p>
