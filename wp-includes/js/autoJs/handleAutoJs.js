var handleBangGiaXe = function(){
    var data = {
        'action': 'load_bang_gia_xe'
    };
    jQuery.post(ajaxUrl, data, function(response) {
        alert(response);
    });
}

var handleSoSanhXe = function(){
    var data = {
        'action': 'load_so_sanh_xe'
    };
    jQuery.post(ajaxUrl, data, function(response) {
        alert(response);
    });
}

var handleThongTinXe = function(){
    var data = {
        'action': 'load_thong_tin_xe',
        'id': $('#autoId').val()
    };
    jQuery.post(ajaxUrl, data, function(response) {
        alert(response);
    });
}

$( document ).ready(function($) {
    var pageName = $('#page_name');
    if (pageName.length > 0){
        pageName = pageName.val();
        switch(pageName){
            case 'bang_gia_xe': 
                handleBangGiaXe();
                break;
            case 'so_sanh_xe':
                handleSoSanhXe();
                break;
            case 'thong_tin_xe':
                handleThongTinXe();
                break;
        }
    }
});