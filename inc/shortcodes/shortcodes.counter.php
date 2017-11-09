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

?>
