<?php
function auto_install(){
    global $wpdb;

    $table_name = $wpdb->prefix . "all_specifications"; 
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      updatedTime datetime DEFAULT '0000-00-00' NOT NULL,
      carBrand text,
      carCompetitors text,
      carEngine text,
      carFuelTankCapacity text,
      carGear text,
      carGroundClearance text,
      carId mediumint(9),
      carMoment text,
      carName text,
      carOrigin text,
      carPower text,
      carPrice text,
      carPriceDeviation text,
      carSize text,
      carTurningCircle text,
      carType text,
      postId mediumint(9),
      postName text,
      PRIMARY KEY  (id)
    ) $charset_collate;";
    
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

function init_auto_category(){
    require_once( ABSPATH . 'wp-admin/includes/taxonomy.php' );
    $catArr = array("chevrolet", "ford", "honda", "hyundai", "infiniti", "isuzu", "kia", "lexus", "maserati", "mazda", "mercedes", "mitsubishi", "nissan", "peugeot",
    "porsche", "renault", "ssangyong", "subaru", "suzuki", "toyota", "vinfast", "volkswagen", "volvo");
    foreach($catArr as $c){
        $obj = get_category_by_slug($c);
        if ($obj == null || $obj == false){
            $newCat = wp_create_category( ucfirst($c));
        }
    }
}

function init_auto_brand_page(){
    require_once( dirname( dirname( __FILE__ ) ) . '/autoPlugin/autoDao.php' );
    require_once( ABSPATH . 'wp-includes/post.php' );
    $catArr = array("chevrolet", "ford", "honda", "hyundai", "infiniti", "isuzu", "kia", "lexus", "maserati", "mazda", "mercedes", "mitsubishi", "nissan", "peugeot",
    "porsche", "renault", "ssangyong", "subaru", "suzuki", "toyota", "vinfast", "volkswagen", "volvo");
    $user_id = get_current_user_id();
    foreach($catArr as $c){
        $brandPage = AutoDao::get_instance_by_post_name(strtolower($c));
        if ($brandPage == false){
            $brandName = ucfirst($c);
            $content = "<div>Trang Giới Thiệu Hãng $brandName";
            $brandArr = array(
                'post_author' => $user_id,
                'post_content' => $content,
                'post_title' => ucfirst($c),
                'post_status' => 'publish',
                'post_type' => 'page',
                'post_name' => strtolower($c)
            );
            wp_insert_post($brandArr);
        }
    }
}

