<?php
   /*
   Plugin Name: Auto Plugin
   Plugin URI: http://firstpage.com
   description: >-
  a plugin to update car price list into database and post
   Version: 1.0
   Author: Mr. loc
   Author URI: http://lochuynh.com
   License: firstpage
   */
?>
<?php
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
require_once( dirname( dirname( __FILE__ ) ) . '/autoPlugin/adminUpdatingPage.php' );
// add_menu_page('Update Auto Db', 'Updating Auto Db', 'update_auto_db', 'myplugin/update-auto-db.php', '', null, 6);
/**
 * Register a custom menu page.
 */
function wpdocs_register_my_custom_menu_page() {
    add_menu_page(
        __( 'Updating Auto Db', 'textdomain' ),
        'Updating Auto Db',
        'manage_options',
        'adminUpdatingPage.php',
        renderUpdatingPage,
        null,
        null
    );
}
add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );

?>