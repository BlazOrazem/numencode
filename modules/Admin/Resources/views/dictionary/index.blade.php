@extends('admin::layout')

@section('title')
    @lang('admin::dictionary.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h5 class="m-t-20">Locales</h5>
            <div class="vertical-tabs">
                <div class="row">
                    <div class="col-sm-3 col-xs-12">
                        <ul class="nav nav-tabs">
                            @foreach($tree as $locale => $groups)
                            <li @if ($loop->first) class="active" @endif>
                                <a href="#dictionary-{{ $locale }}" data-toggle="tab">
                                    {{ $locale }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-9 col-xs-12">
                        <div class="tab-content">
                            @foreach($tree as $locale => $groups)
                            <div class="tab-pane fade @if ($loop->first) in active @endif" id="dictionary-{{ $locale }}">
                                <p>Am increasing at contrasted in favourable he considered astonished. As if made held in an shot. By it enough to valley desire do. Mrs chief great maids these which are ham match she. Abode to tried do thing maids. Doubtful disposed returned rejoiced to dashwood is so up.</p>

                                <p>Throwing consider dwelling bachelor joy her proposal laughter. Raptures returned disposed one entirely her men ham. By to admire vanity county an mutual as roused. Of an thrown am warmly merely result depart supply. Required honoured trifling eat pleasure man relation. Assurance yet bed was improving furniture man. Distrusts delighted she listening mrs extensive admitting far.</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    }).nestable('collapseAll');
                }
            };
//            $('.nestable').NestableList();
        }(jQuery));
    </script>
@endsection