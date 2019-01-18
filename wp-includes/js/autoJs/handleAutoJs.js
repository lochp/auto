var createPostLink = function(data){
    return '/auto/'+data.toLowerCase();
}

var handleBangGiaXe = function(){
    var data = {
        'action': 'load_bang_gia_xe'
    };
    jQuery.post(ajaxUrl, data, function(response) {
        var autoList = JSON.parse(response);
        console.log(autoList);
        var content = '';
        autoList.forEach(c => {
            content += '<tr>';
            content += '	<td scope="col"><a href="'+createPostLink(c.postName)+'" target="blank">'+c.carName+'</a></td>';
            content += '	<td scope="col"><a href="'+createPostLink(c.carBrand)+'" target="blank">'+c.carBrand+'</a></td>';
            content += '	<td scope="col">'+c.carType+'</td>';
            content += '	<td scope="col">'+c.carOrigin+'</td>';
            content += '	<td scope="col">'+c.carPrice+'</em></td>';
            content += '	<td scope="col">'+c.carPriceDeviation+'</td>';
            content += '	<td scope="col">'+c.carEngine+'</td>';
            content += '	<td scope="col">'+c.carPower;
            content += '	</td>';
            content += '	<td scope="col">'+c.carMoment;
            content += '	</td>';
            content += '</tr>'; 
        });
        $('#table-content').append(content);
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