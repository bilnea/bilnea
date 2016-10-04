<?php 

if (!dynamic_sidebar('sidebar')) {

?>

<h3 class="side-title">Archivos</h3>
<ul>
	<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
</ul>
<h3 class="side-title">WordPress</h3>
<ul>
	<?php wp_register(); ?>
	<li><?php wp_loginout(); ?></li>
	<?php wp_meta(); ?>
</ul>

<?php

}

?>