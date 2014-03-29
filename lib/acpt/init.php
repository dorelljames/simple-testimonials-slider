<?php
// Include this file in functions.php or plugin
global $wp_version;
if($wp_version < '3.3' || $wp_version == null ): exit('You need the 3.3+ version of WordPress.');
else: $acpt_version = '2.0';
endif;

// load config
//require_once('config.php');

// Temporarily include DEFINES
// location of acpt class

//define('ACPT_LOCATION', get_stylesheet_directory_uri());
//define('ACPT_FILE_PATH', get_stylesheet_directory_uri());

define('ACPT_LOCATION', plugin_dir_url( __FILE__ ));
define('ACPT_FILE_PATH', plugin_dir_url( __FILE__ ));

// turn on styles
define('ACPT_STYLES', true);

// dynamic messages for post types
define('ACPT_MESSAGES', true);

// forms settings
define('DEV_MODE', true);

// form html defaults
define('BEFORE_LABEL', '<div class="control-group">');
define('AFTER_LABEL', '<div class="controls">');
define('AFTER_FIELD', '</div></div>');

// load plugins
define('ACPT_LOAD_PLUGINS', false);

// plugins list
$acptPlugins = array('sample', 'seo');


/***********************************************************************************************************************************/

// load classes
require_once('core/acpt.php');
include('core/post_type.php');
include('core/tax.php');
include('core/role.php');
include('core/form.php');
include('core/meta_box.php');


// setup
if(defined('ACPT_MESSAGES')) 
	add_filter('post_updated_messages', 'acpt::set_messages' );
add_action('save_post','acpt::save_form');
if(defined('ACPT_STYLES')) add_action('admin_init', 'acpt::apply_css');
if( is_admin() ) add_action('admin_enqueue_scripts', 'acpt::upload_scripts');

// load plugins
if(defined('ACPT_LOAD_PLUGINS') && (ACPT_LOAD_PLUGINS == true)) :
	foreach($acptPlugins as $plugin) {
		$pluginFile = '';
		if (file_exists(DEFINED('ACPT_FILE_PATH') . '/acpt/plugins/' . $plugin . '/index.php')) {
			$pluginFile = 'plugins/' . $plugin . '/index.php';
		} else {
			$pluginFile = 'plugins/' . $plugin . '.php';
		}
		include_once($pluginFile);
	}
endif;

