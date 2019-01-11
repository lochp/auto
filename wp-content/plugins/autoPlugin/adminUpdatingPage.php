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

function renderUpdatingPage(){
    ?>
    <div>
        <div>Updating auto database</div>
        <textarea name="textarea" style="width: 100%; height: 500px;" id="autoDataSource"></textarea>
        <button class="button" id="btn" style="background-color:blue;width:40px;">   
    </div>
    <?php
}

?>