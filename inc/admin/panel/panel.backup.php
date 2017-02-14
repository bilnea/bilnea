<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

?>

<h4>Realizar copia de seguridad</h4>
<em class="notice" style="font-size: 12px;">Se realizará una copia de los ficheros y la base de datos de esta instalación de Wordpress.</em>
<div style="display: block; width: auto; margin-top: 6px;" class="page">
	<input class="gran" style="width: 100%; display: block; margin-top: -2px;" type="text" data-id="9" placeholder="<?= date('Y.m.d').' '.$_SERVER['HTTP_HOST'].'.zip' ?>">
	<input type="submit" value="Hacer copia de seguridad" class="button" />
</div>

<h4>Copias de seguridad</h4>
<div class="subsubsub" style="display: block; width: 100%;">
	<a class="current">Todos (<?= wp_count_posts()->publish ?>)</a>
	<?php
	$var_post_types = array();
	foreach (get_post_types() as $var_type) {
		$var_type = get_post_type_object($var_type);
		if ($var_type->public == 1 && $var_type->name != 'attachment') {
			?>
			<a data-slug="<?= $var_type->name ?>"><?= $var_type->label ?> <span class="count">(<?= wp_count_posts($var_type->name)->publish ?>)</span></a>
			<?php
			array_push($var_post_types, $var_type->name);
		}
	}
	?>
</div>
<div class="content">
	<?php
	$args = array (
		'post_status' => array('publish'),
		'post_type' => $var_post_types,
		'nopaging' => true,
		'posts_per_page' => '1',
	);
	$query = new WP_Query($args);
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			global $post;
			echo '<hr style="margin: 0;" /><div style="display: block; width: auto;" class="'.get_post_type().'">'.get_the_title().'<input class="gran" style="width: 100%; display: block; margin-top: -2px;" type="text" data-id="'.get_the_ID().'" placeholder="'.$post->post_name.'" /></div>';
		}
	}
	wp_reset_postdata();
	?>
</div>