@extends('admin::layout')

@section('title')
    Page Structure
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">Page Structure</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                    </div>
                </div>
                <div class="content">
                    <ul class="nav nav-tabs">
                        @foreach($menus as $menu)
                            <li class="{{ $loop->first ? 'active' : '' }}">
                                <a href="#tab-structure-{{ $menu->id }}" data-toggle="tab">
                                    <i class="zmdi zmdi-menu"></i>{{ $menu->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($menus as $menu)
                            <div class="tab-pane fade {{ $loop->first ? 'in active' : '' }}" id="tab-structure-{{ $menu->id }}">
                                <div class="p-15">
                                    <table class="display datatable non-sortable middle-align datatable-striped table">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Created at</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                        </tr>
                                        <tr>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                        </tr>
                                        <tr>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                        </tr>
                                        <tr>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                            <td>To je tabela.</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

        {{----}}
        {{--<div class="col-lg-12">--}}
            {{--<div class="data-table data-info content-box" data-id="manager-list">--}}
                {{--<div class="head info-bg clearfix">--}}
                    {{--<h5 class="content-title pull-left">Page Structure</h5>--}}
                    {{--<div class="functions-btns pull-right">--}}
                        {{--<a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>--}}
                        {{--<a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}


                {{--<table class="display datatable non-sortable middle-align datatable-striped table">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>Name</th>--}}
                        {{--<th>Email</th>--}}
                        {{--<th>Phone</th>--}}
                        {{--<th>Created at</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                    {{--<tbody>--}}
                        {{--<tr>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                        {{--</tr>--}}
                        {{--<tr>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                            {{--<td>To je tabela.</td>--}}
                        {{--</tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endsection