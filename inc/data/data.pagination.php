<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}

$var_current = max(1, get_query_var('paged'));

$var_pagination_block = paginate_links( array(
	'format' => __('page', 'bilnea').'/%#%',
	'current' => $var_current,
	'total' => $query->max_num_pages,
	'prev_text' => '‹ <span>'.__('Previous', 'bilnea').'</span>',
	'next_text' => '<span>'.__('Next', 'bilnea').'</span> ›'
));

$var_pagination = '<div class="b_pagination"><span class="total-pages">'.sprintf(__('Page %1$s of %2$s', 'bilnea'), $var_current, $query->max_num_pages).'</span>';

if ($var_current > 2) {
	$var_pagination .= '<a class="first page-numbers" href="'.get_permalink().'">« <span>'.__('First', 'bilnea').'</span></a>';
}

$var_pagination .= $var_pagination_block;

if ($var_current < ($query->max_num_pages-2)) {
	$var_pagination .= '<a class="last page-numbers" href="'.get_permalink().'/'.__('page', 'bilnea').'/'.($query->max_num_pages-2).'"><span>'.__('Last', 'bilnea').' »</span></a>';
}

$var_pagination .= '</div>';

if ($query->max_num_pages == 1) {
	$var_pagination = '';
}

array_push($var_shortcodes, '{{b_blog}}');
array_push($var_shortcodes, '{{b_pagination}}');

array_push($var_replace, $var_blog);
array_push($var_replace, $var_pagination);

?>