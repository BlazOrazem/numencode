Vue.http.headers.common['X-CSRF-TOKEN'] = $('meta[name="_token"]').attr('content');

new Vue({
    el: 'body'
});
