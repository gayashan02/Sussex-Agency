@extends('admin.master')

@section('title')
    <title>Sussex Agency | Client</title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Update {{$client->first_name}} {{$client->last_name}}</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('client.update',$client->id)}}" method="post" id="myform">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('First Name') }}<span class="required">*</span></label>
                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"  placeholder="First Name" value="{{ $client->first_name }}">
                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('Last Name') }}<span class="required">*</span></label>
                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"  placeholder="Last Name" value="{{ $client->last_name }}">
                                                @error('last_name')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('Contact Number') }}<span class="required">*</span></label>
                                                <input type="number" class="form-control @error('contact') is-invalid @enderror" name="contact"   placeholder="Contact Number" value="{{ $client->contact }}">
                                                @error('contact')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('Email') }}<span class="required">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"   placeholder="Email" value="{{ $client->email}}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('Address') }}<span class="required">*</span></label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" rows="3">{{ $client->address }}</textarea>
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="footer float-right">
                                                <a href="{{ route('client.index') }}" type="button" class="btn btn-default" data-dismiss="modal">Back</a>
                                                @role('receptionist')
                                                    <button type="submit" class="btn" style="background-color: #da4a0d;color: #fff">Update</button>
                                                @endrole
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    @role('receptionist')
                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Update Hobbies</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table border="0" style="font-size: 16px">
                                <?php $i=1;
                                    $client_hobbies = \App\ClientHobby::where('client_id','=',$client->id)->get();
                                    ?>
                                @foreach($client_hobbies as $client_hobby)
                                    <tr>
                                        <th width="30" height="40" style="color: #00b44e;font-size: 12px"><b><i class="fas fa-check"></i></b></th>
                                        <td>{{\App\Hobby::findOrFail($client_hobby->hobby_id)->name}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    @endrole
                    @role('client_agent')
                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Update Hobbies</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{route('client.assign_hobbies',$client->id)}}" method="post" id="myform">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div style="height:300px;">
                                        <div class="row">
                                            @foreach($hobbies as $hobby)
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="hobbies[]" value="{{$hobby->id}}" @if(\App\ClientHobby::where('hobby_id','=',$hobby->id)->where('client_id','=',$client->id)->count()!= 0) checked @endif>
                                                        <label class="form-check-label" for="defaultCheck1">
                                                            {{$hobby->name}}
                                                        </label>
                                                    </div>
                                                    <br/>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="footer float-right">
                                                <button type="submit" class="btn" style="background-color: #da4a0d;color: #fff">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @endrole
                    @role('financial_manager')
                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Payments</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <table class="table table-borderless" style="font-size: 13px">
                                        <tr>
                                            <th>
                                                Subscription Fee
                                            </th>
                                            <td style="text-align: right">
                                                <?php
                                                    $payment_count = \App\Payment::where('client','=',$client->id)->sum('months');
                                                    $reg_date = $client->created_at;
                                                    $last_payed = date('Y-m-d', strtotime("+".$payment_count." months", strtotime($reg_date)));
                                                    $ts1 = strtotime($last_payed);
                                                    $ts2 = strtotime(date('Y-m-d'));

                                                    $year1 = date('Y', $ts1);
                                                    $year2 = date('Y', $ts2);

                                                    $month1 = date('m', $ts1);
                                                    $month2 = date('m', $ts2);

                                                    $day1 = date('d', $ts1);
                                                    $day2 = date('d', $ts2);
                                                    $diff = (($year2 - $year1) * 365) + (($month2 - $month1)*30) + ($day2 - $day1);
                                                    $total = 0;
                                                    $months = 1;
                                                ?>
                                                <b> &#8364;
                                                    @if($diff <= 0)
                                                        {{number_format(0.0,2)}}
                                                    @elseif($diff <= 30)
                                                        @if($client->type == "local")
                                                            {{number_format(12,2)}}
                                                            <?php $total += 12; ?>
                                                        @else
                                                            {{number_format(5,2)}}
                                                            <?php $total += 5; ?>
                                                        @endif
                                                    @else
                                                        <?php $months = (round($diff/30)+1); ?>
                                                        @if($client->type == "local")
                                                            {{number_format((floor($diff/30)+1)*12,2)}}
                                                            <?php $total += (floor($diff/30)+1)*12; ?>
                                                        @else
                                                            {{number_format((floor($diff/30)+1)*5,2)}}
                                                            <?php $total += (floor($diff/30)+1)*5; ?>
                                                        @endif
                                                    @endif
                                                </b>
                                            </td>
                                        </tr>
                                        @if($diff > 30)
                                        <tr>
                                            <td colspan="2">
                                                <span class="badge badge-pill bg-danger">
                                                    Payment overdue
                                                </span>
                                            </td>
                                        </tr>
                                        @endif
                                        <?php $events = \App\ClientEvent::where('client_id','=',$client->id)->where('confirmation','=',true)->where('payment','=',false)->get(); ?>
                                        @foreach($events as $event)
                                            <tr>
                                                <?php $eve = \App\Event::findOrFail($event->event_id); ?>
                                                <th>
                                                    <b>{{$eve->name}}</b>
                                                </th>
                                                <td style="text-align: right">
                                                    <b>&#8364; {{number_format($eve->fee,2)}}</b>
                                                    <?php $total += $eve->fee; ?>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr style="font-size: 18px">
                                            <th>
                                                <b>Total</b>
                                            </th>
                                            <td style="text-align: right">
                                                <b>&#8364; {{number_format($total,2)}}</b>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <form action="{{route('payment.store')}}" method="post" id="myform">
                                {{ csrf_field() }}
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5>Payment Type</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="radio" name="type" value="cash" checked/>
                                            <label style="margin-left: 30px"><i class="icon fas fa-coins"></i> Cash</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="radio" name="type" value="card" @if(old('type') == 'card') checked @endif/>
                                            <label style="margin-left: 30px"><i class="icon fas fa-credit-card"></i> Card</label>
                                        </div>
                                    </div>
                                    <hr/>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('Card Holder\'s Name') }}<span class="required">*</span></label>
                                                <input type="hidden" name="total" value="{{$total}}"/>
                                                <input type="hidden" name="id" value="{{$client->id}}"/>
                                                <input type="hidden" name="months" value="{{$months}}"/>
                                                <input type="text" class="form-control @error('card_name') is-invalid @enderror" name="card_name"  placeholder="Card Holder's Name" value="{{ old('card_name') }}">
                                                @error('card_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('Card Number') }}<span class="required">*</span></label>
                                                <input type="number" class="form-control @error('card_no') is-invalid @enderror" name="card_no" data-inputmask="'mask': '9999 9999 9999 9999'" placeholder="Card Number" value="{{ old('card_no') }}">
                                                @error('card_no')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('Expiry Date') }}<span class="required">*</span></label>
                                                <input type="text" class="form-control @error('expiry_date') is-invalid @enderror" name="expiry_date"  placeholder="mm/yy" value="{{ old('expiry_date') }}">
                                                @error('expiry_date')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="Post Title">{{ __('CVS') }}<span class="required">*</span></label>
                                                <input type="number" class="form-control @error('CVS') is-invalid @enderror" name="CVS"  placeholder="CVS" value="{{ old('CVS') }}">
                                                @error('CVS')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="footer float-right">
                                                <button type="submit" class="btn" @if($total == 0) disabled @endif style="background-color: #da4a0d;color: #fff">Pay the Bill</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @endrole

                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
    </script>
@endsection
