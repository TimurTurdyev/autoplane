$(function () {
    var mmenu = new Mmenu(
        '#main-menu',
        {
            theme: 'dark',
            navbars: [
                {
                    content: ['searchfield'],
                },
                {
                    position: 'bottom',
                    content: ['<a href="' + $('.phone').attr('href') + '" target="_blank">' + $('.phone').text() + '</a>']
                }
            ],
        }, {
            language: "ru",
        }
    );


    // mmenu.bind('search:before', function () {
    //     $.ajax({
    //         url: location.origin + '/search/?q=' + encodeURIComponent($('#main-menu .mm-searchfield__input input').val()),
    //         dataType: 'json',
    //         cache: false,
    //         success: function (json) {
    //             var data = $.map(json, function (item) {
    //                 return '<li><a href="' + item['value'] + '">' + item['name'] + '</a></li>'
    //             });
    //
    //             $('#search-results').html( data );
    //
    //             mmenu.openPanel( $('#search-results')[0] );
    //         }
    //     });
    // });

});
