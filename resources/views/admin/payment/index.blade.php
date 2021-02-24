@extends('admin.master')

@section('title')
    <title>Sussex Agency | Payments</title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-top: 10px">Payments</h3>
                            <div class="float-right" style="margin-top: 10px">
                                <a href="{{route('payment.summary')}}" class="btn btn-warning btn-sm" title="Create Supplier"><i class="fas fa-download"></i> Quarterly Report</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped" style="text-align: center">
                                    <thead>
                                    <tr>
                                        <th style="width: 80px">ID</th>
                                        <th>Client</th>
                                        <th>Date/Time</th>
                                        <th>Type</th>
                                        <th style="text-align: center">Amount</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php  $i = 1; ?>
                                        @foreach($payments as $payment)
                                            <tr>
                                                <td>{{$payment->id}}</td>
                                                <td>{{\App\Client::findOrFail($payment->client)->first_name}} {{\App\Client::findOrFail($payment->client)->last_name}}</td>
                                                <td>{{$payment->date}} / {{$payment->time}}</td>
                                                <td>
                                                    @if($payment->type == "cash")
                                                        <span class="badge badge-pill bg-success">Cash</span>
                                                    @else
                                                        <span class="badge badge-pill bg-danger">Card</span>
                                                    @endif
                                                </td>
                                                <td style="text-align: right"><b>&#8364 {{number_format($payment->amount,2)}}</b> </td>
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
