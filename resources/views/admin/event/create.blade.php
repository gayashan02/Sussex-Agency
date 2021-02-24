@extends('admin.master')

@section('title')
    <title>Sussex Agency | Event</title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <form action="{{route('event.store')}}" method="post" id="myform">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-6">
                        <div class="card" style="margin-top: 30px">
                            <div class="card-header">
                                <b>Create Event</b>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="Post Title">{{ __('Description') }}<span class="required">*</span></label>
                                                    <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Type the description. Then clients will match automatically . . ." rows="5">{{ old('description') }}</textarea>
                                                    @error('description')
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
                                                    <label for="Post Title">{{ __('Event Name') }}<span class="required">*</span></label>
                                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Event Name" value="{{ old('name')." "}}">
                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Post Title">{{ __('Venue') }}<span class="required">*</span></label>
                                                    <input type="text" class="form-control @error('venue') is-invalid @enderror" name="venue"  placeholder="Venue" value="{{ old('venue') }}">
                                                    @error('venue')
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
                                                    <label for="Post Title">{{ __('Date') }}<span class="required">*</span></label>
                                                    <input type="date" class="form-control @error('date') is-invalid @enderror" name="date"  placeholder="Event Date" value="{{ old('date')}}">
                                                    @error('date')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Post Title">{{ __('Time') }}<span class="required">*</span></label>
                                                    <input type="time" class="form-control @error('time') is-invalid @enderror" name="time"  placeholder="Time" value="{{ old('time') }}">
                                                    @error('time')
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
                                                    <label for="Post Title">{{ __('Event Fee') }} (&#8364)<span class="required">*</span></label>
                                                    <input type="number" class="form-control @error('fee') is-invalid @enderror" name="fee"  placeholder="Event Fee" value="{{ old('fee') }}">
                                                    @error('fee')
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
                                                    <button type="submit" class="btn" style="background-color: #da4a0d;color: #fff">Save</button>
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
                                <b>Matched Clients</b>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table" id="clients">

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
            <!-- /.row -->
        </div>
    </div>
@endsection
@section('custom-scripts')
    @if($errors->has('name') || $errors->has('contact') || $errors->has('address') || $errors->has('com_name') ||$errors->has('email') || $errors->has('password')|| $errors->has('password_confirmation'))
        <script>
            $(function() {
                $('#create').modal({
                    show: true
                });
            });
        </script>
    @endif
    <script>
        $( document ).ready(function() {
            var value = $("#description").val();
            $.ajax({
                url:"{{ route('event.hobby_match') }}",
                method: "get",
                data: {text:value},
                datatype: "json",
                success:function (data) {
                    $('#clients').html(data.html);
                }
            });
        });
        $("#description").on("keyup", function() {
            var value = $(this).val();
            $.ajax({
                url:"{{ route('event.hobby_match') }}",
                method: "get",
                data: {text:value},
                datatype: "json",
                success:function (data) {
                    $('#clients').html(data.html);
                }
            });
        });
    </script>
@endsection
