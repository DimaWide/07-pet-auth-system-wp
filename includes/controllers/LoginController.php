<?php

// Namespace for plugin controllers
namespace AuthSystemWp\Controllers;

use AuthSystemWp\Models\UserModel;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class LoginController {
    private $errors = []; // Array to store errors

    // Handles the incoming request
    public function handle_request() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handle_login_submission();
        }
        $this->show_login_form();
    }

    // Handles login form submission
    private function handle_login_submission() {
        if (isset($_POST['login_submit'])) {
            $username_or_email = sanitize_text_field($_POST['username_or_email']);
            $password = $_POST['password'];

            // Data validation
            if (empty($username_or_email)) {
                $this->errors['username_or_email'] = 'Please enter your username or email.';
            }

            if (empty($password)) {
                $this->errors['password'] = 'Please enter your password.';
            }

            if (empty($this->errors)) {
                $user = UserModel::find_by_username_or_email($username_or_email);

                // Check if the user exists and the password is valid
                if ($user->is_valid() && $user->check_password($password)) {
                    $user->login();
                    wp_redirect(home_url('/profile/'));
                    exit;
                } else {
                    $this->errors['general'] = 'Invalid username or password.';
                }
            }
        }
    }

    // Displays the login form
    private function show_login_form() {
        $errors = $this->errors;
        include plugin_dir_path(__FILE__) . '../views/login-form.php';
    }
}
