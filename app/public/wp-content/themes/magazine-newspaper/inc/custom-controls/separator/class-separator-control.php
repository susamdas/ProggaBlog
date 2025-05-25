<?php
/**
 * Customizer Control: separator
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Magazine_Newspaper_Separator_Control' ) ) {

	/**
	 * Custom control to display separator
	 */
	class Magazine_Newspaper_Separator_Control extends WP_Customize_Control {

		public $type = 'separator';

		protected function content_template() {
			?>
			<label style="cursor: default;">
				<br><hr><br>
			</label>
			<?php
		}

	}

}