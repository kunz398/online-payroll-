<?php

namespace App\Http\Controllers;

use App\Preference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('prefrence.index');
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
//        dd($request);
        // startson
        $company_id = Auth::user()->id;
        $preferences = Preference::where('company_id',$company_id)->get();
        $preferences = json_decode($preferences);

         if ($preferences == null)
         {
            //insert
              $pref = DB::table('preferences')->insert([
                 'company_id' => $company_id,
                 'weeks_start_on' => $request->startson,
                 'weeks_ends_on' => 'null'
             ]);
             $message = "Week Started on Added";
         }else{
            //update
             $pref = DB::table('preferences')
                 ->where('company_id',  $company_id)
                 ->update([
                     'weeks_start_on' =>  $request->startson,
                     'weeks_ends_on' => 'null'
                 ]);
             $message = "Week Started on Updated";
         }
         return view('prefrence.index')->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function show(Preference $preference)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function edit(Preference $preference)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Preference $preference)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Preference  $preference
     * @return \Illuminate\Http\Response
     */
    public function destroy(Preference $preference)
    {
        //
    }
}
