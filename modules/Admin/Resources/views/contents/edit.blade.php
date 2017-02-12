@extends('admin::layout')

@section('title')
    @lang('admin::contents.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::contents.update')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <form method="POST" action="{{ route('contents.update', [$content]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::contents.placeholder.title'),
                            'entity' => $content,
                        ])
                        @include ('admin::components.form.text', [
                            'label' => trans('admin::forms.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::contents.placeholder.lead'),
                            'entity' => $content,
                        ])
                        {{--@include ('admin::components.form.textarea', [--}}
                            {{--'label' => trans('admin::forms.description'),--}}
                            {{--'field' => 'body',--}}
                            {{--'placeholder' => trans('admin::contents.placeholder.body'),--}}
                            {{--'entity' => $content,--}}
                        {{--])--}}
                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                Description
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="form-control" id="my-editor">{{ old('body', $content->body) }}</textarea>
                            </div>
                        </div>
                        @include ('admin::components.form.select', [
                            'label' => trans('admin::contents.plugin'),
                            'field' => 'plugin_id',
                            'data' => $plugins,
                            'class' => 'plugin',
                            'placeholder' => trans('admin::contents.placeholder.plugin'),
                            'dataAttribute' => 'data-api="' . route('plugins.api') . '"',
                        ])
                        <div class="plugin-form"></div>
                        @include ('admin::components.form.order', [
                            'sortOrder' => $content->sort_order,
                        ])
                        @include ('admin::components.form.submit', [
                            'button' => trans('admin::contents.update'),
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(function() {
            http.postHtml = function (url, data) {
                return $.ajax({
                    url: url,
                    dataType: 'html',
                    method: 'POST',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-CSRF-TOKEN', http.token());
                    },
                    data: data
                });
            };

            $('select.plugin').on('change', function() {
                http.postHtml($('select.plugin').data('api'), {id: this.value})
                    .success(function(data) {
                        $('.plugin-form').html(data);
                    })
                    .error(function() {
                        console.log('An error occured.');
                    });
            })
        });

        var editor_config = {
            path_absolute : "/admin/",
            selector: "textarea#my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection