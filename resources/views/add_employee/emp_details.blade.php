<form id="add_emp_details" method="POST">
    @csrf
    <div class="form-group row">
        <label for="email"
               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{__('E-Mail Address')}}</label>
        <div class="col-md-6">
            <input id="disabledEmail" type="text" class="form-control" name="disabledEmail" value="" autocomplete="off"
                   style="background-color: #9E9E9E;" readonly>
        </div>
    </div>

    <div class="form-group row">
        <label for="role"
               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{ __('text.emp_role') }}</label>
        <div class="col-md-6">
            <input id="role" type="text" class="form-control" name="role" value="" autocomplete="off">
            <strong id="role_msg"></strong>
        </div>
    </div>

    <div class="form-group row">
        <label for="empProfilePic"
               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{ __('text.pic') }}</label>
        <input autocomplete="off" type="file" id="empProfilePic" class="upload-file" name="empProfilePic"
               hidden="hidden"/>
        <div class="col-md-6">
            <button type="button" data-previous="empProfilePic" data-upload-text="empProfilePic_msg" class="upload-btn">
                CHOOSE A FILE
            </button>
            <strong id="empProfilePic_msg">No file chosen, yet.</strong>
        </div>
    </div>

    <div class="form-group row">
        <label for="empProfilePic"
               class="col-md-4 col-form-label text-md-right">{{__('text.select')}} {{__('text.pay')}} {{__('text.cycle')}}</label>
        <div class="col-md-6">
            <select id="payCycle" name="PayCycle" class="browser-default custom-select">
                <option selected value="">---</option>
                <option value="weekly">Weekly</option>
                <option value="forthrightly">Forthrightly</option>
                <option value="monthly">Monthly</option>
            </select>
            <strong id="payCycle_msg"></strong>
        </div>
    </div>

    <div class="input-group mb-3">
        <label for="gross_pay" class="col-md-4 col-form-label text-md-right">Gross Pay</label>
        <div class="col-md-6">
            <div class="d-flex">
                <div class="input-group-prepend">
                    <span class="input-group-text custom_append_text_color">$</span>
                </div>
                <input type="text" class="form-control" name="gross_pay" id="gross_pay" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text custom_append_text_color">.00</span>
                </div>
            </div>
            <strong id="gross_pay_msg"></strong>
        </div>
    </div>

    <div class="input-group mb-3">
        <label for="rate" class="col-md-4 col-form-label text-md-right">{{__('text.rate')}}</label>
        <div class="col-md-6">
            <div class="d-flex">
                <div class="input-group-prepend">
                    <span class="input-group-text custom_append_text_color">$</span>
                </div>
                <input type="text" class="form-control" id="rate" name="rate" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text custom_append_text_color">/Hr</span>
                </div>
            </div>
            <strong id="rate_msg"></strong>
        </div>
    </div>

    <div class="form-group row">
        <label for="types_of_deduction"
               class="col-md-4 col-form-label text-md-right">{{__('text.select')}} {{__('text.emp')}} {{__('text.deduction')}}</label>
        <div class="col-md-6">
            <select style="width:100%!important;" id="types_of_deductiontypes_of_deduction" class="types_of_deduction" name="types_of_deduction[]" multiple="multiple">
                <option value="fnpf">FNPF</option>
                <option value="paye">PAYE</option>
            </select>
            <div id="types_of_deduction_msg"></div>
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button id="btnempDEtails" type="submit" name="submit" class="btn btn-outline-success">
                {{__('text.add')}} {{__('text.emp')}} {{__('text.details')}} </button>
            <br/>
            <strong id="btnempDEtails_msg"></strong>
        </div>
    </div>


</form>