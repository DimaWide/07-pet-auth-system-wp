<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get errors, if any
$errors = $controller->get_errors();

get_header();
?>

<div class="cmp-form">
    <div class="form form--profile">
        <h2 class="form__title">Profile Page</h2>
        <form class="form__content" action="" method="POST">

            <div class="form__field form__field--username">
                <label class="form__label">Username:</label>
                <span class="form__info"><?php echo esc_html($current_user->user_login); ?></span>
            </div>

            <div class="form__field form__field--email">
                <label class="form__label" for="email">Email</label>
                <input type="email" class="form__input form__input--email" id="email" name="email" value="<?php echo esc_attr($current_user->user_email); ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <p class="form__error form__error--email"><?php echo esc_html($errors['email']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form__field form__field--password">
                <label class="form__label" for="password">New Password</label>
                <input type="password" class="form__input form__input--password" id="password" name="password">
                <?php if (isset($errors['password'])): ?>
                    <p class="form__error form__error--password"><?php echo esc_html($errors['password']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form__field form__field--confirm-password">
                <label class="form__label" for="confirm_password">Confirm New Password</label>
                <input type="password" class="form__input form__input--confirm-password" id="confirm_password" name="confirm_password">
                <?php if (isset($errors['confirm_password'])): ?>
                    <p class="form__error form__error--confirm-password"><?php echo esc_html($errors['confirm_password']); ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="form__button form__button--save" name="profile_submit">Save Changes</button>

            <?php if (isset($errors['not_updated'])): ?>
                <p class="form__error form__error--not-updated"><?php echo esc_html($errors['not_updated'][0]); ?></p>
            <?php endif; ?>
        </form>

        <p class="form__footer form__footer--logout"><a class="form__link" href="<?php echo wp_logout_url(home_url()); ?>">Logout</a></p>
    </div>
</div>

<?php
get_footer();
?>
