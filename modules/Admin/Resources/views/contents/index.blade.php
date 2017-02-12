@extends('admin::layout')

@section('title')
    @lang('admin::contents.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-info content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::contents.title')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 1, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.title')</th>
                        <th width="60" class="text-right">@lang('admin::tables.order')</th>
                        @if ($admin->can('manage_contents'))
                            <th width="60" class="no-sort text-center">@lang('admin::tables.manage')</th>
                            <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($contents as $content)
                        <tr>
                            <td>{{ $content->title }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $content->sort_order }}
                                </span>
                            </td>
                            @if ($admin->can('manage_contents'))
                                <td class="text-center">
                                    @include ('admin::components.button.edit', [
                                        'action' => route('contents.edit', compact('content')),
                                        'icon' => 'zmdi-collection-text',
                                    ])
                                </td>
                                <td class="text-center">
                                    @include ('admin::components.button.delete', [
                                        'action' => route('contents.destroy', compact('content')),
                                    ])
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if ($admin->can('manage_contents'))
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">@lang('admin::contents.create')</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <div id="content-component" class="content">
                        <form method="POST" action="{{ route('contents.store') }}" class="form-horizontal form-validate">
                            {{ csrf_field() }}
                            @include ('admin::components.form.text', [
                                'label' => trans('admin::forms.title'),
                                'field' => 'title',
                                'placeholder' => trans('admin::contents.placeholder.title'),
                            ])
                            @include ('admin::components.form.text', [
                                'label' => trans('admin::forms.lead'),
                                'field' => 'lead',
                                'placeholder' => trans('admin::contents.placeholder.lead'),
                            ])
                            {{--@include ('admin::components.form.textarea', [--}}
                                {{--'label' => trans('admin::forms.description'),--}}
                                {{--'field' => 'body',--}}
                                {{--'placeholder' => trans('admin::contents.placeholder.body'),--}}
                            {{--])--}}

                            <div class="form-group">
                                <label class="control-label col-sm-3">
                                    Description
                                </label>
                                <div class="col-sm-9">
                                    <textarea name="body" class="form-control" id="my-editor">{{ old('body') }}</textarea>
                                </div>
                            </div>

                            <plugin-params route="{{ route('plugins.api') }}" inline-template>
                                <div>
                                    <div class="form-group">
                                        <label for="pluginId" class="control-label col-sm-3 ">Custom plugin</label>
                                        <div class="col-sm-9">
                                            <select v-on:change="changed" name="plugin_id" v-model="selected.plugin_id" class="form-control selectpicker">
                                                <option value="">---</option>
                                                <option v-for="plugin in plugins" :value="plugin.id">@{{ plugin.title }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div v-html="html"></div>
                                </div>
                            </plugin-params>

                            @include ('admin::components.form.order', [
                                'sortOrder' => $contents->max('sort_order') + 10
                            ])
                            @include ('admin::components.form.submit', [
                                'button' => trans('admin::contents.create')
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')
    <script>
        Vue.component('plugin-params', {
            props: ['route'],
            data: function(){
                return {
                    html: '',
                    plugins: vars.plugins,
                    selected: {
                        plugin_id: ''
                    }
                }
            },
            methods: {
                changed: function() {
                    if (this.selected.plugin_id) {
                        http.postHtml(this.route, {id: this.selected.plugin_id})
                            .success(function(data) {
                                this.html = data;
                            }.bind(this));
                    }
                }
            }
        });

        new Vue({
            el: '#content-component'
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