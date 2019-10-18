@extends('layouts.app')
@section('style')
    <style>

    </style>
@endsection

@section('content')
    <div class="container">
        @if(@$type == "emp")
            <div class="row">
                <div class="col-4">
                    <a class="custom-link"  href="{{route('pay.view')}}"><div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <h5 class="card-title"><i class="fab fa-cc-amazon-pay fa-2x"></i></h5>
                                <p class="card-text"> {{__('text.view')}} {{__('text.pay_slip')}}.</p>
                            </div>
                        </div>
                    </a>
                </div>


            </div>
        @else
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
        @endif

            <form>
                <h1 class="text-monospace">FeedBack</h1>
                <div class="input-group">

                    <textarea type="text" class="form-control"> </textarea>
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </div>
                </div>
            </form>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        validationForm('myCheckBoxes', 'myCheckBoxesMsg', "required",'checkbox',false)
    </script>
@endsection