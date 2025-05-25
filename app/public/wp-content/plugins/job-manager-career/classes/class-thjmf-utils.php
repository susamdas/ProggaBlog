<?php
/**
 * Utils functions for plugin
 *
 * @link       https://themehigh.com
 * @since      1.0.0
 *
 * @package    job-manager-career
 * @subpackage job-manager-career/classes
 */

defined( 'ABSPATH' ) || exit;
if(!defined('WPINC')){	die; }

if(!class_exists('THJMF_Utils')):

	class THJMF_Utils {
		const THJMF_CPT_JOB 	= 'thjm_jobs';
		const THJMF_CPT_APPLICANTS 	= 'thjm_applicants';
		const OPTION_KEY_THJMF_ADVANCED_SETTINGS 	= 'thjmf_advanced_settings';
		const OPTION_KEY_THJMF_VERSION = 'thjmf_db_version';
		const THJMF_JPM_FEATURED = 'featured_job';
		const THJMF_JPM_FILLED = 'filled_job';
		const THJMF_JPM_EXPIRED = 'expired_job';
		const THJMF_APPLICATION_STATUS 	= 'application_status';
		const THJMF_JOB_ID 	= 'job_id';
		const THJMF_PM_ADDITIONAL_NOTE = 'additional_note';
		const OPTION_KEY_THJM_JOB_UPDATION = 'thjm_jobs_updation';
		const OPTION_KEY_THJM_APPL_UPDATION = 'thjm_applicants_updation';
		const OPTION_KEY_THJMF_DB_UPDATED = 'thjmf_110_db_updated';
		const THJMF_POST_META_SETTINGS 	= '_thjm_post_meta_settings';

		//old & not used
		const THJMF_CPT_MAP 	= '_thjm_applicant_job_relation';
		const THJMF_APPLICANT_POST_SETTINGS 	= '_thjm_applicant_data';
		const THJMF_APPLICANT_STATUS 	= '_thjm_applicant_status';
		const THJMF_POST_CUSTOM_SETTINGS 	= '_thjm_post_custom_settings';
		const THJMF_PM_FEATURED = '_thjm_job_featured';
		const THJMF_PM_FILLED = '_thjm_job_filled';
		const THJMF_PM_EXPIRED = '_thjm_job_expired';

		public static $tax = array('location' => 'thjm_job_locations', 'job_type' => 'thjm_job_type', 'category' => 'thjm_job_category');
		public static $shortcode = 'THJM_JOBS';

		public static $appl_meta = array(
			'location' => 'Location', 'category' => 'Category', 'job_type' => 'Job Type'
		);

		// OLD Keys - START

		public static function get_applicant_status_key(){
			return self::THJMF_APPLICANT_STATUS;
		}

		public static function get_cpt_key(){
			return self::THJMF_CPT_MAP;
		}

		public static function get_applicant_pm_key(){
			return self::THJMF_APPLICANT_POST_SETTINGS;
		}

		// OLD Keys - END

		public static function get_posttypes(){
			return array( self::THJMF_CPT_JOB, self::THJMF_CPT_APPLICANTS);
		}
		
		public static function get_all_taxonomies(){
			return self::$tax;
		}

		public static function get_job_cpt(){
			return self::THJMF_CPT_JOB;
		}

		public static function get_applicant_cpt(){
			return self::THJMF_CPT_APPLICANTS;
		}

		public static function get_filled_meta_key(){
			return self::THJMF_JPM_FILLED;
		}

		public static function get_expired_meta_key(){
			return self::THJMF_JPM_EXPIRED;
		}

		public static function get_db_version_key(){
			return self::OPTION_KEY_THJMF_VERSION;
		}

		public static function get_settings_key(){
			return self::OPTION_KEY_THJMF_ADVANCED_SETTINGS;
		}

		public static function get_cpt_map_job_key(){
			return self::THJMF_JOB_ID;
		}

		public static function get_application_status_key(){
			return self::THJMF_APPLICATION_STATUS;
		}

		public static function get_pm_expiry(){
			return self::THJMF_JPM_EXPIRED;
		}

		public static function get_apm_additional_note(){
			return self::THJMF_PM_ADDITIONAL_NOTE;
		}

		public static function get_shortcode( $brackets=false ){
			if( $brackets ){
				return '['.self::$shortcode.']';
			}
			return self::$shortcode;
		}

		public static function get_apply_fields(){
			$appl_fields = array(
				'name' 			=> __('Name', 'job-manager-career'),
				'phone' 		=> __('Phone', 'job-manager-career'),
				'email'			=> __('Email', 'job-manager-career'),
				'cover_letter' 	=> __('Cover Letter', 'job-manager-career')
			);
			return $appl_fields;
		}

		public static function get_jpm_featured($post_id, $text=false){
			$featured = self::get_post_metas($post_id, self::THJMF_JPM_FEATURED, true);
			if($text){
				$featured = filter_var( $featured, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
				$featured =  $featured ? '<span class="dashicons dashicons-yes"></span>' : '--';
			}
			return $featured;
		}

		public static function get_jpm_filled($post_id, $text=false){
			$filled = self::get_post_metas($post_id, self::THJMF_JPM_FILLED, true);
			if($text){
				$filled = filter_var( $filled, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
				$filled =  $filled ? '<span class="dashicons dashicons-yes"></span>' : '--';
			}
			return $filled;
		}

		public static function get_jpm_expired($post_id, $text=false){
			$expiry = self::get_post_metas($post_id, self::THJMF_JPM_EXPIRED, true);
			if( $text ){
				$expiry = !empty( $expiry ) ? self::is_post_expired($expiry) : false;
				$expiry = $expiry ? __('Expired', 'job-manager-career') : __('Active', 'job-manager-career');
				$expiry = '<span class="thjmf-listing-status status-'.esc_attr( strtolower ($expiry) ).'">'. $expiry.'</span>';
			}
			return $expiry;
		}

		public static function get_job_updation(){
			return get_option( self::OPTION_KEY_THJM_JOB_UPDATION );
		}

		public static function get_applicants_updation(){
			return get_option( self::OPTION_KEY_THJM_APPL_UPDATION );
		}

		public static function database_updated(){
			return get_option( self::OPTION_KEY_THJMF_DB_UPDATED );
		}

		public static function set_database_updated( $value ){
			return update_option( self::OPTION_KEY_THJMF_DB_UPDATED, $value );
		}

		public static function set_job_updation( $value ){
			return update_option( self::OPTION_KEY_THJM_JOB_UPDATION, $value );
		}

		public static function set_applicants_updation( $value ){
			return update_option( self::OPTION_KEY_THJM_APPL_UPDATION, $value );
		}

		public static function get_database_version(){
			return get_option( self::get_db_version_key());
		}

		public static function set_database_version( $value ){
			delete_option( self::get_db_version_key() );
			return add_option( self::get_db_version_key(), $value );
		}

		public static function is_applicant_post($type){
			if( self::THJMF_CPT_APPLICANTS == sanitize_key($type) ){
				return true;
			}
			return false;
		}

		public static function is_jobs_post($type){
			if( self::THJMF_CPT_JOB == sanitize_key($type) ){
				return true;
			}
			return false;
		}

		public static function format_field_name($name){
			return sanitize_text_field( strtolower( str_replace( ' ', '_', trim( $name ) ) ) );
		}

		public static function get_formated_label($name){
			$formatted = '';
			if($name){
				$formatted = ucfirst( str_replace('_', ' ', strip_tags( $name ) ) );
			}
			return $formatted;
		}

		public static function get_job_meta_datas($post_id, $single=false){
			$settings = self::get_post_metas( $post_id, self::THJMF_POST_META_SETTINGS, $single);
			return $settings;
		}

		public static function sanitize_post_fields($value, $type='text'){
			$cleaned = '';
			if($type){
				switch ($type) {
					case 'text':
					case 'select':
						$cleaned = sanitize_text_field($value); 
						break;
					case 'colorpicker':
						$cleaned = sanitize_hex_color($value);
						break;
					case 'number':
						$cleaned = is_numeric( trim( $value ) );
						$cleaned = $cleaned ? absint( trim( $value ) ) : "";
						break;
					case 'switch':
					case 'checkbox':
						$cleaned = filter_var( $value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
						break;
					case 'button':
						$cleaned = esc_url($value);
						break;
					case 'email':
						$cleaned = is_email($value);
						break;
					case 'textarea':
						$cleaned = sanitize_textarea_field($value);
					default:
						$cleaned = sanitize_text_field($value); 
						break;
				}
			}
			return $cleaned;
		}

		public static function get_default_settings($tab=false){
			$default_settings = self::default_settings();
			$settings = get_option(self::OPTION_KEY_THJMF_ADVANCED_SETTINGS);
			if( empty( $settings ) ){
				$settings = $default_settings;
			}
			if( !isset($settings['advanced']['enable_social_share']) && isset($default_settings['advanced']) ){
				$settings['advanced'] = $default_settings['advanced'];
			}
			if($tab){
				$settings = isset($settings[$tab]) ? $settings[$tab] : "";
			}
			
			return empty($settings) ? array() : $settings;
		}

		public static function plugin_db_settings($tab=false){
			$settings = get_option(self::OPTION_KEY_THJMF_ADVANCED_SETTINGS);	
			return empty($settings) ? array() : $settings;
		}

		public static function get_job_feature_keys(){
			$settings = self::get_default_settings('job_detail');
			if( $settings && !empty($settings) && is_array($settings) ){
				$settings = isset($settings['job_feature']['job_def_feature']) ? $settings['job_feature']['job_def_feature'] : "";
			}
			return empty($settings) ? array() : $settings;
		}

		public static function should_enqueue($post){
			if( ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, self::$shortcode) ) || get_post_type() == 'thjm_jobs') {
				return true;
			}
			return false;
		}
		
		public static function get_setting_value($settings, $key){
			if(is_array($settings) && isset($settings[$key])){
				return $settings[$key];
			}
			return '';
		}
		
		public static function get_settings($key){
			$settings = self::get_default_settings();
			if(is_array($settings) && isset($settings[$key])){
				return $settings[$key];
			}
			return '';
		}

		public static function get_taxonamy_term_string($post_id, $id){
			$string = '';
			$terms = get_the_terms($post_id, $id);
		
			if(is_array($terms)){
				$count = count($terms);

				foreach ($terms as $key => $value) {
					$suffix = $count == 1 ? '' : ', '; 
					$string .= $value->name.$suffix;
					$count--;
				}
			}else{
				$string = '-';
			}
			
			return $string;
		}

		public static function is_user_capable(){
			$capable = false;
			$user = wp_get_current_user();
			$allowed_roles = apply_filters('thjmf_override_user_capabilities', array('editor', 'administrator') );
			if( array_intersect($allowed_roles, $user->roles ) ) {
	   			$capable = true;
	   		}
	   		return $capable;
		}
		
		public static function load_user_roles(){
			$user_roles = array();
			
			global $wp_roles;
	    	$roles = $wp_roles->roles;
			foreach($roles as $key => $role){
				$user_roles[] = array("id" => $key, "title" => $role['name']);
			}		
			
			return $user_roles;
		}

		public static function save_default_settings($settings, $new=false){
			$result = false;
			if($new){
				$result = add_option(self::OPTION_KEY_THJMF_ADVANCED_SETTINGS, $settings);
			}else{
				$result = update_option(self::OPTION_KEY_THJMF_ADVANCED_SETTINGS, $settings);
			}
			return $result;
		}

		public static function save_post_meta_datas($post_id, $featured, $filled, $expired){
			$save1 = $save2 = $save3 = false;
			$save1 = self::save_post_metas($post_id, self::THJMF_JPM_FEATURED, $featured);
			$save2 = self::save_post_metas($post_id, self::THJMF_JPM_FILLED, $filled);
			$save3 = self::save_post_metas($post_id, self::THJMF_JPM_EXPIRED, $expired);
			return $save1 & $save2 & $save3;
		}

		public static function save_post_metas( $id, $m_key, $m_val){
			if( !metadata_exists('post', $id, $m_key) ){
				$save = add_post_meta($id, $m_key, $m_val);
			}else{
				$save = update_post_meta( $id, $m_key, $m_val );
			}
			return $save;
		}

		public static function get_post_meta_datas($post_id){
			$settings = [];
			$settings['job_featured'] = self::get_post_metas( $post_id, self::THJMF_JPM_FEATURED, true);
			$settings['job_filled'] = self::get_post_metas( $post_id, self::THJMF_JPM_FILLED, true);
			$settings['job_expiry'] = self::get_post_metas( $post_id, self::THJMF_JPM_EXPIRED, true);
			return $settings;
		}

		public static function get_post_metas($post_id, $key, $single=false){
			$settings = false;
			if( get_post_meta( $post_id, $key) ){
				$settings = get_post_meta( $post_id, $key, $single);
			}
			return $settings;
		}

		public static function get_applicant_post_meta_status($post_id){
			$settings = '';
			if( get_post_meta( $post_id, self::THJMF_APPLICATION_STATUS) ){
				$settings = get_post_meta( $post_id, self::THJMF_APPLICATION_STATUS, true);
			}
			return $settings;
		}

		public static function delete_post_meta_datas($post_id){
			$settings = '';
			if( get_post_meta( $post_id, self::THJMF_POST_META_SETTINGS) ){
				$settings = delete_post_meta( $post_id, self::THJMF_POST_META_SETTINGS);
			}
			return $settings;
		}

		public static function reset_advanced_settings( $key, $all=false){
			$settings = false;
			$all = apply_filters('thjmf_clear_plugin_settings', $all);
			if($all){
				$settings = delete_option(self::OPTION_KEY_THJMF_ADVANCED_SETTINGS);
			}else{
				$settings = self::get_default_settings();
				if( isset( $settings[$key] ) ){
					$new_settings = self::default_settings();
					$settings[$key] = isset( $new_settings[$key] ) ? $new_settings[$key] : ""; 
				}
				$settings = self::save_default_settings($settings);
			}
			return $settings;
		}

		public static function get_comma_seperated_taxonamy_terms($id, $name){
			$tags = '';
			$name = isset( self::$tax[$name] ) ? self::$tax[$name] : "";
			$terms = wp_get_post_terms( $id, $name );
			if(is_array($terms) && !empty($terms) && !is_wp_error($terms)){
				$tags = implode(', ', wp_list_pluck($terms, 'name') );
			}
			return $tags;
		}

		public static function get_all_post_terms($tag){
			$terms = '';
			switch($tag){
				case "location":
					$terms = self::get_specific_taxonamy_terms('thjm_job_locations');
					break;
				case "job_type":
					$terms = self::get_specific_taxonamy_terms('thjm_job_type');
					break;
				case "category":
					$terms = self::get_specific_taxonamy_terms('thjm_job_category');
					break;
				default: 
					$terms = "";
			}
			return $terms;
		}

		public static function get_specific_taxonamy_terms($tax){
			$terms = '';
			$args = array(
			    'taxonomy' => sanitize_key( $tax ),
			    'hide_empty' => false,
			);
			if($tax){
				$terms = get_terms( $args );
			}
			return $terms;
		}

		public static function get_logged_user_email(){
			$logged_email = '';
		   	global $current_user; 

			if( $current_user !== 0 && isset($current_user->user_email) ){
				$logged_email = $current_user->user_email;
			}
			$admin_email = get_option('admin_email');
			return $admin_email;
		}

		public static function get_template_directory(){
		    $upload_dir = wp_upload_dir();
		    $dir = $upload_dir['basedir'].'/thjmf_uploads';
	      	$dir = trailingslashit($dir);
	      	return $dir;
		}

		public static function default_settings(){
			$settings = array(
				'job_detail'	=>	array(
					'job_feature'	=> array(
						'job_def_feature' => array(),
					),
	      			'job_expiration' => true,
	      			'job_hide_expired' => false,
	      			'job_hide_filled' => false,
	      			'job_display_post_date' => true,
				),
				'job_submission'	=>	array(
					'enable_apply_form'	=> true,
					'apply_form_disabled_msg' => 'Mail your resume to '.self::get_logged_user_email(),
				),
				'search_and_filt'		=> array(
					'search_category' => true,
					'search_type' => true,
					'search_location' => true,
				),
				'advanced'	=> array(
					'delete_data_uninstall' => false,
					'enable_social_share' => true,
					'enable_email_share' => true,
					'enable_whatsapp_share' => true,
					'enable_facebook_share' => true,
					'enable_twitter_share' => true,
					'enable_linkedin_share' => true
				),
			);
			return $settings;
		}

		public static function format_settings(){
			$settings = self::get_default_settings();
			$new_settings = [];
			$jb_det = isset( $settings['job_detail'] ) ? $settings['job_detail'] : false;
			$features = $jb_det['job_feature'];
			unset($jb_det['job_feature']);
			$jb_det = array_merge($jb_det, $features);
			$jb_sub = isset( $settings['job_submission'] ) ? $settings['job_submission'] : false;
			$jb_filt = isset( $settings['search_and_filt'] ) ? $settings['search_and_filt'] : false;
			$general = '';
			if( $jb_det && $jb_sub && $jb_filt){
				$general  = array_merge( $settings['job_detail'], $settings['job_submission'], $settings['search_and_filt'], $settings['advanced'] );
			}
			$new_settings = array('general' => $general, 'data_management' => '');
			
			return $new_settings;
		}

		public static function get_job_post_titles(){
			$articles = get_posts(
				array(
				  'numberposts' => -1,
				  'post_status' => 'publish',
				  'post_type' => 'thjm_jobs',
				)
			);
			return wp_list_pluck( $articles, 'post_title', 'ID' );
		}

		public static function is_post_expired($date){
			if( strtotime( date('Y-m-d') ) <= strtotime($date) ){
	    		return false; 
			}
			return true;
		}

		public static function show_job_expiration(){
			$settings = self::get_default_settings( 'job_detail' );
			$expiration = isset( $settings['job_expiration'] ) ? $settings['job_expiration'] : false;
			return $expiration;
		} 

		public static function get_post_meta_requirements_column( $id ){
			$meta = self::get_post_meta_datas( $id );
			$data = array('featured' => '--', 'filled' => '--', 'status' => false);
			if( isset( $meta['job_featured'] ) ){
				$featured = isset( $meta['job_featured']) ? $meta['job_featured'] : 0;
				$featured = filter_var( $featured, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
				$data['featured'] =  $featured ? '<span class="dashicons dashicons-yes"></span>' : '--';
			}
			if( isset( $meta['job_filled'] ) ){
				$filled = isset( $meta['job_filled'] ) ? $meta['job_filled'] : 0;
				$filled = filter_var( $filled, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
				$data['filled'] =  $filled ? '<span class="dashicons dashicons-yes"></span>' : '--';
			}
			if( isset( $meta['job_expiry'] ) ){
				$expiry = isset( $meta['job_expiry'] ) ? $meta['job_expiry'] : false;
				if($expiry){
					$data['status'] =  self::is_post_expired($meta['job_expiry']) ? __('Expired', 'job-manager-career') : __('Active', 'job-manager-career');
				}else{
					$data['status'] = __('Active', 'job-manager-career');
				}
				$data['status'] = '<span class="thjmf-listing-status status-'.esc_attr( strtolower ($data['status']) ).'">'. $data['status'].'</span>';
			}
			return $data;
		}

		public static function get_post_meta_requirements( $id ){
			$meta = self::get_post_meta_datas( $id );
			$data = array('featured' => '--', 'filled' => '--', 'status' => false);
			$featured =  isset( $meta['job_featured'] ) ? $meta['job_featured'] : false;
			$data['featured'] = filter_var( $featured, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
			$filled =  isset( $meta['job_filled'] ) ? $meta['job_filled'] : false;
			$data['filled'] = filter_var( $filled, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
			$expiry = isset( $meta['job_expiry'] ) ? $meta['job_expiry'] : false;
			if($expiry){
				$data['status'] =  self::is_post_expired($meta['job_expiry']) ? __('Active', 'job-manager-career') : __( 'Expired', 'job-manager-career');
			}else{
				$data['status'] = false;
			}
			return $data;
		}

		public static function get_post_meta_expiration($id){
			$expired = false;
			$job_expiry = self::get_post_metas( $id, self::THJMF_JPM_EXPIRED, true);
			$expiry = isset( $job_expiry ) ? $job_expiry : false;
			if($expiry){
				$expired =  self::is_post_expired($expiry);
			}
			return $expired;
		}

		public static function get_admin_url( $tab = false ){
			$url = 'edit.php?post_type=thjm_jobs&page=thjmf_settings';
			if($tab && !empty($tab)){
				$url .= '&tab='. $tab;
			}
			return admin_url($url);
		}

		public static function get_posted_date($id = false){
			if($id){
				$date_format = apply_filters( 'thjmf_change_job_column_date_format', get_option('date_format') );
				$date = get_the_time( $date_format , $id );
			}else{
				$date = get_the_Date();
			}
			return $date;
		}

		public static function convert_date_wp($date, $reverse=false){
			$format = $reverse ? 'd-m-Y' : 'Y-m-d';
			$new_date = date( $format, strtotime( $date ) );
			return $new_date;
		}

		public static function sanitize_uploads( $type, $value){
			$cleaned = '';
			$value = $type != 'tmp_name' ? stripslashes( $value ) : $value;
			if( $type ){
				switch ($type) {
					case 'name':
						$cleaned = sanitize_file_name( $value );
						break;
					case 'type':
						$cleaned = sanitize_mime_type( $value );
						break;
					case 'error':
					case 'size':
						$cleaned = is_numeric( trim( $value ) );
						$cleaned = $cleaned ? absint( trim( $value ) ) : "";
						break;
					
					default:
						$cleaned = $value;
						break;
				}
			}
			return $cleaned;
		}

		public static function applicant_post_type_url(){
		// Url used in html content. So use single qoutes.
			$url = "<a href='".admin_url("edit.php?post_type=".self::THJMF_CPT_APPLICANTS."'")."'>".esc_html__('All Applicants', 'job-manager-career')."</a>";
			return $url;
		}

		public static function dump( $str, $left='' ){
		?>
			<pre style="<?php echo $left ? "margin-left:".$left."px;" : "";?>">
				<?php echo var_dump($str); ?>
			</pre>
		<?php
		}

		public static function get_job_title_args( $id ){
			$filled  = self::get_jpm_filled( get_the_ID() );
			$filled  = filter_var( $filled, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE );
			$expired = self::get_jpm_expired( get_the_ID() );
			$expired = !empty( $expired ) ? self::is_post_expired($expired) : false;
			$enable_apply_form = isset( THJMF_SETTINGS['job_submission']['enable_apply_form'] ) ? THJMF_SETTINGS['job_submission']['enable_apply_form'] : true;
			$social_share = isset( THJMF_SETTINGS['advanced']['enable_social_share'] ) ? THJMF_SETTINGS['advanced']['enable_social_share'] : true;
			$wrapper_class = '';
			if( $social_share ){
				$wrapper_class = ' thjmf-job-share-on';
			}else if( !($filled || $expired || !$enable_apply_form) ){
				$wrapper_class = ' thjmf-apply-form-on';
			}
			return array_merge( 
				array(
					'social_share' => $social_share,
					'email_share' => isset( THJMF_SETTINGS['advanced']['enable_email_share'] ) ? THJMF_SETTINGS['advanced']['enable_email_share'] : true,
					'whatsapp_share' => isset( THJMF_SETTINGS['advanced']['enable_whatsapp_share'] ) ? THJMF_SETTINGS['advanced']['enable_whatsapp_share'] : true,
					'facebook_share' => isset( THJMF_SETTINGS['advanced']['enable_facebook_share'] ) ? THJMF_SETTINGS['advanced']['enable_facebook_share'] : true,
					'twitter_share' => isset( THJMF_SETTINGS['advanced']['enable_twitter_share'] ) ? THJMF_SETTINGS['advanced']['enable_twitter_share'] : true,
					'linkedin_share' => isset( THJMF_SETTINGS['advanced']['enable_linkedin_share'] ) ? THJMF_SETTINGS['advanced']['enable_linkedin_share'] : true,
					'expired_job' => $expired,
					'filled_job' => $filled,
					'wrapper_class' => $wrapper_class
				),
				self::get_post_meta_requirements($id)	
			);
		}

		public static function get_country_codes(){
			$codes = self::country_phone_codes();
			$codes = json_decode( $codes, true );
			return $codes;
		}

		public static function country_phone_codes(){
			$calling_codes = '[{
				"name": "Afghanistan",
				"dial_code": "+93",
				"code": "AF",
				"flag": "🇦🇫"
			}, {
				"name": "Albania",
				"dial_code": "+355",
				"code": "AL",
				"flag": "🇦🇱"
			}, {
				"name": "Algeria",
				"dial_code": "+213",
				"code": "DZ",
				"flag": "🇩🇿"
			}, {
				"name": "AmericanSamoa",
				"dial_code": "+1684",
				"code": "AS",
				"flag": "🇦🇸"
			}, {
				"name": "Andorra",
				"dial_code": "+376",
				"code": "AD",
				"flag": "🇦🇩"
			}, {
				"name": "Angola",
				"dial_code": "+244",
				"code": "AO",
				"flag": "🇦🇴"
			}, {
				"name": "Anguilla",
				"dial_code": "+1264",
				"code": "AI",
				"flag": "🇦🇮"
			}, {
				"name": "Antarctica",
				"dial_code": "+672",
				"code": "AQ",
				"flag": "🇦🇶"
			}, {
				"name": "Antigua and Barbuda",
				"dial_code": "+1268",
				"code": "AG",
				"flag": "🇦🇬"
			}, {
				"name": "Argentina",
				"dial_code": "+54",
				"code": "AR",
				"flag": "🇦🇷"
			}, {
				"name": "Armenia",
				"dial_code": "+374",
				"code": "AM",
				"flag": "🇦🇲"
			}, {
				"name": "Aruba",
				"dial_code": "+297",
				"code": "AW",
				"flag": "🇦🇼"
			}, {
				"name": "Australia",
				"dial_code": "+61",
				"code": "AU",
				"preferred": true,
				"flag": "🇦🇺"
			}, {
				"name": "Austria",
				"dial_code": "+43",
				"code": "AT",
				"flag": "🇦🇹"
			}, {
				"name": "Azerbaijan",
				"dial_code": "+994",
				"code": "AZ",
				"flag": "🇦🇿"
			}, {
				"name": "Bahamas",
				"dial_code": "+1242",
				"code": "BS",
				"flag": "🇧🇸"
			}, {
				"name": "Bahrain",
				"dial_code": "+973",
				"code": "BH",
				"flag": "🇧🇭"
			}, {
				"name": "Bangladesh",
				"dial_code": "+880",
				"code": "BD",
				"flag": "🇧🇩"
			}, {
				"name": "Barbados",
				"dial_code": "+1246",
				"code": "BB",
				"flag": "🇧🇧"
			}, {
				"name": "Belarus",
				"dial_code": "+375",
				"code": "BY",
				"flag": "🇧🇾"
			}, {
				"name": "Belgium",
				"dial_code": "+32",
				"code": "BE",
				"flag": "🇧🇪"
			}, {
				"name": "Belize",
				"dial_code": "+501",
				"code": "BZ",
				"flag": "🇧🇿"
			}, {
				"name": "Benin",
				"dial_code": "+229",
				"code": "BJ",
				"flag": "🇧🇯"
			}, {
				"name": "Bermuda",
				"dial_code": "+1441",
				"code": "BM",
				"flag": "🇧🇲"
			}, {
				"name": "Bhutan",
				"dial_code": "+975",
				"code": "BT",
				"flag": "🇧🇹"
			}, {
				"name": "Bolivia, Plurinational State of",
				"dial_code": "+591",
				"code": "BO",
				"flag": "🇧🇴"
			}, {
				"name": "Bosnia and Herzegovina",
				"dial_code": "+387",
				"code": "BA",
				"flag": "🇧🇦"
			}, {
				"name": "Botswana",
				"dial_code": "+267",
				"code": "BW",
				"flag": "🇧🇼"
			}, {
				"name": "Brazil",
				"dial_code": "+55",
				"code": "BR",
				"flag": "🇧🇷"
			}, {
				"name": "British Indian Ocean Territory",
				"dial_code": "+246",
				"code": "IO",
				"flag": "🇮🇴"
			}, {
				"name": "Brunei Darussalam",
				"dial_code": "+673",
				"code": "BN",
				"flag": "🇧🇳"
			}, {
				"name": "Bulgaria",
				"dial_code": "+359",
				"code": "BG",
				"flag": "🇧🇬"
			}, {
				"name": "Burkina Faso",
				"dial_code": "+226",
				"code": "BF",
				"flag": "🇧🇫"
			}, {
				"name": "Burundi",
				"dial_code": "+257",
				"code": "BI",
				"flag": "🇧🇮"
			}, {
				"name": "Cambodia",
				"dial_code": "+855",
				"code": "KH",
				"flag": "🇰🇭"
			}, {
				"name": "Cameroon",
				"dial_code": "+237",
				"code": "CM",
				"flag": "🇨🇲"
			}, {
				"name": "Canada",
				"dial_code": "+1",
				"code": "CA",
				"flag": "🇨🇦"
			}, {
				"name": "Cape Verde",
				"dial_code": "+238",
				"code": "CV",
				"flag": "🇨🇻"
			}, {
				"name": "Cayman Islands",
				"dial_code": "+345",
				"code": "KY",
				"flag": "🇰🇾"
			}, {
				"name": "Central African Republic",
				"dial_code": "+236",
				"code": "CF",
				"flag": "🇨🇫"
			}, {
				"name": "Chad",
				"dial_code": "+235",
				"code": "TD",
				"flag": "🇹🇩"
			}, {
				"name": "Chile",
				"dial_code": "+56",
				"code": "CL",
				"flag": "🇨🇱"
			}, {
				"name": "China",
				"dial_code": "+86",
				"code": "CN",
				"flag": "🇨🇳"
			}, {
				"name": "Christmas Island",
				"dial_code": "+61",
				"code": "CX",
				"flag": "🇨🇽"
			}, {
				"name": "Cocos (Keeling) Islands",
				"dial_code": "+61",
				"code": "CC",
				"flag": "🇨🇨"
			}, {
				"name": "Colombia",
				"dial_code": "+57",
				"code": "CO",
				"flag": "🇨🇴"
			}, {
				"name": "Comoros",
				"dial_code": "+269",
				"code": "KM",
				"flag": "🇰🇲"
			}, {
				"name": "Congo",
				"dial_code": "+242",
				"code": "CG",
				"flag": "🇨🇬"
			}, {
				"name": "Congo, The Democratic Republic of the",
				"dial_code": "+243",
				"code": "CD",
				"flag": "🇨🇩"
			}, {
				"name": "Cook Islands",
				"dial_code": "+682",
				"code": "CK",
				"flag": "🇨🇰"
			}, {
				"name": "Costa Rica",
				"dial_code": "+506",
				"code": "CR",
				"flag": "🇨🇷"
			}, {
				"name": "Cote d\'Ivoire",
				"dial_code": "+225",
				"code": "CI",
				"flag": "🇨🇮"
			}, {
				"name": "Croatia",
				"dial_code": "+385",
				"code": "HR",
				"flag": "🇭🇷"
			}, {
				"name": "Cuba",
				"dial_code": "+53",
				"code": "CU",
				"flag": "🇨🇺"
			}, {
				"name": "Cyprus",
				"dial_code": "+537",
				"code": "CY",
				"flag": "🇨🇾"
			}, {
				"name": "Czech Republic",
				"dial_code": "+420",
				"code": "CZ",
				"flag": "🇨🇿"
			}, {
				"name": "Denmark",
				"dial_code": "+45",
				"code": "DK",
				"flag": "🇩🇰"
			}, {
				"name": "Djibouti",
				"dial_code": "+253",
				"code": "DJ",
				"flag": "🇩🇯"
			}, {
				"name": "Dominica",
				"dial_code": "+1767",
				"code": "DM",
				"flag": "🇩🇲"
			}, {
				"name": "Dominican Republic",
				"dial_code": "+1849",
				"code": "DO",
				"flag": "🇩🇴"
			}, {
				"name": "Ecuador",
				"dial_code": "+593",
				"code": "EC",
				"flag": "🇪🇨"
			}, {
				"name": "Egypt",
				"dial_code": "+20",
				"code": "EG",
				"flag": "🇪🇬"
			}, {
				"name": "El Salvador",
				"dial_code": "+503",
				"code": "SV",
				"flag": "🇸🇻"
			}, {
				"name": "Equatorial Guinea",
				"dial_code": "+240",
				"code": "GQ",
				"flag": "🇬🇶"
			}, {
				"name": "Eritrea",
				"dial_code": "+291",
				"code": "ER",
				"flag": "🇪🇷"
			}, {
				"name": "Estonia",
				"dial_code": "+372",
				"code": "EE",
				"flag": "🇪🇪"
			}, {
				"name": "Ethiopia",
				"dial_code": "+251",
				"code": "ET",
				"flag": "🇪🇹"
			}, {
				"name": "Falkland Islands (Malvinas)",
				"dial_code": "+500",
				"code": "FK",
				"flag": "🇫🇰"
			}, {
				"name": "Faroe Islands",
				"dial_code": "+298",
				"code": "FO",
				"flag": "🇫🇴"
			}, {
				"name": "Fiji",
				"dial_code": "+679",
				"code": "FJ",
				"flag": "🇫🇯"
			}, {
				"name": "Finland",
				"dial_code": "+358",
				"code": "FI",
				"flag": "🇫🇮"
			}, {
				"name": "France",
				"dial_code": "+33",
				"code": "FR",
				"flag": "🇫🇷"
			}, {
				"name": "French Guiana",
				"dial_code": "+594",
				"code": "GF",
				"flag": "🇬🇫"
			}, {
				"name": "French Polynesia",
				"dial_code": "+689",
				"code": "PF",
				"flag": "🇵🇫"
			}, {
				"name": "Gabon",
				"dial_code": "+241",
				"code": "GA",
				"flag": "🇬🇦"
			}, {
				"name": "Gambia",
				"dial_code": "+220",
				"code": "GM",
				"flag": "🇬🇲"
			}, {
				"name": "Georgia",
				"dial_code": "+995",
				"code": "GE",
				"flag": "🇬🇪"
			}, {
				"name": "Germany",
				"dial_code": "+49",
				"code": "DE",
				"flag": "🇩🇪"
			}, {
				"name": "Ghana",
				"dial_code": "+233",
				"code": "GH",
				"flag": "🇬🇭"
			}, {
				"name": "Gibraltar",
				"dial_code": "+350",
				"code": "GI",
				"flag": "🇬🇮"
			}, {
				"name": "Greece",
				"dial_code": "+30",
				"code": "GR",
				"flag": "🇬🇷"
			}, {
				"name": "Greenland",
				"dial_code": "+299",
				"code": "GL",
				"flag": "🇬🇱"
			}, {
				"name": "Grenada",
				"dial_code": "+1473",
				"code": "GD",
				"flag": "🇬🇩"
			}, {
				"name": "Guadeloupe",
				"dial_code": "+590",
				"code": "GP",
				"flag": "🇬🇵"
			}, {
				"name": "Guam",
				"dial_code": "+1671",
				"code": "GU",
				"flag": "🇬🇺"
			}, {
				"name": "Guatemala",
				"dial_code": "+502",
				"code": "GT",
				"flag": "🇬🇹"
			}, {
				"name": "Guernsey",
				"dial_code": "+44",
				"code": "GG",
				"flag": "🇬🇬"
			}, {
				"name": "Guinea",
				"dial_code": "+224",
				"code": "GN",
				"flag": "🇬🇳"
			}, {
				"name": "Guinea-Bissau",
				"dial_code": "+245",
				"code": "GW",
				"flag": "🇬🇼"
			}, {
				"name": "Guyana",
				"dial_code": "+595",
				"code": "GY",
				"flag": "🇬🇾"
			}, {
				"name": "Haiti",
				"dial_code": "+509",
				"code": "HT",
				"flag": "🇭🇹"
			}, {
				"name": "Holy See (Vatican City State)",
				"dial_code": "+379",
				"code": "VA",
				"flag": "🇻🇦"
			}, {
				"name": "Honduras",
				"dial_code": "+504",
				"code": "HN",
				"flag": "🇭🇳"
			}, {
				"name": "Hong Kong",
				"dial_code": "+852",
				"code": "HK",
				"flag": "🇭🇰"
			}, {
				"name": "Hungary",
				"dial_code": "+36",
				"code": "HU",
				"flag": "🇭🇺"
			}, {
				"name": "Iceland",
				"dial_code": "+354",
				"code": "IS",
				"flag": "🇮🇸"
			}, {
				"name": "India",
				"dial_code": "+91",
				"code": "IN",
				"preferred": true,
				"flag": "🇮🇳"
			}, {
				"name": "Indonesia",
				"dial_code": "+62",
				"code": "ID",
				"flag": "🇮🇩"
			}, {
				"name": "Iran, Islamic Republic of",
				"dial_code": "+98",
				"code": "IR",
				"flag": "🇮🇷"
			}, {
				"name": "Iraq",
				"dial_code": "+964",
				"code": "IQ",
				"flag": "🇮🇶"
			}, {
				"name": "Ireland",
				"dial_code": "+353",
				"code": "IE",
				"flag": "🇮🇪"
			}, {
				"name": "Isle of Man",
				"dial_code": "+44",
				"code": "IM",
				"flag": "🇮🇲"
			}, {
				"name": "Israel",
				"dial_code": "+972",
				"code": "IL",
				"flag": "🇮🇱"
			}, {
				"name": "Italy",
				"dial_code": "+39",
				"code": "IT",
				"flag": "🇮🇹"
			}, {
				"name": "Jamaica",
				"dial_code": "+1876",
				"code": "JM",
				"flag": "🇯🇲"
			}, {
				"name": "Japan",
				"dial_code": "+81",
				"code": "JP",
				"flag": "🇯🇵"
			}, {
				"name": "Jersey",
				"dial_code": "+44",
				"code": "JE",
				"flag": "🇯🇪"
			}, {
				"name": "Jordan",
				"dial_code": "+962",
				"code": "JO",
				"flag": "🇯🇴"
			}, {
				"name": "Kazakhstan",
				"dial_code": "+77",
				"code": "KZ",
				"flag": "🇰🇿"
			}, {
				"name": "Kenya",
				"dial_code": "+254",
				"code": "KE",
				"flag": "🇰🇪"
			}, {
				"name": "Kiribati",
				"dial_code": "+686",
				"code": "KI",
				"flag": "🇰🇮"
			}, {
				"name": "Korea, Democratic People\'s Republic of",
				"dial_code": "+850",
				"code": "KP",
				"flag": "🇰🇵"
			}, {
				"name": "Korea, Republic of",
				"dial_code": "+82",
				"code": "KR",
				"flag": "🇰🇷"
			}, {
				"name": "Kuwait",
				"dial_code": "+965",
				"code": "KW",
				"flag": "🇰🇼"
			}, {
				"name": "Kyrgyzstan",
				"dial_code": "+996",
				"code": "KG",
				"flag": "🇰🇬"
			}, {
				"name": "Lao People\'s Democratic Republic",
				"dial_code": "+856",
				"code": "LA",
				"flag": "🇱🇦"
			}, {
				"name": "Latvia",
				"dial_code": "+371",
				"code": "LV",
				"flag": "🇱🇻"
			}, {
				"name": "Lebanon",
				"dial_code": "+961",
				"code": "LB",
				"flag": "🇱🇧"
			}, {
				"name": "Lesotho",
				"dial_code": "+266",
				"code": "LS",
				"flag": "🇱🇸"
			}, {
				"name": "Liberia",
				"dial_code": "+231",
				"code": "LR",
				"flag": "🇱🇷"
			}, {
				"name": "Libyan Arab Jamahiriya",
				"dial_code": "+218",
				"code": "LY",
				"flag": "🇱🇾"
			}, {
				"name": "Liechtenstein",
				"dial_code": "+423",
				"code": "LI",
				"flag": "🇱🇮"
			}, {
				"name": "Lithuania",
				"dial_code": "+370",
				"code": "LT",
				"flag": "🇱🇹"
			}, {
				"name": "Luxembourg",
				"dial_code": "+352",
				"code": "LU",
				"flag": "🇱🇺"
			}, {
				"name": "Macao",
				"dial_code": "+853",
				"code": "MO",
				"flag": "🇲🇴"
			}, {
				"name": "Macedonia, The Former Yugoslav Republic of",
				"dial_code": "+389",
				"code": "MK",
				"flag": "🇲🇰"
			}, {
				"name": "Madagascar",
				"dial_code": "+261",
				"code": "MG",
				"flag": "🇲🇬"
			}, {
				"name": "Malawi",
				"dial_code": "+265",
				"code": "MW",
				"flag": "🇲🇼"
			}, {
				"name": "Malaysia",
				"dial_code": "+60",
				"code": "MY",
				"flag": "🇲🇾"
			}, {
				"name": "Maldives",
				"dial_code": "+960",
				"code": "MV",
				"flag": "🇲🇻"
			}, {
				"name": "Mali",
				"dial_code": "+223",
				"code": "ML",
				"flag": "🇲🇱"
			}, {
				"name": "Malta",
				"dial_code": "+356",
				"code": "MT",
				"flag": "🇲🇹"
			}, {
				"name": "Marshall Islands",
				"dial_code": "+692",
				"code": "MH",
				"flag": "🇲🇭"
			}, {
				"name": "Martinique",
				"dial_code": "+596",
				"code": "MQ",
				"flag": "🇲🇶"
			}, {
				"name": "Mauritania",
				"dial_code": "+222",
				"code": "MR",
				"flag": "🇲🇷"
			}, {
				"name": "Mauritius",
				"dial_code": "+230",
				"code": "MU",
				"flag": "🇲🇺"
			}, {
				"name": "Mayotte",
				"dial_code": "+262",
				"code": "YT",
				"flag": "🇾🇹"
			}, {
				"name": "Mexico",
				"dial_code": "+52",
				"code": "MX",
				"flag": "🇲🇽"
			}, {
				"name": "Micronesia, Federated States of",
				"dial_code": "+691",
				"code": "FM",
				"flag": "🇫🇲"
			}, {
				"name": "Moldova, Republic of",
				"dial_code": "+373",
				"code": "MD",
				"flag": "🇲🇩"
			}, {
				"name": "Monaco",
				"dial_code": "+377",
				"code": "MC",
				"flag": "🇲🇨"
			}, {
				"name": "Mongolia",
				"dial_code": "+976",
				"code": "MN",
				"flag": "🇲🇳"
			}, {
				"name": "Montenegro",
				"dial_code": "+382",
				"code": "ME",
				"flag": "🇲🇪"
			}, {
				"name": "Montserrat",
				"dial_code": "+1664",
				"code": "MS",
				"flag": "🇲🇸"
			}, {
				"name": "Morocco",
				"dial_code": "+212",
				"code": "MA",
				"flag": "🇲🇦"
			}, {
				"name": "Mozambique",
				"dial_code": "+258",
				"code": "MZ",
				"flag": "🇲🇿"
			}, {
				"name": "Myanmar",
				"dial_code": "+95",
				"code": "MM",
				"flag": "🇲🇲"
			}, {
				"name": "Namibia",
				"dial_code": "+264",
				"code": "NA",
				"flag": "🇳🇦"
			}, {
				"name": "Nauru",
				"dial_code": "+674",
				"code": "NR",
				"flag": "🇳🇷"
			}, {
				"name": "Nepal",
				"dial_code": "+977",
				"code": "NP",
				"flag": "🇳🇵"
			}, {
				"name": "Netherlands",
				"dial_code": "+31",
				"code": "NL",
				"flag": "🇳🇱"
			}, {
				"name": "Netherlands Antilles",
				"dial_code": "+599",
				"code": "AN",
				"flag": "🇦🇳"
			}, {
				"name": "New Caledonia",
				"dial_code": "+687",
				"code": "NC",
				"flag": "🇳🇨"
			}, {
				"name": "New Zealand",
				"dial_code": "+64",
				"code": "NZ",
				"flag": "🇳🇿"
			}, {
				"name": "Nicaragua",
				"dial_code": "+505",
				"code": "NI",
				"flag": "🇳🇮"
			}, {
				"name": "Niger",
				"dial_code": "+227",
				"code": "NE",
				"flag": "🇳🇪"
			}, {
				"name": "Nigeria",
				"dial_code": "+234",
				"code": "NG",
				"flag": "🇳🇬"
			}, {
				"name": "Niue",
				"dial_code": "+683",
				"code": "NU",
				"flag": "🇳🇺"
			}, {
				"name": "Norfolk Island",
				"dial_code": "+672",
				"code": "NF",
				"flag": "🇳🇫"
			}, {
				"name": "Northern Mariana Islands",
				"dial_code": "+1670",
				"code": "MP",
				"flag": "🇲🇵"
			}, {
				"name": "Norway",
				"dial_code": "+47",
				"code": "NO",
				"flag": "🇳🇴"
			}, {
				"name": "Oman",
				"dial_code": "+968",
				"code": "OM",
				"flag": "🇴🇲"
			}, {
				"name": "Pakistan",
				"dial_code": "+92",
				"code": "PK",
				"flag": "🇵🇰"
			}, {
				"name": "Palau",
				"dial_code": "+680",
				"code": "PW",
				"flag": "🇵🇼"
			}, {
				"name": "Palestinian Territory, Occupied",
				"dial_code": "+970",
				"code": "PS",
				"flag": "🇵🇸"
			}, {
				"name": "Panama",
				"dial_code": "+507",
				"code": "PA",
				"flag": "🇵🇦"
			}, {
				"name": "Papua New Guinea",
				"dial_code": "+675",
				"code": "PG",
				"flag": "🇵🇬"
			}, {
				"name": "Paraguay",
				"dial_code": "+595",
				"code": "PY",
				"flag": "🇵🇾"
			}, {
				"name": "Peru",
				"dial_code": "+51",
				"code": "PE",
				"flag": "🇵🇪"
			}, {
				"name": "Philippines",
				"dial_code": "+63",
				"code": "PH",
				"flag": "🇵🇭"
			}, {
				"name": "Pitcairn",
				"dial_code": "+872",
				"code": "PN",
				"flag": "🇵🇳"
			}, {
				"name": "Poland",
				"dial_code": "+48",
				"code": "PL",
				"flag": "🇵🇱"
			}, {
				"name": "Portugal",
				"dial_code": "+351",
				"code": "PT",
				"flag": "🇵🇹"
			}, {
				"name": "Puerto Rico",
				"dial_code": "+1939",
				"code": "PR",
				"flag": "🇵🇷"
			}, {
				"name": "Qatar",
				"dial_code": "+974",
				"code": "QA",
				"flag": "🇶🇦"
			}, {
				"name": "Romania",
				"dial_code": "+40",
				"code": "RO",
				"flag": "🇷🇴"
			}, {
				"name": "Russia",
				"dial_code": "+7",
				"code": "RU",
				"flag": "🇷🇺"
			}, {
				"name": "Rwanda",
				"dial_code": "+250",
				"code": "RW",
				"flag": "🇷🇼"
			}, {
				"name": "Réunion",
				"dial_code": "+262",
				"code": "RE",
				"flag": "🇷🇪"
			}, {
				"name": "Saint Barthélemy",
				"dial_code": "+590",
				"code": "BL",
				"flag": "🇧🇱"
			}, {
				"name": "Saint Helena, Ascension and Tristan Da Cunha",
				"dial_code": "+290",
				"code": "SH",
				"flag": "🇸🇭"
			}, {
				"name": "Saint Kitts and Nevis",
				"dial_code": "+1869",
				"code": "KN",
				"flag": "🇰🇳"
			}, {
				"name": "Saint Lucia",
				"dial_code": "+1758",
				"code": "LC",
				"flag": "🇱🇨"
			}, {
				"name": "Saint Martin",
				"dial_code": "+590",
				"code": "MF",
				"flag": "🇲🇫"
			}, {
				"name": "Saint Pierre and Miquelon",
				"dial_code": "+508",
				"code": "PM",
				"flag": "🇵🇲"
			}, {
				"name": "Saint Vincent and the Grenadines",
				"dial_code": "+1784",
				"code": "VC",
				"flag": "🇻🇨"
			}, {
				"name": "Samoa",
				"dial_code": "+685",
				"code": "WS",
				"flag": "🇼🇸"
			}, {
				"name": "San Marino",
				"dial_code": "+378",
				"code": "SM",
				"flag": "🇸🇲"
			}, {
				"name": "Sao Tome and Principe",
				"dial_code": "+239",
				"code": "ST",
				"flag": "🇸🇹"
			}, {
				"name": "Saudi Arabia",
				"dial_code": "+966",
				"code": "SA",
				"flag": "🇸🇦"
			}, {
				"name": "Senegal",
				"dial_code": "+221",
				"code": "SN",
				"flag": "🇸🇳"
			}, {
				"name": "Serbia",
				"dial_code": "+381",
				"code": "RS",
				"flag": "🇷🇸"
			}, {
				"name": "Seychelles",
				"dial_code": "+248",
				"code": "SC",
				"flag": "🇸🇨"
			}, {
				"name": "Sierra Leone",
				"dial_code": "+232",
				"code": "SL",
				"flag": "🇸🇱"
			}, {
				"name": "Singapore",
				"dial_code": "+65",
				"code": "SG",
				"flag": "🇸🇬"
			}, {
				"name": "Slovakia",
				"dial_code": "+421",
				"code": "SK",
				"flag": "🇸🇰"
			}, {
				"name": "Slovenia",
				"dial_code": "+386",
				"code": "SI",
				"flag": "🇸🇮"
			}, {
				"name": "Solomon Islands",
				"dial_code": "+677",
				"code": "SB",
				"flag": "🇸🇧"
			}, {
				"name": "Somalia",
				"dial_code": "+252",
				"code": "SO",
				"flag": "🇸🇴"
			}, {
				"name": "South Africa",
				"dial_code": "+27",
				"code": "ZA",
				"flag": "🇿🇦"
			}, {
				"name": "South Georgia and the South Sandwich Islands",
				"dial_code": "+500",
				"code": "GS",
				"flag": "🇬🇸"
			}, {
				"name": "Spain",
				"dial_code": "+34",
				"code": "ES",
				"flag": "🇪🇸"
			}, {
				"name": "Sri Lanka",
				"dial_code": "+94",
				"code": "LK",
				"flag": "🇱🇰"
			}, {
				"name": "Sudan",
				"dial_code": "+249",
				"code": "SD",
				"flag": "🇸🇩"
			}, {
				"name": "Suriname",
				"dial_code": "+597",
				"code": "SR",
				"flag": "🇸🇷"
			}, {
				"name": "Svalbard and Jan Mayen",
				"dial_code": "+47",
				"code": "SJ",
				"flag": "🇸🇯"
			}, {
				"name": "Swaziland",
				"dial_code": "+268",
				"code": "SZ",
				"flag": "🇸🇿"
			}, {
				"name": "Sweden",
				"dial_code": "+46",
				"code": "SE",
				"flag": "🇸🇪"
			}, {
				"name": "Switzerland",
				"dial_code": "+41",
				"code": "CH",
				"flag": "🇨🇭"
			}, {
				"name": "Syrian Arab Republic",
				"dial_code": "+963",
				"code": "SY",
				"flag": "🇸🇾"
			}, {
				"name": "Taiwan, Province of China",
				"dial_code": "+886",
				"code": "TW",
				"flag": "🇹🇼"
			}, {
				"name": "Tajikistan",
				"dial_code": "+992",
				"code": "TJ",
				"flag": "🇹🇯"
			}, {
				"name": "Tanzania, United Republic of",
				"dial_code": "+255",
				"code": "TZ",
				"flag": "🇹🇿"
			}, {
				"name": "Thailand",
				"dial_code": "+66",
				"code": "TH",
				"flag": "🇹🇭"
			}, {
				"name": "Timor-Leste",
				"dial_code": "+670",
				"code": "TL",
				"flag": "🇹🇱"
			}, {
				"name": "Togo",
				"dial_code": "+228",
				"code": "TG",
				"flag": "🇹🇬"
			}, {
				"name": "Tokelau",
				"dial_code": "+690",
				"code": "TK",
				"flag": "🇹🇰"
			}, {
				"name": "Tonga",
				"dial_code": "+676",
				"code": "TO",
				"flag": "🇹🇴"
			}, {
				"name": "Trinidad and Tobago",
				"dial_code": "+1868",
				"code": "TT",
				"flag": "🇹🇹"
			}, {
				"name": "Tunisia",
				"dial_code": "+216",
				"code": "TN",
				"flag": "🇹🇳"
			}, {
				"name": "Turkey",
				"dial_code": "+90",
				"code": "TR",
				"flag": "🇹🇷"
			}, {
				"name": "Turkmenistan",
				"dial_code": "+993",
				"code": "TM",
				"flag": "🇹🇲"
			}, {
				"name": "Turks and Caicos Islands",
				"dial_code": "+1649",
				"code": "TC",
				"flag": "🇹🇨"
			}, {
				"name": "Tuvalu",
				"dial_code": "+688",
				"code": "TV",
				"flag": "🇹🇻"
			}, {
				"name": "Uganda",
				"dial_code": "+256",
				"code": "UG",
				"flag": "🇺🇬"
			}, {
				"name": "Ukraine",
				"dial_code": "+380",
				"code": "UA",
				"flag": "🇺🇦"
			}, {
				"name": "United Arab Emirates",
				"dial_code": "+971",
				"code": "AE",
				"preferred": true,
				"flag": "🇦🇪"
			}, {
				"name": "United Kingdom",
				"dial_code": "+44",
				"code": "GB",
				"preferred": true,
				"flag": "🇬🇧"
			}, {
				"name": "United States",
				"dial_code": "+1",
				"code": "US",
				"preferred": true,
				"flag": "🇺🇸"
			}, {
				"name": "Uruguay",
				"dial_code": "+598",
				"code": "UY",
				"flag": "🇺🇾"
			}, {
				"name": "Uzbekistan",
				"dial_code": "+998",
				"code": "UZ",
				"flag": "🇺🇿"
			}, {
				"name": "Vanuatu",
				"dial_code": "+678",
				"code": "VU",
				"flag": "🇻🇺"
			}, {
				"name": "Venezuela, Bolivarian Republic of",
				"dial_code": "+58",
				"code": "VE",
				"flag": "🇻🇪"
			}, {
				"name": "Viet Nam",
				"dial_code": "+84",
				"code": "VN",
				"flag": "🇻🇳"
			}, {
				"name": "Virgin Islands, British",
				"dial_code": "+1284",
				"code": "VG",
				"flag": "🇻🇬"
			}, {
				"name": "Virgin Islands, U.S.",
				"dial_code": "+1340",
				"code": "VI",
				"flag": "🇻🇮"
			}, {
				"name": "Wallis and Futuna",
				"dial_code": "+681",
				"code": "WF",
				"flag": "🇼🇫"
			}, {
				"name": "Yemen",
				"dial_code": "+967",
				"code": "YE",
				"flag": "🇾🇪"
			}, {
				"name": "Zambia",
				"dial_code": "+260",
				"code": "ZM",
				"flag": "🇿🇲"
			}, {
				"name": "Zimbabwe",
				"dial_code": "+263",
				"code": "ZW",
				"flag": "🇿🇼"
			}, {
				"name": "Åland Islands",
				"dial_code": "+358",
				"code": "AX",
				"flag": "🇦🇽"
			}]';
			return apply_filters( 'thjm_application_phone_country_codes', $calling_codes );
		}

		public static function get_required_apply_form_fields(){
			return apply_filters('thjmf_apply_form_required_fields', array('name', 'email', 'resume'));
		}

	}

endif;