<form id="registering_emp" method="POST" action="" >
    @csrf

    <div class="form-group row">
        <label for="name"
               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{__('text.name')}}</label>

        <div class="col-md-6">
            <input id="name" type="text"
                   class="form-control" name="name"
                   value="{{ old('name') }}" autocomplete="off" autofocus>
            <strong id="name_msg"></strong>
        </div>

    </div>

    <div class="form-group row">
        <label for="email"
               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email"
                   class="form-control"class="form-control" name="email"
                   value="{{ old('email') }}" required autocomplete="email">

            <strong id="email_msg"></strong>
        </div>
    </div>

    <div class="form-group row">
        <label for="password"
               class="col-md-4 col-form-label text-md-right">{{__('text.emp')}} {{ __('Password') }}</label>
        <div class="input-group col-md-6">
            <input id="password" type="text"
                   class="form-control " name="password"
                   required autocomplete="new-password">
            <div class="input-group-append">
                <button id="generate_pass" class="btn btn-outline-secondary"
                        type="button">{{__('text.generate')}} {{__('text.password')}}</button>
            </div>
            <strong id="pass_msg"></strong>

        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm"
               class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation"  autocomplete="new-password">
            <strong id="confirm_password_msg"></strong>
        </div>

    </div>
    <input id="type" type="text" class="form-control d-none"
           name="type" value="emp">

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button id="btnAddEmp" type="submit" class="btn btn-outline-primary">
                {{__('text.add')}} {{__('text.new')}} {{__('text.emp')}}
            </button> <br />
            <strong id="btnAddEmp_msg"></strong>
        </div>
    </div>
</form>