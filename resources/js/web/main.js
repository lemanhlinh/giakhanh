$(document).ready(function() {
    var fixmeTop = $('.navbar-finalstyle').offset().top;
    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        if (currentScroll >= fixmeTop) {
            $('.navbar-finalstyle').css({
                background: '#fff'
            });
            $('#app .navbar-finalstyle #main-menu ul li a').css({
                color: '#000'
            });
            $('#app .navbar-finalstyle .form-select-lang').css({
                color: '#625B5B'
            });
            $('#app .navbar-finalstyle .form-select-lang select').css({
                color: '#625B5B'
            });
        } else {
            $('.navbar-finalstyle').css({
                background: 'none'
            });
            $('#app .navbar-finalstyle #main-menu ul li a').css({
                color: '#fff'
            });
            $('#app .navbar-finalstyle .form-select-lang').css({
                color: '#fff'
            });
            $('#app .navbar-finalstyle .form-select-lang select').css({
                color: '#fff'
            });
        }
    });

    new Mmenu(document.querySelector("#menu-mobile"));
});
