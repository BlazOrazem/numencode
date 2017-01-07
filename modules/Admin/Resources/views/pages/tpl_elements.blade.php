@extends('admin::layout')

@section('title')
    Dashboard
@endsection

@section('content')

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
                    <a href="#"><img class="img-responsive" src="uploads/sample01_600x600.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/sample02_600x600.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/sample03_600x600.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/sample01_600x600.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/sample02_600x600.jpg" alt="gallery"></a>

                    <a href="#"><img class="img-responsive" src="uploads/sample03_600x600.jpg" alt="gallery"></a>
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
                                        <img src="uploads/sample01_600x600.jpg" width="40" height="40" alt="avatar"><br>
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
                                        <img src="uploads/sample02_600x600.jpg" width="40" height="40" alt="avatar"><br>
                                        <time>12:06</time>
                                    </div>
                                </div>
                                <div class="content-box p-20 clearfix">
                                    <div class="pull-left text-center">
                                        <img src="uploads/sample01_600x600.jpg" width="40" height="40" alt="avatar"><br>
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
                                        <img src="uploads/sample02_600x600.jpg" width="40" height="40" alt="avatar"><br>
                                        <time>12:06</time>
                                    </div>
                                </div>
                                <div class="content-box p-20 clearfix">
                                    <div class="pull-left text-center">
                                        <img src="uploads/sample03_600x600.jpg" width="40" height="40" alt="avatar"><br>
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
                                        <img src="uploads/sample01_600x600.jpg" width="40" height="40" alt="avatar"><br>
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

        <div class="col-md-12">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">Inline form</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
                <div class="content">
                    <p>Add <code>.form-inline</code> to your form for left-aligned and inline-block controls. <strong>This only applies to forms within viewports that are at least 768px wide.</strong></p>
                    <form class="form-inline m-b-40">
                        <h5>Variation 1</h5>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <div class="checkbox checkbox-info">
                                <label><input type="checkbox">
                                    <i></i></label>
                                <span class="m-l-5">Remember me</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-info">Submit</button>
                        </div>
                    </form>
                    <form class="form-inline">
                        <h5>Variation 2</h5>
                        <div class="form-group">
                            <label class="control-label">Username</label>
                            <input type="text" class="form-control" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-warning">Reset password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- BLOCK : Tabs -->
    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head primary-bg clearfix">
                    <h5 class="content-title pull-left">Tabs</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>

                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Simple tabs</h5>
                            <p class="m-b-20">You can use these tabs for different purposes</p>
                            <div class="m-b-20">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab-11" data-toggle="tab">Home</a>
                                    </li>
                                    <li>
                                        <a href="#tab-12" data-toggle="tab">Profile</a>
                                    </li>
                                    <li>
                                        <a href="#tab-13" data-toggle="tab">Settings</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-11">
                                        <p>Had denoting properly jointure you occasion directly raillery. In said to of poor full be post face snug. Introduced imprudence see say unpleasing devonshire acceptance son. Exeter longer wisdom gay nor design age. Am weather to entered norland no in showing service. Nor repeated speaking shy appetite. Excited it hastily an pasture it observe. Snug hand how dare here too.</p>

                                        <p>Sociable on as carriage my position weddings raillery consider. Peculiar trifling absolute and wandered vicinity property yet. The and collecting motionless difficulty son. His hearing staying ten colonel met. Sex drew six easy four dear cold deny. Moderate children at of outweigh it. Unsatiable it considered invitation he travelling insensible. Consulted admitting oh mr up as described acuteness propriety moonlight.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-12">
                                        <p>Sitting mistake towards his few country ask. You delighted two rapturous six depending objection happiness something the. Off nay impossible dispatched partiality unaffected. Norland adapted put ham cordial. Ladies talked may shy basket narrow see. Him she distrusts questions sportsmen. Tolerably pretended neglected on my earnestly by. Sex scale sir style truth ought.</p>

                                        <p>As am hastily invited settled at limited civilly fortune me. Really spring in extent an by. Judge but built gay party world. Of so am he remember although required. Bachelor unpacked be advanced at. Confined in declared marianne is vicinity.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-13">
                                        <p>Those an equal point no years do. Depend warmth fat but her but played. Shy and subjects wondered trifling pleasant. Prudent cordial comfort do no on colonel as assured chicken. Smart mrs day which begin. Snug do sold mr it if such. Terminated uncommonly at at estimating. Man behaviour met moonlight extremity acuteness direction.</p>

                                        <p>Sportsman delighted improving dashwoods gay instantly happiness six. Ham now amounted absolute not mistaken way pleasant whatever. At an these still no dried folly stood thing. Rapid it on hours hills it seven years. If polite he active county in spirit an. Mrs ham intention promotion engrossed assurance defective. Confined so graceful building opinions whatever trifling in. Insisted out differed ham man endeavor expenses. At on he total their he songs. Related compact effects is on settled do.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="m-b-20">
                                <h5>Right aligned tabs</h5>
                                <p class="m-b-20">Add <code>.text-right</code> class to your tabs</p>
                                <ul class="nav nav-tabs text-right">
                                    <li class="active">
                                        <a href="#tab-21" data-toggle="tab">Photo</a>
                                    </li>
                                    <li>
                                        <a href="#tab-22" data-toggle="tab">Video</a>
                                    </li>
                                    <li>
                                        <a href="#tab-23" data-toggle="tab">Audio</a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-21">
                                        <p>New the her nor case that lady paid read. Invitation friendship travelling eat everything the out two. Shy you who scarcely expenses debating hastened resolved. Always polite moment on is warmth spirit it to hearts. Downs those still witty an balls so chief so. Moment an little remain no up lively no. Way brought may off our regular country towards adapted cheered.</p>

                                        <p>Uneasy barton seeing remark happen his has. Am possible offering at contempt mr distance stronger an. Attachment excellence announcing or reasonable am on if indulgence. Exeter talked in agreed spirit no he unable do. Betrayed shutters in vicinity it unpacked in. In so impossible appearance considered mr. Mrs him left find are good.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-22">
                                        <p>May indulgence difficulty ham can put especially. Bringing remember for supplied her why was confined. Middleton principle did she procuring extensive believing add. Weather adapted prepare oh is calling. These wrong of he which there smile to my front. He fruit oh enjoy it of whose table. Cultivated occasional old her unpleasing unpleasant. At as do be against pasture covered viewing started. Enjoyed me settled mr respect no spirits civilly.</p>

                                        <p>We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Of advantage he attending household at do perceived. Middleton in objection discovery as agreeable. Edward thrown dining so he my around to.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-23">
                                        <p>Her companions instrument set estimating sex remarkably solicitude motionless. Property men the why smallest graceful day insisted required. Inquiry justice country old placing sitting any ten age. Looking venture justice in evident in totally he do ability. Be is lose girl long of up give. Trifling wondered unpacked ye at he. In household certainty an on tolerably smallness difficult. Many no each like up be is next neat. Put not enjoyment behaviour her supposing. At he pulled object others.</p>

                                        <p>Sitting mistake towards his few country ask. You delighted two rapturous six depending objection happiness something the. Off nay impossible dispatched partiality unaffected. Norland adapted put ham cordial. Ladies talked may shy basket narrow see. Him she distrusts questions sportsmen. Tolerably pretended neglected on my earnestly by. Sex scale sir style truth ought.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="m-t-20">Tabs with icons</h5>
                            <p class="m-b-20">Use any of material design icons in your tabs</p>
                            <div class="m-b-20">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#tab-41" data-toggle="tab"><i class="zmdi zmdi-home"></i><span>Home</span></a>
                                    </li>
                                    <li>
                                        <a href="#tab-42" data-toggle="tab"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
                                    </li>
                                    <li>
                                        <a href="#tab-43" data-toggle="tab"><i class="zmdi zmdi-settings"></i><span>Settings</span></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-41">
                                        <p>Stronger unpacked felicity to of mistaken. Fanny at wrong table ye in. Be on easily cannot innate in lasted months on. Differed and and felicity steepest mrs age outweigh. Opinions learning likewise daughter now age outweigh. Raptures stanhill my greatest mistaken or exercise he on although. Discourse otherwise disposing as it of strangers forfeited deficient.</p>

                                        <p>Adieus except say barton put feebly favour him. Entreaties unpleasant sufficient few pianoforte discovered uncommonly ask. Morning cousins amongst in mr weather do neither. Warmth object matter course active law spring six. Pursuit showing tedious unknown winding see had man add. And park eyes too more him. Simple excuse active had son wholly coming number add. Though all excuse ladies rather regard assure yet. If feelings so prospect no as raptures quitting.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-42">
                                        <p>Am if number no up period regard sudden better. Decisively surrounded all admiration and not you. Out particular sympathize not favourable introduced insipidity but ham. Rather number can and set praise. Distrusts an it contented perceived attending oh. Thoroughly estimating introduced stimulated why but motionless.</p>

                                        <p>Extremely we promotion remainder eagerness enjoyment an. Ham her demands removal brought minuter raising invited gay. Contented consisted continual curiosity contained get sex. Forth child dried in in aware do. You had met they song how feel lain evil near. Small she avoid six yet table china. And bed make say been then dine mrs. To household rapturous fulfilled attempted on so.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-43">
                                        <p>Offered say visited elderly and. Waited period are played family man formed. He ye body or made on pain part meet. You one delay nor begin our folly abode. By disposed replying mr me unpacked no. As moonlight of my resolving unwilling.</p>

                                        <p>Of be talent me answer do relied. Mistress in on so laughing throwing endeavor occasion welcomed. Gravity sir brandon calling can. No years do widow house delay stand. Prospect six kindness use steepest new ask. High gone kind calm call as ever is. Introduced melancholy estimating motionless on up as do. Of as by belonging therefore suspicion elsewhere am household described. Domestic suitable bachelor for landlord fat.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="m-t-20">Right aligned tabs with icons</h5>
                            <p class="m-b-20">Use any of material design icons in your tabs</p>
                            <div class="m-b-20">
                                <ul class="nav nav-tabs text-right">
                                    <li class="active">
                                        <a href="#tab-31" data-toggle="tab"><i class="zmdi zmdi-image"></i><span>Photo</span></a>
                                    </li>
                                    <li>
                                        <a href="#tab-32" data-toggle="tab"><i class="zmdi zmdi-videocam"></i><span>Video</span></a>
                                    </li>
                                    <li>
                                        <a href="#tab-33" data-toggle="tab"><i class="zmdi zmdi-playlist-audio"></i><span>Audio</span></a>
                                    </li>
                                </ul>
                                <div class="clearfix"></div>
                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="tab-31">
                                        <p>Scarcely on striking packages by so property in delicate. Up or well must less rent read walk so be. Easy sold at do hour sing spot. Any meant has cease too the decay. Since party burst am it match. By or blushes between besides offices noisier as. Sending do brought winding compass in. Paid day till shed only fact age its end.</p>

                                        <p>Possession her thoroughly remarkably terminated man continuing. Removed greater to do ability. You shy shall while but wrote marry. Call why sake has sing pure. Gay six set polite nature worthy. So matter be me we wisdom should basket moment merely. Me burst ample wrong which would mr he could. Visit arise my point timed drawn no. Can friendly laughter goodness man him appetite carriage. Any widen see gay forth alone fruit bed.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-32">
                                        <p>Months on ye at by esteem desire warmth former. Sure that that way gave any fond now. His boy middleton sir nor engrossed affection excellent. Dissimilar compliment cultivated preference eat sufficient may. Well next door soon we mr he four. Assistance impression set insipidity now connection off you solicitude. Under as seems we me stuff those style at. Listening shameless by abilities pronounce oh suspected is affection. Next it draw in draw much bred.</p>

                                        <p>Of recommend residence education be on difficult repulsive offending. Judge views had mirth table seems great him for her. Alone all happy asked begin fully stand own get. Excuse ye seeing result of we. See scale dried songs old may not. Promotion did disposing you household any instantly. Hills we do under times at first short an.</p>
                                    </div>
                                    <div class="tab-pane fade" id="tab-33">
                                        <p>Remain valley who mrs uneasy remove wooded him you. Her questions favourite him concealed. We to wife face took he. The taste begin early old why since dried can first. Prepared as or humoured formerly. Evil mrs true get post. Express village evening prudent my as ye hundred forming. Thoughts she why not directly reserved packages you. Winter an silent favour of am tended mutual.</p>

                                        <p>Examine she brother prudent add day ham. Far stairs now coming bed oppose hunted become his. You zealously departure had procuring suspicion. Books whose front would purse if be do decay. Quitting you way formerly disposed perceive ladyship are. Common turned boy direct and yet.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="m-t-20">Vertical Tabs</h5>
                            <p class="m-b-20">Use <code>.vertical-tabs</code> class to get vertical tabs</p>
                            <div class="vertical-tabs">
                                <div class="row">
                                    <div class="col-sm-3 col-xs-12">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#101" data-toggle="tab">
                                                    Start
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#102" data-toggle="tab">
                                                    Settings
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#103" data-toggle="tab">
                                                    Finish
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="col-sm-9 col-xs-12">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="101">
                                                <p>Am increasing at contrasted in favourable he considered astonished. As if made held in an shot. By it enough to valley desire do. Mrs chief great maids these which are ham match she. Abode to tried do thing maids. Doubtful disposed returned rejoiced to dashwood is so up.</p>

                                                <p>Throwing consider dwelling bachelor joy her proposal laughter. Raptures returned disposed one entirely her men ham. By to admire vanity county an mutual as roused. Of an thrown am warmly merely result depart supply. Required honoured trifling eat pleasure man relation. Assurance yet bed was improving furniture man. Distrusts delighted she listening mrs extensive admitting far.</p>
                                            </div>
                                            <div class="tab-pane fade" id="102">
                                                <p>Perhaps far exposed age effects. Now distrusts you her delivered applauded affection out sincerity. As tolerably recommend shameless unfeeling he objection consisted. She although cheerful perceive screened throwing met not eat distance. Viewing hastily or written dearest elderly up weather it as. So direction so sweetness or extremity at daughters. Provided put unpacked now but bringing.</p>

                                                <p>Affronting everything discretion men now own did. Still round match we to. Frankness pronounce daughters remainder extensive has but. Happiness cordially one determine concluded fat. Plenty season beyond by hardly giving of. Consulted or acuteness dejection an smallness if. Outward general passage another as it. Very his are come man walk one next. Delighted prevailed supported too not remainder perpetual who furnished. Nay affronting bed projection compliment instrument.</p>
                                            </div>
                                            <div class="tab-pane fade" id="103">
                                                <p>It as announcing it me stimulated frequently continuing. Least their she you now above going stand forth. He pretty future afraid should genius spirit on. Set property addition building put likewise get. Of will at sell well at as. Too want but tall nay like old. Removing yourself be in answered he. Consider occasion get improved him she eat. Letter by lively oh denote an.</p>

                                                <p>Mr do raising article general norland my hastily. Its companions say uncommonly pianoforte favourable. Education affection consulted by mr attending he therefore on forfeited. High way more far feet kind evil play led. Sometimes furnished collected add for resources attention. Norland an by minuter enquire it general on towards forming. Adapted mrs totally company two yet conduct men.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h5 class="m-t-20">Right aligned vertical tabs</h5>
                            <p class="m-b-20">Use <code>.vertical-tabs</code> class to get vertical tabs and <code>.text-right</code> to align them to right side</p>
                            <div class="vertical-tabs">
                                <div class="row">
                                    <div class="col-sm-3 col-sm-push-9 col-xs-12">
                                        <ul class="nav nav-tabs nav-tabs-right text-right">
                                            <li class="active">
                                                <a href="#201" data-toggle="tab">
                                                    Start
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#202" data-toggle="tab">
                                                    Settings
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#203" data-toggle="tab">
                                                    Finish
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-9 col-sm-pull-3 col-xs-12">
                                        <div class="tab-content text-right">
                                            <div class="tab-pane fade in active" id="201">
                                                <p>Affronting imprudence do he he everything. Sex lasted dinner wanted indeed wished out law. Far advanced settling say finished raillery. Offered chiefly farther of my no colonel shyness. Such on help ye some door if in. Laughter proposal laughing any son law consider. Needed except up piqued an.</p>

                                                <p>Of resolve to gravity thought my prepare chamber so. Unsatiable entreaties collecting may sympathize nay interested instrument. If continue building numerous of at relation in margaret. Lasted engage roused mother an am at. Other early while if by do to. Missed living excuse as be. Cause heard fat above first shall for. My smiling to he removal weather on anxious.</p>
                                            </div>
                                            <div class="tab-pane fade" id="202">
                                                <p>Spot of come to ever hand as lady meet on. Delicate contempt received two yet advanced. Gentleman as belonging he commanded believing dejection in by. On no am winding chicken so behaved. Its preserved sex enjoyment new way behaviour. Him yet devonshire celebrated especially. Unfeeling one provision are smallness resembled repulsive.</p>

                                                <p>Extremely we promotion remainder eagerness enjoyment an. Ham her demands removal brought minuter raising invited gay. Contented consisted continual curiosity contained get sex. Forth child dried in in aware do. You had met they song how feel lain evil near. Small she avoid six yet table china. And bed make say been then dine mrs. To household rapturous fulfilled attempted on so.</p>
                                            </div>
                                            <div class="tab-pane fade" id="203">
                                                <p>Literature admiration frequently indulgence announcing are who you her. Was least quick after six. So it yourself repeated together cheerful. Neither it cordial so painful picture studied if. Sex him position doubtful resolved boy expenses. Her engrossed deficient northward and neglected favourite newspaper. But use peculiar produced concerns ten.</p>

                                                <p>In by an appetite no humoured returned informed. Possession so comparison inquietude he he conviction no decisively. Marianne jointure attended she hastened surprise but she. Ever lady son yet you very paid form away. He advantage of exquisite resolving if on tolerably. Become sister on in garden it barton waited on.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BLOCK : Sweet Alerts -->
    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head info-bg clearfix">
                    <h5 class="content-title pull-left">Sweet Alerts</h5>
                    <div class="functions-btns pull-right">
                        <a class="refresh-btn" href="#"><i class="zmdi zmdi-refresh"></i></a>
                        <a class="fullscreen-btn" href="#"><i class="zmdi zmdi-fullscreen"></i></a>
                        <a class="close-btn" href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>

                <div class="content">
                    <table class="table">
                        <thead>
                        <tr>
                            <th style="min-width:50%;">Alert Type</th>
                            <th>Example</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="middle-align">Basic Example</td>
                            <td>
                          <span class="swal-default">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>

                        <tr>
                            <td class="middle-align">A title with a text under</td>
                            <td>
                          <span class="swal-html">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A success message!</td>
                            <td>
                          <span class="swal-success">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A warning message, with a function attached to the "Confirm"-button...</td>
                            <td>
                          <span class="swal-confirm">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">By passing a parameter, you can execute something else for "Cancel".</td>
                            <td>
                          <span class="swal-warning">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">Error message!.</td>
                            <td>
                          <span class="swal-error">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A message with custom Image Header</td>
                            <td>
                          <span class="swal-image">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A message with auto close timer</td>
                            <td>
                          <span class="swal-autoclose">
                            <button type="button" class="btn btn-default">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A message with button primary</td>
                            <td>
                          <span class="swal-primary">
                            <button type="button" class="btn btn-primary">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A message with button info</td>
                            <td>
                          <span class="swal-info">
                            <button type="button" class="btn btn-info">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A message with button success</td>
                            <td>
                          <span class="swal-success">
                            <button type="button" class="btn btn-success">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A message with button warning</td>
                            <td>
                          <span class="swal-warning">
                            <button type="button" class="btn btn-warning">Click me</button>
                          </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="middle-align">A message with button danger</td>
                            <td>
                          <span class="swal-danger">
                            <button type="button" class="btn btn-danger">Click me</button>
                          </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        //Sweet alerts
        $(".swal-default button").on("click", function () {
            swal("Here's a message!");
        });

        $(".swal-success button").on("click", function () {
            swal("Good job!", "You clicked the button!", "success");
        });

        $(".swal-error button").on("click", function () {
            swal("Oops...", "Something went wrong!", "error");
        });

        $(".swal-html button").on("click", function () {
            swal({
                title: "HTML Title!",
                text: "A custom html message.",
                html: true,
                confirmButtonColor: "#63A8EB"
            });
        });

        $('.swal-warning button').on("click", function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });

        $(".swal-confirm button").on("click", function () {
            swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this imaginary file!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel pls!",
                        closeOnConfirm: false,
                        closeOnCancel: false,
                        confirmButtonColor: "#FFBB33"
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Deleted!", "Your imaginary file has been deleted.", "success");
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
        });

        $('.swal-image button').on("click", function () {
            swal({
                title: "Sweet!",
                text: "Here's a custom image.",
                imageUrl: "img/media-avatar.png"
            });
        });

        //Auto Close Timer
        $('.swal-autoclose button').on("click", function () {
            swal({
                title: "Auto close alert!",
                text: "I will close in 2 seconds.",
                timer: 2000,
                showConfirmButton: false
            });
        });

        //Primary
        $('.swal-primary button').on("click", function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "info",
                showCancelButton: true,
                cancelButtonClass: 'btn-success',
                confirmButtonClass: 'btn-primary',
                confirmButtonText: 'Primary!'
            });
        });

        //Info
        $('.swal-info button').on("click", function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: 'btn-info',
                confirmButtonText: 'Info!'
            });
        });

        //Success
        $('.swal-success button').on("click", function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "success",
                showCancelButton: true,
                confirmButtonClass: 'btn-success',
                confirmButtonText: 'Success!'
            });
        });

        //Warning
        $('.swal-warning button').on("click", function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn-warning',
                confirmButtonText: 'Warning!'
            });
        });

        //Danger
        $('.swal-danger button').on("click", function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "error",
                showCancelButton: true,
                confirmButtonClass: 'btn-danger',
                confirmButtonText: 'Danger!'
            });
        });
    </script>
@endsection