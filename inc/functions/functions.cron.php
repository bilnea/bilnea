<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


if (!function_exists('b_f_cron_schedule')) {

	function b_f_cron_schedule($var_schedule) {

		$var_schedule['weekly'] = array(
			'interval' => 604800,
			'display' => __('Weekly', 'bilnea')
		);

		$var_schedule['monthly'] = array(
			'interval' => 2592000,
			'display' => __('Monthly', 'bilnea')
		);

		return $var_schedule;

	}

	add_filter('cron_schedules', 'b_f_cron_schedule');

}


if (!wp_next_scheduled('b_f_weekly_cron_job')) {
	wp_schedule_event(current_time( 'timestamp' ), 'weekly', 'b_f_weekly_cron_job');
}


if (!function_exists('b_f_weekly_cron')) {

	function b_f_weekly_cron() {
		
		global $b_g_google_api;

		$var_fonts = json_decode(b_f_get_file_content('https://www.googleapis.com/webfonts/v1/webfonts?key='.$b_g_google_api));

		if (!$var_fonts->error) {

			$var_file = @fopen(get_template_directory_uri().'/inc/data/data.google.fonts.json', 'w');
			if ($var_file !== false) {
				ftruncate($var_file, 0);
				fwrite($var_file, $var_fonts);
				fclose($var_file);
			}

		}


	}

	add_action('b_f_weekly_cron_job', 'b_f_weekly_cron');

}

?>