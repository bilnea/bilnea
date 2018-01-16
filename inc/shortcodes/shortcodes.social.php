<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Botones redes sociales

if (!function_exists('b_s_rrss')) {

	function b_s_rrss($atts) {

		// Atributos
		$a = shortcode_atts(array(
			'type' => null,
			'color' => null,
			'style' => 'normal',
		), $atts);

		// Ordenar
		if ($a['type'] != null) {
			$var_socials = array(esc_attr($a['type']));
		} else {
			$var_socials = array();
			foreach (explode(',', b_f_option('b_opt_social-order')) as $var_social) {
				if (b_f_option('b_opt_social-'.$var_social) != '') {
					array_push($var_socials, $var_social);
				}
			}
		}

		$out = '';

		// Determinar red social
		foreach ($var_socials as $var_social) {

			// Variables locales
			$var_color = b_f_option('b_opt_social-'.$var_social.'-color', true);
			
			switch (esc_attr($a['style'])) {
				case 'normal':
					$var_style = 'background-color: '.$var_color.'; color: white;';
					break;
				case 'stacked':
					$var_style = 'color: '.$var_color.'; border: 2px solid '.$var_color.';';
					break;
			}

			switch ($var_social) {

				// Facebook
				case 'facebook':
					$var_link = b_f_option('b_opt_social-facebook');
					if (strpos($var_link,'facebook.com') === false) {
						$var_link = 'http://facebook.com/'.$var_link;
					}
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-facebook" style="'.$var_style.'"></a>';
					break;

				// Instagram
				case 'instagram':
					$var_link = b_f_option('b_opt_social-instagram');
					if (strpos($var_link,'instagram.com') === false) {
						if ($var_link[0] == '@') $var_link = ltrim($var_link, '@');
						$var_link = 'http://instagram.com/'.$var_link;
					}
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-instagram" style="'.$var_style.'"></a>';
					break;

				// Twitter
				case 'twitter':
					$var_link = b_f_option('b_opt_social-twitter');
					if (strpos($var_link,'twitter.com') === false) {
						if ($var_link[0] == '@') $var_link = ltrim($var_link, '@');
						$var_link = 'http://twitter.com/'.$var_link;
					}
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-twitter" style="'.$var_style.'"></a>';
					break;

				// Google +
				case 'google-plus':
					$var_link = b_f_option('b_opt_social-google-plus');
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-google-plus" style="'.$var_style.'"></a>';
					break;

				// Youtube
				case 'youtube':
					$var_link = b_f_option('b_opt_social-youtube');
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-youtube" style="'.$var_style.'"></a>';
					break;

				// Linkedin
				case 'linkedin':
					$var_link = b_f_option('b_opt_social-linkedin');
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-linkedin" style="'.$var_style.'"></a>';
					break;

				// Pinterest
				case 'pinterest':
					$var_link = b_f_option('b_opt_social-pinterest');
					if (strpos($var_link,'pinterest.com') === false) {
						$var_link = 'http://pinterest.com/'.$var_link;
					}
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-pinterest" style="'.$var_style.'"></a>';
					break;

				// Snapchat
				case 'snapchat':
					$var_link = b_f_option('b_opt_social-snapchat');
					if (strpos($var_link,'snapchat.com') === false) {
						$var_link = 'http://snapchat.com/'.$var_link;
					}
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-snapchat-ghost" style="'.$var_style.'"></a>';
					break;

				// Flickr
				case 'flickr':
					$var_link = b_f_option('b_opt_social-flickr');
					if (strpos($var_link,'flickr.com') === false) {
						$var_link = 'http://flickr.com/'.$var_link;
					}
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-flickr" style="'.$var_style.'"></a>';
					break;

				// Foursquare
				case 'foursquare':
					$var_link = b_f_option('b_opt_social-foursquare');
					if (strpos($var_link,'foursquare.com') === false) {
						$var_link = 'http://foursquare.com/'.$var_link;
					}
					$var_link = 'https://'.preg_replace('#^https?://#', '', $var_link);
					$out .= '<a data-color="'.$var_color.'" href="'.$var_link.'" target="_blank" class="fa fa-foursquare" style="'.$var_style.'"></a>';
					break;

			}
		}

		return $out;

	}

	add_shortcode('b_rrss', 'b_s_rrss');
}


// Widget de Twitter

