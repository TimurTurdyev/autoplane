$(function () {
    var mmenu = new Mmenu(
        '#main-menu',
        {
            theme: 'dark',
            navbars: [
                {
                    position: 'bottom',
                    content: ['<a href="' + $('.phone').attr('href') + '" target="_blank">' + $('.phone').text() + '</a>']
                }
            ]
        }, {
            language: "ru"
        }
    );
});
