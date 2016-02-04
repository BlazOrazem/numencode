new Vue({
    el: 'body',

    http: {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        }
    }
});
