<?php 

/*
 *
 * Register menu to dados aberto API
 */
function wpb_custom_dados_abertos() {
  register_nav_menu('dados-abertos',__( 'Dados Abertos' ));
}
add_action( 'init', 'wpb_custom_dados_abertos' );

/*
*
* Custom Walker to dados aberto API
*/
class CSS_Menu_Walker_Dados_Abertos extends Walker {

	var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');
	
	function start_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}
	
	function end_lvl(&$output, $depth = 0, $args = array()) {
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}
	
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	
		global $wp_query;
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;
		
		/* Add active class */
		if (in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
			unset($classes['current-menu-item']);
		}
		
		/* Check for children */
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (!empty($children)) {
			$classes[] = 'has-sub';
		}
		
		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
		$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';
		
		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		
		$attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
		$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
		$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
		$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'><span>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;
		
		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
	
	function end_el(&$output, $item, $depth = 0, $args = array()) {
		$output .= "</li>\n";
	}
}

/*
*
* Custom CSS to dados aberto template page
*/
function wpse_enqueue_dados_abertos_template_styles() {
    if ( is_page_template( 'template-dados-abertos.php' ) ) {
        wp_enqueue_style( 'template-dados-abertos', get_template_directory_uri() . '/css/template-dados-abertos.css' );
        wp_enqueue_script( 'datatable-js', get_template_directory_uri() . '/js/datatable.min.js', array( 'jquery' ), null, true );
        wp_enqueue_script( 'datatable-jquery', get_template_directory_uri() . '/js/datatable.jquery.min.js', array( 'jquery' ), null, true );
        wp_enqueue_script( 'template-dados-abertos', get_template_directory_uri() . '/js/template-dados-abertos.js', array( 'jquery' ), null, true );
        wp_enqueue_script( 'wpb-fa', 'https://use.fontawesome.com/e7677b358c.js', array( 'jquery' ), null, true );
    }
}
add_action( 'wp_enqueue_scripts', 'wpse_enqueue_dados_abertos_template_styles' );