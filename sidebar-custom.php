<?php

global $post;

$otc = get_post_custom($post->ID);
$sid = $otc['custom_sidebar'][0];

if (!function_exists('dynamic_sidebar') || !dynamic_sidebar()) {
	dynamic_sidebar($sid);
}