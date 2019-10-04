<?php

namespace App\Http\Controllers;


use App\EmpDetail;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashBoardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function redirectAddUserIndex()
    {
        return view('add_employee.index');
    }

    public function redirectviewEmp()
    {
        //query database of emp details where the company owns the emp
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

        return view('add_employee.viewEmp')->with('datas',$data);
    }

    public function redirectIndexCalc()
    {
        //query database of emp details where the company owns the emp
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

        return view('add_employee.IndexCalc')->with('datas',$data);
    }
}
