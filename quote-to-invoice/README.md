# Quote to Invoice

A custom quote-to-invoice system for a pet travel company.

## Description

This plugin provides a complete system for managing quotes and orders for a pet travel company. It includes a front-end quote request form, a customer dashboard, and an admin dashboard.

## Installation

1. Upload the `quote-to-invoice` directory to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

### Quote Request Form

To display the quote request form, create a new page and add the `[quote_request_form]` shortcode to the content.

### Quote Submitted Page

This plugin creates a "Quote Submitted" page when it is activated. This page is where customers are redirected to after they submit a quote request.

### Customer Dashboard

To display the customer dashboard, create a new page and select the "Customer Dashboard" template from the "Page Attributes" meta box. If you do not see the "Customer Dashboard" template, you may need to add the following code to your theme's `functions.php` file:

```php
add_filter( 'theme_page_templates', 'add_customer_dashboard_template' );
function add_customer_dashboard_template( $templates ) {
	$templates['template-customer-dashboard.php'] = __( 'Customer Dashboard', 'quote-to-invoice' );
	return $templates;
}

add_filter( 'template_include', 'load_customer_dashboard_template' );
function load_customer_dashboard_template( $template ) {
	if ( get_page_template_slug() === 'template-customer-dashboard.php' ) {
		$template = WP_PLUGIN_DIR . '/quote-to-invoice/public/partials/template-customer-dashboard.php';
	}
	return $template;
}
```

### Admin Dashboard

The admin dashboard can be accessed from the "Quote to Invoice" menu in the WordPress admin area.

## User Roles

This plugin creates four new user roles:

* **Customer**: This role is assigned to new customers. Customers can only view their own quotes and orders.
* **Nanny**: This role is assigned to nannies. Nannies can only view the orders that are assigned to them.
* **Coordinator**: This role has permission to manage quotes and orders.
* **Admin**: This role has full permission to manage the plugin.

## Payment Gateway

This plugin uses Stripe to process online payments. You will need to enter your Stripe API keys in the plugin settings.

## Invoice Generation

This plugin can generate HTML invoices for orders. To generate an invoice, go to the order edit screen and click the "Generate Invoice" button.

## Branding

To add your own logo to the invoices, replace the `logo.png` file in the `assets/images` directory.
