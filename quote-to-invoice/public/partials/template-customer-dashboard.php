<?php
/**
 * Template Name: Customer Dashboard
 *
 * This is the template that displays the customer dashboard.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Quote_To_Invoice
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

			<div class="customer-dashboard">
				<h2>Your Quotes</h2>
				<?php echo do_shortcode( '[customer_quotes]' ); ?>

				<h2>Your Orders</h2>
				<?php echo do_shortcode( '[customer_orders]' ); ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
