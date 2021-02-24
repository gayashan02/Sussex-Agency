@extends('admin.master')

@section('title')
    <title>Sussex Agency | Dashboard</title>
@endsection

@section('content')
    <div class="container">

        <div class="row" style="margin-top: 30px">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{\App\Client::where('status','=',true)->count()}}</h3>
                        <p>Clients</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer"><small style="opacity: 0.5;">More info</small></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{\App\Event::count()}}</h3>
                        <p>Events</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <a href="#" class="small-box-footer"><small style="opacity: 0.5;">More info</small></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{\App\Hobby::where('status','=',true)->count()}}</h3>
                        <p>Hobbies</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-magic"></i>
                    </div>
                    <a href="#" class="small-box-footer"><small style="opacity: 0.5;">More info</small></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>&#8364 {{number_format(\App\Payment::sum('amount'),2)}}</h3>
                        <p>Income</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <a href="#" class="small-box-footer"><small style="opacity: 0.5;">More info</small></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

    </div>
@endsection

