@extends('admin::layout')

@section('title')
    Page Structure
@endsection

@section('content')

        <div class="row">
            <div class="col-lg-12">
                <div class="content-box">
                    <div class="head info-bg clearfix">
                        <h5 class="content-title pull-left">Tables</h5>
                        <div class="functions-btns pull-right">
                            <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                            <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                            <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                        </div>
                    </div>

                    <div class="content">

                        <h4>Content table</h4>
                        <div class="table-responsive alt-table">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="table-check">
                                        <div class="checkbox checkbox-primary">
                                            <label><input type="checkbox">
                                                <i></i></label>
                                        </div>
                                    </th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th class="table-icon-cell">
                                        <i class="zmdi zmdi-favorite danger-color"></i>
                                    </th>
                                    <th class="table-icon-cell">
                                        <i class="zmdi zmdi-comment primary-color"></i>
                                    </th>
                                    <th>Date Created</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="table-check">
                                        <div class="checkbox checkbox-primary">
                                            <label><input type="checkbox">
                                                <i></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        Last month income
                                    </td>
                                    <td>Revenue for last month in state Ohio for year 2016, with...</td>
                                    <td>
                                        <i class="zmdi zmdi-favorite danger-color"></i>
                                        8
                                    </td>
                                    <td class="table-icon-cell">
                                        <i class="zmdi zmdi-comment primary-color"></i>
                                        47
                                    </td>
                                    <td class="table-date">7 minets ago <i class="zmdi zmdi-time"></i></td>
                                    <td class="text-center">
                                        <img src="img/contacts/5.png" alt="profile" class="img-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="Katerina Dankovich">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-check">
                                        <div class="checkbox checkbox-primary">
                                            <label><input type="checkbox">
                                                <i></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        Expenses in 2016
                                    </td>
                                    <td></td>
                                    <td class="table-icon-cell">
                                        <i class="zmdi zmdi-favorite danger-color"></i>
                                        2
                                    </td>
                                    <td class="table-icon-cell">
                                        <i class="zmdi zmdi-comment primary-color"></i>
                                        15
                                    </td>
                                    <td class="table-date">2 hours ago <i class="zmdi zmdi-time"></i></td>
                                    <td class="text-center">
                                        <img src="img/contacts/2.png" alt="profile" class="img-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="Samantha Fox">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-check">
                                        <div class="checkbox checkbox-primary">
                                            <label><input type="checkbox">
                                                <i></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        Accounting
                                    </td>
                                    <td class="color-blue-grey-lighter">Attention he extremity</td>
                                    <td class="table-icon-cell">
                                        <i class="zmdi zmdi-favorite danger-color"></i>
                                        9
                                    </td>
                                    <td class="table-icon-cell">
                                        <i class="zmdi zmdi-comment primary-color"></i>
                                        20
                                    </td>
                                    <td class="table-date">5 hours ago <i class="zmdi zmdi-time"></i></td>
                                    <td class="text-center">
                                        <img src="img/contacts/3.png" alt="profile" class="img-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="Helen Doe">
                                    </td>
                                </tr>
                                <tr>
                                    <td class="table-check">
                                        <div class="checkbox checkbox-primary">
                                            <label><input type="checkbox">
                                                <i></i></label>
                                        </div>
                                    </td>
                                    <td>
                                        Nike orders
                                    </td>
                                    <td>And produce say the ten moments parties. Simple innate</td>
                                    <td class="table-icon-cell">
                                        <i class="zmdi zmdi-favorite danger-color"></i>
                                        78
                                    </td>
                                    <td class="table-icon-cell">
                                        <i class="zmdi zmdi-comment primary-color"></i>
                                        347
                                    </td>
                                    <td class="table-date">15 hours ago <i class="zmdi zmdi-time"></i></td>
                                    <td class="text-center">
                                        <img src="img/contacts/1.png" alt="profile" class="img-circle" data-toggle="tooltip" data-placement="bottom" data-original-title="Carlos Tevez">
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>

@endsection