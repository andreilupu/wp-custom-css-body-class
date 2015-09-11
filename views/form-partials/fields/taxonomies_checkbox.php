<?php defined('ABSPATH') or die;
/* @var CustomBodyClassFormField $field */
/* @var CustomBodyClassForm $form */
/* @var mixed $default */
/* @var string $name */
/* @var string $idname */
/* @var string $label */
/* @var string $desc */
/* @var string $rendering */

// [!!] the counter field needs to be able to work inside other fields; if
// the field is in another field it will have a null label

$checked = $form->autovalue($name, $default);
$taxonomies = get_taxonomies(array(
	'public'   => true,
));

if ( ! empty( $taxonomies ) ) { ?>
	<div class="taxonomies_checkbox">
		<?php if ( isset( $label ) && !empty( $label ) ) { ?>
			<h3 class="field_title"><?php echo $label; ?></h3>
		<?php } ?>
		<?php if ( isset( $description ) && !empty( $description ) ) { ?>
			<span class="field_description"><?php echo $description; ?></span>
		<?php } ?>
		<ul>
			<?php
			foreach ( $taxonomies as $taxonomy ) {
				$attrs = array(
					'name' => $name . '[' . $taxonomy . ']',
					'id'   => $idname . '[' . $taxonomy . ']',
				); ?>
				<li>
					<input type="checkbox" <?php echo $field->htmlattributes( $attrs ); ?> <?php if ( isset( $checked[ $taxonomy ] ) && $checked[ $taxonomy ] == 'on' ) {
						echo 'checked="checked"';
					} ?>/>
					<?php echo $taxonomy; ?>
				</li>
			<?php } ?>
		</ul>
	</div>
<?php
}