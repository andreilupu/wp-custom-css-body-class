<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should
 * provide the user interface to the end user.
 *
 * @package   PixTypes
 * @author    Andrei Lupu <euthelup@gmail.com>
 * @license   GPL-2.0+
 * @link      https://lup.dev
 * @copyright 2013 Pixel Grade Media
 */

$config = include custom_body_class::pluginpath() . 'plugin-config' . EXT;

// invoke processor
$processor = custom_body_class::processor( $config );
$status    = $processor->status();
$errors    = $processor->errors(); ?>

<div class="wrap" id="custom_body_class_form">

	<div id="icon-options-general" class="icon32"><br></div>

	<h2><?php esc_html_e( 'Custom Body Class', 'wp-custom-body-class' ); ?></h2>

	<?php if ( $processor->ok() ): ?>

		<?php if ( ! empty( $errors ) ): ?>
			<br/>
			<p class="update-nag">
				<strong><?php esc_html_e( 'Unable to save settings.', 'wp-custom-body-class' ); ?></strong>
				<?php esc_html_e( 'Please check the fields for errors and typos.', 'wp-custom-body-class' ); ?>
			</p>
		<?php endif; ?>

		<?php if ( $processor->performed_update() ): ?>
			<br/>
			<p class="update-nag">
				<?php esc_html_e( 'Settings have been updated.', 'wp-custom-body-class' ); ?>
			</p>
		<?php endif;

		echo $f = custom_body_class::form( $config, $processor );
		echo $f->field( 'hiddens' )->render();
		echo $f->field( 'general' )->render();?>

		<button type="submit" class="button button-primary">
			<?php esc_html_e( 'Save Changes', 'wp-custom-body-class' ); ?>
		</button>

		<?php echo $f->endform() ?>

	<?php elseif ( $status['state'] == 'error' ): ?>

		<h3><?php esc_html_e( 'Critical Error', 'wp-custom-body-class' ); ?></h3>

		<p><?php echo esc_html( $status['message'] ); ?></p>

	<?php endif; ?>
</div>