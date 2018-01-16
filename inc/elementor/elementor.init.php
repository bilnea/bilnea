<?php

if (! defined('ABSPATH')) {
	exit;
}

function b_f_p_elementor_load() {

	if (!did_action('elementor/loaded')) {
		return;
	}

	if (!version_compare(ELEMENTOR_VERSION, '1.8.0', '>=')) {
		add_action('admin_notices', 'b_f_p_elementor_fail_date');
		return;
	}

	require('elementor.main.php');

}

add_action('after_setup_theme', 'b_f_p_elementor_load', 50);

function b_f_p_elementor_fail_date() {

	if (!current_user_can('update_plugins')) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=').$file_path, 'upgrade-plugin_'.$file_path);
	
	$out = '<p>'.__('Elementor by bilnea is not working because you are using an old version of Elementor.', 'bilnea').'</p>';
	$out .= '<p>'.sprintf('<a href="%s" class="button-primary">%s</a>', $upgrade_link, __('Update Elementor Now', 'bilnea')).'</p>';

	echo '<div class="error">'.$out.'</div>';

}

?>