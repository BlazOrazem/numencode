@extends('admin::layout')

@section('title')
    @lang('admin::plugins.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::plugins.update') : {{ $plugin->title }}</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div id="plugin-component" class="content">
                    <form method="POST" action="{{ route('plugins.update', [$plugin]) }}" class="form-horizontal form-validate">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.title'),
                            'field' => 'title',
                            'placeholder' => trans('admin::plugins.placeholder.title'),
                            'entity' => $plugin,
                            'required' => true,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.description'),
                            'field' => 'description',
                            'placeholder' => trans('admin::plugins.placeholder.description'),
                            'entity' => $plugin,
                        ])
                        @include('admin::components.form.text', [
                            'label' => trans('admin::forms.action'),
                            'field' => 'action',
                            'placeholder' => trans('admin::plugins.placeholder.action'),
                            'entity' => $plugin,
                            'required' => true,
                        ])

                        <plugin-param v-for="param in params" :param="param" inline-template>
                            <div class="form-group params">
                                <label class="control-label col-sm-3">Param @{{ index+1 }}</label>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="text" :name="'params['+index+'][label]'" :value="label" class="form-control" placeholder="Param label">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" :name="'params['+index+'][name]'" :value="name" class="form-control" placeholder="Param name">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 type-picker">
                                            <br />
                                            <select v-model="type" :name="'params['+index+'][type]'" class="form-control selectpicker type" data-style="btn-info">
                                                <option value="">- select type -</option>
                                                <option value="text">Text</option>
                                                <option value="select">Select</option>
                                                <option value="radio">Radio buttons</option>
                                                <option value="checkbox">Checkboxes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row" v-if="showOptions">
                                        <div class="col-sm-12"><br />
                                            <input type="text" :name="'params['+index+'][options]'" :value="options" class="form-control" placeholder="Select options">
                                            <span class="help-block">Enter options divided with comma or Model@method collection.</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </plugin-param>

                        <div class="form-group add-param-group">
                            <div class="col-sm-9 col-sm-offset-3">
                                <a href="#" class="btn btn-primary btn-link" @click.prevent="addParam">Add parameter</a>
                                <a href="#" class="btn btn-danger btn-link pull-right" v-if="params.length" @click.prevent="removeParam">Remove parameter</a>
                            </div>
                        </div>

                        @include('admin::components.form.order', [
                            'sortOrder' => $plugin->sort_order
                        ])
                        @include('admin::components.form.checkbox', [
                            'label' => 'Is hidden?',
                            'field' => 'is_hidden',
                            'type' => 'warning',
                            'checked' => $plugin->is_hidden,
                        ])
                        @include('admin::components.form.save')
                    </form>
                </div>
            </div>
            <div class="content-box">
                <div class="content text-center">
                    <a class="btn btn-default btn-link btn-md btn-full" href="{{ route('plugins.index') }}">
                        <i class="zmdi zmdi-caret-left-circle left"></i>
                        @lang('admin::plugins.index')
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        Vue.component('plugin-param', {
            props: ['param'],
            data: function() {
                return {
                    index: this.param.index,
                    label: this.param.label,
                    name: this.param.name,
                    type: this.param.type,
                    options: typeof this.param.options !== 'undefined' ? this.param.options : ''
                };
            },
            computed: {
                showOptions: function() {
                    return $.inArray(this.type, ["select", "radio", "checkbox"]) != -1;
                }
            }
        });

        new Vue({
            el: '#plugin-component',
            data: {
                params: vars.plugin_params,
                index: vars.plugin_params.length
            },
            methods: {
                addParam: function() {
                    this.params.push({ index: this.index++, type: '' });
                },
                removeParam: function() {
                    this.index--;
                    this.params.splice(this.index, 1);
                }
            }
        });
    </script>
@endsection