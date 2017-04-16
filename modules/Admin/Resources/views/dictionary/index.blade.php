@extends('admin::layout')

@section('title')
    @lang('admin::dictionary.title')
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head base-bg clearfix">
                    <h5 class="content-title pull-left">@lang('admin::dictionary.title')</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>

                <div class="content">
                    <div class="m-b-20">
                        <ul class="nav nav-tabs">
                            @foreach($tree as $locale => $groups)
                                <li @if ($loop->first) class="active" @endif>
                                    <a href="#dictionary-{{ $locale }}" data-toggle="tab">
                                        {{ $locale }}
                                    </a>
                                </li>
                            @endforeach
                            <li><a href="#dictionary-add" data-toggle="tab">Add new</a></li>
                        </ul>
                        <div class="tab-content">
                            @foreach($tree as $locale => $groups)
                            <div class="tab-pane fade @if ($loop->first) in active @endif" id="dictionary-{{ $locale }}">
                                <div class="panel-group">
                                    <div class="controls m-b-10">
                                        <button class="btn btn-info open-button" type="button">
                                            Open all
                                        </button>
                                        <button class="btn btn-info close-button" type="button">
                                            Close all
                                        </button>
                                    </div>
                                    @foreach($groups as $title => $group)
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#collapse-{{ $locale }}-{{ $loop->iteration }}">{{ $title }}</a>
                                            </h4>
                                        </div>
                                        <div id="collapse-{{ $locale }}-{{ $loop->iteration }}" class="panel-collapse collapse">
                                            <table class="table middle-align">
                                                @foreach($group as $item)
                                                <tr>
                                                    <td class="f-12" width="20%">{{ $item->key }}</td>
                                                    <td>
                                                        <a href="#" class="editable" data-type="wysihtml5" data-pk="{{ $item->id }}" data-url="/post" data-title="{{ $item->key }}">{{ $item->value }}</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                            <div class="tab-pane fade" id="dictionary-add">
                                add new form
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(".open-button").on("click", function() {
            $(this).closest('.panel-group').find('.collapse').collapse('show');
        });

        $(".close-button").on("click", function() {
            $(this).closest('.panel-group').find('.collapse').collapse('hide');
        });

        $.fn.editable.defaults.mode = 'inline';
        $(document).ready(function() {

            $('.editable').editable({
                showbuttons: 'right',
                onblur: 'ignore',
                wysihtml5: {
                    toolbar: {
                        "font-styles": false, //Font styling, e.g. h1, h2, etc. Default true
                        "emphasis": true, //Italics, bold, etc. Default true
                        "lists": false, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
                        "link": true, //Button to insert a link. Default true
                        "html": true, //Button which allows you to edit the generated HTML. Default false
                        "image": false, //Button to insert an image. Default true,
                        "color": false //Button to change color of font
                    }
                }
            });
        });
    </script>
@endsection