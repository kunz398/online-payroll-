@extends('layouts.app')
@section('style')
    <style>
        .weekDays-selector input[type=checkbox] {
            display: none!important;
        }

        .weekDays-selector input[type=checkbox] + label {
            /* display: inline-block; */
            border-radius: 6px;
            background: #dddddd;
            /* height: 40px; */
            width: 80px;
            margin-right: 10px;
            line-height: 40px;
            text-align: center;
            cursor: pointer;
        }

        .weekDays-selector input[type=checkbox]:checked + label {
            background: #f06292;
            color: #ffffff;
        }
        .hrsworked {

            width: 80px;
            margin-right: 10px;
            line-height: 40px;

        }

        .btn-outline-primary{
            color: #b39ddb;
            border-color: #b39ddb;
        }
        .btn-outline-primary:hover{
            background-color: #b39ddb!important;
            border-color: #b39ddb!important;
        }

        .btn-outline-primary:not(:disabled):not(.disabled):active, .btn-outline-primary:not(:disabled):not(.disabled).active, .show > .btn-outline-primary.dropdown-toggle{
            background-color: #b39ddb;
            border-color: #b39ddb;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @foreach($datas as $data)

            <div class="row">
                <div class="col-12">
                    <div class="shadow-lg p-3 bg-white rounded text-center text-monospace">{{$data['email']}}</div>
                    @if( $data['pay_cycle'] == "forthrightly")
                        <?php $size = 2; ?>
                    @elseif($data['pay_cycle'] =="monthly")
                        <?php $size = 4; ?>
                    @elseif($data['pay_cycle'] =="weekly")
                        <?php $size = 1; ?>
                    @endif
                    @for($i = 0; $i < $size; $i++)
                        <div class="weekDays-selector p-5">
                            <div class="row">
                                <input type="checkbox" name="{{$data['id']}}_week:{{$i}}" value="mon:{{$data['id']}}_week:{{$i}}" id="weekday-mon{{$data['id']}}_week:{{$i}}" class="weekday" />
                                <label for="weekday-mon{{$data['id']}}_week:{{$i}}">Monday</label>

                                <input type="checkbox" name="{{$data['id']}}_week:{{$i}}" value="tue:{{$data['id']}}_week:{{$i}}" id="weekday-tue{{$data['id']}}_week:{{$i}}" class="weekday" />
                                <label for="weekday-tue{{$data['id']}}_week:{{$i}}">Tuesday</label>

                                <input type="checkbox" name="{{$data['id']}}_week:{{$i}}" value="wed:{{$data['id']}}_week:{{$i}}" id="weekday-wed{{$data['id']}}_week:{{$i}}" class="weekday" />
                                <label for="weekday-wed{{$data['id']}}_week:{{$i}}">Wednesday</label>

                                <input type="checkbox" name="{{$data['id']}}_week:{{$i}}" value="thu:{{$data['id']}}_week:{{$i}}" id="weekday-thu{{$data['id']}}_week:{{$i}}" class="weekday" />
                                <label for="weekday-thu{{$data['id']}}_week:{{$i}}">Thursday</label>

                                <input type="checkbox" name="{{$data['id']}}_week:{{$i}}" value="fri:{{$data['id']}}_week:{{$i}}" id="weekday-fri{{$data['id']}}_week:{{$i}}" class="weekday" />
                                <label for="weekday-fri{{$data['id']}}_week:{{$i}}">Friday</label>

                                <input type="checkbox" name="{{$data['id']}}_week:{{$i}}" value="sat:{{$data['id']}}_week:{{$i}}" id="weekday-sat{{$data['id']}}_week:{{$i}}" class="weekday" />
                                <label for="weekday-sat{{$data['id']}}_week:{{$i}}">Saturday</label>

                                <input type="checkbox" name="{{$data['id']}}_week:{{$i}}" value="sun:{{$data['id']}}_week:{{$i}}" id="weekday-sun{{$data['id']}}_week:{{$i}}" class="weekday" />
                                <label for="weekday-sun{{$data['id']}}_week:{{$i}}">Sunday</label>
                            </div>

                            <div class="row">
                                <input type="text" name="mon" data-hrsofdays="mon_week:{{$i}}" id="hrs" placeholder="" class="hrsworked" value="">

                                <input type="text" name="tue" data-hrsofdays="tue_week:{{$i}}"  id="hrs" placeholder="" class="hrsworked" value="">

                                <input type="text" name="wed" data-hrsofdays="wed_week:{{$i}}"  id="hrs" placeholder="" class="hrsworked" value="">

                                <input type="text" name="thu" data-hrsofdays="thu_week:{{$i}}"  id="hrs" placeholder="" class="hrsworked" value="">

                                <input type="text" name="fri" data-hrsofdays="fri_week:{{$i}}"  id="hrs" placeholder="" class="hrsworked" value="">

                                <input type="text" name="sat" data-hrsofdays="sat_week:{{$i}}"  id="hrs" placeholder="" class="hrsworked" value="">

                                <input type="text" name="sun" data-hrsofdays="sun_week:{{$i}}"  id="hrs" placeholder="" class="hrsworked" value="">
                            </div>
                            <small style="position: absolute;bottom: 21px;left: 24%;">Hours Worked!</small>
                        </div>
                        @endfor
                </div>
            </div>
        @endforeach
        <center>
            <button class="btn btn-outline-primary hvr-curl-bottom-left" id="genePay">Generate Pay</button>
        </center>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $('#genePay').on('click',  function() {
            var daysCheckedByUsers = [];
            var hoursInputedByUsers = [];
            $.each($("input[class='weekday']:checked"), function(){
                daysCheckedByUsers.push($(this).val());
            });
            $(".hrsworked").each(function() {
                    hoursInputedByUsers.push($(this).data('hrsofdays'));
                    hoursInputedByUsers.push($(this).val());
                    hoursInputedByUsers.push("\n");
            });
            console.log(hoursInputedByUsers);

        });
    </script>
@endsection