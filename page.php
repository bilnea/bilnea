<?php
/**
 * The template for displaying any single page.
 *
 */

get_header();

 ?>
<div id="primary" class="main-row">
	<div id="content" role="main" class="span8 offset2">

		<?php
		if ( have_posts() ) : 
		?>

			<?php
			while ( have_posts() ) : the_post(); 
			?>

				<article class="post">
					
					<div class="the-content">

					<?php
					the_content(); 
					?>

					</div>
						
				</article>

			<?php
			endwhile;
			?>

		<?php
		else :
		?>	

		<?php
		endif;
		?>

	</div>
</div>

<?php
get_footer();
?>