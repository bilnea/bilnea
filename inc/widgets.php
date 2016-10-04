<?php

// Páginas hermanas

class b_w_parent_page extends WP_Widget {
	function b_w_parent_page() {
		$options = array(
			'classname' => 'b_w_parent-page',
			'description' => 'Muestra las páginas hermanas'
		);
		parent::__construct('b_widget_parent_page', 'bilnea | Páginas hermanas', $options);
	}
	function form($instance) {
		$defaults = array(
			'title' => '',
			'numerar'=> '',
			'url' => ''
		);
		$instance = wp_parse_args((array)$instance, $defaults);
		$title = $instance['title'];
		$numerar = $instance['numerar'] ? 'true' : 'false';
		?>
		<p>
			Título
			<input class="widefat" type="text" name="<?php echo $this->get_field_name('title');?>" value="<?php echo esc_attr($title);?>"/>
		</p>
		<p>
			<input class="widefat" type="checkbox" <?php checked( $instance['numerar'], 'on' ); ?> id="<?php echo $this->get_field_id('numerar'); ?>" name="<?php echo $this->get_field_name('numerar'); ?>" /> 
    		<label for="<?php echo $this->get_field_id('numerar'); ?>">Lista numerada</label>
		</p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['numerar'] = $new_instance['numerar'];
		return $instance;
	}
	function widget($args, $instance) {
		extract($args);
		$title = apply_filters( 'widget_title', empty($instance['title']) ? '' : $instance['title'], $instance );
		$numerar = $instance['numerar'];

		$out  = $before_widget;
		if ($title != '') {
			$out .= $before_title.$title.$after_title;
		}
		$out .= '<ul class="hermanos">';
		global $post;
		$parent = $post->post_parent;
		$args = array(
			'child_of' => $parent,
			'sort_column' => 'menu_order'
		); 
		$pages = get_pages($args);
		$i = 1; $j = '';
		foreach ($pages as $page) {
			if ($numerar == 'on') {
				$j = '<span>'.$i.'</span>';
			}
			if (get_the_ID() == $page->ID) {
				$out .= '<li class="active">'.$j.'<a>'.$page->post_title.'</a></li>';
			} else {
				$out .= '<li>'.$j.'<a href="'.get_page_link($page->ID).'">'.$page->post_title.'</a></li>';
			}
			$i++;
		}
		$out .= '</ul>';
		$out .= $after_widget;
		echo $out;
    }
}

add_action('widgets_init', 'b_f_parent_page');

function b_f_parent_page() {
	register_widget('b_w_parent_page');
}


// Entradas recientes

class b_w_recent_posts extends WP_Widget {
	function b_w_recent_posts() {
		$options = array(
			'classname' => 'b_w_recent-posts',
			'description' => 'Entradas más recientes al estilo bilnea');
		parent::__construct('b_widget_recent_posts', 'bilnea | Últimas entradas', $options);
	}
	function form( $instance ) {
		$title 			= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number			= isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date 		= isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$date_format	= isset( $instance['date_format'] ) ? esc_attr( $instance['date_format'] ) : '';
		$show_date 		= isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">Título</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id('number'); ?>">Número de entradas</label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		<p><input class="checkbox" type="checkbox" <?php checked($show_date); ?> id="<?php echo $this->get_field_id('show_date'); ?>" name="<?php echo $this->get_field_name('show_date'); ?>" />
		<label for="<?php echo $this->get_field_id('show_date'); ?>">Mostrar fecha</label></p>
		<p><label for="<?php echo $this->get_field_id('date_format'); ?>">Formato de fecha</label>
		<input class="widefat" id="<?php echo $this->get_field_id('date_format'); ?>" name="<?php echo $this->get_field_name('date_format'); ?>" type="text" value="<?php echo $date_format; ?>" size="3" /></p>
		<?php
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['date_format'] = $new_instance['date_format'];
		return $instance;
	}
	function widget( $args, $instance ) {
		if (!isset( $args['widget_id'])) {
			$args['widget_id'] = $this->id;
		}
		ob_start();
		$title = (!empty( $instance['title'])) ? $instance['title'] : 'Últimas entradas';
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);
		$number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
		if (!$number) { $number = 5; }
		$show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
		$date_format = (!empty( $instance['date_format'])) ? $instance['date_format'] : 'd/m/Y';
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'		=> $number,
			'no_found_rows'			=> true,
			'post_status'			=> 'publish',
			'ignore_sticky_posts' 	=> true
		)));
		if ($r->have_posts()) :
			?>
			<?php echo $args['before_widget']; ?>
			<?php if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>
			<ul>
			<?php while ($r->have_posts()) : $r->the_post(); ?>
				<li>
				<?php if ($show_date) : ?>
					<div class="date_post">
						<span class="post-date"><?php echo get_the_date($date_format); ?></span>
					</div>
				<?php endif; ?>
				<a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
				</li>
			<?php endwhile; ?>
			</ul>
			<?php echo $args['after_widget']; ?>
			<?php
			wp_reset_postdata();
		endif;
		ob_end_flush();
	}
}

add_action('widgets_init', 'b_f_recent_posts');

function b_f_recent_posts() {
	register_widget('b_w_recent_posts');
}

?>