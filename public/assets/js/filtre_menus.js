$(document).ready(function() {
    $('#filters').on('click', '.tous', function() {
        $('.menus').show(1000)
        $('.titre_cache2').show(1000)
        $('.container.bio').show(1000)
    });

    $('#filters').on('click', '.classiques', function() {
        $('.menus').filter('.vegetariens, .vegans').hide(1000)
        $('.titre_cache2').hide(1000)
        $('.container.bio').hide(1000)
        $('.menus').filter('.classiques').show(1000)
    });

    $('#filters').on('click', '.vegetariens', function() {
        $('.menus').filter('.classiques, .vegans').hide(1000)
        $('.titre_cache2').hide(1000)
        $('.container.bio').hide(1000)
        $('.menus').filter('.vegetariens').show(1000)
    });
    $('#filters').on('click', '.vegans', function() {
        $('.menus').filter('.vegetariens, .classiques').hide(1000)
        $('.titre_cache2').hide(1000)
        $('.container.bio').hide(1000)
        $('.menus').filter('.vegans').show(1000)
    });
});
