<?php

/**
 * Plantilla de artículo individual
 *
 */

if (have_posts()) {

	while (have_posts()) {

		the_post();

		get_header();

		// Javascript del formulario
		wp_register_script('functions.comments', get_template_directory_uri().'/js/internal/functions.comments.js', array(), $b_g_version, true);
		$var_temp = array(
			'text' => __('There are errors on the form. Please fix them before continuing', 'bilnea'),
			'empty' => __('Fill in all the required fields', 'bilnea'),
			'email' => __('Enter a valid email address', 'bilnea'),
			'legal' => __('You must accept the legal advice', 'bilnea')
		);
		wp_localize_script('functions.comments', 'comments_errors', $var_temp);
		wp_enqueue_script('functions.comments');

		?>

		<div id="primary" class="main-row">
			<div id="content" role="main" class="span8 offset2">
				<article class="post">
					<div class="the-content">

					<?php

					// Variables globales
					global $b_g_language;

					//locales
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

					if (!function_exists('b_f_i_share')) {
						function b_f_i_share($arg = array('', '', 'all')) {
							if (count($arg) < 3) {
								$var_temp = 'all';
							} else {
								$var_temp = $arg['2'];
							}
							switch ($var_temp) {
								case 'twitter':
									$var_user = '';
									if (strpos(b_f_option('b_opt_social-twitter'), 'twitter.com') !== false) {
										$var_user = explode('twitter.com/', b_f_option('b_opt_social-twitter'))[1];
									} else {
										$var_user = str_replace('@', '', b_f_option('b_opt_social-twitter'));
									}
									($var_user != '') ? $var_via = '&via='.$var_user : $var_via = '';
									return '<a target="_blank" class="sharer fa fa-twitter" href="https://twitter.com/intent/tweet?original_referer='.urlencode(get_the_permalink()).'&related='.$var_user.'&text='.rawurlencode(get_the_title()).'&tw_p=tweetbutton&url='.urlencode(get_the_permalink()).$var_via.'" title="'.__('Share in Twitter', 'bilnea').'"></a>';
									break;
								case 'facebook':
									return '<a target="_blank" class="sharer fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.urlencode(get_the_permalink()).'&t='.rawurlencode(get_the_title()).'" title="'.__('Share in Facebook', 'bilnea').'"></a>';
									break;
								case 'linkedin':
									return '<a target="_blank" class="sharer fa fa-linkedin" href="http://linkedin.com/shareArticle?mini=true&title='.rawurlencode(get_the_title()).'&url='.urlencode(get_the_permalink()).'" title="'.__('Share in Linkedin', 'bilnea').'"></a>';
									break;
								case 'google-plus':
									return '<a target="_blank" class="sharer fa fa-google-plus" href="https://plus.google.com/share?url='.urlencode(get_the_permalink()).'" title="'.__('Share in Google +', 'bilnea').'"></a>';
									break;
								case 'whatsapp':
									if (wp_is_mobile()) {
										return '<a class="sharer fa fa-whatsapp" href="whatsapp://send?text='.rawurlencode(get_the_title()).' – '.urlencode(get_the_permalink()).'" title="'.__('Share in Whatsapp', 'bilnea').'"></a>';
									}
									break;
								case 'mail':
									return '<a class="sharer fa fa-envelope" href="mailto:?subject='.rawurlencode(get_the_title()).'&body='.urlencode(get_the_permalink()).'" title="'.__('Share by email', 'bilnea').'"></a>';
									break;
								default:
									$var_user = '';
									if (strpos(b_f_option('b_opt_social-twitter'), 'twitter.com') !== false) {
										$var_user = explode('twitter.com/', b_f_option('b_opt_social-twitter'))[1];
									} else {
										$var_user = str_replace('@', '', b_f_option('b_opt_social-twitter'));
									}
									($var_user != '') ? $var_via = '&via='.$var_user : $var_via = '';
									$out = '<a target="_blank" class="sharer fa fa-twitter" href="https://twitter.com/intent/tweet?original_referer='.urlencode(get_the_permalink()).'&related='.$var_user.'&text='.rawurlencode(get_the_title()).'&tw_p=tweetbutton&url='.rawurlencode(get_the_permalink()).$var_via.'" title="'.__('Share in Twitter', 'bilnea').'"></a>';
									$out .= '<a target="_blank" class="sharer fa fa-facebook" href="http://www.facebook.com/sharer.php?u='.urlencode(get_the_permalink()).'&t='.rawurlencode(get_the_title()).'" title="'.__('Share in Facebook', 'bilnea').'"></a>';
									$out .= '<a target="_blank" class="sharer fa fa-linkedin" href="http://linkedin.com/shareArticle?mini=true&title='.rawurlencode(get_the_title()).'&url='.urlencode(get_the_permalink()).'" title="'.__('Share in Linkedin', 'bilnea').'"></a>';
									$out .= '<a target="_blank" class="sharer fa fa-google-plus" href="https://plus.google.com/share?url='.urlencode(get_the_permalink()).'" title="'.__('Share in Google +', 'bilnea').'"></a>';
									if (wp_is_mobile()) {
										$out .= '<a class="sharer fa fa-whatsapp" href="whatsapp://send?text='.rawurlencode(get_the_title()).' – '.urlencode(get_the_permalink()).'" title="'.__('Share in Whatsapp', 'bilnea').'"></a>';
									}
									$out .= '<a class="sharer fa fa-envelope" href="mailto:?subject='.rawurlencode(get_the_title()).'&body='.urlencode(get_the_permalink()).'" title="'.__('Share by email', 'bilnea').'"></a>';
									return $out;
									break;
							}
						}
					}

					$var_categories = '<div class="entry-categories">'.implode(', ', $var_categories).'</div>';
					$var_tags = '<div class="entry_tags">'.implode(', ', $var_tags).'</div>';

					$comments = get_comments(array(
						'post_id' => get_the_ID()
					));

					ob_start();
					wp_list_comments(array(
						'per_page' => 10,
						'reverse_top_level' => false
					), $comments);
					$var_comments_list = '<ol class="commentlist">'.ob_get_clean().'</ol>';

					$args = array(
						'fields' => array(
							'author' => '<p class="comment-author"><input id="comment_author" name="author" type="text" size="30" placeholder="* '.__('Name', 'bilnea').'" /></p>',
							'email' => '<p class="comment-email"><input id="comment_email" name="email" type="text" size="30" placeholder="* '.__('Email', 'bilnea').'" /></p>'
						),
						'comment_field' => '<p class="comment-comment"><textarea id="comment_message" name="comment" rows="4" placeholder="* '.__('Comment', 'bilnea').'"></textarea></p>',
						'comment_notes_before' => '',
						'comment_notes_after' => '',
						'title_reply' => '',
						'title_reply_before' => '',
						'title_reply_after' => ''
					);

					ob_start();
					comment_form($args, get_the_ID());

					$var_comments_form = ob_get_clean().'<div class="response"></div>';

					$var_shortcodes = array('{{b_title}}', '{{b_permalink}}', '{{b_content}}', '{{b_date}}', '{{b_categories}}', '{{b_author}}', '{{b_tags}}', '{{b_comments-number}}', '{{b_comments-form}}', '{{b_comments-list}}');
					$var_replace = array(get_the_title(), get_permalink(), apply_filters('the_content',$post->post_content), get_the_date(b_f_option('b_opt_blog-date-'.$b_g_language)), $var_categories, get_the_author_link(), $var_tags, $var_comments, $var_comments_form, $var_comments_list);

					echo do_shortcode(preg_replace_callback("/{{b_share(-)?([a-zA-Z]+)?}}/", "b_f_i_share", preg_replace_callback("/{{b_id-([0-9]+)}}/", "b_f_i_url",  preg_replace_callback("/{{b_image-([0-9a-zA-Z]+)}}/", "b_f_i_image", str_replace($var_shortcodes, $var_replace, b_f_option('b_opt_blog-content-single-'.$b_g_language))))));

					?>

					</div>
				</article>
			</div>
		</div>

		<?php

		get_footer();

	}

}

?>