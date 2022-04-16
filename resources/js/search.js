$('input[type=search]').autocomplete({
    'source': function (request, response) {
        if (request === '') return;
        $.ajax({
            url: location.origin + 'search/?q=' + encodeURIComponent(request),
            dataType: 'json',
            cache: false,
            success: function (json) {
                response($.map(json, function (item) {
                    return {
                        label: item['name'],
                        value: item['value'],
                        data: item['data']
                    }
                }));
            }
        });
    },
    'select': function (item) {
        location.href = location.origin + '/' + item.value;
    }
});
