<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/9bfb9dd95c.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- DataTables -->
{{--    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">--}}

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js" defer></script>
    <script async src="//jsfiddle.net/nerdbiker/f9tsu21k/3/embed/"></script>
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre&display=swap" rel="stylesheet">
    <style type="text/css" >
        #print_bill {
            font-family: 'Abhaya Libre', serif;
        }
    </style>
</head>
<body  class="hold-transition sidebar-mini {{ Request::is('bill/create') ? 'sidebar-collapse' : '' }}">
    <div class="wrapper" id="app">

        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <h4 style="margin-top: 8px">Sussex Agency</h4>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{auth()->user()->name}} ({{auth()->user()->roles->pluck('name')[0]}})<span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        @role('admin')
                        <a class="dropdown-item" data-toggle="modal" data-target="#update_details" href="#" >Update Profile</a>
                        @endrole
                        <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>

                    </div>
                </li>

            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-cyan elevation-4 ">
            <!-- Brand Logo -->
            <a href="{{route('dashboard')}}" class="brand-link">
                <span class="brand-text font-weight-light">Sussex Agency</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset('img/user.png')}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{auth()->user()->name}}</a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="{{route('dashboard')}}" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-house-user"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        @role('receptionist')
                        <li class="nav-item">
                            <a href="{{route('hobby.index')}}" class="nav-link {{ Request::is('hobby') ? 'active' : '' }}">
                                <i class="fas fa-swimmer"></i>
                                <p>Hobbies</p>
                            </a>
                        </li>
                        @endrole
                        <li class="nav-item">
                            <a href="{{route('client.index')}}" class="nav-link {{ Request::is('client*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Clients</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('event.index')}}" class="nav-link {{ Request::is('event*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-tasks"></i>
                                <p>Events</p>
                            </a>
                        </li>
                        @role('financial_manager')
                        <li class="nav-item">
                            <a href="{{route('payment.index')}}" class="nav-link {{ Request::is('payment') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-money-bill"></i>
                                <p>Payments</p>
                            </a>
                        </li>
                        @endrole
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            @yield('content')
            @include('sweetalert::alert')
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- Default to the left -->
            <strong>Copyright &copy; {{ now()->year }} <a href="#" target="_blank">Sussex Agency</a>.</strong> All rights reserved.
        </footer>

        <!-- /.modal -->
    </div>

    <!-- jQuery -->
    <script src="{{asset('js/app.js')}}"></script>

    <script>
        // $(function () {
        //     $('#example1').DataTable({
        //         "paging": true,
        //         "lengthChange": false,
        //         "searching": false,
        //         "ordering": true,
        //         "info": true,
        //         "autoWidth": false
        //     });
        //     $('.select1').select1();
        // });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>

    @if($errors->has('user_name') || $errors->has('user_email') || $errors->has('user_password') )
        <script>
            $(function() {
                $('#update_details').modal({
                    show: true
                });
            });
        </script>
    @endif
    @yield('custom-scripts')
</body>
</html>
