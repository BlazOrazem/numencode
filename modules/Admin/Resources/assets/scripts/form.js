var Form = (function () {
    return {
        serialize: function (form) {
            var data = form.serializeArray();
            var result = {};

            $.each(data, function(key, item) {
                result[item.name] = item.value;
            });

            return result;
        },

        errors: function (data) {
            return $.parseJSON(data.responseText);
        },

        getGroupFor: function (form, name) {
            return form.find('[name=' + name + ']').closest('.form-group');
        },

        getAllGroups: function (form) {
            return form.find('.form-group');
        },

        failFor: function (item, errorMsg) {
            $(item).find('label').removeClass('success-color');
            $(item).find('input').removeClass('input-success');
            item.addClass('has-error');
            item.find('.help-block').html(errorMsg.join(' '));
        },

        successFor: function (item) {
            $(item).removeClass('has-error');
            $(item).find('label').addClass('success-color');
            $(item).find('input').addClass('input-success');
            $(item).find('.help-block').html('');
        }
    };
})();