<?php
/* 
Plugin Name: Devlounge Plugin Series
Plugin URI: http://www.devlounge.net/
Version: v1.00
Author: <a href="http://www.ronalfy.com/">Ronald Huereca</a>
Description: A sample plugin for a <a href="http://www.devlounge.net">Devlounge</a> series.
 
Copyright 2007  Ronald Huereca  (email : ron alfy [a t ] g m ail DOT com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/
if (!class_exists("DevloungePluginSeries")) {
	class DevloungePluginSeries {
		var $adminOptionsName = "DevloungePluginSeriesAdminOptions";
		function DevloungePluginSeries() { //constructor
			
		}
		function init() {
			$this->getAdminOptions();
		}
		//Returns an array of admin options
		function getAdminOptions() {
			$devloungeAdminOptions = array('show_header' => 'true',
				'add_content' => 'true', 
				'comment_author' => 'true', 
				'content' => '');
			$devOptions = get_option($this->adminOptionsName);
			if (!empty($devOptions)) {
				foreach ($devOptions as $key => $option)
					$devloungeAdminOptions[$key] = $option;
			}				
			update_option($this->adminOptionsName, $devloungeAdminOptions);
			return $devloungeAdminOptions;
		}
		
		function addHeaderCode() {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['show_header'] == "false") { return; }
			?>
<!-- Devlounge Was Here -->
			<?php
		
		}
		function addContent($content = '') {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['add_content'] == "true") {
				$content .= $devOptions['content'];
			}
			return $content;
		}
		function authorUpperCase($author = '') {
			$devOptions = $this->getAdminOptions();
			if ($devOptions['comment_author'] == "true") {
				$author = strtoupper($author);
			}
			return $author;
		}
		//Prints out the admin page
		function printAdminPage() {
					$devOptions = $this->getAdminOptions();
										
					if (isset($_POST['update_devloungePluginSeriesSettings'])) { 
						if (isset($_POST['devloungeHeader'])) {
							$devOptions['show_header'] = $_POST['devloungeHeader'];
						}	
						if (isset($_POST['devloungeAddContent'])) {
							$devOptions['add_content'] = $_POST['devloungeAddContent'];
						}	
						if (isset($_POST['devloungeAuthor'])) {
							$devOptions['comment_author'] = $_POST['devloungeAuthor'];
						}	
						if (isset($_POST['devloungeContent'])) {
							$devOptions['content'] = apply_filters('content_save_pre', $_POST['devloungeContent']);
						}
						update_option($this->adminOptionsName, $devOptions);
						
						?>
<div class="updated"><p><strong><?php _e("Settings Updated.", "DevloungePluginSeries");?></strong></p></div>
					<?php
					} ?>
<div class=wrap>
<form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
<h2>Devlounge Plugin Series</h2>
<h3>Content to Add to the End of a Post</h3>
<textarea name="devloungeContent" style="width: 80%; height: 100px;"><?php _e(apply_filters('format_to_edit',$devOptions['content']), 'DevloungePluginSeries') ?></textarea>
<h3>Allow Comment Code in the Header?</h3>
<p>Selecting "No" will disable the comment code inserted in the header.</p>
<p><label for="devloungeHeader_yes"><input type="radio" id="devloungeHeader_yes" name="devloungeHeader" value="true" <?php if ($devOptions['show_header'] == "true") { _e('checked="checked"', "DevloungePluginSeries"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="devloungeHeader_no"><input type="radio" id="devloungeHeader_no" name="devloungeHeader" value="false" <?php if ($devOptions['show_header'] == "false") { _e('checked="checked"', "DevloungePluginSeries"); }?>/> No</label></p>

<h3>Allow Content Added to the End of a Post?</h3>
<p>Selecting "No" will disable the content from being added into the end of a post.</p>
<p><label for="devloungeAddContent_yes"><input type="radio" id="devloungeAddContent_yes" name="devloungeAddContent" value="true" <?php if ($devOptions['add_content'] == "true") { _e('checked="checked"', "DevloungePluginSeries"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="devloungeAddContent_no"><input type="radio" id="devloungeAddContent_no" name="devloungeAddContent" value="false" <?php if ($devOptions['add_content'] == "false") { _e('checked="checked"', "DevloungePluginSeries"); }?>/> No</label></p>

<h3>Allow Comment Authors to be Uppercase?</h3>
<p>Selecting "No" will leave the comment authors alone.</p>
<p><label for="devloungeAuthor_yes"><input type="radio" id="devloungeAuthor_yes" name="devloungeAuthor" value="true" <?php if ($devOptions['comment_author'] == "true") { _e('checked="checked"', "DevloungePluginSeries"); }?> /> Yes</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="devloungeAuthor_no"><input type="radio" id="devloungeAuthor_no" name="devloungeAuthor" value="false" <?php if ($devOptions['comment_author'] == "false") { _e('checked="checked"', "DevloungePluginSeries"); }?>/> No</label></p>

<div class="submit">
<input type="submit" name="update_devloungePluginSeriesSettings" value="<?php _e('Update Settings', 'DevloungePluginSeries') ?>" /></div>
</form>
 </div>
					<?php
				}//End function printAdminPage()
	
	}

} //End Class DevloungePluginSeries

if (class_exists("DevloungePluginSeries")) {
	$dl_pluginSeries = new DevloungePluginSeries();
}

//Initialize the admin panel
if (!function_exists("DevloungePluginSeries_ap")) {
	function DevloungePluginSeries_ap() {
		global $dl_pluginSeries;
		if (!isset($dl_pluginSeries)) {
			return;
		}
		if (function_exists('add_options_page')) {
	add_options_page('Devlounge Plugin Series', 'Devlounge Plugin Series', 9, basename(__FILE__), array(&$dl_pluginSeries, 'printAdminPage'));
		}
	}	
}

//Actions and Filters	
if (isset($dl_pluginSeries)) {
	//Actions
	add_action('admin_menu', 'DevloungePluginSeries_ap');
	add_action('wp_head', array(&$dl_pluginSeries, 'addHeaderCode'), 1);
	add_action('activate_devlounge-plugin-series/devlounge-plugin-series.php',  array(&$dl_pluginSeries, 'init'));
	//Filters
	add_filter('the_content', array(&$dl_pluginSeries, 'addContent'),1); 
	add_filter('get_comment_author', array(&$dl_pluginSeries, 'authorUpperCase'));
}

?>