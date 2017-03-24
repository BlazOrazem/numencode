@extends('admin::layout')

@section('title')
    Page Structure
@endsection

@section('content')

    @foreach ($menus as $menu)
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
                                    <li>@include ('admin::components.button.new', ['action' => route('home'), 'icon' => 'zmdi-file-plus'])</li>
                                    <li>Add new page</li>
                                </ul>
                                <ul class="pull-right hidden-xs">
                                    <li>Active</li>
                                    <li>New</li>
                                    <li>Edit</li>
                                    <li>Delete</li>
                                </ul>
                            </div>
                            @include ('admin::pages.structure-list', ['collection' => $menu->tree['root'], 'menu' => $menu->tree, 'level' => 1])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js"></script>
    <script>
        (function ($) {
            $.fn.NestableList = function () {
                if (! this.length) return;
                if (typeof $.fn.nestable != 'undefined') {
                    this.nestable({
                        rootClass: 'nestable',
                        listNodeName: 'ul',
                        listClass: 'nestable-list',
                        itemClass: 'nestable-item',
                        dragClass: 'nestable-drag',
                        handleClass: 'nestable-handle-off',
                        collapsedClass: 'nestable-collapsed',
                        placeClass: 'nestable-placeholder',
                        emptyClass: 'nestable-empty'
                    });
                }
            };
            $('.nestable').NestableList();
        }(jQuery));
    </script>
@endsection