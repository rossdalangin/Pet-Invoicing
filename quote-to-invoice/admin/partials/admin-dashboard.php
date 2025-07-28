<div class="wrap">
	<h1><?php _e( 'Quote to Invoice Dashboard', 'quote-to-invoice' ); ?></h1>

	<h2 class="nav-tab-wrapper">
		<a href="#quotes" class="nav-tab nav-tab-active"><?php _e( 'Quotes', 'quote-to-invoice' ); ?></a>
		<a href="#orders" class="nav-tab"><?php _e( 'Orders', 'quote-to-invoice' ); ?></a>
	</h2>

	<div id="quotes" class="tab-content">
		<h3><?php _e( 'Quotes', 'quote-to-invoice' ); ?></h3>
		<?php
		// Display the quotes table.
		$quotes_table = new QTI_Quotes_List_Table();
		$quotes_table->prepare_items();
		$quotes_table->display();
		?>
	</div>

	<div id="orders" class="tab-content" style="display: none;">
		<h3><?php _e( 'Orders', 'quote-to-invoice' ); ?></h3>
		<?php
		// Display the orders table.
		$orders_table = new QTI_Orders_List_Table();
		$orders_table->prepare_items();
		$orders_table->display();
		?>
	</div>
</div>
