<?php

namespace App\Http\Controllers;

use App\EmpDetail;
use App\Pay;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $email = Auth::user()->email;

        $pay = Pay::where('email',$email)->get();

        return view('normaluser.index')->with('pays',$pay);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function show(Pay $pay, Request $request)
    {
        $id = $request->id;

        $pays = Pay::where('id',$id)->get();

        $users = User::where('email',$pays[0]['email'])->get();
        $empDetails = EmpDetail::where('email',$pays[0]['email'])->get();
        $companyInfo = User::where('id',$empDetails[0]['user_id'])->get();
        $allPaysOfThisUsers = Pay::where('email',$pays[0]['email'])->get();

        $ytd_gross = 0;
        $ytd_net = 0;
foreach ($allPaysOfThisUsers as $allPaysOfThisUser){
     $ytd_gross += $allPaysOfThisUser->gross_pay;
        $ytd_net += $allPaysOfThisUser->net_pay;


}

        $data = array(
                        "company_name"=>$companyInfo[0]->name,
                        "pay_to"=>$pays[0]['pay_to'],
                        "position"=>$empDetails[0]['role'],
                        "name"=>$users[0]['name'],
                        "gross_pay"=>round($pays[0]['gross_pay'],2),
                        "paye"=>'0.00',
                        "deduction"=>$pays[0]['deductions'],
                        "net_pay"=>round($pays[0]['net_pay'],2),
                        "ytd_gross"=>round($ytd_gross,2),
                        "ytd_net"=>round($ytd_net,2),
                );

        return view('normaluser.individual')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function edit(Pay $pay)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pay $pay)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pay $pay)
    {
        //
    }
}
