@extends('admin.master')

@section('title')
    <title>Sussex Agency | Event</title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Registered Events</b>
                            <div class="float-right">
                                @role('client_agent')
                                <a href="{{route('event.create')}}" class="btn btn-sm" style="background-color: #da4a0d;color: #fff" title="Create"><i class="fas fa-plus-circle"></i> Create</a>
                                @endrole
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr style="text-align: center">
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Venue</th>
                                        <th>Time</th>
                                        <th>Date</th>
                                        <th style="width: 150px">Accept Bookings</th>
                                        <th style="width: 70px">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php  $i = 1; ?>
                                        @foreach($events as $event)
                                            <tr style="text-align: center">
                                                <td>{{$i++}}</td>
                                                <td>{{$event->name}}</td>
                                                <td>{{$event->venue}}</td>
                                                <td>{{$event->time}}</td>
                                                <td>{{$event->date}}</td>
                                                <td >{{\App\ClientEvent::where('event_id','=',$event->id)->where('confirmation','=',true)->count()}}</td>
                                                <td>
                                                    <a href="{{route('event.show', $event->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="View"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                    @role('receptionist')
                                                    <button class="btn btn-danger btn-sm" data-eventid="{{$event->id}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></button>
                                                    @endrole
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </div>

@endsection
@section('custom-scripts')
    <script>
        $(document).ready( function () {
            $('#example1').DataTable();
        } );

    </script>
@endsection
