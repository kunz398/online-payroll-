<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $guarded =[];

    public function EmpDetails()
    {
        return $this->belongsTo(EmpDetail::class,'emp_detail_id');
    }
}
