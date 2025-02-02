<?php

namespace AuthSystemWp\Controllers;

use AuthSystemWp\Models\UserModel;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class RegistrationController {
    private $errors = []; // Array to store errors

    // Main method to handle the request
    public function handle_request() {
        // Check if the form has been submitted
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handle_form_submission();
        }
        $this->show_registration_form();
    }

    // Method to process the registration form data
    private function handle_form_submission() {
        if (isset($_POST['register_submit'])) {
            // Retrieve form data
            $username = sanitize_text_field($_POST['username']);
            $email = sanitize_email($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            // Validate the data
            if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
                $this->errors['general'] = 'Please fill in all the fields.';
            }

            if (!is_email($email)) {
                $this->errors['email'] = 'Invalid email format.';
            }

            if ($password !== $confirm_password) {
                $this->errors['password'] = 'Passwords do not match.';
            }

            if (empty($this->errors)) {
                // Create the user through the model
                $user = UserModel::create($username, $password, $email);
                if (is_wp_error($user)) {
                    $this->errors['general'] = $user->get_error_message();
                } else {
                    // Redirect to the login page on successful registration
                    wp_redirect(home_url('/login/'));
                    exit;
                }
            }
        }
    }

    // Method to display the registration form
    private function show_registration_form() {
        $errors = $this->errors;
        include plugin_dir_path(__FILE__) . '../views/registration-form.php';
    }
}
