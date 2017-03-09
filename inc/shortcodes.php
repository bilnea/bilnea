<?php










function b_f_blog($atts) {
	global $lg;
	if ($lg == '') {
		$lg = 'es';
	}
	$a = shortcode_atts(array(
		'total' => '-1',
		'number' => null,
		'pagination' => 'true',
		'class'	=> null,
		'category' => null,
		'type' => 'post',
		'height' => 'auto'
	), $atts);
	$pag = (get_query_var('paged')) ? get_query_var('paged') : 1;
	if (esc_attr($a['number']) != null) {
		$blog_number = esc_attr($a['number']);
	} else {
		$blog_number = b_f_option('b_opt_blog-number');
	}
	$o = array(
		'post_type' => esc_attr($a['type']),
		'posts_per_page' => $blog_number,
		'paged' => $pag,
		'orderby' => b_f_option('b_opt_blog-order'),
	);
	$b_categ = b_f_option('b_opt_blog-categories');
	if ($b_categ == null) {
		$b_categ = array('all');
	}
	if (esc_attr($a['category']) != null) {
		$o['category_name'] = esc_attr($a['category']);
	} else {
		if (!in_array('all', $b_categ)) {
			$o['category_name'] = join(',',$b_categ);
		}
	}
	$query = new WP_Query($o);
	if ($query->have_posts()) {
		$out = '<ul class="blog-wrapper '.esc_attr($a['class']).'">';
		while ($query->have_posts()) {
			$query->the_post();
			ob_start();
			$heg = '';
			if (esc_attr($a['height']) == 'auto') {
				$heg = ' auto-height';
			}
			?>
			<li class="post-entry<?= $heg ?>">
				<?php 
				if (has_post_thumbnail()) {
					$url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					if (b_f_option('b_opt_blog') == 1) {
						?>
						<div class="image big" style="background-image: url(<?php echo $url[0]; ?>);" title="<?php the_title(); ?>">
							<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<h2 class="title">
									<?php the_title(); ?>
								</h2>
							</a>
						</div>
						<?php
					} elseif (b_f_option('b_opt_blog') == 2) {
						?>
						<a class="image big" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo $url[0]; ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					} elseif (b_f_option('b_opt_blog') == 3) {
						?>
						<a class="image small" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo $url[0]; ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					}
				} else {
					if (b_f_option('b_opt_blog') == 1) {
						?>
						<div class="image big empty" style="background-image: url(<?php echo b_f_option('b_opt_positive-logo'); ?>); background-size: contain;" title="<?php the_title(); ?>">
							<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<h2 class="title">
									<?php the_title(); ?>
								</h2>
							</a>
						</div>
						<?php
					} elseif (b_f_option('b_opt_blog') == 2) {
						?>
						<a class="image big empty" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo b_f_option('b_opt_positive-logo'); ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					} elseif (b_f_option('b_opt_blog') == 3) {
						?>
						<a class="image small empty" href="<?php the_permalink(); ?>" rel="nofollow" style="background-image: url(<?php echo b_f_option('b_opt_positive-logo'); ?>);" title="<?php the_title(); ?>">
						</a>
						<?php
					}
				}
				?>
				<div class="post-meta top">
					<?php
					switch (b_f_option('b_opt_blog-position-1-1')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-2')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-3')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-4')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-1-5')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</span>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					?>
				</div>
				<?php
				if (b_f_option('b_opt_blog') != 1) {
					?>
					<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<h2 class="title">
							<?php the_title(); ?>
						</h2>
					</a>
					<?php
				}
				?>
				<div class="post-meta bottom">
					<?php
					switch (b_f_option('b_opt_blog-position-2-1')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-2')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-3')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-4')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					switch (b_f_option('b_opt_blog-position-2-5')) {
						case 2:
							echo '<span class="author">'.get_the_author().'</span>';
							break;
						case 3:
							echo '<span class="date">'.get_the_date(b_f_option('b_opt_blog-date-'.$lg)).'</time>';
							break;
						case 4:
							echo '';
							break;
						case 5:
							echo '<span class="categories">'.get_the_category_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						case 6:
							echo'<span class="tags">'.get_the_tag_list(', &nbsp;', '&nbsp;').'</span>';
							break;
						default:
							echo '';
							break;
					}
					?>
				</div>
				<div class="the-content">
					<?php
					switch (b_f_option('b_opt_blog-excerpt')) {
						case 2:
							if (b_f_option('b_opt_blog-html') == 1) {
								the_excerpt();
								echo '<a class="read-more" href="'.get_the_permalink().'" title="'.get_the_title().'">'.b_f_option('b_opt_blog-read-more-'.$lg).'</a>';
							} else {
								strip_tags(the_excerpt());
								echo '<a class="read-more" href="'.get_the_permalink().'" title="'.get_the_title().'">'.b_f_option('b_opt_blog-read-more-'.$lg).'</a>';
							}
							break;
						case 3:
							if (b_f_option('b_opt_blog-html') == 1) {
								the_content();
							} else {
								strip_tags(the_content());
							}
							break;
					}
					?>
				</div>
			</li>
			<?php
			$out .= ob_get_clean();
		}
		wp_reset_postdata();
	} else {
		$out = '<ul class="blog-wrapper '.esc_attr($a['class']).'">'.__('No posts found', 'bilnea');
	}
	if ($query->max_num_pages > 1) {
		$arp = array();
		$out .= '<div class="pager">';
		$out .= '<div>'.sprintf(__('Page %1$s of %2$s', 'bilnea'), $pag, $query->max_num_pages).'</div>';
		if ($pag != 1) {
			$out .= '<a href="'.get_permalink().'page/'.($pag-1).'"><</a>';
		}
		if ($pag == 1) {
			$out .= '<a class="active">1</a>';
		} else {
			$out .= '<a href="'.get_permalink().'page/1">1</a>';
		}
		$dtb = false; $dta = false;
		for ($i = 2; $i <= $query->max_num_pages-1; $i++) {
			if ($pag == $i) {
				$out .= '<a class="active">'.$i.'</a>';
			}
			if ($i < $pag-3 && $dtb == false) {
				$out .= '<div class="more">...</div>';
				$dtb = true;
			}
			if ($pag != $i && $pag >= $i-3 && $pag <= $i+3) {
				$out .= '<a href="'.get_permalink().'page/'.$i.'">'.$i.'</a>';
			}
			if ($i > $pag+3 && $dta == false) {
				$out .= '<div class="more">...</div>';
				$dta = true;
			}
		}
		if ($pag == $query->max_num_pages) {
			$out .= '<a class="active">'.$query->max_num_pages.'</a>';
		} else {
			$out .= '<a href="'.get_permalink().'page/'.$query->max_num_pages.'">'.$query->max_num_pages.'</a>';
		}
		if ($pag != $query->max_num_pages) {
			$out .= '<a href="'.get_permalink().'page/'.($pag+1).'">></a>';
		}
		$out .= '</div>';
	}
	$out .= '</ul>';
	return $out;
}

