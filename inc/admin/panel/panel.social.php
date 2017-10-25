<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<!-- Redes sociales -->
<h4>Redes Sociales</h4>
<div id="admin-rrss">

	<?php

	$i = 1;

	$var_rrss = explode(',', b_f_option('b_opt_social-order', true));
	foreach ($var_rrss as $temp_rrss) {
		switch ($temp_rrss) {
			case 'snapchat':
				$icon = $temp_rrss.'-ghost';
				break;
			case 'telegram':
				$icon = 'paper-plane';
				break;
			default:
				$icon = $temp_rrss;
				break;
		}
		switch ($temp_rrss) {
			case 'google-plus':
			case 'youtube':
			case 'linkedin':
			case 'rss':
				$var_placeholder = 'url';
				break;
			case 'whatsapp':
				$var_placeholder = 'número de teléfono';
				break;
			case 'telegram':
				$var_placeholder = 'usuario';
				break;
			default:
				$var_placeholder = 'url o usuario';
				break;
		}

		?>

		<div style="width: 100%; display: inline-block;" class="color-wrapper" id="<?= $temp_rrss ?>">
			<i class="fa fa-<?= $icon ?>"></i>
			<input type="text" class="gran" name="bilnea_settings[b_opt_social-<?= $temp_rrss ?>]" value="<?= b_f_option('b_opt_social-'.$temp_rrss) ?>" placeholder="<?= $var_placeholder ?>" />
			<div>
				<input type="text" class="sp-input" name="bilnea_settings[b_opt_social-<?= $temp_rrss ?>-color]" value="<?= b_f_option('b_opt_social-'.$temp_rrss.'-color') ?>" placeholder="<?= b_f_default('b_opt_social-'.$temp_rrss.'-color') ?>" />
				<input type="text" class="colora peq">
			</div>
		</div>

		<?php

	}

	?>

</div>
<input id="b_opt_social-order" type="hidden" name="bilnea_settings[b_opt_social-order]" value="<?= b_f_option('b_opt_social-order') ?>" />
<script>
	jQuery(function() {
		jQuery('#admin-rrss').sortable({
			update: function(event, ui) {
				var rrss_order = jQuery('#admin-rrss').sortable("toArray");
				jQuery('#b_opt_social-order').val(rrss_order);
			}
		});
		jQuery('#admin-rrss').disableSelection();
	});
</script>