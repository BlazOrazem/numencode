@extends('admin::layout')

@section('title')
    Dashboard
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-box">
                <div class="head head-with-btns clearfix">
                    <h5 class="content-title text-color pull-left">Website analytics</h5>
                    <div class="functions-btns pull-right">
                        <button type="button" class="btn btn-base analytics-switch" data-period="week">
                            Week
                        </button>
                        <button type="button" class="btn btn-info analytics-switch" data-period="month">
                            Month
                        </button>
                        <button type="button" class="btn btn-info analytics-switch" data-period="year">
                            Year
                        </button>
                    </div>
                </div>
                <div class="content analytics-chart analytics-week">
                    <div class="chart-legend chart-legend-week"></div>
                    <div class="chartjs-container full-page-chart">
                        <canvas class="chart-line-week"></canvas>
                    </div>
                </div>
                <div class="content analytics-chart analytics-month" style="display: none;">
                    <div class="chart-legend chart-legend-month"></div>
                    <div class="chartjs-container full-page-chart">
                        <canvas class="chart-line-month"></canvas>
                    </div>
                </div>
                <div class="content analytics-chart analytics-year" style="display: none;">
                    <div class="chart-legend chart-legend-year"></div>
                    <div class="chartjs-container full-page-chart">
                        <canvas class="chart-line-year"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="content-box p-20 base-bg white f-s-16 text-center">
                <div>
                    <p>Logged in as<br /><strong>{{ $admin->name }}</strong></p>
                    <span class="current-date"></span>
                </div>
                <span class="time" style="font-size: 50px; font-weight: 400; letter-spacing: 0; margin-top: 27px; line-height: 50px;"></span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box">
                <div class="head clearfix">
                    <h5 class="content-title text-color text-center" style="width: 100%;">Website visitors</h5>
                </div>
                <div class="content">
                    <div class="visitors-chart text-right" data-percent="0"></div>
                    <div class="p-absolute t-50 l-20">
                        <p class="zero-m">New visitors</p>
                        <p class="zero-m success-color f-20 visitorsNew">0%</p>
                    </div>
                    <div class="p-absolute b-20 l-20">
                        <p class="zero-m">Returning<br />visitors</p>
                        <p class="zero-m base-color f-20 visitorsReturn">0%</p>
                    </div>
                </div>
                <div class="visible-lg visible-md" style="height: 6px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box success-bg white text-center">
                <div class="head clearfix">
                    <h5 class="content-title" style="width: 100%;">Website statistics</h5>
                </div>
                <div class="content" style="padding-top: 12px;">
                    <p class="text-uppercase zero-m">Visitors</p>
                    <p class="f-30 visitorCounter">0</p>
                    <p class="text-uppercase zero-m">Pageviews</p>
                    <p class="zero-m f-30 pageviewCounter">0</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="content-box info-bg white text-center">
                <div class="head clearfix">
                    <h5 class="content-title" style="width: 100%;">Website traffic</h5>
                </div>
                <div class="content" style="padding-top: 12px;">
                    <p class="text-uppercase zero-m">Average session duration</p>
                    <p class="f-30 avgSessionDuration">0</p>
                    <p class="text-uppercase zero-m">Currently active visiors</p>
                    <p class="zero-m f-30">{{ $activeVisitors }}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <section id="todo-app">
                <div class="content-box top-box">
                    <div class="head head-with-btns clearfix">
                        <h5 class="content-title text-color pull-left">My Tasks</h5>
                        <div class="functions-btns pull-right">
                            <button type="button" @click.prevent="filterAll" :class="{ btn: true, 'btn-info': visibility != 'all', 'btn-base': visibility == 'all' }">
                                All
                            </button>
                            <button type="button" @click.prevent="filterActive" :class="{ btn: true, 'btn-info': visibility != 'active', 'btn-base': visibility == 'active' }">
                                Active
                            </button>
                            <button type="button" @click.prevent="filterCompleted" :class="{ btn: true, 'btn-info': visibility != 'completed', 'btn-base': visibility == 'completed' }">
                                Completed
                            </button>
                        </div>
                    </div>
                </div>
                <div class="content-box">
                    <header class="header">
                        <input class="new-todo"
                               autofocus autocomplete="off"
                               placeholder="What needs to be done?"
                               v-model="newTodo"
                               @keyup.enter="addTodo">
                    </header>
                    <section class="main" v-show="todos.length" v-cloak>
                        <input class="toggle-all" type="checkbox" v-model="allDone">
                        <ul class="todo-list">
                            <li v-for="todo in filteredTodos"
                                class="todo"
                                :key="todo.id"
                                :class="{ completed: todo.completed, editing: todo == editedTodo }">
                                <div class="view">
                                    <input class="toggle" type="checkbox" v-model="todo.completed">
                                    <label @dblclick="editTodo(todo)">@{{ todo.title }}</label>
                                    <button class="destroy" @click="removeTodo(todo)"></button>
                                </div>
                                <input class="edit" type="text"
                                       v-model="todo.title"
                                       v-todo-focus="todo == editedTodo"
                                @blur="doneEdit(todo)"
                                @keyup.enter="doneEdit(todo)"
                                @keyup.esc="cancelEdit(todo)">
                            </li>
                        </ul>
                    </section>
                    <footer class="footer" v-show="todos.length" v-cloak>
                        <span class="todo-count">
                          <strong>@{{ remaining }}</strong> @{{ remaining | pluralize }} left
                        </span>
                        <button class="btn btn-info clear-completed" @click="removeCompleted" v-show="todos.length > remaining">
                            Clear completed
                        </button>
                    </footer>
                </div>
            </section>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // Google Analytics data
        var weekLineChartData = {
            labels : vars.weekLabels,
            datasets : [
                {
                    label: "Page views",
                    fillColor : "rgba(153, 204, 0, 0.5)",
                    strokeColor : "rgba(153, 204, 0, 0.7)",
                    pointColor : "rgba(153, 204, 0, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(33, 150, 243, 1)",
                    data : vars.weekPageViews
                },
                {
                    label: "Visitors",
                    fillColor : "rgba(73, 206, 255, 0.5)",
                    strokeColor : "rgba(73, 206, 255, 0.7)",
                    pointColor : "rgba(73, 206, 255, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(255, 193, 7, 1)",
                    data : vars.weekVisitors
                }
            ]
        }

        var monthLineChartData = {
            labels : vars.monthLabels,
            datasets : [
                {
                    label: "Page views",
                    fillColor : "rgba(153, 204, 0, 0.5)",
                    strokeColor : "rgba(153, 204, 0, 0.7)",
                    pointColor : "rgba(153, 204, 0, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(33, 150, 243, 1)",
                    data : vars.monthPageViews
                },
                {
                    label: "Visitors",
                    fillColor : "rgba(73, 206, 255, 0.5)",
                    strokeColor : "rgba(73, 206, 255, 0.7)",
                    pointColor : "rgba(73, 206, 255, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(255, 193, 7, 1)",
                    data : vars.monthVisitors
                }
            ]
        }

        var yearLineChartData = {
            labels : vars.yearLabels,
            datasets : [
                {
                    label: "Page views",
                    fillColor : "rgba(153, 204, 0, 0.5)",
                    strokeColor : "rgba(153, 204, 0, 0.7)",
                    pointColor : "rgba(153, 204, 0, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(33, 150, 243, 1)",
                    data : vars.yearPageViews
                },
                {
                    label: "Visitors",
                    fillColor : "rgba(73, 206, 255, 0.5)",
                    strokeColor : "rgba(73, 206, 255, 0.7)",
                    pointColor : "rgba(73, 206, 255, 0.9)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "rgba(255, 193, 7, 1)",
                    data : vars.yearVisitors
                }
            ]
        }

        window.onload = function(){
            var ctxWeek = $('.chart-line-week')[0].getContext("2d");
            var myLineWeek = new Chart(ctxWeek).Line(weekLineChartData, {
                scaleShowVerticalLines: false,
                scaleShowLabels: true,
                datasetStrokeWidth : 6,
                pointDotRadius : 6,
                responsive: true,
                legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
            });
            $('.chart-legend-week').html(myLineWeek.generateLegend());
            $('.visitorCounter').html(vars.weekVisitorCounter);
            $('.pageviewCounter').html(vars.weekPageviewCounter);
            $('.avgSessionDuration').html(vars.weekAvgSessionDuration);
            $('.visitorsNew').html(vars.weekVisitorsNewPercent + '%');
            $('.visitorsReturn').html(vars.weekVisitorsReturnPercent + '%');
            $('.visitors-chart').data('easyPieChart').update(vars.weekVisitorsNewPercent);
        }

        // Analytics switch
        $('.analytics-switch').on("click", function () {
            $('.analytics-switch').each(function(index) {
                if ($(this).hasClass('btn-base')) {
                    $(this).removeClass('btn-base');
                }
                if (!$(this).hasClass('btn-info')) {
                    $(this).addClass('btn-info');
                }
            });

            $(this).removeClass('btn-info').addClass('btn-base');

            $('div.analytics-chart').hide();

            $('div.analytics-chart.analytics-'+ $(this).data('period')).show();

            if ($(this).data('period') == 'week') {
                var ctxWeek = $('.chart-line-week')[0].getContext("2d");
                var myLineWeek = new Chart(ctxWeek).Line(weekLineChartData, {
                    scaleShowVerticalLines: false,
                    scaleShowLabels: true,
                    datasetStrokeWidth : 6,
                    pointDotRadius : 6,
                    responsive: true,
                    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                });
                $('.chart-legend-week').html(myLineWeek.generateLegend());
                $('.visitorCounter').html(vars.weekVisitorCounter);
                $('.pageviewCounter').html(vars.weekPageviewCounter);
                $('.avgSessionDuration').html(vars.weekAvgSessionDuration);
                $('.visitorsNew').html(vars.weekVisitorsNewPercent + '%');
                $('.visitorsReturn').html(vars.weekVisitorsReturnPercent + '%');
                $('.visitors-chart').data('easyPieChart').update(vars.weekVisitorsNewPercent);
            }

            if ($(this).data('period') == 'month') {
                var ctxMonth = $('.chart-line-month')[0].getContext("2d");
                var myLineMonth = new Chart(ctxMonth).Line(monthLineChartData, {
                    scaleShowVerticalLines: false,
                    scaleShowLabels: true,
                    datasetStrokeWidth : 6,
                    pointDotRadius : 6,
                    responsive: true,
                    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                });
                $('.chart-legend-month').html(myLineMonth.generateLegend());
                $('.visitorCounter').html(vars.monthVisitorCounter);
                $('.pageviewCounter').html(vars.monthPageviewCounter);
                $('.avgSessionDuration').html(vars.monthAvgSessionDuration);
                $('.visitorsNew').html(vars.monthVisitorsNewPercent + '%');
                $('.visitorsReturn').html(vars.monthVisitorsReturnPercent + '%');
                $('.visitors-chart').data('easyPieChart').update(vars.monthVisitorsNewPercent);
            }

            if ($(this).data('period') == 'year') {
                var ctxYear = $('.chart-line-year')[0].getContext("2d");
                var myLineYear = new Chart(ctxYear).Line(yearLineChartData, {
                    scaleShowVerticalLines: false,
                    scaleShowLabels: true,
                    datasetStrokeWidth : 6,
                    pointDotRadius : 6,
                    responsive: true,
                    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].pointColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
                });
                $('.chart-legend-year').html(myLineYear.generateLegend());
                $('.visitorCounter').html(vars.yearVisitorCounter);
                $('.pageviewCounter').html(vars.yearPageviewCounter);
                $('.avgSessionDuration').html(vars.yearAvgSessionDuration);
                $('.visitorsNew').html(vars.yearVisitorsNewPercent + '%');
                $('.visitorsReturn').html(vars.yearVisitorsReturnPercent + '%');
                $('.visitors-chart').data('easyPieChart').update(vars.yearVisitorsNewPercent);
            }
        });

        // Visitors
        $(function() {
            $('.visitors-chart').easyPieChart({
                barColor: "#99cc00",
                trackColor: '#2196f3',
                size: 115,
                lineWidth: 15,
                scaleLength: 0
            });
        });
    </script>

    <script>
        var todoStorage = {
            save: function (todos) {
                http.post('/admin/managers/tasks', todos);
            }
        };

        var filters = {
            all: function (todos) {
                return todos;
            },
            active: function (todos) {
                return todos.filter(function (todo) {
                    return !todo.completed;
                })
            },
            completed: function (todos) {
                return todos.filter(function (todo) {
                    return todo.completed;
                })
            }
        };

        var app = new Vue({
            data: {
                todos: vars.manager_tasks || [],
                newTodo: '',
                editedTodo: null,
                visibility: 'all'
            },
            watch: {
                todos: {
                    handler: function (todos) {
                        todoStorage.save(todos);
                    },
                    deep: true
                }
            },
            computed: {
                filteredTodos: function () {
                    return filters[this.visibility](this.todos);
                },
                remaining: function () {
                    return filters.active(this.todos).length;
                },
                allDone: {
                    get: function () {
                        return this.remaining === 0;
                    },
                    set: function (value) {
                        this.todos.forEach(function (todo) {
                            todo.completed = value;
                        })
                    }
                }
            },
            filters: {
                pluralize: function (n) {
                    return n === 1 ? 'item' : 'items';
                }
            },
            methods: {
                addTodo: function () {
                    var value = this.newTodo && this.newTodo.trim();
                    if (!value) {
                        return;
                    }
                    this.todos.push({
                        id: todoStorage.uid++,
                        title: value,
                        completed: false
                    })
                    this.newTodo = '';
                },
                removeTodo: function (todo) {
                    this.todos.splice(this.todos.indexOf(todo), 1);
                },
                editTodo: function (todo) {
                    this.beforeEditCache = todo.title;
                    this.editedTodo = todo;
                },
                doneEdit: function (todo) {
                    if (!this.editedTodo) {
                        return;
                    }
                    this.editedTodo = null
                    todo.title = todo.title.trim()
                    if (!todo.title) {
                        this.removeTodo(todo);
                    }
                },
                cancelEdit: function (todo) {
                    this.editedTodo = null;
                    todo.title = this.beforeEditCache;
                },
                filterAll: function () {
                    this.visibility = 'all';
                },
                filterActive: function () {
                    this.visibility = 'active';
                },
                filterCompleted: function () {
                    this.visibility = 'completed';
                },
                removeCompleted: function () {
                    this.todos = filters.active(this.todos);
                }
            },
            directives: {
                'todo-focus': function (el, value) {
                    if (value) {
                        el.focus();
                    }
                }
            }
        });

        app.$mount('#todo-app');
    </script>
@endsection