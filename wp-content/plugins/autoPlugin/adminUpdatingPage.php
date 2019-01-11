<?php
add_action( 'admin_footer', 'save_new_auto_db_javascript' ); // Write our JS below here

function save_new_auto_db_javascript() { ?>
	<script type="text/javascript" >
	var save_auto_data = function($) {
        var dataSource = jQuery('#autoDataSource').val();
        var data = {
            'action': 'save_new_auto_db',
            'dataSource': dataSource
        };
        // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
        jQuery.post(ajaxurl, data, function(response) {
            alert('Got this from the server: ' + response);
        });
    }
    jQuery('#btn').bind("click", save_auto_data);
	</script> <?php
}

add_action( 'wp_ajax_save_new_auto_db', 'save_new_auto_db' );

function save_new_auto_db() {
	global $wpdb; // this is how you get access to the database

	$whatever =  $_POST['dataSource'];

    echo $whatever;

	wp_die(); // this is required to terminate immediately and return a proper response
}

function auto_install(){
    global $wpdb;

    $table_name = $wpdb->prefix . "car_info_history"; 
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      value text,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function insert_into_car_info_history($row){
    global $wpdb;
    $table_name = $wpdb->prefix . "car_info_history"; 
    $wpdb->insert( 
        $table_name, $row
        );
    /**
     * $row = array( 
            'time' => current_time( 'mysql' ), 
            'value' => 'json auto value'
        )
     */
}

auto_install();

function renderUpdatingPage(){
    ?>
    <div>
        <h3>Updating auto database</h3>
        <textarea name="textarea" style="width: 100%; height: 500px;" id="autoDataSource"></textarea>
        <button class="button" id="btn" style="background-color:#0000a7;width:80px;color:white;text-align:center;font-weight:bold;">Save</button>   
    </div>
    <?php
}

?>