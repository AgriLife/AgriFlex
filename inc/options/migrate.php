<?php

/**
 * This class migrates the options from AgriFlex 1.x to the new options
 * framework in 2.0.
 *
 * @package AgriFlex
 * @subpackage Options Framework
 * @since AgriFlex 2.0
 * @author J. Aaron Eaton <aaron@channeleaton.com>
 */

class AgriFlex_Migrate {

  /**
   * The option being migrated
   *
   * @var string
   */
  private $option = '';

  /**
   * Array of AgriFlex 1.0 options
   *
   * @var array
   */
  private $old_options = array();

  /**
   * Array to translate old option keys to new keys
   *
   * @var array
   */
  private $translation = array(
    'isResearch' => 'research',
    'isExtension' => 'extension',
    'isCollege'   => 'college',
    'isTvmdl'     => 'tvmdl',
    'isFazd'      => 'fazd',
    'useCustomHeader' => 'minimal-header',
    'custom_header_text' => 'minimal-header-text',
    'useCustomFooter' => 'minimal-footer',
    'extension_type'  => 'ext-type',
    'custom_logo'     => 'custom-agency-logo',
    'header_type'     => 'site-title',
    'titleImg'        => 'custom-site-logo',
    'hours'       => 'hours',
    'county-name' => 'county-name',
    'county-name-human' => 'county-name-human',
    'address-street1' => 'p-street-1',
    'address-street2' => 'p-street-2',
    'address-city'    => 'p-city',
    'address-zip'     => 'p-zip',
    'map-link'        => 'map-link',
    'map-img'         => 'map-image',
    'address-mail-street1'  => 'm-street-1',
    'address-mail-street2'  => 'm-street-2',
    'address-mail-city'     => 'm-city',
    'address-mail-zip'      => 'm-zip',
    'email_public'  => 'email',
    'phone' => 'phone',
    'fax'   => 'fax',
    'feedBurner' => 'feedburner',
    'googleAnalytics' => 'g-analytics',
  );

  /**
   * Array of options that require special translation
   *
   * @var array
   */
  private $checkbox = array(
    'useCustomHeader',
    'useCustomFooter',
  );

  /**
   * Initialize the class by setting the old options
   */
  function __construct() {

    $this->set_old_options();

  } // __construct

  /**
   * Retrives the old AgriFlex 1.0 options
   * 
   * @access private
   */
  private function set_old_options() {
  
    if ( $old = get_option( 'AgrilifeOptions' ) ) {
      $this->old_options = $old;
    }
  
  } // set_old_options

  /**
   * Translates the given option to the old option key
   *
   * @access private
   * @param  string $option  The given option key
   * @return string $old_key The matched old option key
   */
  private function get_old_key( $option ) {
  
    $old_key = array_search( $option, $this->translation );

    return $old_key;
  
  } // get_old_key

  /**
   * Gets the old option value based on the given option key
   *
   * @access public
   * @param  string $option The given option name
   * @return string $value  The corresponding option value
   */
  public function get_default( $option ) {
  
    $old_key = $this->get_old_key( $option );

    if ( $old_key ) {
      $value = $this->old_options[$old_key];
    }

    if ( in_array( $old_key, $this->checkbox ) ) {
      switch ( $value ) {
        case 'on' :
          $value = 1;
          break;
        default :
          $value = 0;
      }
    }

    if ( $old_key == 'extension_type' ) {
      switch ( $value ) {
        case 0 :
          $value = 'typical';
          break;
        case 1 :
          $value = '4h';
          break;
        case 2 :
          $value = 'county';
          break;
        case 3 :
          $value = 'tce';
          break;
        case 4 :
          $value = 'mg';
          break;
        case 5 :
          $value = 'mn';
          break;
        case 6 :
          $value = 'sg';
          break;
      }
    }

    if ( ! empty( $value ) ) {
      return $value;
    } else {
      return '';
    }

  } // get_default

} // class AgriFlex_Migrate
