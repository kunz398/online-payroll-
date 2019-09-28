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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
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
//        request()->validate([
//            'type'=>'required',
//            'amount' => 'required|numeric'
//        ]);

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

}//end of class
