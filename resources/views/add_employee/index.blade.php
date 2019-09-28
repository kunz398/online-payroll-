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
                    <div class="card-header text-center material_pink">{{ __('text.add') }} {{__('text.emp')}}</div>

                    <div class="card-body">
                        @include('add_employee.registering_emp')
                        @include('add_employee.emp_details')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">

        /*------------------------------------------------------------------First Form------------------------------------------------------------------*/

        $('#generate_pass').on('click', function (e) {
            $("#password").val(generate_pass(9));
        });

        $('#btnAddEmp').on('click', function (e) { //First Form
            e.preventDefault();
            let isvalid = [];
            isvalid.push(validationForm('name', 'name_msg', "required|min:2|alpha"));
            isvalid.push(validationForm('email', 'email_msg', "required|email"));
            isvalid.push(validationForm('password', 'pass_msg', "required|min:8"));
            isvalid.push(validationForm('password-confirm', 'confirm_password_msg', "required|min:8"));
            if ($("#password").val() == $("#password-confirm").val() ||  $("#password-confirm").val() == " " || $("#password-confirm").val() == '')
            {
                $("#password-confirm").removeClass('inbalid');
                $("#password-confirm").removeClass('inbalid-feedback');
                $("#password-confirm").html("");

                $("#password-confirm").addClass('balid');
                $("#password-confirm").addClass('balid-feedback');

                isvalid.push("true")
            }else{

                $("#password-confirm").removeClass('balid');
                $("#confirm_password_msg").removeClass('balid-feedback');

                $("#password-confirm").addClass('inbalid');
                $("#confirm_password_msg").addClass('inbalid-feedback');
                $("#confirm_password_msg").html("Passwords do no match." );
                isvalid.push("false")

            }
            console.log("First Form: " + isvalid);
            if (jQuery.inArray("false", isvalid) != -1) {
                // if false is found in the array

            } else {

                let name =$("#name").val();
                let email =$("#email").val();
                let pass =$("#password").val();
                let type =$("#type").val();
                let btn =  $("#btnAddEmp");
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('register_new_emp')}}",
                    method: 'POST',
                    data: {
                        name:name,
                        email:email,
                        pass:pass,
                        type:type
                    },
                    beforeSend: function () {
                        btn.attr("disabled", true);
                        btn.removeClass('btn-outline-primary');
                        btn.html("<img src='{{asset('images/loading.gif')}}' class='loading_img'>");
                    },
                    success: function (data)
                    {
                        let json = JSON.parse(data);
                        if  (json.code == 0)
                        {
                            var btnMSG =  $("#btnAddEmp_msg");
                            btn.attr("disabled", false);
                            btn.addClass('btn-outline-primary');
                            btn.html(" {{__('text.add')}} {{__('text.new')}} {{__('text.emp')}}");

                            btnMSG.addClass('inbalid-feedback');
                            btnMSG.addClass('inbalid-feedback');
                            $("#email_msg").addClass('inbalid-feedback');

                            $("#email").removeClass('balid');
                            $("#email").addClass('inbalid');
                            $("#btnAddEmp_msg").html(json.response);
                        }else{
                            $("#btnAddEmp_msg").removeClass('inbalid-feedback');
                            validationForm('email', 'email_msg', "required|email");
                            $("#btnAddEmp_msg").html("");

                            $("#registering_emp").hide({ direction: "left" }, 1000);
                            $("#add_emp_details").show({ direction: "right" }, 1000);
                            $("#disabledEmail").val(json.data);
                        }
                    }
                });
            }

        });
        /*------------------------------------------------------------------First Form------------------------------------------------------------------*/


        /*------------------------------------------------------------------Second Form------------------------------------------------------------------*/
        $('.types_of_deduction').select2({
            tags: true,
            tokenSeparators: [',', ' ','\n']
        });
        $(".upload-btn").click(function (e) {
            let id = $(this).data("previous");
            let text = $(this).data("upload-text");
            $("#" + id).trigger('click');

            $("#" + id).on('change', function () {
                validationForm(id,text,'required|file:[png,jpg,jpeg]|fileSize:[10]');
            });
        });
        $('form#add_emp_details').on('submit', function (e) {
            e.preventDefault();
            let isvalid = [];
            isvalid.push(validationForm('payCycle', 'payCycle_msg', "required|",'select',false));
            isvalid.push(validationForm('empProfilePic', 'empProfilePic_msg','required|file:[png,jpg,jpeg]|fileSize:[10]'));
            isvalid.push (validationForm('gross_pay', 'gross_pay_msg', "required|numeric|min:2"));
            isvalid.push (validationForm('rate', 'rate_msg', "required|"));
            console.log("Second Form: " + isvalid);

            if (jQuery.inArray("false", isvalid) != -1)
            {
                // if false is found in the array
            } else {
            // alert ($("#disabledEmail").val());
                let formData = new FormData($('#add_emp_details')[0]);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{route('other_emp_details')}}",
                    method: 'POST',
                    processData: false,
                    contentType: false,
                    async: true,
                    cache: false,
                    data: formData,
                    beforeSend: function () {
                        let btn = $("#btnempDEtails");
                        btn.attr("disabled", true);
                        btn.removeClass('btn-outline-primary');
                        btn.html("<img src='{{asset('images/loading.gif')}}' class='loading_img'>");
                    },
                    success: function (data) {
                        let json = JSON.parse(data);
                        if  (json.code == 0)
                        {
                            var btnMSGDetails =  $("#btnempDEtails_msg");
                            var btnDetails =  $("#btnempDEtails");
                            btnDetails.attr("disabled", false);
                            btnDetails.addClass('btn-outline-primary');
                            btnDetails.html(" {{__('text.add')}} {{__('text.emp')}} {{__('text.details')}}");

                            btnMSGDetails.addClass('inbalid-feedback');
                            btnMSGDetails.addClass('inbalid-feedback');
                        }else{
                            $("#add_emp_details").hide({ direction: "right" }, 1000);
                            $("#deductionForm").show({ direction: "left" }, 1000);
                            let id = json.data;
                            window.location.replace("{{url('deductionForm')}}" + "/" + id);
                        }
                    }
                });
            }
        });
/*------------------------------------------------------------------Second Form------------------------------------------------------------------*/


    </script>
@endsection