<?php
/**
 * Plugin Name: Brownfields
 * Plugin URI: http://www.trustsolutions.sk
 * Description: Zanedbané a nevyužívané územia.
 * Version: 1.0
 * Author: Trustsolutions
 * Author URI: http://www.trustsolutions.sk
 */
 

//*********************

add_shortcode( "brownfieldform", "form_function" );
  include "includes/b-form.php";

add_shortcode( "brownfieldlist", "list_function" );
  include "includes/b-list.php";
  
add_action('admin_menu', 'admin_function');
  include "includes/b-admin.php";

?>