@extends('admin::layout')

@section('title')
    @lang('admin::plugins.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="data-table data-base content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::plugins.plugins')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <table class="display datatable middle-align datatable-striped table" data-order='[[ 3, "asc" ]]'>
                    <thead>
                    <tr>
                        <th>@lang('admin::tables.title')</th>
                        <th>@lang('admin::tables.description')</th>
                        <th>@lang('admin::tables.action')</th>
                        <th width="60" class="text-right">@lang('admin::tables.order')</th>
                        @if($admin->can('manage_plugins'))
                            <th width="60" class="no-sort text-center">@lang('admin::tables.edit')</th>
                            <th width="60" class="no-sort text-center">@lang('admin::tables.delete')</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($plugins as $plugin)
                        <tr>
                            <td>{{ $plugin->title }}</td>
                            <td>{{ $plugin->description }}</td>
                            <td>{{ $plugin->action }}</td>
                            <td class="text-right">
                                <span class="badge badge-base">
                                    {{ $plugin->sort_order }}
                                </span>
                            </td>
                            @if($admin->can('manage_plugins'))
                                <td class="text-center">
                                    @include('admin::components.button.edit', [
                                        'action' => route('plugins.edit', compact('plugin')),
                                    ])
                                </td>
                                <td class="text-center">
                                    @include('admin::components.button.delete', [
                                        'action' => route('plugins.destroy', compact('plugin'))
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

    @if($admin->can('manage_plugins'))
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">@lang('admin::plugins.create')</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>
                    <div id="plugin-component" class="content">
                        <form method="POST" action="{{ route('plugins.store') }}" class="form-horizontal form-validate">
                            {{ csrf_field() }}
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.title'),
                                'field' => 'title',
                                'placeholder' => trans('admin::plugins.placeholder.title'),
                                'required' => true,
                            ])
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.description'),
                                'field' => 'description',
                                'placeholder' => trans('admin::plugins.placeholder.description'),
                            ])
                            @include('admin::components.form.text', [
                                'label' => trans('admin::forms.action'),
                                'field' => 'action',
                                'placeholder' => trans('admin::plugins.placeholder.action'),
                                'required' => true,
                            ])

                            <plugin-param v-for="param in params" :index="param.index" inline-template>
                                <div class="form-group params">
                                    <label class="control-label col-sm-3">Param @{{ index+1 }}</label>
                                    <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <input type="text" :name="'params['+index+'][label]'" class="form-control" placeholder="Param label">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" :name="'params['+index+'][name]'" class="form-control" placeholder="Param name">
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
                                            <div class="col-sm-12">
                                                <br />
                                                <input type="text" :name="'params['+index+'][options]'" class="form-control" placeholder="Select options">
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
                                'sortOrder' => $plugins->max('sort_order') + 10
                            ])
                            @include('admin::components.form.checkbox', [
                                'label' => 'Is hidden?',
                                'field' => 'is_hidden',
                            ])
                            @include('admin::components.form.submit', [
                                'button' => trans('admin::plugins.create')
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
        Vue.component('plugin-param', {
            props: ['index'],
            data: function() {
                return {
                    type: ''
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
                params: [],
                index: 0
            },
            methods: {
                addParam: function() {
                    this.params.push({ index: this.index++ });
                },
                removeParam: function() {
                    this.index--;
                    this.params.splice(this.index-1, 1);
                }
            }
        });
    </script>
@endsection