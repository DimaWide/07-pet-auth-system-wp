<?php

/**
 * Plugin Name: Auth System Wp
 * Description: Plugin for custom registration, authentication, and user profile.
 * Version: 1.0
 * Author: Dmitriy Chirokij
 * License: GPL2
 */

require 'vendor/autoload.php'; // Include Composer autoloader

use AuthSystemWp\CustomAuthRoutes;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// error_reporting(E_ERROR | E_PARSE);
// error_reporting(1);

// Register styles and scripts
function custom_auth_plugin_enqueue_assets() {
    wp_enqueue_style('custom-auth-style', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('custom-auth-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'custom_auth_plugin_enqueue_assets');


// Initialize the plugin and routes
function custom_auth_plugin_init() {
    // Register routes
    $custom_auth_routes = new CustomAuthRoutes();
}
add_action('init', 'custom_auth_plugin_init');


// Register plugin routes
function register_routes() {
    // Route for the registration page
    add_rewrite_rule('^register/?$', 'index.php?custom_auth=register', 'top');

    // Route for the login page
    add_rewrite_rule('^login/?$', 'index.php?custom_auth=login', 'top');

    // Route for the profile page
    add_rewrite_rule('^profile/?$', 'index.php?custom_auth=profile', 'top');
}
add_action('init', 'register_routes');


// Plugin activation function
function custom_auth_plugin_activate() {
    // Flush rewrite rules
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'custom_auth_plugin_activate');


// Plugin deactivation function
function custom_auth_plugin_deactivate() {
    // Flush rewrite rules on deactivation
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'custom_auth_plugin_deactivate');
