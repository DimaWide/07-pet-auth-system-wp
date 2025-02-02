<?php
// Защита от прямого доступа
if (!defined('ABSPATH')) {
	exit;
}

get_header();
?>

<div class="cmp-form">
	<div class="form form--login">
		<h2 class="form__title">Login</h2>

		<form class="form__content" method="POST" action="">

			<div class="form__field form__field--username-or-email">
				<label class="form__label" for="username_or_email">Username or Email:</label>
				<input type="text" class="form__input form__input--username-or-email" name="username_or_email" id="username_or_email" value="<?php echo isset($_POST['username_or_email']) ? esc_attr($_POST['username_or_email']) : ''; ?>">
				<?php if (isset($errors['username_or_email'])): ?>
					<p class="form__error form__error--username-or-email"><?php echo esc_html($errors['username_or_email']); ?></p>
				<?php endif; ?>
			</div>

			<div class="form__field form__field--password">
				<label class="form__label" for="password">Password:</label>
				<input type="password" class="form__input form__input--password" name="password" id="password">
				<?php if (isset($errors['password'])): ?>
					<p class="form__error form__error--password"><?php echo esc_html($errors['password']); ?></p>
				<?php endif; ?>
			</div>

			<div class="form__button-container">
				<button type="submit" class="form__button form__button--login" name="login_submit">Login</button>
				<?php if (isset($errors['general'])): ?>
					<p class="form__error form__error--general"><?php echo esc_html($errors['general']); ?></p>
				<?php endif; ?>
			</div>
		</form>

		<p class="form__footer">Don't have an account? <a class="form__link" href="<?php echo home_url('/register/'); ?>">Register</a></p>
	</div>
</div>

<?php
get_footer();
?>