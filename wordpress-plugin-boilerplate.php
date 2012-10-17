<?php
/**
 * @package Wordpress_Plugin_Boilerplate
 * @version 0.1
 */
/*
Plugin Name: WordPress Plugin Boilerplate
Plugin URI: http://regularbasic.com/wordpress-plugin-boilerplate
Description: Your easy start for any WordPress plugin development project
Version: 0.1
Author: Tailor Vijay
Author URI: http://about.me/tailorvj
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/*
How to use this boilerplate:
* Duplicate this plugin's folder and rename it to your-plugin-name (with hyphens instead of spaces).
* Rename wordpress-plugin-boilerplate.php to your-plugin-name.php (same as folder name). Open in text editor.
* Search and replace 'tvj_wpb' with your initials and your plugin name, for example, if your name is John Smith and your plugin is WordPress Ajaxifier, replace 'tvj_wpb' with 'js_ajaxifier'.
* Uncomment sample codes and play around with them. They include everything you need for the plugin menus, settings pages and widgets.
* Explore further on the WordPress Codex - http://codex.wordpress.org/Plugin_API

reference plugin resources for web like this:
example: loading an image from the images folder under your plugin
echo '<img src="'. plugins_url('/images/icon.png', __FILE__). '">';

Read about all this in the wordpress codex - http://codex.wordpress.org/Plugin_API/Hooks

*/

// Prevent direct call to script
if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); }

/*
//activation, deactivation and installation functions
*/
register_activation_hook(__FILE__, 'tvj_wpb_activate');
function tvj_wpb_activate(){
	//Code put here runs during plugin activation. Create default settings and database tables, for example.
	//example, default settings
	$tvj_wpb_options = array(
		'foo' => 'bar',
		'hello' => 'world'
	)
	update_option('tvj_wpb_options' $tvj_wpb_options);
}
register_deactivation_hook(__FILE__, 'tvj_wpb_deactivate');
function tvj_wpb_deactivate(){
	//do your magic when plugin is deactivated
}
register_uninstall_hook(__FILE__, 'tvj_wpb_uninstall');
function tvj_wpb_uninstall(){
	//do your magic when plugin is uninstalled
	//example, remove plugins settings from the options table in wordpress.
	delete_option('tvj_wpb_options');
}

//i18n - change first parameter to your plugin folder name
load_plugin_textdomain('wordress-boilerplate-plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );

/*
//Sample code: load a js file with dependency on jQuery
//More info: http://codex.wordpress.org/Function_Reference/wp_enqueue_script
function tvj_wpb_load_js() {
	wp_enqueue_script(
		'tvj_wpb_script',
		plugins_url('/js/plugin.js', __FILE__),
		array('jquery')
	);
}    
add_action('wp_enqueue_scripts', 'tvj_wpb_load_js');
*/

/*
//Sample code: load a css file
    add_action( 'wp_enqueue_scripts', 'tvj_wpb_add_my_stylesheet' );
    function tvj_wpb_add_my_stylesheet() {
        // Respects SSL, Style.css is relative to the current file
        wp_register_style( 'tvj_wpb_style', plugins_url('/css/style.css', __FILE__) );
        wp_enqueue_style( 'tvj_wpb_style' );
    }
*/


/*
//Sample code: A basic menu and submenu for your plugin

add_action('admin_menu', 'tvj_wpb_admin_menu');
fuction tvj_wpb_admin_menu(){
	add_menu_page('WordPress Boilerplate Plugin Settings Page', 'Boilerplate Menu Title', 'manage_options', 'boilerplate-menu-slug', tvj_wpb_settings_page, plugins_url('/images/icon.png', __FILE__);
	add_submenu_page(__FILE__, 'About', 'manage_options', 'boilerplate-about-slug', tvj_wpb_about_page);
}
//This is your settings page HTML output. It should contain some meaningful form options.
function tvj_wpb_settings_page(){
	if(is_admin() && file_exists(dirname(__FILE__).'include/settings.php')){  
        include_once(dirname(__FILE__).'include/settings.php');  
    } 	
}
//Sample code: About page HTML, connected with the above set subment
function tvj_wpb_about_page(){
	if(is_admin() && file_exists(dirname(__FILE__).'include/about.php'){  
			include_once(dirname(__FILE__).'include/about.php');  
    } 	
}
*/


/*
//Sample code: Add a submenu to built-in system menus
//For example, add a settings submenu and page
//All WordPress built-in menus: add_posts_page, add_media_page, add_links_page, add_pages_page, add_comments_page, add_theme_page, add_plugins_page, add_users_page, add_management_page, add_options_page
add_options_page('Boilerplate Settings', 'Boilerplate submenu', 'manage_options', 'boilerplate-settings-slug', tvj_wpb_settings_page);
function tvj_wpb_settings_page(){
	if(is_admin()){  
        include_once(dirname(__FILE__).'include/settings.php');  
    } 	
}
*/


/*
//Sample code: Add a widget
*/
/*
add_action('widgets_init', 'tvj_wpb_register_widgets');
function tvj_wpb_register_widgets(){
	register_widget('tvj_wpb_widget');
}
class tvj_wpb_widget extends WP_Widget {
	function tvj_wpb_widget(){
		$widget_ops = array('classname' => 'tvj_wpb_widget_class_for_css', 'description' => 'Widget Description');
		this -> WP_Widget('tvj_wpb_widget', 'Boilerplage widget', $widget_ops);
	}
	//this is overriding a default method implementation by the WP_Widget class - creates the widget options form.
	function form($instance){
		$tvj_wpb_defaults = array('title' => 'Boilerplate widget', 'tvj_wpb_field1' => 'default value 1', 'tvj_wpb_field2' => 'default value 2');
		$instance = wp_parse_args((array)$instance, $tvj_wpb_defaults);
		$title = $instance['title'];
		$tvj_wpb_field1 = $instance['tvj_wpb_field1'];
		$tvj_wpb_field2 = $instance['tvj_wpb_field2'];
		?>
		<p>Title: <input class="widefat" name="<?php echo $this->get_field_name('title');?>" type="text" value="<?php esc_attr($title);?>" /></p>
		<p>Field 1: <input class="widefat" name="<?php echo $this->get_field_name('tvj_wpb_field1');?>" type="text" value="<?php esc_attr($tvj_wpb_field1);?>" /></p>
		<p>Field 2: <input class="widefat" name="<?php echo $this->get_field_name('tvj_wpb_field2');?>" type="text" value="<?php esc_attr($tvj_wpb_field2);?>" /></p>	
		<?php
	}
	//display the widget
	function widget($args, $instance){
		extract($args);
		echo $before_widget;
		apply_filter('widget_title', $instance['title']);
		$tvj_wpb_field1 = empty($instance['tvj_wpb_field1']) ? '&nbsp;' : $instance['tvj_wpb_field1'];
		$tvj_wpb_field2 = empty($instance['tvj_wpb_field2']) ? '&nbsp;' : $instance['tvj_wpb_field2'];
		if (!empty($title)){
			echo $before_title . $title . $after_title;
		}
		echo '<p>Field 1: ' . $tvj_wpb_field1 . '</p>';
		echo '<p>Field 2: ' . $tvj_wpb_field2 . '</p>';
		echo $after_widget;
	}
}
*/
?>