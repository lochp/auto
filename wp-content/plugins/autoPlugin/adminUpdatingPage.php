<?php
function auto_install(){
    global $wpdb;

    $table_name = $wpdb->prefix . "car_info_history"; 
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
      value mediumtext,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

auto_install();

function insert_into_car_info_history($data){
    global $wpdb;
    $table_name = $wpdb->prefix . "car_info_history"; 
    $wpdb->insert( 
        $table_name, array(
            'time' => current_time( 'mysql' ), 
            'value' => $data
        ));
}

add_action( 'admin_footer', 'save_new_auto_db_javascript' ); // Write our JS below here

function save_new_auto_db_javascript() { ?>
	<script type="text/javascript" >
	var save_auto_data = function($) {
        var dataSource = jQuery('#autoDataSource').val();
        dataSource = JSON.parse(dataSource.substring((dataSource.indexOf('listCarsByBrand') + 16), (dataSource.indexOf('listPriceChange') - 5)));
        // var carArr = Object.keys(dataSource).map(function(k) { return dataSource[k] });
        var carBrand = ["chevrolet", "ford", "honda", "hyundai", "infiniti", "isuzu", "kia", "lexus", "maserati", "mazda", "mercedes", "mitsubishi", "nissan", "peugeot",
                        "porsche", "renault", "ssangyong", "subaru", "suzuki", "toyota", "vinfast", "volkswagen", "volvo"];
        var output = [];
        carBrand.forEach(b => {
            var carLst = dataSource[b];
            carLst = Object.keys(carLst).map(function(k) {
                delete carLst[k].carId;
                delete carLst[k].shareUrl;
                delete carLst[k].carImage;
                return carLst[k];
            });
            output.push({
                brand: b,
                carList: carLst
            });
        });
        var data = {
            'action': 'save_new_auto_db',
            'dataSource': JSON.stringify(output)
        };
        jQuery.post(ajaxurl, data, function(response) {
            alert(response);
        });
    }
    jQuery('#btn').bind("click", save_auto_data);
	</script> <?php
}

add_action( 'wp_ajax_save_new_auto_db', 'save_new_auto_db' );

function save_new_auto_db() {
    global $wpdb; // this is how you get access to the database
    
    $data =  $_POST['dataSource'];
    
    insert_into_car_info_history($data);
    
    // echo "Updating Info successfully!";
    echo $data;

	wp_die(); // this is required to terminate immediately and return a proper response
}

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