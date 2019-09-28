@extends('layouts.app')
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center material_pink">{{ __('text.add') }} {{__('text.deduction')}}</div>

                    <div class="card-body">

                        <form id="deductionForm" method="POST" action="{{route('updateDeduction')}}">
                            @csrf
                            @forelse ($results as $result)
                                <div class="alert alert-light text-xl-center" role="alert">
                                    <strong class="">{{__('text.deduction')}} {{__('text.name')}}</strong> {{$result->name}}
                                </div>
                                <input class="form-control" type="text" value="{{$result->id}}" name="id[]" readonly hidden>

                                <div class="form-group row">
                                    <label for="type"
                                           class="col-md-4 col-form-label text-md-right">{{__('text.deduction')}} {{__('text.type')}}</label>
                                    <div class="col-md-6">
                                        <select id="type" class="form-control" name="type[]">
                                            <option value="%" @if($result->type == '%') selected @endif>%</option>
                                            <option value="$" @if($result->type == '$') selected @endif>$$</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="amount"
                                           class="col-md-4 col-form-label text-md-right">{{__('text.deduction')}} {{__('text.amount')}}</label>
                                    <div class="col-md-6">
                                        <input class="form-control" type="text" value="{{$result->amount}}" name="amount[]" autocomplete="off">
                                    </div>
                                </div>
                            @empty
                                <p>No Deduction</p>
                            @endforelse
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button id="" type="submit" name="submit" class="btn btn-outline-success" >
                                        {{__('text.add')}} {{__('text.deduction')}}
                                    </button>
                                    <br/>
                                </div>
                            </div>

                        </form>
                        <div class="container">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <i class="fas fa-exclamation-triangle"></i>
                                            {{ $error }} <br />
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script type="text/javascript">

    </script>
@endsection