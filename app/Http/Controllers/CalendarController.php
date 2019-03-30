<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Auth;
use DB;
use Calendar;
use App\Users;
use App\User_roles;
use App\Departments;
use App\Events;
use App\Patients;
use App\Interventions;
use App\Patient_Event_List;
use App\Transfer_Requests;
use Hash;
use Session;

class CalendarController extends Controller
{
   public function showCalen()
   {


       $roles = User_roles::all();
       $deps = Departments::all();
       $users = Users::find(Auth::user()->id);
       $transfer = Transfer_Requests::all();
      

       return view('calendar.viewCalendar')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);

   }

   public function get_Events()
   {
          $events = Events::all()->toArray();

          return response()->json($events);

   }

    public function create_event(){

       $roles = User_roles::all();
       $deps = Departments::all();
       $patients = Patients::all();
               $transfer = Transfer_Requests::all();


       $interven = Interventions::all();
       $users = Users::find(Auth::user()->id);
 


       return view('calendar.createEvent')->with('roles',$roles)->with('deps',$deps)->with('interven', $interven)->with('patients', $patients)->with('users',$users)->with('transfer',$transfer);
      
    }

    public function add_event(Request $request){

        $events = rand();
        $input = $request->all();    

        $patients = $request->input('checkitem');

        $event = new Events([
           'evt_id' => $events,
        'title' => $request->input('title'),
        'venue' => $request->input('venue'),
        'start' => $request->input('start_date')." ".date("H:m:s", strtotime($request->input('start_time'))),
        'end' => $request->input('end_date')." ".date("H:m:s", strtotime($request->input('end_time'))),
        'start_date' => $request->input('start_date'),
         'end_date' => $request->input('end_date'),
        'start_time' => $request->input('start_time'),
        'end_time' => $request->input('end_time')


        ]);

      $event->save();

      $eventz = Events::where('evt_id',$events)->get();

      foreach ($eventz as $ev) 
      {
        $eventid = $ev->id;
      }


        foreach($request->input('checkitem') as $pat)
        {


            $patient_event = new Patient_Event_List([

                'event_id' =>  $eventid,
                'patient_id' => $pat,
                'status' => 1


            ]);
            $patient_event->save();
        }

      Session::flash('alert-class', 'success'); 
      flash('Schedule Created', '')->overlay();

        $roles = User_roles::all();
        $deps = Departments::all();
        $transfer = Transfer_Requests::all();
 
    //    return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps);

        $users = Users::find(Auth::user()->id);

        return view('superadmin.chooseuser')->with('roles',$roles)->with('deps',$deps)->with('users',$users)->with('transfer',$transfer);

    }

    public function viewevent($id)
    {
        $pid = 0;
        $evt = Events::where('id',$id)->get();
        foreach ($evt as $evts) {
          $evt_id = $evts->id;
        }
        $roles = User_roles::all();
        $deps = Departments::all();
        $interven = Interventions::where('parent', 0)->get();
        $transfer = Transfer_Requests::all();
        $event_patient = Patient_Event_List::where('event_id', $evt_id)->with('events')->with('patients')->get();


        $users = Users::find(Auth::user()->id);

        return view('calendar.viewEvent')->with('roles' , $roles)->with('deps',$deps)->with('evt' ,$evt)->with('users',$users)->with('pats', $event_patient)->with('intv', $interven)->with('transfer',$transfer);


    }
}
