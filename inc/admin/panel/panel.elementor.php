<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4 data-type="title">Páginas de elementor</h4>

<?php

if (function_exists('pll_languages_list')) {

	$count = 0;

	foreach (get_terms(array('taxonomy' => 'term_language', 'hide_empty' => false)) as $language) {

		echo ($count != 0) ? '<br /><hr style="margin: 8px 0;" />' : '';

		?>

		<strong style="display: block;"><?= $language->name ?></strong>

		<?= b_f_admin_elementor('Página de entradas', 'index-'.str_replace('pll_', '', $language->slug)) ?>

		<hr />

		<?php

		foreach (get_post_types(array('public' => true), 'objects') as $slug => $type) {

			if (!in_array($slug, array('page', 'attachment', 'elementor_library', 'jet-menu'))) {

				?>

				<?= b_f_admin_elementor('Página individual para "'.$type->labels->name.'"', $slug.'-'.str_replace('pll_', '', $language->slug)) ?>

				<hr />

				<?php

			}

		}

		?>

		<?= b_f_admin_elementor('Página 404', '404-'.str_replace('pll_', '', $language->slug)) ?>

		<?php

		foreach (get_taxonomies(array('public' => true), 'objects') as $slug => $taxonomy) {

			if ($slug != 'post_format' && $slug != 'product_shipping_class') {

				?>

				<hr />

				<?= b_f_admin_elementor('Página de archivos para taxonomía "'.$taxonomy->labels->name.'"', $slug.'-'.str_replace('pll_', '', $language->slug)) ?>

				<?php

			}

		}

		if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

			echo '<hr />';

			echo b_f_admin_elementor('Página de la tienda', 'store-'.str_replace('pll_', '', $language->slug));

		}

		$count++;

	}

} else {

	?>

	<?= b_f_admin_elementor('Página de entradas', 'index-es') ?>

	<hr />

	<?php

	foreach (get_post_types(array('public' => true), 'objects') as $slug => $type) {

		if (!in_array($slug, array('page', 'attachment', 'elementor_library'))) {

			?>

			<?= b_f_admin_elementor('Página individual para "'.$type->labels->name.'"', $slug.'-es') ?>

			<hr />

			<?php

		}

	}

	?>

	<?= b_f_admin_elementor('Página 404', '404-es') ?>

	<?php

	foreach (get_taxonomies(array('public' => true), 'objects') as $slug => $taxonomy) {

		if ($slug != 'post_format' && $slug != 'product_shipping_class') {

			?>

			<hr />

			<?= b_f_admin_elementor('Página de archivos para taxonomía "'.$taxonomy->labels->name.'"', $slug.'-es') ?>

			<?php

		}

	}

	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

		echo '<hr />';

		echo b_f_admin_elementor('Página de la tienda', 'store-es');

	}

}

?>