<?php

namespace App\Http\Controllers;


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
        return view('add_employee.viewEmp');
    }
}
