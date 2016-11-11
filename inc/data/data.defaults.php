<?php

if (__FILE__ == $_SERVER['PHP_SELF']) {
	die();
}


// Valores por defecto

function b_f_default($var_data) {
	switch ($var_data) {
		case 'b_opt_exterior-width':
			return '1200px';
			break;
		case 'b_opt_interior-width':
			return '995px';
			break;
		case 'b_opt_sidebar-width':
			return '310px';
			break;
		case 'b_opt_header-height':
			return '120px';
			break;
		case 'b_opt_menu-height':
			return '24px';
			break;
		case 'b_opt_logo-height':
			return '88px';
			break;
		case 'b_opt_column_separator':
			return '30px';
			break;
		case 'b_opt_footer-menu':
			return 1;
			break;
		case 'b_opt_header-width':
			return 1;
			break;
		case 'b_opt_menu-width':
			return 1;
			break;
		case 'b_opt_header-rrss-icons':
			return 1;
			break;
		case 'header_menu':
			return 1;
			break;
		case 'b_opt_header-color':
			return '#fafafa';
			break;
		case 'b_opt_topbar-color':
			return 'black';
			break;
		case 'b_opt_top-bar_ttf-color':
			return 'white';
			break;
		case 'b_opt_top-bar_ttf-size':
			return '10px';
			break;
		case 'top_bar_font':
			return '"Open Sans", sans-serif';
			break;
		case 'b_opt_main-menu_ttf-color':
			return 'black';
			break;
		case 'b_opt_main-menu_ttf-size':
			return '18px';
			break;
		case 'b_opt_main-menu_ttf-bold':
			return 1;
			break;
		case 'b_opt_main-menu_ttf-font':
			return '"Montserrat", sans-serif';
			break;
		case 'b_opt_main-color':
			return 'white';
			break;
		case 'b_opt_h1_ttf-font':
			return '"Montserrat", sans-serif';
			break;
		case 'b_opt_h1_ttf-size'	:
			return '28px';
			break;
		case 'b_opt_h1_ttf-color':
			return 'black';
			break;
		case 'b_opt_h2_ttf-font'	:
			return '"Montserrat", sans-serif';
			break;
		case 'b_opt_h2_ttf-size'	:
			return '24px';
			break;
		case 'b_opt_h2_ttf-color':
			return 'black';
			break;
		case 'b_opt_h3_ttf-font'	:
			return '"Montserrat", sans-serif';
			break;
		case 'b_opt_h3_ttf-size'	:
			return '20px';
			break;
		case 'b_opt_h3_ttf-color':
			return 'black';
			break;
		case 'b_opt_h4_ttf-font'	:
			return '"Montserrat", sans-serif';
			break;
		case 'b_opt_h4_ttf-size'	:
			return '18px';
			break;
		case 'b_opt_h4_ttf-color':
			return 'black';
			break;
		case 'b_opt_h5_ttf-font'	:
			return '"Montserrat", sans-serif';
			break;
		case 'b_opt_h5_ttf-size'	:
			return '16px';
			break;
		case 'b_opt_h5_ttf-color':
			return 'black';
			break;
		case 'b_opt_h6_ttf-font'	:
			return '"Montserrat", sans-serif';
			break;
		case 'b_opt_h6_ttf-size'	:
			return '14px';
			break;
		case 'b_opt_h6_ttf-color':
			return 'black';
			break;
		case 'b_opt_text_ttf-size':
			return '14px';
			break;
		case 'b_opt_text_ttf-font':
			return '"Open Sans", sans-serif';
			break;
		case 'b_opt_text_ttf-color':
			return 'black';
			break;
		case 'b_opt_bold_ttf-size':
			return '14px';
			break;
		case 'b_opt_bold_ttf-font':
			return '"Open Sans", sans-serif';
			break;
		case 'b_opt_bold_ttf-color':
			return 'black';
			break;
		case 'b_opt_link_ttf-size':
			return '14px';
			break;
		case 'b_opt_link_ttf-font':
			return '"Open Sans", sans-serif';
			break;
		case 'b_opt_link_ttf-color':
			return 'black';
			break;
		case 'b_opt_hover_ttf-size':
			return '14px';
			break;
		case 'b_opt_hover_ttf-font':
			return '"Open Sans", sans-serif';
			break;
		case 'b_opt_hover_ttf-color':
			return 'rgba(40, 157, 204, 0.8)';
			break;
		case 'b_opt_menu-color'	:
			return '#e1e1e1';
			break;
		case 'b_opt_menu-color'	:
			return '#289dcc';
			break;
		case 'b_opt_body_bg_color':
			return '#fafafa';
			break;
		case 'b_opt_footer-color':
			return '#289dcc';
			break;
		case 'footer_title_color':
			return 'black';
			break;
		case 'footer_title_size'	:
			return '18px';
			break;
		case 'footer_title_font'	:
			return '"Montserrat", sans-serif';
			break;
		case 'footer_text_color'	:
			return '#222222';
			break;
		case 'footer_text_size'	:
			return '18px';
			break;
		case 'footer_text_font'	:
			return '"Open Sans", sans-serif';
			break;
		case 'b_opt_submenu-color':
			return 'rgba(255,255,255,0.8)';
			break;
		case 'b_opt_socket-color':
			return 'black';
			break;
		case 'socket_text_color'	:
			return 'white';
			break;
		case 'socket_text_size'	:
			return '12px';
			break;
		case 'b_opt_mobile-menu'	:
			return 2;
			break;
		case 'b_opt_responsive'	:
			return '768px';
			break;
		case 'b_opt_mobile-margin':
			return '8px';
			break;
		case 'b_opt_mobile-htext':
			return '80%';
			break;
		case 'b_opt_mobile-htext':
			return '80%';
			break;
		case 'b_opt_construction':
			return 0;
			break;
		case 'b_opt_jquery-ui'	:
			return 0;
			break;
		case 'b_opt_jquery-mobile':
			return 0;
			break;
		case 'b_opt_jquery-mobile-css':
			return 0;
			break;
		case 'b_opt_lightbox'	:
			return 1;
			break;
		case 'b_opt_lightbox-location':
			return 1;
			break;
		case 'b_opt_mobile-sidebar':
			return 0;
			break;
		case 'b_opt_mobile-search':
			return 1;
			break;
		case 'b_opt_tablet-search':
			return 1;
			break;
		case 'user_email'		:
			return get_option('admin_email');
			break;
		case 'b_opt_cookies-warning':
			return 1;
			break;
		case 'b_opt_show-cookies':
			return 1;
			break;
		case 'b_opt_main-logo'	:
			return get_template_directory_uri().'/img/logo-bilnea.png';
			break;
		case 'b_opt_hyphenator-selector':
			return 'text';
			break;
		case 'b_opt_blog-number'	:
			return 5;
			break;
		case 'b_opt_blog-excerpt':
			return 1;
			break;
		case 'b_opt_blog-excerpt':
			return 100;
			break;
		case 'b_opt_blog-read-more-es':
			return 'Leer más';
			break;
		case 'b_opt_blog-read-more-en':
			return 'Read more';
			break;
		case 'b_opt_blog-date-es':
			return 'd/m/Y';
			break;
		case 'b_opt_blog-order'	:
			return 'date';
			break;
		case 'b_opt_blog'		:
			return 1;
			break;
		case 'b_opt_form-email'	:
			return get_option('admin_email');
			break;
		case 'b_opt_social-order':
			return 'facebook,twitter,instagram,snapchat,google-plus,youtube,linkedin,pinterest,flickr,foursquare';
			break;
		case 'b_opt_social-facebook-color':
			return '#3b5998';
			break;
		case 'b_opt_social-twitter-color':
			return '#1da1f2';
			break;
		case 'b_opt_social-instagram-color':
			return '#c13584';
			break;
		case 'b_opt_social-pinterest-color':
			return '#bd081c';
			break;
		case 'b_opt_social-linkedin-color':
			return '#00a0dc';
			break;
		case 'b_opt_social-google-plus-color':
			return '#dd4b39';
			break;
		case 'b_opt_social-youtube-color':
			return '#cd201f';
			break;
		case 'b_opt_social-snapchat-color':
			return '#fffc00';
			break;
		case 'b_opt_social-flickr-color':
			return '#0063dc';
			break;
		case 'b_opt_social-foursquare-color':
			return '#f94877';
			break;
	}
}

?>