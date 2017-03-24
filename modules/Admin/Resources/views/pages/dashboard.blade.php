@extends('admin::layout')

@section('title')
    Dashboard
@endsection

@section('content')

    @if (config('numencode.analytics'))
        @include('admin::pages.analytics.chart')
        @include('admin::pages.analytics.data')
    @else
        <div class="row">
            <div class="col-lg-12">
                <div class="content-box p-20 info-bg white f-s-16 text-center">
                    <div>
                        <p>Logged in as<br /><strong>{{ $admin->name }}</strong></p>
                        <span class="current-date"></span>
                    </div>
                    <span class="time" style="font-size: 50px; font-weight: 400; letter-spacing: 0; margin-top: 27px; line-height: 50px;"></span>
                </div>
            </div>
        </div>
    @endif

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

    @if (config('numencode.analytics'))
        @include('admin::pages.analytics.script')
    @endif

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