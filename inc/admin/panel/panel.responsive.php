<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4 data-type="title">Menú responsive</h4>

<div data-type="block">
	Activar en pantallas de resolución menor a
	<input data-type="text" data-float="right" data-size="33" type="text" class="peq" name="bilnea_settings[b_opt_responsive]" value="<?= b_f_option('b_opt_responsive'); ?>" placeholder="<?= b_f_default('b_opt_responsive'); ?>">
</div>

<hr />

<?php

if (function_exists('pll_languages_list')) {

	$count = 0;

	foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

		echo ($count != 0) ? '<br /><hr style="margin: 8px 0;" />' : '';

		?>

		<div data-type="block">Cabecera móvil (<?= $language->name ?>)</div>

		<div data-type="block" data-size="50">

			<select name="bilnea_settings[b_opt_widget-header-mobile-<?= str_replace('pll_', '', $language->slug) ?>]" style="margin-top: -2px; width: 100% !important;">
				<option value="none" selected>Seleccionar widget</option>

				<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-header-mobile-'.str_replace('pll_', '', $language->slug)), $widget->ID).'>'.$widget->post_title.'</option>';
					}

				?>

			</select>

		</div>

		<div data-type="block" data-size="50" data-float="right">

			<?php

			if (b_f_option('b_opt_widget-header-mobile-'.str_replace('pll_', '', $language->slug)) && current_user_can('edit_pages')) {
				echo '<a data-type="elementor-link" target="_blank" href="'.trim(site_url(), '/').'/wp-admin/post.php?post='.b_f_option('b_opt_widget-header-mobile-'.str_replace('pll_', '', $language->slug)).'&action=elementor">Editar bloque</a>';
			}

			?>

		</div>

		<?php

		$count++;

	}

} else {

	?>

	<div data-type="block">Cabecera móvil</div>

	<div data-type="block" data-size="50">

		<select name="bilnea_settings[b_opt_widget-header-mobile-es]" style="margin-top: -2px; width: 100% !important;">
			<option value="none" selected>Seleccionar widget</option>

			<?php

				$args = array(
					'post_type'		 => 'elementor_library',
					'posts_per_page' => -1,
					'post_status'	 => 'publish'
				);

				foreach (get_posts($args) as $widget) {
					echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-header-mobile-es'), $widget->ID).'>'.$widget->post_title.'</option>';
				}

			?>

		</select>

	</div>

	<div data-type="block" data-size="50" data-float="right">

		<?php

		if (b_f_option('b_opt_widget-header-mobile-es') && current_user_can('edit_pages')) {
			echo '<a data-type="elementor-link" target="_blank" href="'.trim(site_url(), '/').'/wp-admin/post.php?post='.b_f_option('b_opt_widget-header-mobile-es').'&action=elementor">Editar bloque</a>';
		}

		?>

	</div>

	<?php

}

?>

<hr />

<?php

if (function_exists('pll_languages_list')) {

	$count = 0;

	foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

		echo ($count != 0) ? '<br /><hr style="margin: 8px 0;" />' : '';

		?>

		<div data-type="block">Menú móvil (<?= $language->name ?>)</div>

		<div data-type="block" data-size="50">

			<select name="bilnea_settings[b_opt_widget-mobile-menu-<?= str_replace('pll_', '', $language->slug) ?>]" style="margin-top: -2px; width: 100% !important;">
				<option value="none" selected>Seleccionar widget</option>

				<?php

					$args = array(
						'post_type'		 => 'elementor_library',
						'posts_per_page' => -1,
						'post_status'	 => 'publish'
					);

					foreach (get_posts($args) as $widget) {
						echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-mobile-menu-'.str_replace('pll_', '', $language->slug)), $widget->ID).'>'.$widget->post_title.'</option>';
					}

				?>

			</select>

		</div>

		<div data-type="block" data-size="50" data-float="right">

			<?php

			if (b_f_option('b_opt_widget-mobile-menu-'.str_replace('pll_', '', $language->slug)) != 'none' && current_user_can('edit_pages')) {
				echo '<a data-type="elementor-link" target="_blank" href="'.trim(site_url(), '/').'/wp-admin/post.php?post='.b_f_option('b_opt_widget-mobile-menu-'.str_replace('pll_', '', $language->slug)).'&action=elementor">Editar bloque</a>';
			}

			?>

		</div>

		<?php

		$count++;

	}

} else {

	?>

	<div data-type="block">Menú móvil</div>

	<div data-type="block" data-size="50">

		<select name="bilnea_settings[b_opt_widget-mobile-menu-es]" style="margin-top: -2px; width: 100% !important;">
			<option value="none" selected>Seleccionar widget</option>

			<?php

				$args = array(
					'post_type'		 => 'elementor_library',
					'posts_per_page' => -1,
					'post_status'	 => 'publish'
				);

				foreach (get_posts($args) as $widget) {
					echo '<option value="'.$widget->ID.'" '.selected(b_f_option('b_opt_widget-mobile-menu-es'), $widget->ID).'>'.$widget->post_title.'</option>';
				}

			?>

		</select>

	</div>

	<div data-type="block" data-size="50" data-float="right">

		<?php

		if (b_f_option('b_opt_widget-mobile-menu-es') != 'none' && current_user_can('edit_pages')) {
			echo '<a data-type="elementor-link" target="_blank" href="'.trim(site_url(), '/').'/wp-admin/post.php?post='.b_f_option('b_opt_widget-mobile-menu-es').'&action=elementor">Editar bloque</a>';
		}

		?>

	</div>

	<?php

}

?>
