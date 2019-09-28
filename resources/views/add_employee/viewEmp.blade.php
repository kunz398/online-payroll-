@extends('layouts.app')
@section('style')
    <style>
        .card {
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

        button {
            border: none;
            outline: 0;
            display: inline-block;
            padding: 8px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }

        a {
            text-decoration: none;
            font-size: 22px;
            color: black;
        }

        button:hover, a:hover {
            opacity: 0.7;
        }
        #editEmp{
            overflow: unset;
            opacity: 1;

            height: 51%;
            max-width: 35%;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        {{--<h2 style="text-align:center">User Profile Card</h2>--}}
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <img src="{{asset('images/a.png')}}" alt="John" style="width:100%">
                    <h1>Name</h1>
                    <p class="title">Role</p>
                    <p>Email</p>
                    <div style="margin: 20px 0;">
                        <a href="#" id="clickEditIcon" data-toggle="tooltip" data-placement="top" title="Edit User"><i
                                    class="fas fa-edit"></i></a>
                        &nbsp; &nbsp;
                        <a href="#" data-toggle="tooltip" data-placement="top" title="Remove User"><i
                                    class="fas fa-user-times"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div id="editEmp" class="modal">
            <div class="modal-header"> Edit <span class="name_of_emp">__</span></div>
            <div class="modal-body">
                <form id="editFormEmp" method="POST">
                    @csrf
                    <div class="form-group row">

                        <label for="id"
                               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{__('text.id')}}</label>
                        <div class="col-md-6 col-6">
                            <input id="id" type="text" class="form-control" name="id" value="id" autocomplete="off" readonly>
                        </div>
                        <label for="name"
                               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{__('text.name')}}</label>
                        <div class="col-md-6 col-6">
                            <input id="name" type="text" class="form-control" name="id" value="name" autocomplete="off">
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="email"
                               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{__('text.email')}}</label>
                        <div class="col-md-6 col-6">
                            <input id="email" type="text" class="form-control" name="email" value="email" autocomplete="off">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <p>Date Registered: dd/mm/yyyy</p>
            </div>
        </div>

    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
        $('#clickEditIcon').on('click', function () {
            $("#editEmp").modal({
                fadeDuration: 200
            });
        });


    </script>
@endsection