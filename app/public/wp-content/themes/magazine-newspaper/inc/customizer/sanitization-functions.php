<?php
/**
 * Sanitization Functions
 *
 * @package magazine-newspaper
 * 
 */

    
function magazine_newspaper_sanitize_category( $input ){
  $output = intval( $input );
  return $output;

}

function magazine_newspaper_sanitize_dropdown_pages( $page_id, $setting ) {
  // Ensure $input is an absolute integer.
  $page_id = absint( $page_id );
  
  // If $page_id is an ID of a published page, return it; otherwise, return the default.
  return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

//checkbox sanitization function
function magazine_newspaper_sanitize_checkbox( $input ){       
    //returns true if checkbox is checked
    return ( ( isset( $input ) && true == $input ) ? true : false );
}

//file input sanitization function
function magazine_newspaper_sanitize_file( $file, $setting ) {
 
    //allowed file types
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'webp'         => 'image/webp',
    );
     
    //check file type from file name
    $file_ext = wp_check_filetype( $file, $mimes );
     
    //if file has a valid mime type return it, otherwise return default
    return ( $file_ext['ext'] ? $file : $setting->default );
}

function magazine_newspaper_sanitize_array( $value ){    
    if ( is_array( $value ) ) {
    foreach ( $value as $key => $subvalue ) {
      $value[ $key ] = esc_attr( $subvalue );
    }
    return $value;
  }
  return esc_attr( $value );    
}

function magazine_newspaper_sanitize_google_fonts( $input, $setting ) {

  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;
  
  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

function magazine_newspaper_sanitize_hex_color( $color ) {
  if ( '' === $color ) {
    return '';
  }

  // 3 or 6 hex digits, or the empty string.
  if ( preg_match( '|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) ) {
    return $color;
  }

  return NULL;
}

function magazine_newspaper_sanitize_script( $script_textarea ) {
    $allowed_html = array(
        'script' => array(
            'async' => array(),
            'src' => array()
        )
    );
    return wp_kses( $script_textarea, $allowed_html );
}

function magazine_newspaper_sanitize_choices( $input, $setting ) {
    global $wp_customize;
 
    $control = $wp_customize->get_control( $setting->id );
 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}