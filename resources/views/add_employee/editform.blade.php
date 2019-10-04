@foreach($datas as $data)
<form id="editFormEmp" method="POST" action="{{route('update_emp')}}">
    @csrf
    <div class="row">
        <div class="mb-2 col-12 col-md-6">
            <label for="emp_id" class="col-form-label">{{__('text.id')}}</label>
            <input type="text" name="emp_id" id="emp_id" placeholder="" class="form-control"
                   autocomplete="off" readonly value="{{$data['id']}}">
        </div>

        <div class="mb-2 col-12 col-md-6">
            <label for="emp_name" class="col-form-label">{{__('text.name')}}</label>
            <input type="text" name="emp_name" id="emp_name" placeholder="" class="form-control" value="{{$data['name']}}">
            <input type="text" name="Actual_emp_name" id="Actual_emp_name" placeholder="" class="form-control" value="{{$data['name']}}" hidden>
        </div>

        <div class="mb-2 col-12 col-md-6">
            <label for="emp_email" class="col-form-label">{{__('text.email')}}</label>
            <input type="text" name="emp_email" id="emp_email" placeholder="" class="form-control" value="{{$data['email']}}">
        </div>

        <div class="mb-2 col-12 col-md-6">
            <label for="emp_role" class="col-form-label">{{__('text.role')}}</label>
            <input type="text" name="emp_role" id="emp_role" placeholder="" class="form-control"  value="{{$data['role']}}">
        </div>

        <div class="mb-2 col-12 col-md-6">
            <label for="emp_pay_cycle"
                   class="col-form-label">{{__('text.pay')}} {{__('text.cycle')}}</label>
            <input type="text" name="emp_pay_cycle" id="emp_pay_cycle" placeholder="" class="form-control"  value="{{$data['pay_cycle']}}" >
        </div>

        <div class="mb-2 col-12 col-md-6">
            <label for="emp_gross_pay"
                   class="col-form-label">{{__('text.gross')}} {{__('text.pay')}}</label>
            <input type="text" name="emp_gross_pay" id="emp_gross_pay" placeholder="" class="form-control" value="{{$data['gross_pay']}}">
        </div>

        <div class="mb-2 col-12 col-md-6">
            <label for="emp_rate" class="col-form-label">{{__('text.rate')}}</label>
            <input type="text" name="emp_rate" id="emp_rate" placeholder="" class="form-control" value="{{$data['rate']}}">
        </div>

    </div><!-- row -->

    <div class="row">
        <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="emp_details_update"
                    id="emp_details_update">{{__('text.update')}}</button>
        </div>
    </div>
</form>
@endforeach