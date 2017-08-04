<?php

global $wp_query;

get_header();

?>
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span8 offset2">
			<div class="search-title">
				<div class="container">
				<h1>
					<?php
					if ($wp_query->found_posts > 0) {
						printf(__('%1$s search results for "%2$s"', 'bilnea'), $wp_query->found_posts, get_search_query());
					} else {
						printf(__('No results for "%1$s"', 'bilnea'), get_search_query());
					}
					?>
				</h1>
				</div>
			</div>
			<?php 
			if (have_posts()) :
			?>
				<div class="container">
					<?php
					while (have_posts()) : the_post();

						$var_title = get_the_title();
						$var_excerpt = b_f_get_excerpt(preg_replace('~\[([a-z]|[A-Z]|[0-9]|\/|_|=|"| |<|>|-|#|\(|\)|.|,)+?\]~s', '', strip_tags(get_the_content())), 60);
						$var_content = preg_replace('~\[([a-z]|[A-Z]|[0-9]|\/|_|=|"| |<|>|-|#|\(|\)|.|,)+?\]~s', '', strip_tags(get_the_content()));

						$var_keys = explode(' ', $s);

						$var_title = preg_replace('/('.implode('|', $var_keys) .')/iu', '<strong class="title-highlight">\0</strong>', $var_title);
						$var_excerpt = preg_replace('/('.implode('|', $var_keys) .')/iu', '<strong class="excerpt-highlight">\0</strong>', $var_excerpt);

						$var_total = count(explode(' ', get_the_title()))+count(explode(' ', $var_content));
						$var_ocurrances = substr_count(strtolower(get_the_title().' '.$var_content), strtolower($s));

						?>
						<article class="resultado" style="margin-top: 20px;">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<h2 class="question">
									<?= $var_title ?>
								</h2>
							</a>
							<div class="the-content">
								<span class="search-ocurrances"><?= number_format((float)$var_ocurrances/$var_total, 3, "'", '').'%' ?></span><?= $var_excerpt ?>
							</div>	
						</article>
						<?php
					endwhile;

					$var_current = max(1, get_query_var('paged'));

					$var_pagination_block = paginate_links( array(
						'format' => __('page', 'bilnea').'/%#%',
						'current' => $var_current,
						'total' => $wp_query->max_num_pages,
						'prev_text' => '‹ <span>'.__('Previous', 'bilnea').'</span>',
						'next_text' => '<span>'.__('Next', 'bilnea').'</span> ›'
					));

					$var_pagination = '<div class="b_pagination"><span class="total-pages">'.sprintf(__('Page %1$s of %2$s', 'bilnea'), $var_current, $wp_query->max_num_pages).'</span>';

					if ($var_current > 2) {
						$var_pagination .= '<a class="first page-numbers" href="'.get_permalink().'">« <span>'.__('First', 'bilnea').'</span></a>';
					}

					$var_pagination .= $var_pagination_block;

					if ($var_current < ($wp_query->max_num_pages-2)) {
						$var_pagination .= '<a class="last page-numbers" href="'.get_permalink().'/'.__('page', 'bilnea').'/'.($wp_query->max_num_pages-2).'"><span>'.__('Last', 'bilnea').' »</span></a>';
					}

					$var_pagination .= '</div>';

					if ($wp_query->max_num_pages == 1) {
						$var_pagination = '';
					}

					echo $var_pagination;

					?>

				<?php
				else :
				?>
				<div class="container" style="margin: 20px auto 40px auto">
					<article class="resultado">
						<span style="display: block; margin-bottom: 10px; font-size: 14px; color: #4D4D4D;">
							<?php the_time('j | F, Y'); ?>
						</span>
						<div class="the-content">
							<?php
							_e('Try to redefine your search using another term, or visit the homepage.', 'bilnea');
							?>
						</div>	
					</article>
				</div>
				<?php
				endif;
				?>

			</div>
		</div>
	</div>
<?php
get_footer();
?>