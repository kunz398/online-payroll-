<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmpDetail extends Model
{
   protected $guarded =[];

   public function user()
   {
       return $this->belongsTo(User::class); //belongs to one nd only one user
   }
    public function deduction()
    {
        return $this->hasMany(Deduction::class,'emp_detail_id');
    }

}
