@extends('admin::layout')

@section('title')
    @if($content->page_id)
        @lang('admin::pages.title')
    @else
        @lang('admin::contents.title')
    @endif
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
                <div id="content-component" class="content">
                    <form method="POST" action="{{ route('contents.update', compact('content')) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @if($content->page_id)
                            <div class="form-group">
                                <label for="pageID" class="control-label col-sm-3">
                                    @lang('admin::contents.page')
                                </label>
                                <div class="col-sm-9">
                                    <select name="page_id"
                                            id="pageID"
                                            class="form-control selectpicker"
                                            data-style="btn-info"
                                            >
                                        <option value="">@lang('admin::contents.placeholder.page')</option>
                                        @include('admin::pages.tree.option-list', [
                                            'pageCollection' => $pages['root'],
                                            'pageStructure' => $pages,
                                            'selected' => $content->page_id,
                                            'level' => 1,
                                        ])
                                    </select>
                                </div>
                            </div>
                        @endif
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::contents.placeholder.title'),
                            'entity' => $content,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.lead'),
                            'field' => 'lead',
                            'placeholder' => trans('admin::contents.placeholder.lead'),
                            'entity' => $content,
                        ])

                        <div class="form-group">
                            <label class="control-label col-sm-3">
                                @lang('admin::forms.description')
                            </label>
                            <div class="col-sm-9">
                                <textarea name="body" class="wysiwyg-editor">{{ old('body', $content->body) }}</textarea>
                            </div>
                        </div>

                        @include('admin::components.form.select', [
                            'label'      => trans('admin::contents.position'),
                            'field'      => 'position',
                            'data'       => $positions,
                            'parameters' => ['code', 'title'],
                            'selected'   => $content->position,
                            'required'   => true,
                        ])

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

                        @include('admin::components.form.order', [
                            'sortOrder' => $content->sort_order,
                        ])
                        @include('admin::components.form.submit', [
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
        Vue.component('plugin-params', {
            props: ['route'],
            data: function(){
                return {
                    html: `{!! $pluginForm !!}`,
                    plugins: vars.plugins,
                    selected: {
                        plugin_id: ''
                    }
                }
            },
            mounted: function() {
                this.load();
            },
            methods: {
                load: function() {
                    if (vars.plugin_id) {
                        this.selected.plugin_id = vars.plugin_id;
                    }
                },
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
    </script>
@endsection