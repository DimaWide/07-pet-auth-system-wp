<?php

namespace AuthSystemWp\Models;

use WP_Error;

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

class UserModel {
    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    // Find user by username or email
    public static function find_by_username_or_email($username_or_email) {
        if (is_email($username_or_email)) {
            return new self(get_user_by('email', $username_or_email));
        } else {
            return new self(get_user_by('login', $username_or_email));
        }
    }

    // Check if the password is correct
    public function check_password($password) {
        return wp_check_password($password, $this->user->user_pass, $this->user->ID);
    }

    // Log the user in
    public function login() {
        wp_set_current_user($this->user->ID);
        wp_set_auth_cookie($this->user->ID);
    }

    // Get the username of the user
    public function get_username() {
        return $this->user->user_login;
    }

    // Check if the user is valid
    public function is_valid() {
        return !is_null($this->user) && $this->user !== false;
    }

    // Create a new user
    public static function create($username, $password, $email) {
        if (email_exists($email) || username_exists($username)) {
            return new WP_Error('user_exists', 'A user with this username or email already exists.');
        }

        $user_id = wp_create_user($username, $password, $email);
        if (is_wp_error($user_id)) {
            return $user_id;
        }

        return new self(get_user_by('id', $user_id));
    }

    // Get the current logged-in user
    public static function get_current_user() {
        return new self(wp_get_current_user());
    }

    // Update user details
    public function update($username, $email, $password = null) {
        $user_id = $this->user->ID;

        // Update user data
        $user_update = wp_update_user([
            'ID' => $user_id,
            'user_login' => $username,
            'user_email' => $email,
        ]);

        if (is_wp_error($user_update)) {
            return $user_update;
        }

        if (!empty($password)) {
            wp_set_password($password, $user_id);
        }

        return true;
    }
}
