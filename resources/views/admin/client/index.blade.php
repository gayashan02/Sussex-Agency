@extends('admin.master')

@section('title')
    <title>Sussex Agency | Clients</title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <b>Registered Clients</b>
                            <div class="float-right">
                                @role('receptionist')
                                <a href="" class="btn btn-sm" style="background-color: #da4a0d;color: #fff" data-toggle="modal" data-target="#create" title="Create"><i class="fas fa-user-plus"></i> Create</a>
                                @endrole
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th style="min-width: 70px">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php  $i = 1; ?>
                                        @foreach($clients as $client)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$client->first_name}}</td>
                                                <td>{{$client->last_name}}</td>
                                                <td>{{$client->email}}</td>
                                                <td>{{$client->contact}}</td>
                                                <td>
                                                    <a href="{{route('client.edit', $client->id)}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="View"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
                                                    @role('receptionist')
                                                    <button class="btn btn-danger btn-sm" data-clientid="{{$client->id}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></button>
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

    <!--create client modal-->
    <div class="modal fade " id="create">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #da4a0d;color: #fff">
                    <b>Create Client</b>
                    <button type="button" class="close" data-dismiss="modal"  style="color: #fff;outline: none !important;"  aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('client.store')}}" method="post" id="myform">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Post Title">{{ __('First Name') }}<span class="required">*</span></label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name"  placeholder="First Name" value="{{ old('first_name') }}">
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
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name"  placeholder="Last Name" value="{{ old('last_name') }}">
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
                                    <input type="number" class="form-control @error('contact') is-invalid @enderror" name="contact"   placeholder="Contact Number" value="{{ old('contact') }}">
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
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"   placeholder="Email" value="{{ old('email') }}">
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
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Address" rows="3">{{ old('address') }}</textarea>
                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background-color: #da4a0d;color: #fff">Add</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- delete modal -->
    <div id="delete" class="modal fade" >
        <div class="modal-dialog modal-confirm"  style="width: 450px;margin-top: 100px ">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header">
                    <i class="fa fa-trash-o" style="font-size:80px;color:red;margin-left: auto;margin-right: auto;margin-bottom: 20px"></i>
                </div>
                <form action="{{ route('client.destroy', '0') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE')}}
                    <div class="modal-body">
                        <input type="hidden" name="client_id" value="" id="client_id">
                        <h2 style="margin-bottom: 10px"><b>Are you Sure ?</b></h2>
                        <p style="font-size: 14px;text-align: center">Do you really want to delete this record? This process cannot be undone.</p>
                    </div>
                    <div class="row justify-content-md-center">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>&nbsp;&nbsp;
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    @if($errors->has('email') || $errors->has('first_name') || $errors->has('last_name') || $errors->has('contact') || $errors->has('address'))
        <script>
            $(function() {
                $('#create').modal({
                    show: true
                });
            });
        </script>
    @endif
    <script>
        $('#delete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id = button.data('clientid');
            console.log(id);
            var modal = $(this)
            modal.find('#client_id').val(id);
        });
    </script>
    <script>
        $(document).ready( function () {
            $('#example1').DataTable();
        } );
    </script>
@endsection
