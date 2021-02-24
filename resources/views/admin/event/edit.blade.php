@extends('admin.master')

@section('title')
    <title>Sussex Agency | Event</title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Event ({{$event->name}})</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="modal-body">
                                <table class="table" style="font-size: 13px">
                                    <tr>
                                        <th >
                                            Event ID
                                        </th>
                                        <td>
                                            <b># {{$event->id}}</b>
                                        </td>
                                    </tr>
                                    <tr >
                                        <th style="padding-top: 50px">
                                            Event Name
                                        </th>
                                        <td style="padding-top: 50px">
                                            <B>{{$event->name}}</B>
                                        </td>
                                    </tr>
                                    <tr >
                                        <th>
                                            Event Fee
                                        </th>
                                        <td>
                                            <B>{{number_format($event->fee,2)}}</B>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Venue
                                        </th>
                                        <td>
                                                {{$event->venue}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Event Info
                                        </th>
                                        <td>
                                                {{$event->description}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>
                                            Date / Time
                                        </th>
                                        <td>
                                                {{$event->date}} / {{$event->time}}
                                        </td>
                                    </tr>
                                </table>
                                <div class="row" style="margin-top: 50px">
                                    <div class="col ">
                                        <div class="footert float-right">
                                            <a href="{{ route('event.download',$event->id) }}" type="button" class="btn btn-sm btn-warning" data-dismiss="modal"><i class="fas fa-download"></i> Download</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top: 50px">
                                    <div class="col">
                                        <div class="footert">
                                            <a href="{{ route('event.index') }}" type="button" class="btn btn-default" data-dismiss="modal">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Clients</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="min-height: 470px">
                            <table class="table" >
                                @foreach($clients as $client)
                                    <tr>
                                        <th width="30" height="40" ><b>
                                                @if($client->confirmation)
                                                    <i style="color: #00b44e;font-size: 12px" class="fas fa-check"></i>
                                                @else
                                                    <i style="color: #ae1c17;font-size: 12px" class="fas fa-exclamation"></i>
                                                @endif
                                            </b></th>
                                        <td>{{\App\Client::findOrFail($client->client_id)->first_name}} {{\App\Client::findOrFail($client->client_id)->last_name}}</td>
                                        <td>
                                            @role('client_agent')
                                                @if(!$client->confirmation)
                                                    <a href="{{route('event.accept',$client->id)}}" class="btn btn-sm btn-success"  title="Accept"><i class="fas fa-check"></i> Accept</a>
                                                @endif
                                            @endrole
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection

