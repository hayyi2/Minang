$(document).on('change', '[data-toggle-checkbox=display]', function(event) {
    var el = $(this);
    if($(el).attr('type') == 'checkbox' ){
        if( el.is(':checked') ) {
            $( el.attr('target-display') ).show();
        } else {
            $( el.attr('target-display') ).hide();
        }
    }
}).change();

$(document).on('click', '[remove-hide]', function(event) {
    var el = $(this);

    $(el.attr('remove-hide')).removeClass('hide');
});

$(document).on('change', '[change-show]', function(event) {
    var el = $(this);

    $(el.attr('change-show')).show();
});

$(document).on('click', '[add-name]', function(event) {
    var el = $(this);
    var target = $(el.attr('add-name'));

    target.attr('name', target.attr('attr-name'));
});

$(document).on('click', '[add-alfa]', function(event) {
    var el = $(this);

    $($('[alfa-master]').html()).appendTo(el.attr('add-alfa'));
    $(el.attr('add-alfa') + ' input').attr('required', '');
});

$(document).on('click', '[remove-alfa]', function(event) {
    var el = $(this);

    el.parents(el.attr('remove-alfa')).remove();
});

$(function() {
    $('.form_date').datetimepicker({
        format: "yyyy-mm-dd hh:00",
        minView : 1,
        showMeridian: true,
        autoclose: true,
        todayBtn: true
    });
    $('.form_date2').datetimepicker({
        format: "yyyy-mm-dd",
        minView : 2,
        showMeridian: true,
        autoclose: true,
        todayBtn: true
    });
});