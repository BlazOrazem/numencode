@extends('admin::layout')

@section('title')
    @lang('admin::pages.structure')
@endsection

@section('content')

    @foreach($menus as $menu)
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head base-bg clearfix">
                        <h5 class="content-title pull-left">{{ $menu->title }}</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        </div>
                    </div>

                    <div class="content">

                        <div class="nestable page-structure">
                            <div class="nestable-legend">
                                <ul class="pull-left">
                                    <li>
                                        @include('admin::components.button.new', [
                                            'action' => route('pages.create.menu', ['menu' => $menu]),
                                            'icon' => 'zmdi-file-plus',
                                        ])
                                    </li>
                                    <li class="add-new">
                                        <a href="{{ route('pages.create.menu', ['menu' => $menu]) }}">
                                            Add new page
                                        </a>
                                    </li>
                                </ul>
                                <ul class="pull-right hidden-xs">
                                    <li>Active</li>
                                    <li>New</li>
                                    <li>Edit</li>
                                    <li>Delete</li>
                                </ul>
                            </div>
                            @include('admin::pages.tree.structure-list', [
                                'collection' => $menu->tree['root'],
                                'tree' => $menu->tree,
                                'menu' => $menu,
                                'level' => 1,
                            ])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection