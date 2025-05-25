<?php
/**
 * Customizer Custom Controls
 */

if ( class_exists( 'WP_Customize_Control' ) ) {

	/**
	 * Toggle Switch Custom Control
	 */
	class Jason_Portfolio_Resume_Toggle_Switch_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toggle_switch';

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" 
														<?php
															$this->link();
															checked( $this->value() );
														?>
					>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}

	/**
	 * Sortable Repeater Custom Control
	 */
	class Jason_Portfolio_Resume_Sortable_Repeater_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'sortable_repeater';

		/**
		 * Button labels
		 */
		public $button_labels = array();

		/**
		 * Constructor
		 */
		public function __construct( $manager, $id, $args = array(), $options = array() ) {
			parent::__construct( $manager, $id, $args );
			// Merge the passed button labels with our default labels
			$this->button_labels = wp_parse_args(
				$this->button_labels,
				array(
					'add' => __( 'Add', 'jason-portfolio-resume' ),
				)
			);
		}

		/**
		 * Render the control in the customizer
		 */
		public function render_content() {
			?>
			<div class="sortable_repeater_control">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize-control-sortable-repeater" <?php $this->link(); ?> />
				<div class="sortable_repeater sortable">
					<div class="repeater">
						<input type="text" value="" class="repeater-input" placeholder="https://" /><span class="dashicons dashicons-sort"></span><a class="customize-control-sortable-repeater-delete" href="#"><span class="dashicons dashicons-no-alt"></span></a>
					</div>
				</div>
				<button class="button customize-control-sortable-repeater-add" type="button"><?php echo esc_html( $this->button_labels['add'] ); ?></button>
			</div>
			<?php
		}
	}

	/**
	 * Multi Input field
	 */
	class Jason_Portfolio_Resume_Multi_Input_Custom_control extends WP_Customize_Control {
		public $type = 'multi_input';

		public function render_content() {
			?>
			<label class="customize_multi_input">
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<p><?php echo wp_kses_post( $this->description ); ?></p>
				<input type="hidden" id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $this->value() ); ?>" class="customize_multi_value_field" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>"/>
				<div class="customize_multi_fields ascendoor-multi-fields">
					<div class="set">
						<input type="text" value="" class="customize_multi_single_field"/>
						<a href="#" class="customize_multi_remove_field dashicons dashicons-no-alt">X</a>
					</div>
				</div>
				<a href="#" class="button button-primary customize_multi_add_field"><?php echo esc_html__( 'Add More', 'jason-portfolio-resume' ); ?></a>
			</label>
			<?php
		}
	}

	/**
	 * Horizontal Line Control
	 */
	class Jason_Portfolio_Resume_Customize_Horizontal_Line extends WP_Customize_Control {
		/**
		 * Control Type
		 */
		public $type = 'hr';

		/**
		 * Render Settings
		 */
		public function render_content() {
			?>
			<div>
				<hr style="border: 1px dotted #72777c;" />
			</div>
			<?php
		}
	}

    /**
     * Repeater Field
     */
    class Jason_Portfolio_Resume_Customize_Field_Repeater extends WP_Customize_Control {
        public $id;
        private $boxtitle = array();
        private $add_field_label = array();
        private $custom_icon_container = '';
        private $allowed_html = array();
        public $custom_repeater_image_control = false;
        public $custom_repeater_icon_control = false;
        public $custom_repeater_color_control = false;
        public $custom_repeater_color2_control = false;
        public $custom_repeater_title_control = false;
        public $custom_repeater_subtitle_control = false;
        public $custom_repeater_text_control = false;
        public $custom_repeater_link_control = false;
        public $custom_repeater_text2_control = false;
        public $custom_repeater_link2_control = false;
        public $custom_repeater_shortcode_control = false;
        public $custom_repeater_repeater_control = false;
        public $custom_repeater_repeater_fields = '';
        public $custom_repeater_radio_control = array();



        /*Class constructor*/
        public function __construct( $manager, $id, $args = array() ) {
            parent::__construct( $manager, $id, $args );
            /*Get options from customizer.php*/
            $this->add_field_label = esc_html__( 'Add new field', 'jason-portfolio-resume' );
            if ( ! empty( $args['add_field_label'] ) ) {
                $this->add_field_label = $args['add_field_label'];
            }

            $this->boxtitle = esc_html__( 'Customizer Repeater', 'jason-portfolio-resume' );
            if ( ! empty ( $args['item_name'] ) ) {
                $this->boxtitle = $args['item_name'];
            } elseif ( ! empty( $this->label ) ) {
                $this->boxtitle = $this->label;
            }

            if ( ! empty( $args['custom_repeater_image_control'] ) ) {
                $this->custom_repeater_image_control = $args['custom_repeater_image_control'];
            }

            if ( ! empty( $args['custom_repeater_icon_control'] ) ) {
                $this->custom_repeater_icon_control = $args['custom_repeater_icon_control'];
            }

            if ( ! empty( $args['custom_repeater_color_control'] ) ) {
                $this->custom_repeater_color_control = $args['custom_repeater_color_control'];
            }

            if ( ! empty( $args['custom_repeater_color2_control'] ) ) {
                $this->custom_repeater_color2_control = $args['custom_repeater_color2_control'];
            }

            if ( ! empty( $args['custom_repeater_title_control'] ) ) {
                $this->custom_repeater_title_control = $args['custom_repeater_title_control'];
            }

            if ( ! empty( $args['custom_repeater_subtitle_control'] ) ) {
                $this->custom_repeater_subtitle_control = $args['custom_repeater_subtitle_control'];
            }

            if ( ! empty( $args['custom_repeater_text_control'] ) ) {
                $this->custom_repeater_text_control = $args['custom_repeater_text_control'];
            }

            if ( ! empty( $args['custom_repeater_link_control'] ) ) {
                $this->custom_repeater_link_control = $args['custom_repeater_link_control'];
            }

            if ( ! empty( $args['custom_repeater_text2_control'] ) ) {
                $this->custom_repeater_text2_control = $args['custom_repeater_text2_control'];
            }

            if ( ! empty( $args['custom_repeater_link2_control'] ) ) {
                $this->custom_repeater_link2_control = $args['custom_repeater_link2_control'];
            }

            if ( ! empty( $args['custom_repeater_shortcode_control'] ) ) {
                $this->custom_repeater_shortcode_control = $args['custom_repeater_shortcode_control'];
            }

            if ( ! empty( $args['custom_repeater_repeater_control'] ) ) {
                $this->custom_repeater_repeater_control = $args['custom_repeater_repeater_control'];
            }

            if ( ! empty( $id ) ) {
                $this->id = $id;
            }

            if ( file_exists( get_template_directory() . '/inc/customizer/icons.php' ) ) {
                $this->custom_icon_container =  'inc/customizer/icons';
            }

            $allowed_array1 = wp_kses_allowed_html( 'post' );
            $allowed_array2 = array(
                'input' => array(
                    'type'        => array(),
                    'class'       => array(),
                    'placeholder' => array()
                )
            );

            $this->allowed_html = array_merge( $allowed_array1, $allowed_array2 );
        }

        /*Enqueue resources for the control*/
        public function enqueue() {
            wp_enqueue_style( 'jason-portfolio-resume-font-awesome', get_template_directory_uri().'/assets/css/font-awesome.css', array(), JASON_PORTFOLIO_RESUME_VERSION );
            wp_enqueue_style( 'jason-portfolio-resume-customizer-repeater-admin-stylesheet', get_template_directory_uri().'/assets/css/admin-style.css', array(), JASON_PORTFOLIO_RESUME_VERSION );
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'jason-portfolio-resume-customizer-customizer-repeater-script', get_template_directory_uri() . '/assets/js/customizer_repeater.js', array('jquery', 'jquery-ui-draggable', 'wp-color-picker' ), JASON_PORTFOLIO_RESUME_VERSION, true  );
            wp_enqueue_script( 'jason-portfolio-resume-customizer-repeater-fontawesome-iconpicker', get_template_directory_uri() . '/assets/js/fontawesome-iconpicker.js', array( 'jquery' ), JASON_PORTFOLIO_RESUME_VERSION, true );
            wp_enqueue_style( 'jason-portfolio-resume-customizer-repeater-fontawesome-iconpicker-script', get_template_directory_uri() . '/assets/css/fontawesome-iconpicker.min.css', array(), JASON_PORTFOLIO_RESUME_VERSION );
        }

        public function render_content() {

            /*Get default options*/
            $this_default = json_decode( $this->setting->default );

            /*Get values (json format)*/
            $values = $this->value();

            /*Decode values*/
            $json = json_decode( $values );

            if ( ! is_array( $json ) ) {
                $json = array( $values );
            } ?>

            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <div class="customizer-repeater-general-control-repeater customizer-repeater-general-control-droppable">
                <?php
                if ( ( count( $json ) == 1 && '' === $json[0] ) || empty( $json ) ) {
                    if ( ! empty( $this_default ) ) {
                        $this->iterate_array( $this_default ); ?>
                        <input type="hidden"
                               id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                               class="customizer-repeater-colector"
                               value="<?php echo esc_textarea( json_encode( $this_default ) ); ?>"/>
                        <?php
                    } else {
                        $this->iterate_array(); ?>
                        <input type="hidden"
                               id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                               class="customizer-repeater-colector"/>
                        <?php
                    }
                } else {
                    $this->iterate_array( $json ); ?>
                    <input type="hidden" id="customizer-repeater-<?php echo esc_attr( $this->id ); ?>-colector" <?php esc_attr( $this->link() ); ?>
                           class="customizer-repeater-colector" value="<?php echo esc_textarea( $this->value() ); ?>"/>
                    <?php
                } ?>
            </div>
            <button type="button" class="button add_field customizer-repeater-new-field">
                <?php echo esc_html( $this->add_field_label ); ?>
            </button>
            <?php
        }

        private function iterate_array($array = array()){
            /*Counter that helps checking if the box is first and should have the delete button disabled*/
            $it = 0;
            if(!empty($array)){
                foreach($array as $icon){ ?>
                    <div class="customizer-repeater-general-control-repeater-container customizer-repeater-draggable">
                        <div class="customizer-repeater-customize-control-title">
                            <?php echo esc_html( $this->boxtitle ) ?>
                        </div>
                        <div class="customizer-repeater-box-content-hidden">
                            <?php
                            $choice = $image_url = $icon_value = $title = $subtitle = $text = $text2  = $link2 = $link = $shortcode = $repeater = $color = $color2 = '';

                            $radio_value = $icon->field_type;
                            if(!empty($this->custom_repeater_radio_control)) {
                                $this->icon_type_radio($radio_value, $this->custom_repeater_radio_control);
                            }

                            if(!empty($icon->id)){
                                $id = $icon->id;
                            }
                            if(!empty($icon->choice)){
                                $choice = $icon->choice;
                            }
                            if(!empty($icon->image_url)){
                                $image_url = $icon->image_url;
                            }
                            if(!empty($icon->icon_value)){
                                $icon_value = $icon->icon_value;
                            }
                            if(!empty($icon->color)){
                                $color = $icon->color;
                            }
                            if(!empty($icon->color2)){
                                $color2 = $icon->color2;
                            }
                            if(!empty($icon->title)){
                                $title = $icon->title;
                            }
                            if(!empty($icon->subtitle)){
                                $subtitle =  $icon->subtitle;
                            }
                            if(!empty($icon->text)){
                                $text = $icon->text;
                            }
                            if(!empty($icon->link)){
                                $link = $icon->link;
                            }
                            if(!empty($icon->text2)){
                                $text2 = $icon->text2;
                            }
                            if(!empty($icon->link2)){
                                $link2 = $icon->link2;
                            }
                            if(!empty($icon->shortcode)){
                                $shortcode = $icon->shortcode;
                            }

                            if(!empty($icon->social_repeater)){
                                $repeater = $icon->social_repeater;
                            }

                            if($this->custom_repeater_image_control == true && $this->custom_repeater_icon_control == true) {
                                $this->icon_type_choice( $choice );
                            }
                            if($this->custom_repeater_image_control == true){
                                $choice = 'customizer_repeater_image';
                                $atts = array('label' => 'Image');
                                $this->image_control($image_url, $choice, $atts);
                            }
                            if($this->custom_repeater_icon_control == true){
                                $this->icon_picker_control($icon_value, $choice);
                            }
                            if($this->custom_repeater_color_control == true){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Background Color','jason-portfolio-resume' ), $this->id, 'custom_repeater_color_control' ),
                                    'class' => 'customizer-repeater-color-control',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'custom_repeater_color_control' ),
                                    'sanitize_callback' => 'sanitize_hex_color',
                                    'choice' => $choice,
                                ), $color);
                            }
                            if($this->custom_repeater_color2_control == true){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Color','jason-portfolio-resume' ), $this->id, 'custom_repeater_color2_control' ),
                                    'class' => 'customizer-repeater-color2-control',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'custom_repeater_color2_control' ),
                                    'sanitize_callback' => 'sanitize_hex_color'
                                ), $color2);
                            }
                            if($this->custom_repeater_title_control==true){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title','jason-portfolio-resume' ), $this->id, 'custom_repeater_title_control' ),
                                    'class' => 'customizer-repeater-title-control',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_title_control' ),
                                ), $title);
                            }
                            if($this->custom_repeater_subtitle_control==true){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Subtitle','jason-portfolio-resume' ), $this->id, 'custom_repeater_subtitle_control' ),
                                    'class' => 'customizer-repeater-subtitle-control',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_subtitle_control' ),
                                ), $subtitle);
                            }
                            if($this->custom_repeater_text_control==true){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Text','jason-portfolio-resume' ), $this->id, 'custom_repeater_text_control' ),
                                    'class' => 'customizer-repeater-text-control',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'custom_repeater_text_control' ),
                                ), $text);
                            }
                            if($this->custom_repeater_link_control){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','jason-portfolio-resume' ), $this->id, 'custom_repeater_link_control' ),
                                    'class' => 'customizer-repeater-link-control',
                                    'sanitize_callback' => 'esc_url_raw',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_link_control' ),
                                ), $link);
                            }
                            if($this->custom_repeater_text2_control==true){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Text','jason-portfolio-resume' ), $this->id, 'custom_repeater_text2_control' ),
                                    'class' => 'customizer-repeater-text2-control',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'custom_repeater_text2_control' ),
                                ), $text2);
                            }
                            if($this->custom_repeater_link2_control){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','jason-portfolio-resume' ), $this->id, 'custom_repeater_link2_control' ),
                                    'class' => 'customizer-repeater-link2-control',
                                    'sanitize_callback' => 'esc_url_raw',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_link2_control' ),
                                ), $link2);
                            }
                            if($this->custom_repeater_shortcode_control==true){
                                $this->input_control(array(
                                    'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Shortcode','jason-portfolio-resume' ), $this->id, 'custom_repeater_shortcode_control' ),
                                    'class' => 'customizer-repeater-shortcode-control',
                                    'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_shortcode_control' ),
                                ), $shortcode);
                            }
                            if($this->custom_repeater_repeater_control==true){
                                $this->repeater_control($repeater);
                            }

                            $value = $icon->field_repeater;
                            if(!empty($this->custom_repeater_repeater_fields)) {
                                $this->repeater_fields($value, $this->custom_repeater_repeater_fields);
                            }
                            ?>

                            <input type="hidden" class="social-repeater-box-id" value="<?php if ( ! empty( $id ) ) {
                                echo esc_attr( $id );
                            } ?>">
                            <button type="button" class="social-repeater-general-control-remove-field" <?php if ( $it == 0 ) {
                                echo 'style="display:none;"';
                            } ?>>
                                <?php echo esc_html__( 'Delete field', 'jason-portfolio-resume' ); ?>
                            </button>

                        </div>
                    </div>

                    <?php
                    $it++;
                }
            } else { ?>
                <div class="customizer-repeater-general-control-repeater-container">
                    <div class="customizer-repeater-customize-control-title">
                        <?php echo esc_html( $this->boxtitle ) ?>
                    </div>
                    <div class="customizer-repeater-box-content-hidden">
                        <?php
                        if(!empty($this->custom_repeater_radio_control)) {
                            $this->icon_type_radio($data = '', $this->custom_repeater_radio_control);
                        }
                        if ( $this->custom_repeater_image_control == true && $this->custom_repeater_icon_control == true ) {
                            $this->icon_type_choice();
                        }
                        if ( $this->custom_repeater_image_control == true ) {
                            $this->image_control();
                        }
                        if ( $this->custom_repeater_icon_control == true ) {
                            $this->icon_picker_control();
                        }
                        if($this->custom_repeater_color_control==true){
                            $this->input_control(array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Color','jason-portfolio-resume' ), $this->id, 'custom_repeater_color_control' ),
                                'class' => 'customizer-repeater-color-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'custom_repeater_color_control' ),
                                'sanitize_callback' => 'sanitize_hex_color'
                            ) );
                        }
                        if($this->custom_repeater_color2_control==true){
                            $this->input_control(array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Color','jason-portfolio-resume' ), $this->id, 'custom_repeater_color2_control' ),
                                'class' => 'customizer-repeater-color2-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', 'color', $this->id, 'custom_repeater_color2_control' ),
                                'sanitize_callback' => 'sanitize_hex_color'
                            ) );
                        }
                        if ( $this->custom_repeater_title_control == true ) {
                            $this->input_control( array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Title','jason-portfolio-resume' ), $this->id, 'custom_repeater_title_control' ),
                                'class' => 'customizer-repeater-title-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_title_control' ),
                            ) );
                        }
                        if ( $this->custom_repeater_subtitle_control == true ) {
                            $this->input_control( array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Subtitle','jason-portfolio-resume' ), $this->id, 'custom_repeater_subtitle_control' ),
                                'class' => 'customizer-repeater-subtitle-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_subtitle_control' ),
                            ) );
                        }
                        if ( $this->custom_repeater_text_control == true ) {
                            $this->input_control( array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Text','jason-portfolio-resume' ), $this->id, 'custom_repeater_text_control' ),
                                'class' => 'customizer-repeater-text-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'custom_repeater_text_control' ),
                            ) );
                        }
                        if ( $this->custom_repeater_link_control == true ) {
                            $this->input_control( array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','jason-portfolio-resume' ), $this->id, 'custom_repeater_link_control' ),
                                'class' => 'customizer-repeater-link-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_link_control' ),
                            ) );
                        }
                        if ( $this->custom_repeater_text2_control == true ) {
                            $this->input_control( array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Text','jason-portfolio-resume' ), $this->id, 'custom_repeater_text2_control' ),
                                'class' => 'customizer-repeater-text2-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', 'textarea', $this->id, 'custom_repeater_text2_control' ),
                            ) );
                        }
                        if ( $this->custom_repeater_link2_control == true ) {
                            $this->input_control( array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Link','jason-portfolio-resume' ), $this->id, 'custom_repeater_link2_control' ),
                                'class' => 'customizer-repeater-link2-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_link2_control' ),
                            ) );
                        }
                        if ( $this->custom_repeater_shortcode_control == true ) {
                            $this->input_control( array(
                                'label' => apply_filters('repeater_input_labels_filter', esc_html__( 'Shortcode','jason-portfolio-resume' ), $this->id, 'custom_repeater_shortcode_control' ),
                                'class' => 'customizer-repeater-shortcode-control',
                                'type'  => apply_filters('customizer_repeater_input_types_filter', '', $this->id, 'custom_repeater_shortcode_control' ),
                            ) );
                        }
                        if($this->custom_repeater_repeater_control==true){
                            $this->repeater_control();
                        }

                        if(!empty($this->custom_repeater_repeater_fields)) {
                            $this->repeater_fields($value = array(), $this->custom_repeater_repeater_fields);
                        }
                        ?>
                        <input type="hidden" class="social-repeater-box-id">
                        <button type="button" class="social-repeater-general-control-remove-field button" style="display:none;">
                            <?php echo esc_html__( 'Delete field', 'jason-portfolio-resume' ); ?>
                        </button>
                    </div>
                </div>
                <?php
            }
        }

        private function input_control( $options, $value='' ){ ?>

            <?php
            if( !empty($options['type']) ){
                switch ($options['type']) {
                    case 'textarea':?>
                        <span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
                        <textarea name="<?php echo esc_attr( isset($options['name']) ? $options['name']:'' ); ?>" class="<?php echo esc_attr( isset($options['class']) ? $options['class']:'' ); ?>" placeholder="<?php echo esc_attr( isset($options['label']) ? $options['label']:'' ); ?>"><?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?></textarea>
                        <?php
                        break;
                    case 'color':
                        $style_to_add = '';
                        ?>
                        <span class="customize-control-title" <?php if( !empty( $style_to_add ) ) { echo 'style="'.esc_attr( $style_to_add ).'"';} ?>><?php echo esc_html( $options['label'] ); ?></span>
                        <div class="color-mienle <?php echo esc_attr($options['class']); ?>" <?php if( !empty( $style_to_add ) ) { echo 'style="'.esc_attr( $style_to_add ).'"';} ?>>
                            <input data-mienl="true" type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" />
                        </div>
                        <?php
                        break;
                }
            } else { ?>
                <span class="customize-control-title"><?php echo esc_html( $options['label'] ); ?></span>
                <input name="<?php echo esc_attr( isset($options['name']) ? $options['name']:'' ); ?>" type="text" value="<?php echo ( !empty($options['sanitize_callback']) ?  call_user_func_array( $options['sanitize_callback'], array( $value ) ) : esc_attr($value) ); ?>" class="<?php echo esc_attr($options['class']); ?>" placeholder="<?php echo esc_attr( !empty($options['placeholder']) ? $options['placeholder']:$options['label'] ); ?>"/>
                <?php
            }
        }

        private function icon_picker_control($value = '', $show = ''){
            ?>
            <div class="social-repeater-general-control-icon" <?php if( $show === 'customizer_repeater_image' || $show === 'customizer_repeater_none' ) { echo 'style="display:none;"'; } ?>>
                <span class="customize-control-title">
                    <?php echo esc_html__('Icon','jason-portfolio-resume'); ?>
                </span>
                <span class="description customize-control-description">
                    <?php printf( __( 'Note: Some icons may not be displayed here. You can see the full list of icons at %s', 'jason-portfolio-resume' ), 'http://fontawesome.io/icons/' ); ?>
                </span>
                <div class="input-group icp-container">
                    <input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value );} ?>" type="text">
                    <span class="input-group-addon">
                        <i class="fa <?php echo esc_attr($value); ?>"></i>
                    </span>
                </div>
                <?php get_template_part( $this->custom_icon_container ); ?>
            </div>
            <?php
        }

        private function image_control($value = '', $show = '', $attrs = array()){ ?>
            <div class="customizer-repeater-image-control" <?php if( $show === 'customizer_repeater_icon' || $show === 'customizer_repeater_none' || empty( $show ) ) { echo 'style="display:none;"'; } ?>>
                <span class="customize-control-title">
                    <?php printf(__('%s', 'jason-portfolio-resume'), $attrs['label']); ?>
                </span>
                <input type="text" name="<?php echo esc_attr($attrs['name']) ?>" class="widefat custom-media-url <?php printf(__('%s', 'jason-portfolio-resume'), $attrs['class']); ?>" value="<?php printf(__('%s', 'jason-portfolio-resume'), esc_attr( $value )); ?>">
                <input type="button" class="button button-secondary customizer-repeater-custom-media-button" value="<?php printf(__('Upload Image', 'jason-portfolio-resume'), $attrs['class']); ?>" />
            </div>
            <?php
        }

        private function icon_type_choice($value='customizer_repeater_icon'){ ?>
            <span class="customize-control-title"><?php esc_html__('Image type','jason-portfolio-resume');?></span>
            <select class="customizer-repeater-image-choice">
                <option value="customizer_repeater_icon" <?php selected($value,'customizer_repeater_icon');?>><?php esc_html__('Icon','jason-portfolio-resume'); ?></option>
                <option value="customizer_repeater_image" <?php selected($value,'customizer_repeater_image');?>><?php esc_html__('Image','jason-portfolio-resume'); ?></option>
                <option value="customizer_repeater_none" <?php selected($value,'customizer_repeater_none');?>><?php esc_html__('None','jason-portfolio-resume'); ?></option>
            </select>
            <?php
        }

        private function icon_type_radio($value, $field){ ?>
            <span class="customize-control-title">
                <?php printf( __( '%s', 'jason-portfolio-resume' ), $field['label']);?>
            </span>
            <div class="radio_type">
                <?php if( !empty($field['choices']) ) { ?>
                    <select class="customizer-repeater-option">
                        <?php  foreach ($field['choices'] as $name => $item) { ?>
                            <option value="<?php echo esc_attr($name); ?>" <?php selected($value,$name);?>><?php echo esc_html( $item ); ?></option>
                        <?php }; ?>
                    </select>
                <?php }; ?>
            </div>
            <?php
        }

        private function repeater_control($value = ''){
            $social_repeater = array();
            $show_del        = 0; ?>
            <span class="customize-control-title"><?php echo esc_html__( 'Social icons', 'jason-portfolio-resume' ); ?></span>
            <?php
            '<span class="description customize-control-description">';
                printf(__('Note: Some icons may not be displayed here. You can see the full list of icons at %s', 'jason-portfolio-resume'), 'http://fontawesome.io/icons/');
            echo '</span>';
            if(!empty($value)) {
                $social_repeater = json_decode( html_entity_decode( $value ), true );
            }
            if ( ( count( $social_repeater ) == 1 && '' === $social_repeater[0] ) || empty( $social_repeater ) ) { ?>
                <div class="customizer-repeater-social-repeater">
                    <div class="customizer-repeater-social-repeater-container">
                        <div class="customizer-repeater-rc input-group icp-container">
                            <input data-placement="bottomRight" class="icp icp-auto" value="<?php if(!empty($value)) { echo esc_attr( $value ); } ?>" type="text">
                            <span class="input-group-addon"></span>
                        </div>
                        <?php get_template_part( $this->custom_icon_container ); ?>
                        <input type="text" class="customizer-repeater-social-repeater-link" placeholder="<?php esc_attr_e( 'Link', 'jason-portfolio-resume' ); ?>">
                        <input type="hidden" class="customizer-repeater-social-repeater-id" value="">
                        <button class="social-repeater-remove-social-item" style="display:none">
                            <?php esc_html__( 'Remove Icon', 'jason-portfolio-resume' ); ?>
                        </button>
                    </div>
                    <input type="hidden" id="social-repeater-socials-repeater-colector" class="social-repeater-socials-repeater-colector" value=""/>
                </div>
                <button class="social-repeater-add-social-item button-secondary"><?php esc_html__( 'Add Icon', 'jason-portfolio-resume' ); ?></button>
                <?php
            } else { ?>
                <div class="customizer-repeater-social-repeater">
                    <?php
                    foreach ( $social_repeater as $social_icon ) {
                        $show_del ++; ?>
                        <div class="customizer-repeater-social-repeater-container">
                            <div class="customizer-repeater-rc input-group icp-container">
                                <input data-placement="bottomRight" class="icp icp-auto" value="<?php if( !empty($social_icon['icon']) ) { echo esc_attr( $social_icon['icon'] ); } ?>" type="text">
                                <span class="input-group-addon"><i class="fa <?php echo esc_attr( $social_icon['icon'] ); ?>"></i></span>
                            </div>
                            <?php get_template_part( $this->custom_icon_container ); ?>
                            <input type="text" class="customizer-repeater-social-repeater-link"
                                   placeholder="<?php esc_attr_e( 'Link', 'jason-portfolio-resume' ); ?>"
                                   value="<?php if ( ! empty( $social_icon['link'] ) ) {
                                       echo esc_url( $social_icon['link'] );
                                   } ?>">
                            <input type="hidden" class="customizer-repeater-social-repeater-id"
                                   value="<?php if ( ! empty( $social_icon['id'] ) ) {
                                       echo esc_attr( $social_icon['id'] );
                                   } ?>">
                            <button class="button-primary social-repeater-remove-social-item" style="<?php if ( $show_del == 1 ) {echo "display:none";} ?>"><?php esc_html__( 'Remove Icon', 'jason-portfolio-resume' ); ?></button>
                        </div>
                        <?php
                    } ?>
                    <input type="hidden" id="social-repeater-socials-repeater-colector"
                           class="social-repeater-socials-repeater-colector"
                           value="<?php echo esc_textarea( html_entity_decode( $value ) ); ?>" />
                </div>
                <button class="social-repeater-add-social-item button-secondary"><?php esc_html__( 'Add Icon', 'jason-portfolio-resume' ); ?></button>
                <?php
            }
        }

        private function repeater_fields($value = '', $data = array()) {
            $field_repeater = array('');
            if(!empty($value)) {
                $field_repeater = json_decode( html_entity_decode( $value ), true );
            }
            if($field_repeater == NULL) {
                $field_repeater = array('');
            }
            ?>
            <span class="customize-control-title"><?php printf(__('%s', 'jason-portfolio-resume'), $data['label'][0]); ?></span>
            <div class="customizer-repeater-field" data-key="<?php printf(__('%s', 'jason-portfolio-resume'), $data['key']); ?>">
                <?php $show_btn_delete = 0; foreach ($field_repeater as $k => $v): $show_btn_delete++; ?>
                <div class="customizer-repeater-field__group">
                    <?php
                        $c = 0;
                        foreach ($data['fields'] as $name => $item) {
                            ?>
                            <div class="customizer-repeater-field__item">
                                <?php
                                    if($item['type'] == 'textarea') {
                                        $this->input_control( array(
                                            'label' => apply_filters('repeater_input_labels_filter', sprintf(__('%s', 'jason-portfolio-resume'), $item['label']), $this->id, 'custom_repeater_link_control' ),
                                            'class' => $item['class'],
                                            'name'  => $name,
                                            'type' => $item['type'],
                                            'placeholder' => !empty($item['placeholder']) ? $item['placeholder']:$item['label'],
                                        ), isset($v[$name]) ? $v[$name]:'');
                                    } elseif ($item['type'] == 'icon') {
                                        ?>
                                        <span class="customize-control-title"><?php echo esc_html( $item['label'] ); ?></span>
                                        <div class="customizer-repeater-rc input-group icp-container">
                                            <input data-placement="bottomRight" name="<?php echo esc_attr($name); ?>" class="<?php echo esc_attr($item['class']); ?> icp icp-auto" value="<?php echo $v[$name] ?>" type="text">
                                            <span class="input-group-addon"><i class="fa <?php echo esc_attr( $v[$name] ); ?>"></i></span>
                                        </div>
                                        <?php
                                        get_template_part($this->custom_icon_container);
                                    } elseif($item['type'] == 'image') {
                                        $choice = 'customizer_repeater_image';
                                        $image_url = isset($v[$name]) ? $v[$name]:'';
                                        $args = array('label' => $item['label'],'name' => $name,'class' => $item['class']);
                                        $this->image_control($image_url, $choice, $args);
                                    } else {
                                        $this->input_control( array(
                                            'label' => apply_filters('repeater_input_labels_filter', sprintf(__('%s', 'jason-portfolio-resume'), $item['label']), $this->id, 'custom_repeater_link_control' ),
                                            'class' => $item['class'],
                                            'name'  => $name,
                                            'placeholder' => !empty($item['placeholder']) ? $item['placeholder']:$item['label'],
                                        ), isset($v[$name]) ? $v[$name]:'');
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <?php
                        $item_delete = esc_attr( 'Remove Item', 'jason-portfolio-resume' );
                        if(!empty($data['label'][2])) {
                            $item_delete = $data['label'][2];
                        }
                    ?>
                    <button class="button-primary" data-button-delete="<?php echo $data['key'] ?>" style="<?php if ( $show_btn_delete == 1 ) {echo "display:none";} ?>"><?php echo $item_delete; ?></button>
                </div>
                <?php endforeach; ?>
                <input type="hidden" name="<?php echo $data['key'] ?>" class="customizer-repeater-field" value="<?php echo !empty($value) ? esc_textarea( html_entity_decode( $value ) ) : ''; ?>" />
                <?php
                $item_add = esc_attr( 'Add Item', 'jason-portfolio-resume' );
                if(!empty($data['label'][1])) {
                    $item_add = $data['label'][1];
                }
                ?>
                <button class="button-add-row button-secondary" data-button="<?php echo $data['key'] ?>"><?php echo $item_add; ?></button>
            </div>
            <?php
        }
    }

    /**
     * Select Multiple
     */
    class Jason_Portfolio_Resume_Customize_Select_Multiple extends WP_Customize_Control {
        /**
         * The type of customize control being rendered.
         *
         * @var    string
         */
        public $type = 'select-multiple';

        /**
         * Custom classes to apply on select.
         *
         * @var string
         */
        public $custom_class = '';

        /**
         * Custom height to apply on select.
         *
         * @var string
         */
        public $custom_height = '50';

        /**
         * Hestia_Select_Multiple constructor.
         *
         * @param WP_Customize_Manager $manager Customize manager object.
         * @param string               $id Control id.
         * @param array                $args Control arguments.
         */
        public function __construct( WP_Customize_Manager $manager, $id, array $args = array() ) {
            parent::__construct( $manager, $id, $args );
            if ( array_key_exists( 'custom_class', $args ) ) {
                $this->custom_class = esc_attr( $args['custom_class'] );
            }
            if ( array_key_exists( 'height', $args ) ) {
                $this->custom_height = esc_attr( $args['height'] );
            }
        }

        /**
         * Add custom parameters to pass to the JS via JSON.
         *
         * @since  1.1.40
         * @access public
         * @return array
         */
        public function json() {
            $json                 = parent::json();
            $json['choices']      = $this->choices;
            $json['link']         = $this->get_link();
            $json['value']        = (array) $this->value();
            $json['id']           = $this->id;
            $json['custom_class'] = $this->custom_class;
            $json['custom_height'] = $this->custom_height;

            return $json;
        }


        /**
         * Underscore JS template to handle the control's output.
         *
         * @since  1.1.40
         * @access public
         * @return void
         */
        public function content_template() {
            ?>
            <#
            if ( ! data.choices ) {
            return;
            } #>

            <label>
                <# if ( data.label ) { #>
                <span class="customize-control-title">{{ data.label }}</span>
                <# } #>

                <# if ( data.description ) { #>
                <span class="description customize-control-description">{{{ data.description }}}</span>
                <# } #>

                <#
                var custom_class = ''
                if ( data.custom_class ) {
                custom_class = 'class='+data.custom_class
                } #>

                <#
                var custom_height = ''
                if ( data.custom_height ) {
                custom_height = 'style=height:'+data.custom_height+'px'
                } #>

                <select multiple="multiple" {{{ data.link }}} {{ custom_class }} {{ custom_height }}>
                    <# _.each( data.choices, function( label, choice ) {
                    var selected = data.value.includes( choice.toString() ) ? 'selected="selected"' : ''
                    #>
                    <option value="{{ choice }}" {{ selected }} >{{ label }}</option>
                    <# } ) #>
                </select>
            </label>
            <?php
        }
    }

}

if ( class_exists( 'WP_Customize_Section' ) ) {
	/**
	 * Upsell section
	 */
	class Jason_Portfolio_Resume_Custom_Section extends WP_Customize_Section {
		/**
		 * The type of control being rendered
		 */
		public $type = 'jason-portfolio-resume-upsell';

		/**
		 * The Upsell button text
		 */
		public $button_text = '';

		/**
		 * The Upsell URL
		 */
		public $url = '';

		/**
		 * The background color for the control
		 */
		public $background_color = '';

		/**
		 * The text color for the control
		 */
		public $text_color = '';

		/**
		 * Render the section, and the controls that have been added to it.
		 */
		protected function render() {
			?>
			<li id="accordion-section-<?php echo esc_attr( $this->id ); ?>" class="jason_portfolio_resume_upsell_section accordion-section control-section control-section-<?php echo esc_attr( $this->id ); ?> cannot-expand">
				<h3 class="accordion-section-title" tabindex="0" style="">
					<?php echo esc_html( $this->title ); ?>
					<a href="<?php echo esc_url( $this->url ); ?>" class="button button-secondary alignright" target="_blank" style=""><?php echo esc_html( $this->button_text ); ?></a>
				</h3>
			</li>
			<?php
		}
	}
}
