<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="cmp-form">
    <div class="form form--register">
        <h2 class="form__title">Registration</h2>

        <form class="form__content" method="POST" action="">
            <div class="form__field form__field--username">
                <label class="form__label" for="username">Username:</label>
                <input type="text" class="form__input form__input--username" name="username" id="username" value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>">
                <?php if (isset($errors['username'])): ?>
                    <p class="form__error form__error--username"><?php echo esc_html($errors['username']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form__field form__field--email">
                <label class="form__label" for="email">Email:</label>
                <input type="email" class="form__input form__input--email" name="email" id="email" value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                <?php if (isset($errors['email'])): ?>
                    <p class="form__error form__error--email"><?php echo esc_html($errors['email']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form__field form__field--password">
                <label class="form__label" for="password">Password:</label>
                <input type="password" class="form__input form__input--password" name="password" id="password">
                <?php if (isset($errors['password'])): ?>
                    <p class="form__error form__error--password"><?php echo esc_html($errors['password']); ?></p>
                <?php endif; ?>
            </div>

            <div class="form__field form__field--confirm-password">
                <label class="form__label" for="confirm_password">Confirm Password:</label>
                <input type="password" class="form__input form__input--confirm-password" name="confirm_password" id="confirm_password">
                <?php if (isset($errors['confirm_password'])): ?>
                    <p class="form__error form__error--confirm-password"><?php echo esc_html($errors['confirm_password']); ?></p>
                <?php endif; ?>
            </div>

            <button type="submit" class="form__button form__button--register" name="register_submit">Register</button>

            <?php if (isset($errors['general'])): ?>
                <p class="form__error form__error--general"><?php echo esc_html($errors['general']); ?></p>
            <?php endif; ?>
        </form>

        <p class="form__footer form__footer--login">
            Already have an account? <a class="form__link" href="<?php echo home_url('/login/'); ?>">Login</a>
        </p>
    </div>
</div>



<?php
get_footer();
?>