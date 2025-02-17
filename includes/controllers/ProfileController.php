<?php

namespace AuthSystemWp\Controllers;

use AuthSystemWp\Models\UserModel;

if (!defined('ABSPATH')) {
    exit;
}

class ProfileController {

    private $errors = []; // Array to store errors

    // Handles incoming requests
    public function handle_request() {
        // Ensure the user is logged in
        if (!is_user_logged_in()) {
            wp_redirect(home_url('/login/'));
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handle_profile_update();
        }

        $this->show_profile_page();
    }

    // Handles profile updates
    private function handle_profile_update() {
        $user = UserModel::get_current_user(); 

        // Retrieve data from the form
        $new_email = sanitize_email($_POST['email']);
        $new_password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Validation
        if (empty($new_email)) {
            $this->errors['email'] = 'Email is required.';
        } elseif (!is_email($new_email)) {
            $this->errors['email'] = 'Invalid email format.';
        }

        if (!empty($new_password) && $new_password !== $confirm_password) {
            $this->errors['password'] = 'Passwords do not match.';
            $this->errors['confirm_password'] = 'Passwords do not match.';
        }

        // If no errors, update the user data using the model
        if (empty($this->errors)) {
            $update_result = $user->update($user->get_username() , $new_email, $new_password);

            if ($update_result === true) {
                wp_redirect(home_url('/profile/'));
                exit;
            } else {
                $this->errors['not_updated'] = $update_result->get_error_messages();
            }
        }
    }

    // Returns any errors encountered during processing
    public function get_errors() {
        return $this->errors;
    }

    // Displays the profile page
    private function show_profile_page() {
        $current_user = wp_get_current_user();
        $controller = $this;
        include plugin_dir_path(__FILE__) . '../views/profile-page.php';
    }
}
