    <?php

    namespace App\Http\Controllers;

    use App\Deduction;
    use App\User;
    use App\EmpDetail;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Hash;

    class AddUserController extends Controller
    {

        public function index()
        {
            //
        }

        public function AjaxsEditEmp(Request $request)
        {
            $id = $request->id;
            $data = [];
            $employees = EmpDetail::where('id',$id)->get();
            foreach ($employees as $employee)
            {
                $users = User::where('email',$employee->email)->get();

                foreach ($users as $user)
                {
                    $temp = array(
                        "id"=>$user->id,
                        "name"=>$user->name,
                        "role"=>$employee->role,
                        "email"=>$user->email,
                        "picture"=>$employee->pic,
                        "pay_cycle"=>$employee->pay_cycle,
                        "gross_pay"=>$employee->gross_pay,
                        "rate"=>$employee->rate,
                        "deductions"=>$employee->deductions
                    );
                }
                array_push($data, $temp);
            }

            $deduct = Deduction::where('emp_detail_id',$id)->get();
            return view('add_employee.editform')->with('datas',$data)->with('deducts',$deduct);
        }

        public function update_emp(Request $request)
        {
            $user = DB::table('users')
                ->where('id',  $request->emp_id)
                ->update([
                    'name' =>   $request->emp_name,
                    'email' => $request->emp_email
                ]);
            $emp_details = DB::table('emp_details')
                ->where('email',  $request->Actual_emp_name)
                ->update([
                    'role' =>   $request->emp_role,
                    'email' => $request->emp_email,
                    'pay_cycle' => $request->emp_pay_cycle,
                    'gross_pay' => $request->emp_gross_pay,
                    'rate' => $request->emp_rate
                ]);
            $company_id = Auth::user()->id;
            $employees = EmpDetail::where('user_id',$company_id)->get();
            $employees = (json_decode($employees));

            $data = [];
            $temp =[];
            foreach ($employees as $employee)
            {
                $users = User::where('id',$employee->user_id)->get();
                $users = (json_decode($users));

                foreach ($users as $user)
                {
                    $temp = array(
                        "id"=>$employee->id,
                        "name"=>$user->name,
                        "role"=>$employee->role,
                        "email"=>$employee->email,
                        "picture"=>$employee->pic
                    );
                }
                array_push($data, $temp);
            }
            return view('add_employee.viewEmp')->with('message','Employee ID: '. $request->emp_id .' Employee Updated.')->with('datas',$data);
        }
        public function deleteEmp(Request $request)
        {
            $company_id = Auth::user()->id;
            $employees = EmpDetail::where('user_id',$company_id)->get();
            $employees = (json_decode($employees));

            $data = [];
            $temp =[];
            foreach ($employees as $employee)
            {
                $users = User::where('id',$employee->user_id)->get();
                $users = (json_decode($users));

                foreach ($users as $user)
                {
                    $temp = array(
                        "id"=>$employee->id,
                        "name"=>$user->name,
                        "role"=>$employee->role,
                        "email"=>$employee->email,
                        "picture"=>$employee->pic
                    );
                }
                array_push($data, $temp);
            }
            // dash board function
            return view('add_employee.viewEmp')->with('message','Employee ID: '. $request->emp_id .' Employee Deleted.')->with('datas',$data);
        }

        public function store(Request $request)
        {
            $name = $request->name;
            $email = $request->email;
            $pass = $request->pass;
            $pass = Hash::make($pass);
            $type = $request->type;

            $result = [];
            $user = User::where("email", $email)->get();

            if (empty(json_decode($user))) {
                $u = new User();
                $u->name = $name;
                $u->email = $email;
                $u->password = $pass;
                $u->type = $type;

                $save = $u->save();
                if ($save) {

                    $result = array(
                        "code" => "1",
                        "data" => "$email",
                        "response" => 'User added!'
                    );
                } else {
                    $result = array(
                        "code" => "0",
                        "data" => "$email",
                        "response" => 'Somthing went Wrong Please Try Again!'
                    );
                }
            } else {
                $result = array(
                    "code" => "0",
                    "data" => "$email",
                    "response" => 'User Already Exists!'
                );

            }
            return json_encode($result);
        }

        public function other_emp_details(Request $request)
        {
            $role = $request->role;
            $PayCycle = $request->PayCycle;
            $disabledEmail = $request->disabledEmail;
            $gross_pay = $request->gross_pay;
            $rate = $request->rate;
            $types_of_deduction = implode(',', $request->types_of_deduction);
            $company_id = Auth::user()->id;
            $result = array();
            $flag = false;
    //profile pic
            $profile_pic = $request->file('empProfilePic');
            $new_name_arry = explode('@', $disabledEmail);
            $profile_pic_extension = $profile_pic->getClientOriginalExtension();
            $new_name = $new_name_arry[0] . '_' . rand() . '.' . $profile_pic_extension;
            $profile_pic->move(public_path("images"), $new_name);
    //\\Endprofile pic
            $emp_details = DB::table('emp_details')->insertGetId(
                [
                    'user_id' => $company_id,
                    'email' => $disabledEmail,
                    'role' => $role,
                    'pic' => $new_name,
                    'pay_cycle' => $PayCycle,
                    'gross_pay' => $gross_pay,
                    'rate' => $rate,
                    'deductions' => $types_of_deduction
                ]
            );

            if (!empty($emp_details)) {
                $types_of_deductionArry = explode(',', $types_of_deduction);
                for ($i = 0; $i < sizeof($types_of_deductionArry); $i++) {
                    DB::table('deductions')->insert([
                        'emp_detail_id' => $emp_details,
                        'name' => $types_of_deductionArry[$i],
                        'type' => '$',
                        'amount' => '0.00'
                    ]);
                }
                $result = array(
                    "code" => "1",
                    "data" => $emp_details,
                    "response" => 'Employee Details added!'
                );
            } else {
                $result = array(
                    "code" => "0",
                    "data" => "",
                    "response" => 'Employee Email Exists!'
                );
            }
            return json_encode($result);
        }

        function deductionForm(Request $request)
        {
            $current_emp_id = $request->id;


            $emp_details = Deduction::where('emp_detail_id', $current_emp_id)->get();


            return view('add_employee.deductionForm')->with('results', $emp_details);
        }

        public function updateDeduction(Request $request)
        {

            for ($i = 0; $i <sizeof($request->id); $i++)
            {

                $deduc = DB::table('deductions')
                    ->where('id',  $request->id[$i])
                    ->update([
                        'type' =>   $request->type[$i],
                        'amount' => $request->amount[$i]
                ]);
            }

            return view('dashboard');
        }

        public function pickUsersCalcPay(Request $request)
        {
            $temp =[];
            $data=[];
            foreach($request->request as $key => $value)
            {
                if ($value == 'on')
                {
                    $empdetails = EmpDetail::where('id',$key)->get();
                    $empdetails = (json_decode($empdetails));

                    foreach ($empdetails as $empdetail)
                    {
                        $temp = array(
                            "id"=>$empdetail->id,
                            "role"=>$empdetail->role,
                            "email"=>$empdetail->email,
                            "picture"=>$empdetail->pic,
                            "pay_cycle"=>$empdetail->pay_cycle
                        );
                    }
                        array_push($data, $temp);
                    }
            }

            return view('add_employee.ifAnyabsents')->with('datas',$data);
        }
    }//end

















































































