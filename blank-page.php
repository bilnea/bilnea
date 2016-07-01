<?php

/*
Template Name: Página sin barra lateral
*/

?>

<?php get_header(); ?>
	<div class="contenido-principal">	
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php wp_link_pages(); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
<?php get_footer(); ?>