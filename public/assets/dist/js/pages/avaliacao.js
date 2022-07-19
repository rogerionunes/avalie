
$(function () {

    $('td').click(function () {
        $('input[type=radio]', this).prop('checked', true);
    });
    
});
