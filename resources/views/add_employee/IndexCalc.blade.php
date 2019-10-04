@extends('layouts.app')
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <form method="post" action="{{route('post.calc.pick.user')}}">
            @csrf
            @foreach($datas as $data)
            <div class="custom-control custom-checkbox p-2">
                <input type="checkbox" class="custom-control-input" name="{{$data['id']}}" id="emp_{{$data['id']}}">

                <label class="custom-control-label" for="emp_{{$data['id']}}">
                    <img src="{{asset('images')}}/{{$data['picture']}}" class="rounded-circle"
                         style="width: 74px; height: 57px;"
                    />
                    <span class="text-monospace">
                        {{$data['email']}}
                    </span>

                </label>
            </div>
            @endforeach
            <button type="submit" class="btn btn-outline-success"><i class="fas fa-infinity"></i> {{__('text.calc')}} {{__('text.pay')}}</button>
        </form>

    </div>
@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection