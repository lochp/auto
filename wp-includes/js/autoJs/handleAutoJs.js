$( document ).ready(function($) {
    $('#testDiv').combobox({
        data: [{
            "id":1,
            "text":"text1"
        },{
            "id":2,
            "text":"text2"
        },{
            "id":3,
            "text":"text3",
            "selected":true
        },{
            "id":4,
            "text":"text4"
        },{
            "id":5,
            "text":"text5"
        }],
        valueField:'id',
        textField:'text'
    });
});