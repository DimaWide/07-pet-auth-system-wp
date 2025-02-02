<?php

// Declare the namespace for plugin routes
namespace AuthSystemWp;

use AuthSystemWp\Controllers\RegistrationController;
use AuthSystemWp\Controllers\LoginController;
use AuthSystemWp\Controllers\ProfileController;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class CustomAuthRoutes {

    public function __construct() {
        // Register hooks
        add_action('init', array($this, 'register_routes'));
        add_filter('query_vars', array($this, 'add_query_vars'));
        add_action('template_redirect', array($this, 'handle_custom_routes'));
        add_filter('body_class', array($this, 'add_body_classes'));
    }

    // Register plugin routes
    public function register_routes() {
        // Route for the registration page
        add_rewrite_rule('^register/?$', 'index.php?custom_auth=register', 'top');

        // Route for the login page
        add_rewrite_rule('^login/?$', 'index.php?custom_auth=login', 'top');

        // Route for the profile page
        add_rewrite_rule('^profile/?$', 'index.php?custom_auth=profile', 'top');
    }

    // Add custom query variables
    public function add_query_vars($vars) {
        $vars[] = 'custom_auth';
        return $vars;
    }

    // Handle custom routes and display content
    public function handle_custom_routes() {
        $custom_auth = get_query_var('custom_auth');

        if (empty($custom_auth)) {
            return;
        }

        switch ($custom_auth) {
            case 'register':
                // Include the registration controller
                $controller = new RegistrationController();
                $controller->handle_request();
                break;
            case 'login':
                // Include the login controller
                $controller = new LoginController();
                $controller->handle_request();
                break;
            case 'profile':
                // Include the profile controller
                $controller = new ProfileController();
                $controller->handle_request();
                break;
        }
    }

    // Add body classes for custom routes
    public function add_body_classes($classes) {
            $classes[] = 'auth-system-wp';

        return $classes;
    }
}

