@extends('layouts.main')

@section('content')


    <div class="row">
        
        <div class="col-md-12">
            @if(Auth::user()->type == 'Admin')
                <div class="row margin"  style="margin-left:0;padding-left:0">
                    <div class="col-sm-12 col-md-4 col-lg-3"  style="margin-left:0;padding-left:0">
                        <div class="fomr-group">
                            <label for="">Select User</label>
                            <select name="selected_user" id="selected_user" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            @else 
                <input type="hidden" id="selected_user" value="{{ Auth::user()->id }}">
            @endif
            <div id="table_holder">
                <div class="box box-primary">
                    <div class="overlay">
                        <i class=" fa fa-refresh fa-spin"></i>
                    </div>

                    <div class="box-header with-border">
                        <h3 class="box-title">Leaves</h3>
                    </div>
                    <div class="box-body">
                    </div>
                    <div class="box-footer">
                    </div>
                </div>
            </div>
        </div>
        
    </div>


@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script>
        $(function (){
            @if(Auth::user()->type == 'Admin')
                $('#selected_user').val('{{ Auth::user()->id }}');
            @endif
            fetch_record(1);
        })

        $('body').on('change', '#selected_user', function () {
            fetch_record(1);
        });

        $('body').on('click', '.delete-leave', function () {
            var id = $(this).data('id');
            
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then(function () {
                $.ajax({
                    url     : "{{ route('delete_leave') }}",
                    type    : 'POST',
                    data    : { _token : "{{ csrf_token() }}", id : id },
                    dataType    : 'json',
                    success : function (data) {
                        if(data['errRes'] == 0)
                        {
                            swal({
                                title: data['Msg'],
                                text: '',
                                type: 'success',
                                timer: 2000
                                }).then(
                                    function () {},
                                    // handling the promise rejection
                                    function (dismiss) {}
                                )
                                
                            fetch_record(1);
                        }
                        else if(data['errRes'] == 1)
                        {
                            //var retErrorMsg = data['errMsg']['id'];
                            
                            swal({
                                title: 'Invalid selection.',
                                text: '',
                                type: 'error',
                                timer: 2000
                                }).then(
                                    function () {},
                                    // handling the promise rejection
                                    function (dismiss) {}
                                )
                        }
                        else
                        {
                            swal({
                                title: data['errMsg'],
                                text: '',
                                type: 'error',
                                timer: 2000
                                }).then(
                                    function () {},
                                    // handling the promise rejection
                                    function (dismiss) {}
                                )
                        }
                    }
                })
            },
                function (dissmiss) {
                }
            )

            
        });

        function fetch_record(page){
            $('.overlay').removeClass('hidden');
            $.ajax({
                url     : "{{ route('leave_list') }}",
                type    : 'POST',
                data    : { _token : "{{ csrf_token() }}", page : page, user: $('#selected_user').val() },
                success : function (data) {
                    //alert(data);
                    $('#table_holder').empty().append(data);
                    $('.overlay').addClass('hidden');
                }
            });
        }
    </script>
@endsection