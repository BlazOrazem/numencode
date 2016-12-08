@extends('admin::layout')

@section('title')
    Page Structure
@endsection

@section('content')

    @foreach ($menus as $menu)
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head info-bg clearfix">
                        <h5 class="content-title pull-left">{{ $menu->title }}</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                            <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>

                    <div class="content">

                        <div class="nestable" id="nestable">
                            @include ('admin::pages.structure-list', ['collection' => $menu->tree['root'], 'menu' => $menu->tree])
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{--<div class="row">--}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="content-box">--}}
                {{--<div class="head success-bg clearfix">--}}
                    {{--<h5 class="content-title pull-left">Nestable Lists</h5>--}}
                    {{--<div class="functions-btns pull-right">--}}
                        {{--<a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>--}}
                        {{--<a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>--}}
                        {{--<a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}

                {{--<div class="content">--}}
                    {{--<div class="row">--}}
                        {{--<div class="col-md-4">--}}
                            {{--<h5>Draggable Items</h5>--}}
                            {{--<div class="nestable" id="nestable">--}}
                                {{--<ul class="nestable-list">--}}

                                    {{--<li class="nestable-item" data-id="1">--}}
                                        {{--<div class="nestable-handle">Item 1</div>--}}
                                    {{--</li><li class="nestable-item" data-id="2">--}}
                                        {{--<div class="nestable-handle">Item 2</div>--}}
                                        {{--<ul class="nestable-list">--}}
                                            {{--<li class="nestable-item" data-id="2.1">--}}
                                                {{--<div class="nestable-handle">Item 2.1</div>--}}
                                            {{--</li>--}}
                                            {{--<li class="nestable-item" data-id="2.2">--}}
                                                {{--<div class="nestable-handle">Item 2.2</div>--}}
                                                {{--<ul class="nestable-list">--}}
                                                    {{--<li class="nestable-item" data-id="2.3.1">--}}
                                                        {{--<div class="nestable-handle">Item 2.2.1</div>--}}
                                                    {{--</li>--}}
                                                    {{--<li class="nestable-item" data-id="2.3.2">--}}
                                                        {{--<div class="nestable-handle">Item 2.2.2</div>--}}
                                                    {{--</li>--}}
                                                {{--</ul>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}

                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-4">--}}
                            {{--<h5>Draggable Handles</h5>--}}
                            {{--<div class="nestable" id="nestable-handles">--}}
                                {{--<ul class="nestable-list">--}}

                                    {{--<li class="nestable-item nestable-item-handle" data-id="2">--}}
                                        {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                        {{--<div class="nestable-content">Item 2</div>--}}
                                    {{--</li><li class="nestable-item nestable-item-handle" data-id="1">--}}
                                        {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                        {{--<div class="nestable-content">Item 1</div>--}}
                                    {{--</li>--}}
                                    {{--<li class="nestable-item nestable-item-handle" data-id="3">--}}
                                        {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                        {{--<div class="nestable-content">Item 3</div>--}}
                                        {{--<ul class="nestable-list">--}}
                                            {{--<li class="nestable-item nestable-item-handle" data-id="3.1">--}}
                                                {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                                {{--<div class="nestable-content">Item 3.1</div>--}}
                                            {{--</li>--}}
                                            {{--<li class="nestable-item nestable-item-handle" data-id="3.2">--}}
                                                {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                                {{--<div class="nestable-content">Item 3.2</div>--}}
                                            {{--</li>--}}
                                            {{--<li class="nestable-item nestable-item-handle" data-id="3.3">--}}
                                                {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                                {{--<div class="nestable-content">Item 3.3</div>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="col-md-4">--}}
                            {{--<h5>Draggable Handles (Primary color)</h5>--}}
                            {{--<div class="nestable nestable-handle-primary" id="nestable-handles-primary">--}}
                                {{--<ul class="nestable-list">--}}

                                    {{--<li class="nestable-item nestable-item-handle" data-id="1">--}}
                                        {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                        {{--<div class="nestable-content">Item 1</div>--}}
                                    {{--</li><li class="nestable-item nestable-item-handle" data-id="2">--}}
                                        {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                        {{--<div class="nestable-content">Item 2</div>--}}
                                    {{--</li>--}}
                                    {{--<li class="nestable-item nestable-item-handle" data-id="3">--}}
                                        {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                        {{--<div class="nestable-content">Item 3</div>--}}
                                        {{--<ul class="nestable-list">--}}
                                            {{--<li class="nestable-item nestable-item-handle" data-id="3.1">--}}
                                                {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                                {{--<div class="nestable-content">Item 3.1</div>--}}
                                            {{--</li>--}}
                                            {{--<li class="nestable-item nestable-item-handle" data-id="3.2">--}}
                                                {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                                {{--<div class="nestable-content">Item 3.2</div>--}}
                                            {{--</li>--}}
                                            {{--<li class="nestable-item nestable-item-handle" data-id="3.3">--}}
                                                {{--<div class="nestable-handle"><i class="zmdi zmdi-menu"></i></div>--}}
                                                {{--<div class="nestable-content">Item 3.3</div>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</li>--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

    @section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js"></script>
        <script>
            (function ($) {
                /**
                 * jQuery plugin wrapper
                 */
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

@endsection