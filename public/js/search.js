$('input[type=search]').autocomplete({
    'source': function (request, response) {
        if (request === '') return;
        var base = $('base').attr('href');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: base + 'search/',
            dataType: 'json',
            method: 'POST',
            data: {
                q: encodeURIComponent(request)
            },
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
        location.href = base + item.value;
    }
});
