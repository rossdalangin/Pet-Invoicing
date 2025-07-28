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

To display the customer dashboard, create a new page and select the "Customer Dashboard" template from the "Page Attributes" meta box.

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

## Testing

To test the plugin, follow these steps:

1.  **Activate the plugin.**
2.  **Create a new page and add the `[quote_request_form]` shortcode to the content.**
3.  **View the page and submit the quote request form.**
4.  **Check that you are redirected to the "Quote Submitted" page.**
5.  **Go to the "Quotes" menu in the WordPress admin and check that the new quote has been created.**
6.  **Go to the "Users" menu and check that a new user has been created with the "Customer" role.**
7.  **Log in as the new user and go to the "Customer Dashboard" page.**
8.  **Check that you can see the new quote.**
9.  **Log out and log back in as an admin.**
10. **Go to the "Orders" menu and create a new order.**
11. **Assign a nanny to the order.**
12. **Generate an invoice for the order.**
13. **Log in as the nanny and check that you can see the order.**
