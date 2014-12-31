<?php
/**
 * The template for displaying search forms in Jeg Theme
 *
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="field" name="s" id="s" placeholder="<?php j_e('Search'); ?>" />
</form>
