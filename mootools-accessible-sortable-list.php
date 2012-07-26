<?php

/*
	Plugin Name: MooTools Accessible Sortable List
	Plugin URI: http://wordpress.org/extend/plugins/mootools-accessible-sortable-list/
	Description: WAI-ARIA Enabled Sortable List Plugin for Wordpress
	Version: 1.0
	Author: Votis Konstantinos
	Author URI: http://iti.gr/iti/people/Konstantinos_Votis.html
*/

require_once 'php/getCategories.php';

/**
 * Widget Class
 */
class MootoolsAccessibleSortableList extends WP_Widget
{    
    function __construct()
    {
		$widget_ops = array('classname' => 'widget_mootools_accessible_sortable_list', 'description' => __( 'Mootools accessible sortable list' ) );
		parent::__construct('mootools-accessible-sortable-list', __('Mootools Accessible Sortable List'), $widget_ops);
		$this->alt_option_name = 'widget_mootools_accessible_sortable_list';   
		
		if (is_active_widget(false, false, $this->id_base))
		{
			// styles
			wp_register_style('sortablelist_style', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-sortable-list/css/style.css'));
			wp_enqueue_style('sortablelist_style');
			
			// scripts
			wp_deregister_script('jquery');
			wp_register_script('jquery', (get_bloginfo('wpurl') .'/wp-includes/js/jquery/jquery.js'));
			wp_enqueue_script('jquery');

			wp_register_script('mootools-core', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-sortable-list/js/libs/mootools-core.js'));
			wp_enqueue_script('mootools-core');

			wp_register_script('mootools-more', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-sortable-list/js/libs/mootools-more.js'));
			wp_enqueue_script('mootools-more');
			
			wp_register_script('sortablelist', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-sortable-list/js/libs/sortablelist.js'));
			wp_enqueue_script('sortablelist');

			wp_register_script('sortablelist_script', (get_bloginfo('wpurl') . '/wp-content/plugins/mootools-accessible-sortable-list/js/script.js'));
			wp_enqueue_script('sortablelist_script');
		}
	}

    /** @see WP_Widget::widget */
    function widget($args, $instance)
    {	
        extract( $args );
        
        // options
        $title = apply_filters('widget_title', $instance['title']);
        if(!$title)
		{
			$title = 'Mootools Accessible Sortable List';
		}
        
        echo $before_widget;
        
        // if the title is set
		if ( $title )
		{
			echo $before_title . $title . $after_title;
		}
		
		// content
		echo '<ul id="sortablelist">'.getCategories().'</ul>';
		
		echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance)
    {		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance)
    {	
		$title = esc_attr($instance['title']);
		
		?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget title:'); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			</p>
		<?php
    }
} // Widget Class

// register widget
add_action('widgets_init', create_function('', 'register_widget("MootoolsAccessibleSortableList");'));

?>