// include custom jQuery
function include_handle_auto_js() {
    // wp_enqueue_style( 'jeasyuiJqueryUiCss', '/wp-includes/js/autoJs/jeasyui/styles/jquery-ui.css',false,null,null);
    // wp_enqueue_style( 'jeasyuiJqueryUiCustomCss', '/wp-includes/js/autoJs/jeasyui/styles/jquery-ui-1.8.22.custom.css',false,null,null);
    // wp_enqueue_style( 'jeasyuiCss', '/wp-includes/js/autoJs/jeasyui/themes/default/easyui.css',false,null,null);
    // wp_enqueue_style( 'jeasyuiIconCss', '/wp-includes/js/autoJs/jeasyui/themes/icon.css',false,null,null);
	wp_deregister_script('jquery');
    wp_enqueue_script('jquery', '/wp-includes/js/autoJs/jeasyui/jquery.min.js', array(), null, true);
    wp_enqueue_script('jeasyui', '/wp-includes/js/autoJs/jeasyui/jquery.easyui.min.js', array(), null, true);
    wp_enqueue_script('autoscripts', '/wp-includes/js/autoJs/handleAutoJs.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'include_handle_auto_js');

function insert_init_pages(){
    /**
     * Insert bang-gia-xe
     */
    require_once( dirname( dirname( __FILE__ ) ) . '/autoPlugin/autoDao.php' );
    require_once( ABSPATH . 'wp-includes/post.php' );
    $bangGiaXe = AutoDao::get_instance_by_post_name('bang-gia-xe');
    if ($bangGiaXe == false){
        $user_id = get_current_user_id();
        $content = '
        <div id="bangGiaXe">
            <div>
                <table style="width: 100%;text-align:center;" border="1">
                    <tbody id="table-content">
                        <tr>
                            <th scope="col">Mẫu xe</th>
                            <th scope="col">Hãng</th>
                            <th scope="col">Loại xe</th>
                            <th scope="col">Nguồn gốc</th>
                            <th scope="col">Giá niêm yết <em>(triệu)</em></th>
                            <th scope="col">* Giá đàm phán <em>(triệu)</em></th>
                            <th scope="col">Động cơ</th>
                            <th scope="col">Công suất<br />
                            <em>(mã lực)</em></th>
                            <th scope="col">Mô-men xoắn<br />
                            <em>(Nm)</em></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <input type="hidden" id="page_name" value="bang_gia_xe">
        ';
        $bangGiaXeArr = array(
            'post_author' => $user_id,
            'post_content' => $content,
            'post_title' => 'Bảng giá xe',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_name' => 'bang-gia-xe'
        );
        wp_insert_post($bangGiaXeArr);
    }
    /**
     * Insert so-sanh-xe
     */
    $soSanhXe = AutoDao::get_instance_by_post_name('so-sanh-xe');
    if ($soSanhXe == false){
        $user_id = get_current_user_id();
        $content = "
        <div id='soSanhXe'>
            <table width='200' border='1'>
                <tr>
                <th scope='row'>Mẫu xe</th>
                <td><select id='carName1'><select></td>
                <td><select id='carName2'><select></td>
                </tr>
                <tr>
                <th scope='row'>Giá niêm yết</th>
                <td><label id='carPrice1'><label></td>
                <td><label id='carPrice2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Giá đàm phán</th>
                <td><label id='carPriceDeviation1'><label></td>
                <td><label id='carPriceDeviation2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Dài x rộng x cao (mm)</th>
                <td><label id='carSize1'><label></td>
                <td><label id='carSize2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Dung tích bình xăng (lít)</th>
                <td><label id='carFuelTankCapacity1'><label></td>
                <td><label id='carFuelTankCapacity2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Động cơ</th>
                <td><label id='carEngine1'><label></td>
                <td><label id='carEngine2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Công suất (mã lực)</th>
                <td><label id='carPower1'><label></td>
                <td><label id='carPower2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Mô-men xoắn (Nm)</th>
                <td><label id='carMoment1'><label></td>
                <td><label id='carMoment2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Khoảng sáng gầm (mm)</th>
                <td><label id='carGroundClearance1'><label></td>
                <td><label id='carGroundClearance2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Đường kính vòng quay tối thiểu (m)</th>
                <td><label id='carTurningCircle1'><label></td>
                <td><label id='carTurningCircle2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Nguồn gốc</th>
                <td><label id='carOrigin1'><label></td>
                <td><label id='carOrigin2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Loại xe</th>
                <td><label id='carType1'><label></td>
                <td><label id='carType2'><label></td>
                </tr>
                <tr>
                <th scope='row'>Hộp số</th>
                <td><label id='carGear1'><label></td>
                <td><label id='carGear2'><label></td>
                </tr>
            </table>
        </div>
        <input type='hidden' id='page_name' value='so_sanh_xe'>
        ";
        $soSanhXeArr = array(
            'post_author' => $user_id,
            'post_content' => $content,
            'post_title' => 'So sánh xe',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_name' => 'so-sanh-xe'
        );
        wp_insert_post($soSanhXeArr);
    }
}

function init_data(){
    auto_install();
    init_auto_category();
}

init_data();
add_action('wp_loaded', 'insert_init_pages');
add_action('wp_loaded', 'init_auto_brand_page');

function myplugin_ajaxurl() {
    echo '<script type="text/javascript">
           window.ajaxUrl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action('wp_head', 'myplugin_ajaxurl');

function insert_into_auto_all_specifications($data){
    global $wpdb;
    $table_name = $wpdb->prefix . "all_specifications";
    $wpdb->insert( $table_name, $data);
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
            'dataSource': output
        };
        jQuery.post(ajaxurl, data, function(response) {
            alert(response);
        });
    }
    jQuery('#btn').bind("click", save_auto_data);
	</script> <?php
}

function load_bang_gia_xe(){
    global $wpdb;
    $table_name = $wpdb->prefix . "all_specifications";
    $autoList = $wpdb->get_results( "SELECT * FROM {$table_name} where updatedTime = (select max(updatedTime) from {$table_name} )");
    foreach($autoList as $c){
        unset($c->updatedTime);
        unset($c->carCompetitors);
        unset($c->carId);
    }
    echo json_encode($autoList);
    wp_die();
}

function load_so_sanh_xe(){
    load_bang_gia_xe();
}

function load_thong_tin_xe(){
    global $wpdb;
    $autoId =  $_POST['id'];
    $table_name = $wpdb->prefix . "all_specifications";
    $auto = $wpdb->get_results( $wpdb->prepare("SELECT * FROM {$table_name} where id=%d", $autoId));
    unset($auto->carId);
    unset($auto->carCompetitors);
    unset($auto->updatedTime);
    echo json_encode($auto);
    wp_die();
}

add_action( 'wp_ajax_save_new_auto_db', 'save_new_auto_db' );
add_action( 'wp_ajax_load_bang_gia_xe', 'load_bang_gia_xe' );
add_action( 'wp_ajax_load_so_sanh_xe', 'load_so_sanh_xe' );
add_action( 'wp_ajax_load_thong_tin_xe', 'load_thong_tin_xe' );

function create_auto_posts($cateArr){
    require_once( dirname( dirname( __FILE__ ) ) . '/autoPlugin/autoDao.php' );
    require_once( ABSPATH . 'wp-includes/post.php' );

    global $wpdb;
    $table_name = $wpdb->prefix . "all_specifications";
    $autoList = $wpdb->get_results( "SELECT * FROM {$table_name} where updatedTime = (select max(updatedTime) from {$table_name} )");
    $user_id = get_current_user_id();
    foreach ($autoList as $data){
        $autoPost = AutoDao::get_instance_by_post_title($data->carBrand . ' ' .$data->carName);
        $postId = null;
        $postName = '';
        if ($autoPost == false){
            $content = "
            <h3>Thông số kỹ thuật<h3>
            <div id='divInfo'>
                <table style='width:100%;' border='1'>
                    <tr>
                        <th scope='row'>Mẫu xe</th>
                        <td><label id='carName'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Giá niêm yết(Triệu VNĐ)</th>
                        <td><label id='carPrice'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Giá đàm phán(Triệu VNĐ)</th>
                        <td><label id='carPriceDeviation'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Dài x rộng x cao (mm)</th>
                        <td><label id='carSize'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Dung tích bình xăng (lít)</th>
                        <td><label id='carFuelTankCapacity'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Động cơ</th>
                        <td><label id='carEngine'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Công suất (mã lực)</th>
                        <td><label id='carPower'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Mô-men xoắn (Nm)</th>
                        <td><label id='carMoment'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Khoảng sáng gầm (mm)</th>
                        <td><label id='carGroundClearance'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Đường kính vòng quay tối thiểu (m)</th>
                        <td><label id='carTurningCircle'><label></td>
                    </tr>
                        <tr>
                        <th scope='row'>Nguồn gốc</th>
                        <td><label id='carOrigin'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Loại xe</th>
                        <td><label id='carType'><label></td>
                    </tr>
                    <tr>
                        <th scope='row'>Hộp số</th>
                        <td><label id='carGear'><label></td>
                    </tr>
                </table>
            </div>
            <input type='hidden' id='page_name' value='thong_tin_xe'>
            <input type='hidden' id='autoId' value='{$data->id}'>";
            $autoPost = array(
                'post_author' => $user_id,
                'post_content' => $content,
                'post_title' => $data->carBrand . ' ' .$data->carName,
                'post_status' => 'publish',
                'post_type' => 'post',
                'post_category' => array($cateArr[strtolower($data->carBrand)]->term_id)
            );
            $postId = wp_insert_post($autoPost);
            $postName = get_post($postId)->post_name;
        }else{
            $postId = $autoPost->ID;
            $postName = $autoPost->post_name;
        }
        $wpdb->update($table_name, array('postId' => $postId, 'postName' => $postName), array('id' => $data->id));
    }
}

function save_new_auto_db() {
    global $wpdb; // this is how you get access to the database
    
    $data =  $_POST['dataSource'];
    /**
     * Insert auto posts into database
     */
    $catArr = array("chevrolet", "ford", "honda", "hyundai", "infiniti", "isuzu", "kia", "lexus", "maserati", "mazda", "mercedes", "mitsubishi", "nissan", "peugeot",
    "porsche", "renault", "ssangyong", "subaru", "suzuki", "toyota", "vinfast", "volkswagen", "volvo");
    $timeStamp = current_time( 'mysql' );
    $cates = array();
    foreach($data as $brand){
        foreach($brand[carList] as $car){
            $car[updatedTime] = $timeStamp;
            insert_into_auto_all_specifications($car);
        }
        $cates[$brand[brand]] =  get_category_by_slug($brand[brand]);
    }
     /**
      * Create auto Posts
      */
    create_auto_posts($cates);
    echo "Updating Info successfully!";

	wp_die(); // this is required to terminate immediately and return a proper response
}

function create_auto_post($data){

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