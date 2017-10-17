<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

$var_categories = array();
$var_tags = array();

if (get_the_category()) {
	foreach (get_the_category() as $var_category) {
		array_push($var_categories, '<a href="'.esc_url(get_category_link($var_category->term_id)).'">'.esc_html($var_category->name).'</a>');
	}
}

if (get_the_tags()) {
	foreach (get_the_tags() as $var_tag) {
		array_push($var_tags, '<a href="'.esc_url(get_tag_link($var_tag->term_id)).'">'.esc_html($var_tag->name ).'</a>');
	}
}

$var_categories = '<div class="entry-categories">'.implode(', ', $var_categories).'</div>';
$var_tags = '<div class="entry_tags">'.implode(', ', $var_tags).'</div>';

if (comments_open()) {
	if (get_comments_number() == 0) {
		$var_comments = __('No comments', 'bilnea');
	} elseif (get_comments_number() > 1) {
		$var_comments = get_comments_number().__(' comments', 'bilnea');
	} else {
		$var_comments = __('1 comment', 'bilnea');
	}
	$var_comments = '<a href="'.get_comments_link().'">'.$var_comments.'</a>';
} else {
	$var_comments =  __('Comments are disabled', 'bilnea');
}

if (!function_exists('b_f_i_image')) {
	function b_f_i_image($arg = array('', 'thumbnail')) {
		return wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), $arg[1])[0];
	}
}

$var_shortcodes = array('{{b_title}}', '{{b_cat-title}}', '{{b_permalink}}', '{{b_excerpt}}', '{{b_content}}', '{{b_date}}', '{{b_categories}}', '{{b_author}}', '{{b_tags}}', '{{b_comments-number}}', '{{b_share}}');
$var_replace = array(get_the_title(), get_queried_object()->name, get_permalink(), wp_trim_words(get_the_content(), 30), get_the_content(), get_the_date(b_f_option('b_opt_blog-date-'.$b_g_language, true)), $var_categories, get_the_author_link(), $var_tags, $var_comments, '');

?>