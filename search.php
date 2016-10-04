<?php
/**
 * The template for displaying any single page.
 *
 */

function extracto($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit) {
		array_pop($words);
		return implode(' ', $words).'...';
	} else {
		return implode(' ', $words);
	}
}

$pag = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts($query_string.'&showposts=-1&posts_per_page=10&paged='.$pag);

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
				<div class="container" style="margin: 20px auto 40px auto">
					<?php
					while (have_posts()) : the_post();
					?>
					<article class="resultado" style="margin-top: 20px;">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<h2 class="question">
								<?php the_title(); ?>
							</h2>
						</a>
						<div class="the-content">
							<?php
							echo extracto(preg_replace('~\[([a-z]|[A-Z]|[0-9]|\/|_|=|"| |<|>|-|#|\(|\)|.|,)+?\]~s', '', strip_tags(get_the_content())), 60);
							?>
						</div>	
					</article>
					<?php
					endwhile;

					$get = '';

					foreach ($_GET as $key => $value) {
						if ($key != 'paged') {
							$get .= $key.'='.$value.'&';
						}
					}

					if ($wp_query->max_num_pages > 1) {
						$out = '<div class="pager">';
						if ($pag != 1) {
							$out .= '<a href="/?'.$get.'paged='.($pag-1).'"><</a>';
						}
						for ($i = 1; $i <= $wp_query->max_num_pages; $i++) {
							if ($pag == $i) {
								$out .= '<a class="active">'.$i.'</a>';
							} else {
								$out .= '<a href="/?'.$get.'paged='.$i.'">'.$i.'</a>';
							}
						}
						if ($pag != $wp_query->max_num_pages) {
							$out .= '<a href="/?'.$get.'paged='.($pag+1).'">></a>';
						}
						$out .= '</div>';
					}

					echo $out;

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