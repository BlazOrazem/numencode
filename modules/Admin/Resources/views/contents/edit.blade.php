@extends('admin::layout')

@section('title')
    @lang('admin::contents.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::contents.update')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
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
                        @include ('admin::components.form.textarea', [
                            'label' => trans('admin::forms.description'),
                            'field' => 'body',
                            'placeholder' => trans('admin::contents.placeholder.body'),
                            'entity' => $content,
                        ])
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
    </script>
@endsection