add_shortcode('b_blog', 'b_f_blog');


function mostrar_idioma($atts) {
	$a = shortcode_atts(array(
		'mode' => 'select',
		'flag' => 'true',
		'text' => 'true',
		'translate' => 'true',
		'id' => null,
	), $atts);

	if (function_exists('icl_object_id')) {
		$iny = '';
		$inz = '';
		$tot = 0;
		$idi = icl_get_languages('skip_missing=0&orderby=code');
		if (!empty($idi)) {
			if (esc_attr($a['mode']) == 'inline') { $cl = ' en-linea'; } else { $cl = ' desplegable'; }
			$iny .= '<ul class="selector-idioma'.$cl.'">'."\n";
			foreach ($idi as $i) {
				if (!$i['active']) {
					if (esc_attr($a['id']) != null) {
						$pl = get_permalink(icl_object_id(esc_attr($a['id']), get_post_type(esc_attr($a['id'])), true, $i['language_code']));
					} else {
						$pl = $i['url'];
					}
					$inz .= '<li><a href="'.$pl.'">'."\n";
					if (esc_attr($a['flag']) == 'true') {
						$inz .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="bandera" />'."\n";
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) == 'true') {
						$inz .= $i['translated_name'];
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) != 'true') {
						$inz .= $i['native_name'];
					}
					$inz .= '</a></li>'."\n";
					$tot++;
				}
			}
			foreach ($idi as $i) {
				if ($i['active'] == 1) {
					$iny .= '<li><a href="'.$i['url'].'">'."\n";
					if (esc_attr($a['flag']) == 'true') {
						$iny .= '<img src="'.$i['country_flag_url'].'" height="12" alt="'.$i['language_code'].'" width="18" class="bandera" />'."\n";
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) == 'true') {
						$iny .= $i['translated_name'];
					}
					if (esc_attr($a['text']) == 'true' && esc_attr($a['translate']) != 'true') {
						$iny .= $i['native_name'];
					}
					$iny .= '<div class="selector-abajo"></div></a>'."\n";
					if ($tot > 0) {
						$iny .= '<ul>'.$inz.'</ul>'."\n";
					}
					$iny .= '</li>'."\n";
				}
			}
		}
		return $iny;
	}
}

add_shortcode('b_wpml', 'mostrar_idioma');











function b_f_timeline($atts) {
	$a = shortcode_atts(array(
		'username' => null,
		'tweets' => 3,
	), $atts);
	include_once(ABSPATH.WPINC.'/feed.php');
	$twt = fetch_feed('https://api.twitter.com/1/statuses/user_timeline.rss?screen_name='.esc_attr($a['username']));
	$max = $twt->get_item_quantity(esc_attr($a['tweets']));
	$its = $twt->get_items(0, $max);
	$out = '<ul>';
	if (esc_attr($a['username']) == null) {
		$out .= '<li>'.__('It\'s not possible to get latest tweets. No username configured', 'bilnea').'</li>';
	} else {
		if ($max == 0) {
			$out .= '<li>'.__('No tweets', 'bilnea').'</li>';
		} else {
			foreach ($its as $item) {
				$out .= '<li><a href='.$item->get_permalink().'>'.$item->get_title().'</a></li>';
			}
		}
	}
	$out .= '</ul>';
	return $out;
}





function b_rrss($atts) {
	$a = shortcode_atts(array(
		'type' => null
	), $atts);
	if ($a[type] != null) {
		switch (esc_attr($a['type'])) {
			case 'twitter':
				$link = b_f_option('b_opt_social-twitter');
				if (strpos($link,'twitter.com') === false) {
					if ($link[0] == '@') $link = ltrim($link, '@');
					$link = 'http://twitter.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-twitter"></a>';
				break;
			case 'facebook':
				$link = b_f_option('b_opt_social-facebook');
				if (strpos($link,'facebook.com') === false) {
					$link = 'http://facebook.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-facebook"></a>';
				break;
			case 'google-plus':
				$link = b_f_option('b_opt_social-google-plus');
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-google-plus"></a>';
				break;
			case 'youtube':
				$link = b_f_option('b_opt_social-youtube');
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-youtube"></a>';
				break;
			case 'linkedin':
				$link = b_f_option('b_opt_social-linkedin');
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-linkedin"></a>';
				break;
			case 'instagram':
				$link = b_f_option('b_opt_social-instagram');
				if (strpos($link,'instagram.com') === false) {
					if ($link[0] == '@') $link = ltrim($link, '@');
					$link = 'http://instagram.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-instagram"></a>';
				break;
			case 'pinterest':
				$link = b_f_option('b_opt_social-pinterest');
				if (strpos($link,'pinterest.com') === false) {
					$link = 'http://pinterest.com/'.$link;
				}
				$link = 'https://'.preg_replace('#^https?://#', '', $link);
				return '<a href="'.$link.'" target="_blank" class="fa fa-pinterest"></a>';
				break;
		}
	}
}

add_shortcode('b_rrss', 'b_rrss');

// Línea de tiempo de Twitter

function b_twitter($atts) {
	global $mes;
	$a = shortcode_atts(array(
		'username' => null,
		'number' => 5,
		'retweet' => true,
		'response' => false,
	), $atts);

	// Claves de acceso
	$api_key = urlencode(b_f_option('b_opt_apis_twitter_api-key'));
	$api_secret = urlencode(b_f_option('b_opt_apis_twitter_api-secret'));

	// Variables temporales
	$data_username = esc_attr($a['username']);
	$data_count = esc_attr($a['number']);

	// Token de acceso
	$api_credentials = base64_encode($api_key.':'.$api_secret);

	$auth_headers = 'Authorization: Basic '.$api_credentials."\r\n";
	$auth_headers .= 'Content-Type: application/x-www-form-urlencoded;charset=UTF-8'."\r\n";

	$auth_context = stream_context_create(
	    array(
	        'http' => array(
	            'header' => $auth_headers,
	            'method' => 'POST',
	            'content'=> http_build_query(array('grant_type' => 'client_credentials', )),
	        )
	    )
	);

	$auth_response = json_decode(file_get_contents('https://api.twitter.com/oauth2/token', 0, $auth_context), true);
	$auth_token = $auth_response['access_token'];

	// Tweets del usuario
	$data_context = stream_context_create( array( 'http' => array( 'header' => 'Authorization: Bearer '.$auth_token."\r\n", ) ) );

	// Información del usuario
	$out = '<ul class="twitter-shortcode">';
	$data = json_decode(file_get_contents('https://api.twitter.com/1.1/users/show.json?screen_name='.urlencode($data_username), 0, $data_context), true);
	$out .= '<li class="user-profile" data-id="'.$data['id'].'"><a href="https://twitter.com/'.strtolower($data['screen_name']).'" target="" rel="nofollow" class="tw-profile-pic" style="background-image: url('.$data['profile_image_url'].');"></a><div>'.$data['name'].'<br /><a href="https://twitter.com/'.strtolower($data['screen_name']).'" target="" rel="nofollow" class="tw-user">@'.$data['screen_name'].'</a><a href="https://twitter.com/'.strtolower($ddata['screen_name']).'" target="" rel="nofollow" class="fa fa-twitter"></a></div></li>';

	// Configuración adiccional
	$params = '';
	if (esc_attr($a['response']) == false) {
		$params .= '&exclude_replies=true';
	}
	if (esc_attr($a['retweet']) == false) {
		$params .= '&include_rts=false';
	}

	$data = json_decode(file_get_contents('https://api.twitter.com/1.1/statuses/user_timeline.json?tweet_mode=extended&count='.$data_count.$params.'&screen_name='.urlencode($data_username), 0, $data_context), true);

	foreach ($data as $tweet) {
		$text = $tweet['full_text'];
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text, $match);
		$main_url = end($match[0]);
		foreach ($tweet['entities']['media'] as $media) {
			$text = str_replace($media['url'], '<a href="'.$media['media_url'].'" class="fa fa-picture-o"></a>', $text);
		}
		foreach ($tweet['entities']['urls'] as $url) {
			$text = str_replace($url['url'], '<a class="tw-url" href="'.$url['expanded_url'].'" target="_blank" rel="nofollow">'.$url['display_url'].'</a>', $text);
		}
		$text = str_replace($main_url, '', $text);
		$text = preg_replace('/#(\w+)/', ' <a href="https://twitter.com/hashtag/$1" class="tw-hashtag">#$1</a>', $text);
		$out .= '<li tweet-id="'.$tweet['id'].'"><a href="'.$main_url.'">@'.$tweet['user']['screen_name'].'</a><span class="tw-date">'.date('j', strtotime($tweet['created_at'])).' '.$mes[date('n', strtotime($tweet['created_at']))-1].' '.date('Y, G:i', strtotime($tweet['created_at'])).'</span><p>'.$text.'</p></li>';
	}

	$out .= '</ul>';

	return $out;
}

add_shortcode('b_twitter', 'b_twitter');

?>