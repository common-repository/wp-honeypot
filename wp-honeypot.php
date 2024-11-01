<?php
/*
	Plugin Name: WP-HoneyPot
	Plugin URI: https://wiki.geekyhabitat.com/tiki-index.php?page=WP-HoneyPot
	Version: v1.0
	Author: Stuart Ryan
	Author URI: http://www.secludedhabitat.com/
	Description: A plugin to enable simple integration of Project Honeypot into your Wordpress blog. Any issues with this plugin should be reported on <a href="https://bugzilla.geekyhabitat.com/">GeekyHabitat BugZilla</a>
*/

/*  Copyright 2008  Stuart Ryan  (email : bugmin@geekyhabitat.com)

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
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



	if (!class_exists("ProjectHoneypotPlugin")) {
		class ProjectHoneypotPlugin {
			var $adminOptionsName = "wpHoneyPotAdminOptions";
			
			//Prints out the admin page
			function printAdminPage() {
				?>
<div class="wrap">
    <h2>WP-HoneyPot</h2>
    <h3>
        <?php _e('Notices'); ?>
    </h3>
    <div class="message" style="background-color: #f66;">
        <p>
            <?php
if (get_option('wp_honeypot_enabled') == '' && get_option('wp_honeypot_URL') == '') {
echo 'You must enable the plugin below and enter your HoneyPot/Quicklink URL for this plugin to function.';
}
elseif (get_option('wp_honeypot_enabled') == '') {
echo 'You must enable the plugin below otherwise the links will not be added to your site.';
}
elseif (get_option('wp_honeypot_URL') == '') {
echo 'You must fill out your HoneyPot/Quicklink URL otherwise this plugin will not work.';
}
            ?>
        </p>
    </div>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">
                    Enable WP-HoneyPot
                </th>
                <td>
                    <label for="wp_honeypot_enabled">
                        <input name="wp_honeypot_enabled" type="checkbox" id="wp_honeypot_enabled" value="1"
                        <?php checked('1', get_option('wp_honeypot_enabled')); ?>
/>
                    </label>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row">
                    Honeypot or Quicklink URL
                </th>
                <td>
                    <input type="text" name="wp_honeypot_URL" value="<?php echo get_option('wp_honeypot_URL'); ?>" size="50"/>
                </td>
            </tr>
        </table><input type="hidden" name="page_options" value="wp_honeypot_enabled, wp_honeypot_URL" /><input type="hidden" name="action" value="update" />
        <p class="submit">
            <input type="submit" name="Submit" value="<?php _e('Save Changes') ?>" />
        </p>
        <p>
            <?php
if (get_option('wp_honeypot_URL') == '') {
echo '<P>&nbsp;</P>If you have not already done so you can sign up to project honeypot by clicking the below image.<BR>';
echo '<a href="http://www.projecthoneypot.org/?rf=48756" target="_blank"> <img src="../wp-content/plugins/wp-honeypot/project_honey_pot_button.gif" height="31px" width="88px" border="0" alt="Stop Spam Harvesters, Join Project Honey Pot"></a>';
}
            ?>
        </p>
    </form>
</div>
<?php
			}//End function printAdminPage()

			function generate_random_number($total){
				srand(time());
				$random = (rand()%$total);
				return $random;
			}

			function honeypot_config_admin_msg() { echo '<div class="error"><p>WP-HoneyPot has not been configured. Please visit the <a href="admin.php?page=' . basename(__FILE__) . '">WP-HoneyPot Settings Page</a> to complete configuration as soon as possible.</p></div>'; }
			function honeypot_misconfig_admin_msg() { echo '<div class="error"><p>WP-HoneyPot is misconfigured. The plugin is enabled but no HoneyPot URL has been entered. Please visit the <a href="admin.php?page=' . basename(__FILE__) . '">WP-HoneyPot Settings Page</a> and enter a honeypot URL as soon as possible.</p></div>'; }

			function generate_link(){
				$num_options = '3';
				$rand = $this->generate_random_number($num_options);
	
				if ($rand == '0') {
					return '<a href="' . get_option('wp_honeypot_URL') . '"><!-- Private Link --></a>';
				}
				elseif ($rand =='1') {
					return '<!-- <a href="' . get_option('wp_honeypot_URL') . '">Private</a> -->';
				}
				elseif ($rand == '2'){
					return '<a href="' . get_option('wp_honeypot_URL') . '"><span style="display: none;">Private</span></a>';
				}
				elseif ($rand == '3'){
					return '<a href="' . get_option('wp_honeypot_URL') . '"></a>';
				}
			}

			function add_link_to_site(){
				if	(get_option('wp_honeypot_enabled') == '1') {
					echo $this->generate_link();
				}
			}

			function select_hook() {
				$num_options = '2';
				$rand = $this->generate_random_number($num_options);

				if ($rand == '0'){
					return 'loop_end';
				}
				elseif ($rand == '1') {
					return 'wp_footer';
				}
				elseif ($rand == '2') {
					return 'get_footer';
				}
			}
		}
	} //End Class ProjectHoneypotPlugin

	if (class_exists("ProjectHoneypotPlugin")) {
		$dl_plugin = new ProjectHoneypotPlugin();
	}

	//Actions and Filters   
	
	//Initialize the admin panel
	if (!function_exists("WPHoneypot_ap")) {
		function WPHoneypot_ap() {
			global $dl_plugin;
			if (!isset($dl_plugin)) {
				return;
			}
			if (function_exists('add_options_page')) {
				add_options_page('WP-HoneyPot', 'WP-HoneyPot', 9, basename(__FILE__), array(&$dl_plugin, 'printAdminPage'));
			}
		}

		add_action('admin_menu', 'WPHoneypot_ap');

		if (isset($dl_plugin)) {
			//Actions
			add_action ( $dl_plugin->select_hook(), array(&$dl_plugin, 'add_link_to_site'));

			//Filters
		}
	}

	if ( is_admin() && (get_option(wp_honeypot_URL)=='') && ($_GET['page'] != 'wp-honeypot.php') && (get_option(wp_honeypot_enabled)=='0' ))  {
		add_action('admin_notices', array(&$dl_plugin, 'honeypot_config_admin_msg'));
	}

	if ( is_admin() && (get_option(wp_honeypot_URL)=='') && ($_GET['page'] != 'wp-honeypot.php') && (get_option(wp_honeypot_enabled)=='1' ))  {
		add_action('admin_notices', array(&$dl_plugin, 'honeypot_misconfig_admin_msg'));
	}
?>
