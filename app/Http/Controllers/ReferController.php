<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Response;
use Auth;
use DB;
use Calendar;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Events;
use App\Patients;
use App\Refers;
use Hash;
use Session;

class ReferController extends Controller
{
	public function createRefer(Request $request)
    {


    	 $refer = Refers::create($request->all());
    	 return Response::json($refer);

    }


    public function getRefer($id) {

        $data = Refers::find($id);
            
            return Response::json($data);

	}

    function putRefer(Request $request, $id) {

        $id = Refers::find($id);

        $id->ref_date = $request->ref_date;
        $id->patient_id = $request->patient_id;
        $id->ref_at = $request->ref_at;
        $id->ref_reason = $request->ref_reason;
        $id->ref_by = $request->ref_by;
        $id->contact_person = $request->contact_person;
        $id->recommen = $request->recommen;
        $id->ref_back_date = $request->ref_back_date;
        $id->ref_back_by = $request->ref_back_by;
        $id->accepted_by = $request->accepted_by;
        $id->ref_slip_return = $request->ref_slip_return;

        $id->save();
        return Response::json($id);


    }
		  

}