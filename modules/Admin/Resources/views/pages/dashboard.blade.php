@extends('admin::layout')

@section('title')
    Dashboard
@stop

@section('content')

    <!-- BLOCK : Google Analytics -->
    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head head-with-btns clearfix">
                    <h5 class="content-title text-color pull-left">Total sales statistics</h5>
                    <div class="functions-btns pull-right">
                        <button type="button" class="btn btn-info">
                            Week
                        </button>
                        <button type="button" class="btn btn-warning">
                            Month
                        </button>
                        <button type="button" class="btn btn-warning">
                            Year
                        </button>
                    </div>
                </div>
                <div class="content">
                    <div id="js-legend" class="chart-legend"></div>
                    <div class="chartjs-container full-page-chart">
                        <canvas id="chart-line"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="content-box warning-bg white">
                <div class="head clearfix">
                    <h5 class="content-title pull-left">Orders</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <div id="line-chart-3" class="flot-chart"></div>
                    <p class="text-uppercase zero-m">Total orders</p>
                    <p class="zero-m f-30">45,245,659</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box">
                <div class="head clearfix">
                    <h5 class="content-title text-color pull-left">Implementation of a plan</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn text-color" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn text-color" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn text-color" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="p-l-20">
                    <button type="button" class="btn btn-info m-b-5">
                        Week
                    </button>
                    <button type="button" class="btn btn-warning m-b-5">
                        Month
                    </button>
                </div>
                <div class="content">
                    <div class="easychart text-right" data-percent="55"></div>
                    <div class="p-absolute b-20 l-20">
                        <p class="text-uppercase zero-m">Profit</p>
                        <p class="zero-m danger-color f-30">254,395</p>
                    </div>
                </div>
                <!-- Used for demo purposes. Remove if it is needed-->
                <div class="visible-lg visible-md" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box success-bg white">
                <div class="head clearfix">
                    <h5 class="content-title pull-left">Visitors</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <div id="line-chart-4" class="flot-chart"></div>
                    <p class="text-uppercase zero-m">Total visitors</p>
                    <p class="zero-m f-30">15,654,700</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box info-bg white">
                <div class="head clearfix">
                    <h5 class="content-title pull-left">Returns</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <div id="line-chart-2" class="flot-chart"></div>
                    <p class="text-uppercase zero-m">Total returns</p>
                    <p class="zero-m f-30">573,935</p>
                </div>
            </div>
        </div>
    </div>

    <!-- BLOCK : Widgets -->
    <div class="row">
        <div class="col-md-12">
            <div class="content-box gallery-widget">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">Gallery</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content clearfix">
                    <a href="#"><img class="img-responsive" src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" alt="gallery"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="content-box p-20 info-bg white f-s-16 text-center">
                <div class="text-right">
                    <span class="current-date"></span>
                </div>
                <span class="time"></span>
            </div>
        </div>
        <div class="col-md-8">
            <div class="content-box chat-widget">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">Chat</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="chat-container">
                                <div class="content-box p-20 clearfix">
                                    <div class="pull-left text-center">
                                        <img src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" width="40" height="40" alt="avatar"><br>
                                        <time>12:04</time>
                                    </div>
                                    <div class="message">
                                        <p><em>Must you with him from him her were more. In eldest be it result should remark vanity square.</em></p>
                                    </div>
                                </div>
                                <div class="content-box p-20 clearfix reply">
                                    <div class="pull-left message">
                                        <p><em>His not get talked effect worthy barton. Household shameless incommode at no objection behaviour.</em></p>
                                        <p><em>Especially do at he possession insensible sympathize boisterous it.</em></p>
                                    </div>
                                    <div class="pull-right text-center">
                                        <img src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" width="40" height="40" alt="avatar"><br>
                                        <time>12:06</time>
                                    </div>
                                </div>
                                <div class="content-box p-20 clearfix">
                                    <div class="pull-left text-center">
                                        <img src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" width="40" height="40" alt="avatar"><br>
                                        <time>12:017</time>
                                    </div>
                                    <div class="message">
                                        <p><em>Subjects to ecstatic children he. Could ye leave up as built match.</em></p>
                                    </div>
                                </div>
                                <div class="content-box p-20 clearfix reply">
                                    <div class="pull-left message">
                                        <p><em>Out believe has request not how comfort evident. Up delight cousins we feeling minutes. Genius has looked end piqued spring.</em></p>
                                        <p><em> Old had conviction discretion understood put principles you. Match means keeps round one her quick.</em></p>
                                    </div>
                                    <div class="pull-right text-center">
                                        <img src="uploads/avatars/b43199014d2ba00f7943c3d5acff8fb4ef3843d9.jpg" width="40" height="40" alt="avatar"><br>
                                        <time>13:24</time>
                                    </div>
                                </div>
                            </div>
                            <form id="chat">
                                <div class="form-group fg-float pull-left m-r-10">
                                    <input class="form-control" type="text" placeholder="Type message">
                                    <input id="fileinput" type="file" class="hidden">
                                </div>
                                <button id="fileinputbtn" type="button" class="btn btn-info btn-lg icon">
                                    <i class="zmdi zmdi-attachment-alt"></i>
                                </button>
                                <button type="submit" class="btn btn-info btn-lg icon">
                                    <i class="zmdi zmdi-mail-send"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BLOCK : DataTables -->
    <div class="row">
        <div class="col-lg-12">
            <div class="data-info">
                <table id="table1" class="display datatable no-stripes table">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Number of Orders</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="info-color">Coats Tony Taylor</td>
                        <td>Mens</td>
                        <td>3 324</td>
                        <td>Alisa Kito</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$245</td>
                    </tr>
                    <tr>
                        <td class="info-color">Nike sneakers</td>
                        <td>Womans</td>
                        <td>5 467</td>
                        <td>John Tredmont</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$560</td>
                    </tr>
                    <tr>
                        <td class="info-color">Adidas T-shirt</td>
                        <td>Children</td>
                        <td>2 546</td>
                        <td>Kyle Jackson</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$2764</td>
                    </tr>
                    <tr>
                        <td class="info-color">Jacket</td>
                        <td>Womans</td>
                        <td>1 875</td>
                        <td>CJ Watson</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$1329</td>
                    </tr>
                    <tr>
                        <td class="info-color">Shirt Diamond</td>
                        <td>Mens</td>
                        <td>6 032</td>
                        <td>Olga Lutchkova</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$896</td>
                    </tr>
                    <tr>
                        <td class="info-color">Summer Shorts</td>
                        <td>Children</td>
                        <td>1 358</td>
                        <td>Silvia Saint</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$8 907</td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="data-danger">
                <table id="table2" class="display datatable">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Number of Orders</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Coats Tony Taylor</td>
                        <td>Mens</td>
                        <td>3 324</td>
                        <td class="danger-color">Alisa Kito</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$245</td>
                    </tr>
                    <tr>
                        <td>Nike sneakers</td>
                        <td>Womans</td>
                        <td>5 467</td>
                        <td class="danger-color">John Tredmont</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$560</td>
                    </tr>
                    <tr>
                        <td>Adidas T-shirt</td>
                        <td>Children</td>
                        <td>2 546</td>
                        <td class="danger-color">Kyle Jackson</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$2764</td>
                    </tr>
                    <tr>
                        <td>Jacket</td>
                        <td>Womans</td>
                        <td>1 875</td>
                        <td class="danger-color">CJ Watson</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$1329</td>
                    </tr>
                    <tr>
                        <td>Shirt Diamond</td>
                        <td>Mens</td>
                        <td>6 032</td>
                        <td class="danger-color">Olga Lutchkova</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$896</td>
                    </tr>
                    <tr>
                        <td>Summer Shorts</td>
                        <td>Children</td>
                        <td>1 358</td>
                        <td class="danger-color">Silvia Blake</td>
                        <td><span class="label label-default">Closed</span></td>
                        <td>$8 907</td>
                    </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- BLOCK : Forms - elements -->
    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head success-bg clearfix">
                    <h5 class="content-title pull-left">Input types</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputText" class="col-sm-2 control-label">Text</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputText" placeholder="Some text here">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPlaceholder" class="col-sm-2 control-label">Placeholder</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPlaceholder" placeholder="Placeholder">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="inputPassword3" value="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Textarea</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="3"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputFocus" class="col-sm-2 control-label">Focused</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputFocus" placeholder="Focused">
                                        {{--<input type="text" class="form-control" id="inputFocus" placeholder="Focused" autofocus>--}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputDisabled" class="col-sm-2 control-label">Disabled</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputDisabled" placeholder="Disabled input here..." disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputHelped" class="col-sm-2 control-label">Help</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputHelped" placeholder="Helping text">
                                        <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Selects</label>
                                    <div class="col-sm-10">
                                        <select class="form-control selectpicker">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <select class="form-control selectpicker" data-style="btn-primary">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <select class="form-control selectpicker" data-style="btn-info">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">Input States</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <div class="form-group">
                        <label class="control-label warning-color">Input warning</label>
                        <input type="text" class="form-control input-warning">
                    </div>
                    <div class="form-group">
                        <label class="control-label danger-color">Input error</label>
                        <input type="text" class="form-control input-danger">
                    </div>
                    <div class="form-group">
                        <label class="control-label success-color">Input success</label>
                        <input type="text" class="form-control input-success">
                    </div>
                    <div class="form-group">
                        <label class="control-label primary-color">Input primary</label>
                        <input type="text" class="form-control input-primary">
                    </div>
                    <div class="form-group">
                        <label class="control-label info-color">Input info</label>
                        <input type="text" class="form-control input-info">
                    </div>
                    <div class="form-group has-icon">
                        <label class="control-label success-color">Input success with icon</label>
                        <div class="p-relative">
                            <input type="text" class="form-control input-success">
                            <span class="zmdi zmdi-check success-color f-s-24 form-icon"></span>
                        </div>
                    </div>
                    <div class="form-group has-icon">
                        <label class="control-label warning-color">Input warning with icon</label>
                        <div class="p-relative">
                            <input type="text" class="form-control input-warning">
                            <span class="zmdi zmdi-alert-triangle warning-color f-s-24 form-icon"></span>
                        </div>
                    </div>
                    <div class="form-group has-icon">
                        <label class="control-label danger-color">Input danger with icon</label>
                        <div class="p-relative">
                            <input type="text" class="form-control input-danger">
                            <span class="zmdi zmdi-close danger-color f-s-24 m-r-5 form-icon"></span>
                        </div>
                    </div>
                    <div class="form-group has-icon">
                        <label class="control-label">Input with custom icon</label>
                        <div class="p-relative">
                            <input type="text" class="form-control">
                            <span class="zmdi zmdi-car f-s-24 form-icon"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-box">
                <div class="head warning-bg clearfix">
                    <h5 class="content-title pull-left">Input sizes</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <div class="form-group">
                        <label class="control-label">Large Input</label>
                        <input type="email" class="form-control input-lg">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Default Input</label>
                        <input type="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Small input</label>
                        <input type="email" class="form-control input-sm">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Grid sizes</label>
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-5">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-8">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-10">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-4">
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-8">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-6">
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-6">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-9">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control m-b-20" placeholder=".col-md-3">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control" placeholder=".col-md-12">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="content-box">
                <div class="head danger-bg clearfix">
                    <h5 class="content-title pull-left">Input addons</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Static</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="zmdi zmdi-twitter"></span></div>
                                    <input type="text" class="form-control" placeholder="Twitter">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                    <div class="input-group-addon"><span class="zmdi zmdi-email"></span></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="zmdi zmdi-edit"></span></div>
                                    <input type="text" class="form-control" placeholder="Username">
                                    <div class="input-group-addon">Profile</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Buttons</label>
                                <div class="input-group">
                                    <div class="input-group-addon p-0"><button type="button" class="btn btn-default">$</button></div>
                                    <input type="text" class="form-control" placeholder="Amount">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="email" class="form-control" placeholder="Email">
                                    <div class="input-group-addon p-0"><button type="button" class="btn btn-info">Submit</button></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon p-0"><button type="button" class="btn btn-success"><span class="zmdi zmdi-facebook"></span></button></div>
                                    <input type="text" class="form-control" placeholder="http://facebook.com">
                                    <div class="input-group-addon p-0"><button type="button" class="btn btn-warning"><span class="zmdi zmdi-edit m-r-5"></span>Edit</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('scripts')
    <script>
//        $('#table1').DataTable({
//            "dom": '<"toolbar tool1">rtip',
//            info: true,
//            paging: true,
//            responsive: true
//        });
//
//        $("div.tool1").html('<h5 class="zero-m">Info table</h5>');
//
//        $('#table2').DataTable({
//            "dom": '<"toolbar tool2"><"clear-filter">frtip',
//            info: false,
//            paging: false,
//            responsive: true,
//            "oLanguage": { "sSearch": "" }
//        });
//
//        $("div.tool2").html('<h5 class="zero-m">Danger table</h5>');
//
//        $('.dataTables_filter input').attr("placeholder", "Search");


        // Pie chart
        $(function() {
            $('.easychart').easyPieChart({
                barColor: "#F44336",
                trackColor: '#cccccc',
                size: 115,
                lineWidth: 15,
                scaleLength: 0
            });
        });


        // Data for charts
        $(function () {
            /* Make some random data for the Chart*/

            var d1 = [];
            for (var i = 0; i <= 10; i += 1) {
                d1.push([i, parseInt(Math.random() * 100)]);
            }

            var d2 = [];
            for (var i = 0; i <= 10; i += 1) {
                d2.push([i, parseInt(Math.random() * 100)]);
            }

            var d3 = [];
            for (var i = 0; i <= 10; i += 1) {
                d3.push([i, parseInt(Math.random() * 100)]);
            }

            var d4 = [];
            for (var i = 0; i <= 50; i += 1) {
                d4.push([i, parseInt(Math.random() * 100)]);
            }

            /* Chart Options */

            var options = {
                series: {
                    shadowSize: 0,
                    label: "Qty",
                    lines: {
                        show: true,
                        lineWidth: 2
                    },
                    points: {
                        show: true
                    }
                },
                grid: {
                    margin: 10,
                    show: false,
                    hoverable: true,
                    clickable: true
                },
                yaxis: {
                    max: 100,
                    min: 0
                },
                legend: {
                    show: false
                },
                tooltip: {
                    show: true,
                    cssClass: "flot-tooltip",
                    defaultTheme: false,
                    content: '%y.2',
                    shifts: {
                        x: 1,
                        y: -45
                    }
                }
            };

            var options2 = {
                series: {
                    shadowSize: 5,
                    label: "Qty",
                    lines: {
                        show: true,
                        lineWidth: 2
                    }
                },
                grid: {
                    margin: 10,
                    show: false,
                    hoverable: true,
                    clickable: false
                },
                legend: {
                    show: false
                },
                tooltip: {
                    show: true,
                    cssClass: "flot-tooltip",
                    defaultTheme: false,
                    content: '%y.2',
                    shifts: {
                        x: 1,
                        y: -45
                    }
                }
            };

            /* Let's create the chart */
            if ($("#line-chart-2")[0]) {
                $.plot($("#line-chart-2"), [
                    {data: d2, color: '#fff' }
                ], options);
            }

            if ($("#line-chart-3")[0]) {
                $.plot($("#line-chart-3"), [
                    {data: d3, color: '#fff' }
                ], options);
            }

            if ($("#line-chart-4")[0]) {
                $.plot($("#line-chart-4"), [
                    {data: d4, color: '#fff' }
                ], options2);
            }

        });


        // Some more charts for dashboard
        var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

        var lineChartData = {
            labels : ["MONDAY","TUESDAY","WEDNESDAY","THURSDAY","FRIDAY","SATURDAY","SUNDAY"],
            datasets : [
                {
                    label: "Mens goods",
                    fillColor : "rgba(73, 206, 255, 0.5)",
                    strokeColor : "rgba(73, 206, 255, 0.7)",
                    pointColor : "rgba(73, 206, 255, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(255, 193, 7, 1)",
                    data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                },
                {
                    label: "Women goods",
                    fillColor : "rgba(255, 187, 51, 0.5)",
                    strokeColor : "rgba(255, 187, 51, 0.7)",
                    pointColor : "rgba(255, 187, 51, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(244, 67, 54, 1)",
                    data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                },
                {
                    label: "Children goods",
                    fillColor : "rgba(153, 204, 0, 0.5)",
                    strokeColor : "rgba(153, 204, 0, 0.7)",
                    pointColor : "rgba(153, 204, 0, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(33, 150, 243, 1)",
                    data : [randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]
                }
            ]

        }

        window.onload = function(){
            var ctx = document.getElementById("chart-line").getContext("2d");
            var myLine = new Chart(ctx).Line(lineChartData, {
                scaleShowVerticalLines: false,
//        scaleShowLabels: false,
//        maintainAspectRatio: true,
                datasetStrokeWidth : 6,
                pointDotRadius : 6,
                responsive: true,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            });

            document.getElementById('js-legend').innerHTML = myLine.generateLegend();
        }
    </script>
@stop