$(document).ready(function() {
    $('#change_lang').on('change', function () {
        window.location =  $(this).val();
    })
});
