@extends('layouts.app')
@section('style')
    <style>

    </style>
@endsection

@section('content')
    @if(@$message !=NULL || @$message != '')
        <div class="alert alert-success" role="alert">
            {{$message}}
        </div>
    @endif
    <form method="POST" action="{{route('post.week.starts')}}">
        @csrf
        <div class="form-group row">
            <label for="startson"
                   class="col-md-4 col-form-label text-md-right">{{__('text.week')}} {{__('text.starts')}} {{__('text.on')}}</label>
            <div class="col-md-6">
                <select id="startson" name="startson" class="browser-default custom-select">
                    <option value="Monday">{{__('text.Monday')}}</option>
                    <option value="Tuesday">{{__('text.Tuesday')}}</option>
                    <option value="Wednesday">{{__('text.Wednesday')}}</option>
                    <option value="Thursday">{{__('text.Thursday')}}</option>
                    <option value="Friday">{{__('text.Friday')}}</option>
                    <option value="Saturday">{{__('text.Saturday')}}</option>
                    <option value="Sunday">{{__('text.Sunday')}}</option>
                </select>
            </div>
            <button class="btn btn-outline-primary hvr-rotate" type="submit">Submit</button>
        </div>

        <div class="form-group row">
            <label for="amount"
                   class="col-md-4 col-form-label text-md-right">Normal Hours for {{__('text.Monday')}}</label>
            <div class="col-md-6">
                <input class="form-control" type="text" value="" name="hours_monday" autocomplete="off">
            </div>
        </div>

        <div class="form-group row">
            <label for="amount"
                   class="col-md-4 col-form-label text-md-right">Normal Hours for {{__('text.Tuesday')}}</label>
            <div class="col-md-6">
                <input class="form-control" type="text" value="" name="hours_tuesday" autocomplete="off">
            </div>
        </div>

        <div class="form-group row">
            <label for="amount"
                   class="col-md-4 col-form-label text-md-right">Normal Hours for {{__('text.Wednesday')}}</label>
            <div class="col-md-6">
                <input class="form-control" type="text" value="" name="hourse_wend" autocomplete="off">
            </div>
        </div>

        <div class="form-group row">
            <label for="amount"
                   class="col-md-4 col-form-label text-md-right">Normal Hours for {{__('text.Thursday')}}</label>
            <div class="col-md-6">
                <input class="form-control" type="text" value="" name="hourse_thursday" autocomplete="off">
            </div>
        </div>

        <div class="form-group row">
            <label for="amount"
                   class="col-md-4 col-form-label text-md-right">Normal Hours for {{__('text.Friday')}}</label>
            <div class="col-md-6">
                <input class="form-control" type="text" value="" name="hourse_friday" autocomplete="off">
            </div>
        </div>

        <div class="form-group row">
            <label for="amount"
                   class="col-md-4 col-form-label text-md-right">Normal Hours for {{__('text.Saturday')}}</label>
            <div class="col-md-6">
                <input class="form-control" type="text" value="" name="hourse_saturday" autocomplete="off">
            </div>
        </div>


        <div class="form-group row">
            <label for="amount"
                   class="col-md-4 col-form-label text-md-right">Normal Hours for {{__('text.Sunday')}}</label>
            <div class="col-md-6">
                <input class="form-control" type="text" value="" name="hourse_sunday" autocomplete="off">
            </div>

        </div>
    </form>


@endsection

@section('script')
    <script type="text/javascript">

    </script>
@endsection