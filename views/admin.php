<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should
 * provide the user interface to the end user.
 *
 * @package   PixTypes
 * @author    Andrei Lupu <andrei.lupu@pixelgrade.com>
 * @license   GPL-2.0+
 * @link      http://andrei-lupu.com
 * @copyright 2013 Pixel Grade Media
 */

$config = include custom_body_class::pluginpath() . 'plugin-config' . EXT;

// invoke processor
$processor = custom_body_class::processor( $config );
$status    = $processor->status();
$errors    = $processor->errors(); ?>

<div class="wrap" id="custom_body_class_form">

	<div id="icon-options-general" class="icon32"><br></div>

	<h2><?php _e( 'Custom Body Class', 'custom_body_class_txtd' ); ?></h2>

	<?php if ( $processor->ok() ): ?>

		<?php if ( ! empty( $errors ) ): ?>
			<br/>
			<p class="update-nag">
				<strong><?php _e( 'Unable to save settings.', 'custom_body_class_txtd' ); ?></strong>
				<?php _e( 'Please check the fields for errors and typos.', 'custom_body_class_txtd' ); ?>
			</p>
		<?php endif; ?>

		<?php if ( $processor->performed_update() ): ?>
			<br/>
			<p class="update-nag">
				<?php _e( 'Settings have been updated.', 'custom_body_class_txtd' ); ?>
			</p>
		<?php endif;

		echo $f = custom_body_class::form( $config, $processor );
		echo $f->field( 'hiddens' )->render();
		echo $f->field( 'general' )->render();?>

		<button type="submit" class="button button-primary">
			<?php _e( 'Save Changes', 'custom_body_class_txtd' ); ?>
		</button>

		<?php echo $f->endform() ?>

	<?php elseif ( $status['state'] == 'error' ): ?>

		<h3><?php _e( 'Critical Error', 'custom_body_class_txtd' ); ?></h3>

		<p><?php echo $status['message'] ?></p>

	<?php endif; ?>
</div>