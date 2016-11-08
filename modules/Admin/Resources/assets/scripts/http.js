var http = http || {};

/* request */
http.token = function () {
    return $('meta[name=_token]').attr('content');
};

http.get = function (url, callback) {
    return $.getJSON(url, callback)
        .error(function (data) {
            http.handleAjaxError(data);
        });
};

http.post = function (url, data) {
    return $.ajax({
        url: url,
        dataType: 'json',
        method: 'POST',
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Content-Type", "application/json");
            xhr.setRequestHeader("Accept", "application/json");
            xhr.setRequestHeader('X-CSRF-TOKEN', http.token());
        },
        data: JSON.stringify(data)
    });
};

http.put = function (url, data) {
    data._method = 'PUT';
    return http.post(url, data);
};

http.patch = function (url, data) {
    data._method = 'PATCH';
    return http.post(url, data);
};

http.delete = function (url, data) {
    data._method = 'DELETE';
    return http.post(url, data);
};

/* response */
http.handleAjaxError = function (data) {
    alert('AJAX error - details have been dumped to console.');
    console.log(data);
};
