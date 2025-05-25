<?php
/**
 * Plugin Name: Job Manager & Career - Manage job board listings, and recruitments
 * Description: Create and manage jobs from WordPress admin panel.
 * Author:      ThemeHigh
 * Version:     1.4.8
 * Author URI:  https://www.themehigh.com
 * Plugin URI:  https://www.themehigh.com/job-manager
 * Text Domain: job-manager-career
 * Domain Path: /languages
 */
 
if(!defined( 'ABSPATH' )) exit;

define('THJMF_VERSION', '1.4.8');
!defined('THJMF_FILE') && define('THJMF_FILE', __FILE__);
!defined('THJMF_PATH') && define('THJMF_PATH', plugin_dir_path( __FILE__ ));
!defined('THJMF_URL') && define('THJMF_URL', plugins_url( '/', __FILE__ ));
!defined('THJMF_BASE_NAME') && define('THJMF_BASE_NAME', plugin_basename( __FILE__ ));
!defined('THJMF_ASSETS_URL') && define('THJMF_ASSETS_URL', THJMF_URL.'assets/');
!defined('THJMF_TEMPLATES') && define('THJMF_TEMPLATES', THJMF_PATH . 'templates');

require THJMF_PATH . 'classes/class-thjmf.php';
require THJMF_PATH . 'classes/class-thjmf-settings.php';
require THJMF_PATH . 'classes/class-thjmf-post-fields.php';
require THJMF_PATH . 'classes/class-thjmf-posts.php';


register_activation_hook( __FILE__, 'activate_thjmf' );
register_deactivation_hook( __FILE__, 'deactivate_thjmf' );

function activate_thjmf(){
	THJMF::initialize_settings();
}

function deactivate_thjmf(){
	THJMF::prepare_deactivation();
}

function run_thjmf() {
	$plugin = new THJMF();
}
run_thjmf();
