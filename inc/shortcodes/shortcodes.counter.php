<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Contador

if (!function_exists('b_s_counter')) {

	function b_s_counter($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'date' => null,
			'units' => 'd,h,m',
			'label' => false,
		), $atts);

		// Fecha actual

		$fechafijada = (date('U', strtotime($a['date']))*1000);

		$fechaactual = (date('U', strtotime(date('F d, Y H:i:s')))*1000);

		// Número aleatorio para identificar al contador
		$var_random = rand(0, 99999999);

		wp_enqueue_script('functions.counter.flipclock');
		wp_enqueue_style('styles.flipclock');

		$out = '<div class="b_counter" id="counter-'.$var_random.'"></div>';

		$out .= '<script type="text/javascript">'."\n";



		$out .= '	jQuery(function() {'."\n";
		if ($fechaactual > $fechafijada) {
			$out .= '		var date = new Date("0 0, 0 00:00:00");'."\n";
		} else {
			$out .= '		var date = new Date('.(date('U', strtotime($a['date']))*1000).'),'."\n";
		}


		$out .= '			now = new Date(),'."\n";
		$out .= '			diff = (date.getTime()/1000) - ('.current_time('timestamp').');'."\n";
		$out .= ''."\n";
		$out .= '		var clock = jQuery(\'#counter-'.$var_random.'\').FlipClock(diff,{'."\n";
		$out .= '				clockFace: \'DailyCounter\','."\n";
		$out .= '				countdown: true,'."\n";
		$out .= '				language: \''.str_replace('_', '-', strtolower(get_locale())).'\','."\n";
		$out .= '		});'."\n";
		$out .= '	});'."\n";
		$out .= '</script>'."\n";

		return $out;

	}

	add_shortcode('b_counter', 'b_s_counter');

}


// Contador creciente

if (!function_exists('b_s_counterup')) {

	function b_s_counterup($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'start' => 0,
			'value' => null,
			'separator' => '.',
			'decimal' => ',',
			'prefix' => null,
			'suffix' => null,
			'decimals' => 0,
			'time' => 4
		), $atts);

		// Número aleatorio para identificar al contador
		$var_random = rand(0, 99999999);

		wp_enqueue_script('functions.counter.countup');

		$out = '<div class="wow" id="b_counterup-'.$var_random.'"></div>';
		$out .= '<script type="text/javascript">'."\n";
		$out .= '	jQuery(window).on(\'load scroll\', function() {'."\n";
		$out .= '		if (!jQuery(\'#b_counterup-'.$var_random.'\').hasClass(\'initialized\') && jQuery(\'#b_counterup-'.$var_random.'\').hasClass(\'animated\')) {'."\n";
		$out .= '			jQuery(\'#b_counterup-'.$var_random.'\').addClass(\'initialized\')'."\n";
		$out .= '			var counter_opts_'.$var_random.' = {'."\n";
		$out .= '				useEasing: true,'."\n";
		$out .= '				useGrouping: true,'."\n";
		$out .= '				separator: \''.$a['separator'].'\','."\n";
		$out .= '				decimal: \''.$a['decimal'].'\','."\n";
		if (!is_null($a['prefix'])) {
			$out .= '			prefix: \''.$a['prefix'].'\','."\n";
		}
		if (!is_null($a['suffix'])) {
			$out .= '			suffix: \''.$a['suffix'].'\','."\n";
		}
		$out .= '			}'."\n";
		$out .= '			var counter_'.$var_random.' = new CountUp(\'b_counterup-'.$var_random.'\', '.$a['start'].', '.$a['value'].', '.$a['decimals'].', '.$a['time'].', counter_opts_'.$var_random.');'."\n";
		$out .= '			if (!counter_'.$var_random.'.error) {'."\n";
		$out .= '				counter_'.$var_random.'.start();'."\n";
		$out .= '			} else {'."\n";
		$out .= '				console.error(counter_'.$var_random.'.error);'."\n";
		$out .= '			}'."\n";
		$out .= '		};'."\n";
		$out .= '	})'."\n";
		$out .= '</script>'."\n";

		if (!is_null($a['value'])) {
			return $out;
		}

	}

	add_shortcode('b_counterup', 'b_s_counterup');

}

?>
