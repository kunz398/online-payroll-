@extends('layouts.app')
@section('style')
    <style>
        #viewemp .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            max-width: 300px;
            margin: auto;
            text-align: center;
            font-family: arial;
        }

        .title {
            color: grey;
            font-size: 18px;
        }

        #viewemp a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        #editEmp, #deleteEmp {
            overflow: unset;
            opacity: 1;

            height: auto;
            /*max-width: 35%;*/
        }
    </style>
@endsection

@section('content')
    <div id="viewemp" class="container">
        {{--<h2 style="text-align:center">User Profile Card</h2>--}}
        @if(@$message !=NULL || @$message != '')
            <div class="alert alert-success" role="alert">
               {{$message}}
            </div>
        @endif
        <div class="row">

            @foreach($datas as $data)

                <div class="col-4">
                    <div class="card">
                        <img src="{{asset('images')}}/{{$data['picture']}}" alt="John" style="width:100%">
                        <h1>{{$data['name']}}</h1>
                        <p class="title">{{$data['role']}}</p>
                        <p>{{$data['email']}}</p>
                        <div style="margin: 20px 0;">
                            <a href="#" class="clickEditIcon" data-id="{{$data['id']}}" data-toggle="tooltip" data-placement="top"
                               title="Edit User"><i class="fas fa-edit"></i></a>
                            &nbsp; &nbsp;
                            <a href="#" class="clickDeleteIcon" data-id="{{$data['id']}}" data-email="{{$data['email']}}" data-toggle="tooltip" data-placement="top" title="Remove User"><i
                                        class="fas fa-user-times"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div id="editEmp" class="modal">
        <div class="modal-header"> Edit <span class="name_of_emp">{{$data['name']}}</span></div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <p>Date Registered: dd/mm/yyyy</p>
        </div>
    </div>

    <div id="deleteEmp" class="modal">
        <div class="modal-header"> Delete <span class="name_of_emp">{{$data['name']}}</span></div>
        <div class="modal-body">
            <button name="delete" id="delete" class="btn btn-danger" >Yes Delete</button>
            <button  name="cancel" id="cancel" class="btn btn-info" >No I Changed My Mind</button>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $('.clickEditIcon').on('click', function () {


            $("#editEmp").modal({
                fadeDuration: 200
            });
            let id = $(this).data("id");


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            /* Ajaxs*/
            $.ajax({
                url: "{{route('edit_emp')}}",
                method: 'POST',
                data: {
                    id: id
                },
                success: function (data) {
                    $(".modal-body").html(data);
                }
            });
        });

        $('.clickDeleteIcon').on('click', function () {


            $("#deleteEmp").modal({
                fadeDuration: 200
            });
            let id = $(this).data("id");
            let email = $(this).data("email");

            $('#delete').on('click', function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                /* Ajaxs*/
                $.ajax({
                    url: "{{route('delete_emp')}}",
                    method: 'POST',
                    data: {
                        id: id,
                        email:email
                    },
                    success: function (data) {

                    }
                });
            });
            $('#cancel').on('click', function () {
                $(".close-modal ").trigger('click');
            });




        });


    </script>
@endsection