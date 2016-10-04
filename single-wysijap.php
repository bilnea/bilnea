<?php
/**
 * The template for displaying mailpoet pages
 *
 */

if (!function_exists('site_url')) {
	$uri = explode('wp-content',$_SERVER['SCRIPT_FILENAME']);
	require($uri[0].'wp-load.php');
	wp();
}

if ( have_posts() ) : 

	while ( have_posts() ) : the_post(); 

?>

<!DOCTYPE html>
<html class="wysija-page">
	<head>
		<?php wp_head(); ?>
		<title><?php echo get_the_title().' | '; ?><?php bloginfo('name'); ?></title>
		<meta name="robots" content="noindex,nofollow" />
		<style type="text/css">
		</style>
	</head>
	<body>
		<div class="container">
			<h1>
				<?php echo get_the_title(); ?>
			</h1>
			<div>
				<?php
				echo the_content();
				?>
				<br/>
				<a class="home-link" href="<?php echo site_url(); ?>">Ir a la página principal</a>
			</div>
		</div>
	</body>
</html>

<?php

	endwhile;
	
endif;

?>


