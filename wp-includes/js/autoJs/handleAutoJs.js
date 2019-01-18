var createPostLink = function(data){
    return '/auto/'+data.toLowerCase();
}

var handleBangGiaXe = function(){
    var data = {
        'action': 'load_bang_gia_xe'
    };
    jQuery.post(ajaxUrl, data, function(response) {
        var autoList = JSON.parse(response);
        var content = '';
        autoList.forEach(c => {
            content += '<tr>';
            content += '	<td scope="col"><a href="'+createPostLink(c.postName)+'" target="blank">'+c.carBrand + ' ' + c.carName+'</a></td>';
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

var changeCar = function(carNum, autoId){
    if (autoId == null){
        autoId = $('#carName'+carNum).val();
    }
    var auto = null;
    autoList.forEach(c => {
        if (c.id == autoId){
            auto = c;
        }
    });
    for (var att in auto){
        if (att != 'carName'){
            $('#' + att + carNum).html(auto[att]);
        }
    }
}


var handleSoSanhXe = function(){
    var data = {
        'action': 'load_so_sanh_xe'
    };
    jQuery.post(ajaxUrl, data, function(response) {
        window.autoList = JSON.parse(response);
        var content = '';
        autoList.forEach(c => {
            content += '<option value="'+c.id+'">'+c.carBrand + ' ' + c.carName+'</option>';
        });
        $('#carName1').append(content);
        $('#carName2').append(content);
        var f1 = changeCar.bind(this, 1, null);
        var f2 = changeCar.bind(this, 2, null);
        $('#carName1').bind('change', f1);
        $('#carName2').bind('change', f2);
        changeCar(1, autoList[0].id);
        changeCar(2, autoList[0].id);
    });
}

var handleThongTinXe = function(){
    var data = {
        'action': 'load_thong_tin_xe',
        'id': $('#autoId').val()
    };
    jQuery.post(ajaxUrl, data, function(response) {
        var auto = JSON.parse(response);
        auto = auto[0];
        for (var att in auto){
            $('#' + att).html(auto[att]);
        }
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