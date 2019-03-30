<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{

    protected $fillable = ['evt_id','title','venue','start','end', 'start_date', 'end_date', 'start_time', 'end_time'];
 
  
}
