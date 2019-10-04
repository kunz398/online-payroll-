@extends('layouts.app')
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-4">

             <a class="custom-link"  href="{{route('add_emp')}}"><div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                    <div class="card-header">{{__('text.add')}} {{__('text.emps')}}</div>
                    <div class="card-body">
                        <h5 class="card-title"><i class="text-dark fas fa-user-plus fa-2x"></i></h5>
                        <p class="card-text">{{__('text.add')}} {{__('text.new')}} {{__('text.emp')}}.</p>
                    </div>
                </div>
             </a>
            </div>

            <div class="col-4">
                <a class="custom-link"  href="{{route('view_emp')}}"><div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                        <div class="card-header">{{__('text.view')}} {{__('text.emp')}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="text-dark far fa-address-book fa-2x"></i></h5>
                            <p class="card-text">{{__('text.view')}} {{__('text.current')}} {{__('text.registered')}} {{__('text.emps')}}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-4">
                <a class="custom-link"  href="{{route('index.calc')}}"><div class="card text-white mb-3" style="max-width: 18rem; background: #e4615d;">
                        <div class="card-header">{{__('text.calc')}} {{__('text.pay')}}</div>
                        <div class="card-body">
                            <h5 class="card-title"><i class="text-dark fas fa-calculator fa-2x"></i></h5>
                            <p class="card-text">{{__('text.calc')}} {{__('text.emps')}} {{__('text.pay')}} </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        validationForm('myCheckBoxes', 'myCheckBoxesMsg', "required",'checkbox',false)
    </script>
@endsection