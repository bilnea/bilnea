<?php

/**
 * Plantilla para una página individual.
 *
 */

get_header();

?>

<div id="primary" class="main-row">
	<div id="content" role="main" class="span8 offset2">

		<?php woocommerce_content(); ?>

	</div>
</div>

<?php

get_footer();

?>