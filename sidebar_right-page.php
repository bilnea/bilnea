<?php

/*
Template Name: Página con barra lateral derecha
*/

$opc = get_post_custom(get_the_ID());

if(isset($opc['custom_sidebar'])) {
	$barra_lateral = $opc['custom_sidebar'][0];
} else {
	$barra_lateral = 'default';
}

?>

<?php get_header(); ?>
	<div class="contenido-principal sidebar-right">	
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	<aside class="barra-lateral sidebar-right" id="sidebar">
		<?php
			if($barra_lateral && $barra_lateral != 'default') {
				get_sidebar('custom');
			} else {
				get_sidebar();
			}
		?>
	</aside>
<?php get_footer(); ?>