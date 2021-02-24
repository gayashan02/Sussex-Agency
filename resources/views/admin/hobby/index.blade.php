@extends('admin.master')

@section('title')
    <title>Sussex Agency | Hobbies</title>
@endsection

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card" style="margin-top: 30px">
                        <div class="card-header">
                            <h3 class="card-title" style="margin-top: 10px">Hobbies</h3>
                            <div class="float-right" style="margin-top: 10px">
                                <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#create" title="Create Hobby"><i class="fas fa-user-plus"></i> Create</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th style="width: 80px">ID</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th style="width: 90px">Action</th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                        <?php  $i = 1; ?>
                                        @foreach($hobbies as $hobby)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$hobby->name}}</td>
                                                <td>{{$hobby->desctription}}</td>

                                                <td>
                                                    @role('receptionist' )
                                                        <button class="btn btn-danger btn-sm" data-hobbyid="{{$hobby->id}}" data-toggle="modal" data-target="#delete"><i class="fa fa-trash" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></button>
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

    <!--create modal-->
    <div class="modal fade" id="create">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create hobby</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form action="{{route('hobby.store')}}" method="post" id="myform" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="Post Title">{{ __('Hobby Name') }}<span class="required">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"  placeholder="Hobby name">
                                    @error('name')
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
                                    <label for="Post Title">{{ __('Description') }}</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="float-right" style="margin-bottom: 20px">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
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
        <div class="modal-dialog modal-confirm">
            <div class="modal-content" style="padding: 30px">
                <div class="modal-header">
                    <h1>Are you Sure ?</h1>
                </div>


                <form action="{{ route('hobby.destroy', '0') }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE')}}
                    <div class="modal-body">
                        <input type="hidden" name="hobby_id" value="" id="hobby_id">
                        <p>Do you really want to delete these records? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer"></div>
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
    @if($errors->has('name') )
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
            var id = button.data('hobbyid');
            console.log(id);
            var modal = $(this)
            modal.find('#hobby_id').val(id);
        });
    </script>
    <script>
        $(document).ready( function () {
            $('#example1').DataTable();
        } );
    </script>
@endsection