if (!function_exists('b_s_twitter')) {

	function b_s_twitter($atts) {

		// Variables globales
		global $b_g_months;

		// Atributos
		$a = shortcode_atts(array(
			'username' => null,
			'number' => 5,
			'retweet' => true,
			'response' => false,
		), $atts);

		// Opciones
		$var_api_key = urlencode(b_f_option('b_opt_apis_twitter_api-key'));
		$var_api_secret = urlencode(b_f_option('b_opt_apis_twitter_api-secret'));

		if ($var_api_key == '' || $var_api_secret == '') {
			return __('No Twitter API key set', 'bilnea');
		}

		// Variables temporales
		$data = array(
			'username' => esc_attr($a['username']),
			'number' => esc_attr($a['number']),
		);

		// Token de acceso
		$var_token = base64_encode($var_api_key.':'.$var_api_secret);

		$var_headers = 'Authorization: Basic '.$var_token."\r\n";
		$var_headers .= 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'."\r\n";

		$var_auth = stream_context_create(
		    array(
		        'http' => array(
		            'header' => $var_headers,
		            'method' => 'POST',
		            'content'=> http_build_query(array('grant_type' => 'client_credentials', )),
		        )
		    )
		);

		$var_response = json_decode(file_get_contents('https://api.twitter.com/oauth2/token', 0, $var_auth), true);
		$var_token = $var_response['access_token'];

		// Tweets del usuario
		$var_context = stream_context_create( array( 'http' => array( 'header' => 'Authorization: Bearer '.$var_token."\r\n", ) ) );

		// Información del usuario
		$out = '<ul class="twitter-shortcode">';
		$var_data = json_decode(file_get_contents('https://api.twitter.com/1.1/users/show.json?screen_name='.urlencode($data_username), 0, $var_data), true);
		$out .= '<li class="user-profile" data-id="'.$var_data['id'].'"><a href="https://twitter.com/'.strtolower($var_data['screen_name']).'" target="" rel="nofollow" class="tw-profile-pic" style="background-image: url('.$data['profile_image_url'].');"></a><div>'.$data['name'].'<br /><a href="https://twitter.com/'.strtolower($data['screen_name']).'" target="" rel="nofollow" class="tw-user">@'.$data['screen_name'].'</a><a href="https://twitter.com/'.strtolower($data['screen_name']).'" target="" rel="nofollow" class="fa fa-twitter"></a></div></li>';

		// Configuración adiccional
		$var_params = '';
		if (esc_attr($a['response']) == false) {
			$var_params .= '&exclude_replies=true';
		}
		if (esc_attr($a['retweet']) == false) {
			$var_params .= '&include_rts=false';
		}

		$tweets = json_decode(file_get_contents('https://api.twitter.com/1.1/statuses/user_timeline.json?tweet_mode=extended&count='.$data['number'].$var_params.'&screen_name='.urlencode($data['username']), 0, $var_context), true);

		foreach ($tweets as $tweet) {
			$var_text = $tweet['full_text'];
			preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $var_text, $match);
			$var_url = end($match[0]);
			foreach ($tweet['entities']['media'] as $media) {
				$var_text = str_replace($media['url'], '<a href="'.$media['media_url'].'" class="fa fa-picture-o"></a>', $var_text);
			}
			foreach ($tweet['entities']['urls'] as $url) {
				$var_text = str_replace($url['url'], '<a class="tw-url" href="'.$url['expanded_url'].'" target="_blank" rel="nofollow">'.$url['display_url'].'</a>', $var_text);
			}
			$var_text = str_replace($var_url, '', $var_text);
			$var_text = preg_replace('/#(\w+)/', ' <a href="https://twitter.com/hashtag/$1" class="tw-hashtag">#$1</a>', $var_text);
			$out .= '<li tweet-id="'.$tweet['id'].'"><a href="'.$var_url.'">@'.$tweet['user']['screen_name'].'</a><span class="tw-date">'.date('j', strtotime($tweet['created_at'])).' '.$mes[date('n', strtotime($tweet['created_at']))-1].' '.date('Y, G:i', strtotime($tweet['created_at'])).'</span><p>'.$text.'</p></li>';
		}

		$out .= '</ul>';

		return $out;

	}

	add_shortcode('b_twitter', 'b_s_twitter');

}


// Compartir url actual

if (!function_exists('b_s_sharer')) {
	
	function b_s_sharer($atts) {

		$a = shortcode_atts(array(
			'social' => 'twitter, facebook, linkedin, google-plus, whatsapp',
			'text' => __('We share?', 'bilnea'),
		), $atts);

		$out = '<div class="b_sharer"><span>'.esc_attr($a['text']).'</span>'."\n";

		foreach (explode(',', esc_attr($a['social'])) as $social) {

			switch (trim($social)) {
				case 'twitter':
					$var_user = '';
					if (strpos(b_f_option('b_opt_social-twitter'), 'twitter.com') !== false) {
						$var_user = explode('twitter.com/', b_f_option('b_opt_social-twitter'))[1];
					} else {
						$var_user = str_replace('@', '', b_f_option('b_opt_social-twitter'));
					}
					($var_user != '') ? $var_via = '&via='.$var_user : $var_via = '';
					$out .= '<a target="_blank" class="sharer fa fa-twitter" href="https://twitter.com/intent/tweet?original_referer='.urlencode(get_the_permalink()).'&related='.$var_user.'&text='.rawurlencode(get_the_title()).'&tw_p=tweetbutton&url='.urlencode(get_the_permalink()).$var_via.'" title="'.__('Share in Twitter', 'bilnea').'"></a>';
					break;
				case 'facebook':
					$out .= '<a target="_blank" class="sharer fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.urlencode(get_the_permalink()).'&t='.rawurlencode(get_the_title()).'" title="'.__('Share in Facebook', 'bilnea').'"></a>';
					break;
				case 'linkedin':
					$out .= '<a target="_blank" class="sharer fa fa-linkedin" href="http://linkedin.com/shareArticle?mini=true&title='.rawurlencode(get_the_title()).'&url='.urlencode(get_the_permalink()).'" title="'.__('Share in Linkedin', 'bilnea').'"></a>';
					break;
				case 'google-plus':
					$out .= '<a target="_blank" class="sharer fa fa-google-plus" href="https://plus.google.com/share?url='.urlencode(get_the_permalink()).'" title="'.__('Share in Google +', 'bilnea').'"></a>';
					break;
				case 'whatsapp':
					if (wp_is_mobile()) {
						$out .= '<a class="sharer fa fa-whatsapp" href="whatsapp://send?text='.rawurlencode(get_the_title()).' – '.urlencode(get_the_permalink()).'" title="'.__('Share in Whatsapp', 'bilnea').'"></a>';
					}
					break;
				case 'mail':
					$out .= '<a class="sharer fa fa-envelope" href="mailto:?subject='.rawurlencode(get_the_title()).'&body='.urlencode(get_the_permalink()).'" title="'.__('Share by email', 'bilnea').'"></a>';
					break;
			}

		}

		$out .= '</div>';

		return $out;
			
	}

	add_shortcode('b_sharer', 'b_s_sharer');

}

?>