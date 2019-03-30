@extends('main')
@section('content')

<style>

      th {
      text-align: inherit;
      background-color: #343a40;
      color:white;
      }

</style>
@section('style')

<style>
table, th, td {
  border: 1px solid lightgray;
  border-collapse: collapse;
}
th, td {
  padding: 7px;
  text-align: left;  

}
</style>

@endsection
<?php 

$month = date('m');
$day = date('d');
$year = date('Y');

$today = $year . '-' . $month . '-' . $day;
?>
        <!-- Breadcrumbs-->
      @if($pid)
        @foreach($pat as $pats)
          @if($pats->department_id != Auth::user()->department || Auth::user()->user_role->first()->name == 'Superadmin')
            @foreach($transfers as $trans)
              @if($trans->status == "")
                    <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
                      <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
                      <a href="{{URL::to('transfer_patient_now/'.$pats->id.'/'.$trans->to_department.'/'.$trans->transfer_id.'/'.$pid)}}" class="btn btn-primary" style="margin-left:550px;height: 60px;width: 100px;margin-top: 10px"><p style="margin-top: 10px">Enroll</p></a>
                    </ol>
              @elseif(Auth::user()->department == $pats->department_id || Auth::user()->user_role->first()->name == 'Superadmin')
                    <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
                    <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
                    </ol>
            @endif
            @endforeach

            @include('flash::message')
        <!-- Icon Cards-->
                  <div class="container">
                     <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                        <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                            <div class="container" style="margin-left: 10px">
                              <div class="row">
                                <div class="col-md-2">
                                  <p style="font-size: 15px"><h5>Name:</h5> {{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</p>
                                </div>
                                <div class="col-md-2">
                                  <p style="font-size: 15px"><h5>Date of Birth:</h5> {{$pats->birthdate}}</p>
                                </div>
                                <div class="col-md-3">
                                  <p style="font-size: 15px"><h5>Address:</h5> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                                </div>
                                <div class="col-md-2">
                                  <p style="font-size: 15px"><h5>Marital Status:</h5> {{$pats->civil_status}}</p>
                                </div>
                                <div class="col-md-1">
                                  <p style="font-size: 15px"><h5>Age:</h5> {{$pats->age}}</p>
                                </div>
                                <div class="col-md-2">
                                  <p style="font-size: 15px"><h5>Date Admitted:</h5> {{$pats->date_admitted}}</p>
                                </div>
                             </div>
                             <div class="row">
                            @if($pats->birthorder != NULL)
                              @if($pats->birthorder != 'NULL')
                                <div class="col-md-2">
                                  <p style="font-size: 15px"><h5>Birth Order:</h5> {{$pats->birthorder}}</p>
                                </div>
                              @endif
                              @if($pats->contact != 'NULL')
                                <div class="col-md-3">
                                  <p style="font-size: 15px"><h5>Contact Number:</h5> {{$pats->contact}}</p>
                                </div>
                              @endif
                              @if($pats->nationality != 'NULL')
                                <div class="col-md-2">
                                  <p style="font-size: 15px"><h5>Nationality:</h5> {{$pats->nationality}}</p>
                                </div>
                              @endif
                              @if($pats->religion != 'NULL')
                                <div class="col-md-2"> 
                                  <p style="font-size: 15px"><h5>Religion:</h5> {{$pats->religion}}</p>
                                </div>
                              @endif
                            @endif
                             </div>
                            </div>
                    </fieldset>
                    <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                      <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Transfer Remarks</legend>
                          <div class="container" style="margin-left: 10px">
                            <div class="row">
                            @foreach($transfer as $trans)
                              <p style="margin-left: 30px">{{$trans->remarks}}</p>
                            @endforeach
                           </div>
                           <div class="row">
                          
                           </div>
                          </div>
                    </fieldset>
                  </div>
            
          @else
                  <ol class="breadcrumb" style="height: 100px;font-size:50px;text-align: center">
                    <li class="breadcrumb-item active" style=""><i class="fas fa-fw fa fa-user"></i>Patient Information</li>
                    <button class="btn btn-success" style="margin-left: 10px;margin-left:400px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
                  </ol>

              include('flash::message')
        <!-- Icon Cards-->
                <div class="container">
                   <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                      <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                          <div class="container" style="margin-left: 10px">
                               <div class="row">
                                  <div class="col-md-2">
                                    <p style="font-size: 15px"><h5>Name:</h5> {{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</p>
                                  </div>
                                  <div class="col-md-2">
                                    <p style="font-size: 15px"><h5>Date of Birth:</h5> {{$pats->birthdate}}</p>
                                  </div>
                                  <div class="col-md-3">
                                    <p style="font-size: 15px"><h5>Address:</h5> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                                  </div>
                                  <div class="col-md-2">
                                    <p style="font-size: 15px"><h5>Marital Status:</h5> {{$pats->civil_status}}</p>
                                  </div>
                                  <div class="col-md-1">
                                    <p style="font-size: 15px"><h5>Age:</h5> {{$pats->age}}</p>
                                  </div>
                               </div>
                               <div class="row">
                                  @if($pats->birthorder != NULL)
                                    @if($pats->birthorder != 'NULL')
                                      <div class="col-md-2">
                                        <p style="font-size: 15px"><h5>Birth Order:</h5> {{$pats->birthorder}}</p>
                                      </div>
                                    @endif
                                    @if($pats->contact != 'NULL')
                                      <div class="col-md-3">
                                        <p style="font-size: 15px"><h5>Contact Number:</h5> {{$pats->contact}}</p>
                                      </div>
                                    @endif
                                    @if($pats->nationality != 'NULL')
                                      <div class="col-md-2">
                                        <p style="font-size: 15px"><h5>Nationality:</h5> {{$pats->nationality}}</p>
                                      </div>
                                    @endif
                                    @if($pats->religion != 'NULL')
                                      <div class="col-md-2"> 
                                        <p style="font-size: 15px"><h5>Religion:</h5> {{$pats->religion}}</p>
                                      </div>
                                    @endif
                                    @endif
                               </div>
                          </div>
                    </fieldset>
                    <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                      <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
                        <div class="container" style="margin-left: 10px">
                         <div class="row">
                            <div class="col-md-2">
                              <p style="font-size: 8px"><h6>Date Admitted:</h6> {{$pats->date_admitted}}</p>
                            </div>
                         </div>
                        </div>
                    </fieldset>
                </div>
          @endif
          @endforeach
      @else
          @foreach($pat as $pats)
            @if($pats->department_id == Auth::user()->department || Auth::user()->user_role->first()->name == 'Superadmin')
                  <div class="row">
                        <div class="col-md-4 bg-dark" style="border:solid white;margin-left: 28px;margin-right: 60px">
                          <p><h1 style="color:white">Patient No. {{$pats->id}}</h1></p>
                        </div>
                        <div class="col-md-7" style="margin-top: 10px">
                          <ol class="breadcrumb" style="height: 100px;font-size:40px;text-align: center;">
                            <li class="breadcrumb-item active" style="margin-left: 20px"><i class="fas fa-fw fa fa-user"></i><span><h6>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}<h6></span></li>
                              <button class="btn btn-success" style="margin-left:30px;height: 60px;width: 90px;margin-top: 10px">Graduate</button><button class="btn btn-warning" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px" data-toggle="modal" data-target="#transferPatient" data-patientid="{{$pats->id}}" data-patientdep="{{$pats->department_id}}">Transfer</button><button class="btn btn-danger" style="margin-left: 10px;height: 60px;width: 90px;margin-top: 10px">Dismiss</button>
                          </ol>
                        </div>
                   </div>
                  @include('flash::message')
        <!-- Icon Cards-->
              <div class="row" style="margin-left: 0px;">
                  <div style="">
                      <div class="col-md-11" style="margin-right: 50px">
                        <ul class="sidebar navbar-nav" style="background-color:white;">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                          <li class="nav-item active"  id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="margin-top: 10px">
                            <a class="nav-link active bg-dark" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true" style="color:white;margin-bottom: 10px;height: 45px"><h6>Information</h6></a>
                          </li>
                          <li class="nav-item" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="">
                            <a class="nav-link bg-dark" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false" style="color:white;margin-bottom: 10px;height: 45px"><h6>Refer</h6></a>
                          </li>
                          <li class="nav-item" id="v-pills-visit-tab" data-toggle="pill" href="#v-pills-visit" role="tab" aria-controls="v-pills-visit" aria-selected="false">
                            <a class="nav-link bg-dark" id="v-pills-visit-tab" data-toggle="pill" href="#v-pills-visit" role="tab" aria-controls="v-pills-visit" aria-selected="false" style="color:white;margin-bottom: 10px;height: 45px"><h6>Sessions</h6></a>
                          </li>
                          <li class="nav-item" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false">
                            <a class="nav-link bg-dark" id="v-pills-history-tab" data-toggle="pill" href="#v-pills-history" role="tab" aria-controls="v-pills-history" aria-selected="false" style="color:white;margin-bottom: 10px;height: 45px"><h6>History</h6></a>
                          </li>
                          <li class="nav-item dropdown" style="border-radius: 0px">
                          <a class="nav-link bg-dark dropdown-toggle" href="#" id="v-pills-forms-tab" role="tab" data-toggle="dropdown" aria-selected="false" style="color:white;margin-bottom:10px;height: 45px;font-weight: bold"><span>Forms</span></a>
                            <div class="dropdown-menu" aria-labelledby="v-pills-forms-tab" style="margin-left: 0px">
                              <a class="dropdown-item bg-dark" style="color:white;margin-bottom: 3px;border-radius: 0px" href="#">Intake Form</a>
                              <a class="dropdown-item bg-dark" style="color:white;border-radius: 0px" href="#">Drug Dependency<br>Examination Form</a>
                            </div>
                          </li>
                        </div>
                        </ul>
                    </div>
                  </div>
              <div class="col-md-9" style="margin-top: 10px">
                <div class="tab-content" id="v-pills-tabContent" >
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                         <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                             <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Personal Information</legend>
                              <div class="container" style="margin-left: 10px">
                                  <div class="row">
                                          <div class="col-md-2">
                                            <p style="font-size: 8px"><h6>Name:</h6><span>{{$pats->fname}} {{$pats->mname}}. {{$pats->lname}}</span></p>
                                           </div>
                                           <div class="col-md-2">
                                              <p style="font-size: 8px"><h6>Date of Birth:</h6> {{$pats->birthdate}}</p>
                                           </div>
                                          <div class="col-md-4">
                                            <p style="font-size: 8px"><h6>Address:</h6> {{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</p>
                                          </div>
                                          <div class="col-md-2">
                                           <p style="font-size: 8px"><h6>Marital Status:</h6> {{$pats->civil_status}}</p>
                                          </div>
                                          <div class="col-md-1">
                                             <p style="font-size: 8px"><h6>Age:</h6> {{$pats->age}}</p>
                                          </div>
                                      @if($pats->birthorder != NULL)
                                          @if($pats->birthorder != 'NULL')
                                          <div class="col-md-2">
                                            <p style="font-size: 8px"><h6>Birth Order:</h6> {{$pats->birthorder}}</p>
                                          </div>
                                          @endif
                                          @if($pats->contact != 'NULL')
                                          <div class="col-md-3">
                                            <p style="font-size: 8px"><h6>Contact Number:</h6> {{$pats->contact}}</p>
                                          </div>
                                          @endif
                                          @if($pats->nationality != 'NULL')
                                          <div class="col-md-2">
                                            <p style="font-size: 8px"><h6>Nationality:</h6> {{$pats->nationality}}</p>
                                          </div>
                                         @endif
                                         @if($pats->religion != 'NULL')
                                           <div class="col-md-2"> 
                                             <p style="font-size: 8px"><h6>Religion:</h6> {{$pats->religion}}</p>
                                          </div>
                                         @endif
                                      @endif
                                  </div>
                              </div>
                         </fieldset>
                         <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                              <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">General Information</legend>
                              <div class="container" style="margin-left: 10px">
                                <div class="row">
                                  <div class="col-md-3">
                                  <p style="font-size: 8px"><h6>Department:</h6> {{$pats->departments->department_name}} Department</p>
                                 </div>
                                 <div class="col-md-3">
                                  <p style="font-size: 8px"><h6>Date Admitted:</h6> {{$pats->date_admitted}}</p>
                                 </div>
                                 @if($pats->case != "")
                                  <div class="col-md-2">
                                  <p style="font-size: 8px"><h6>Case Type:</h6> {{$pats->case}}</p>
                                 </div>
                                 @endif
                                 @if($pats->submission != "")
                                  <div class="col-md-3">
                                  <p style="font-size: 8px"><h6>Submission Type:</h6> {{$pats->submission}}</p>
                                 </div>
                                 @endif
                                  <div class="col-md-10">
                    
                                 </div>
                                </div>
                                </div>
                        </fieldset>
                    </div>
                    <div class="tab-pane fade" id="v-pills-history" role="tabpanel" aria-labelledby="v-pills-history-tab">
                        <fieldset style="margin-bottom: 30px;margin-left: 0px;border:solid thin gray;border-radius: 10px">
                          <legend style="color:white;text-indent: 20px;width:900px;margin-bottom: 20px;border-radius: 5px" class="bg bg-dark">Patient History</legend>
                          <div class="container" style="margin-left: 0px">
                            <div class="row">
                              <div class="col-md-12">
                               <div class="table-responsive">
                                <table class="table table-bordered"  width="100%" cellspacing="0" style="font-size: 12px">
                                  <thead>
                                   <tr>
                                     <th>Date</th>
                                     <th>Performed By</th>
                                     <th>Type</th>
                                     <th>From Department</th>
                                     <th>To Department</th>
                                     <th>Remarks</th>
                                  </tr>
                                  </thead>
                                <tbody>
                                  @foreach($history as $hist)
                                  <tr>
                                    <td>{{$hist->date}}</td>
                                    <td>{{$hist->userss->fname}} {{$hist->userss->lname}}</td>
                                    <td>{{$hist->type}}</td>
                                    @if($hist->dep)
                                    <td>{{$hist->dep->department_name}} Department</td>
                                    @else
                                    <td></td>
                                    @endif  
                                    <td>{{$hist->deps->department_name}} Department</td>
                                    <td>{{$hist->remarks}}</td>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              </div>
                            </div>
                            </div>
                           </div>
                        </fieldset>
                    </div>

                @include('refer.tabform')
                
                 @include('calendar.patientviewEvent')
                


              </div>
            </div>
          </div>
          @endif
        @endforeach
      @endif
  
@endsection


@section('script')
<script>
      
  $(document).ready(function () {
    ////----- Open the modal to CREATE a link -----////
    $('#btn-add').click(function () {
        $('#btn-save').val("add");
        $('#modalFormData').trigger("reset");
        $('#linkEditorModal').modal('show');
    });

        $('#btn-accept').click(function () {
         var result = confirm('Your are about to accept this referal. Would you like to continue?');
    
         if(result = true){

         }


        });

        $('body').on('click', '.open-modal', function () {
        var refer_id = $(this).val();

        $.get('{{URL::to("/refers")}}' + '/' + refer_id, function (data) {
            $('#id').val(data.id);
            $('#refDate').val(data.ref_date);
            $('#reason').val(data.ref_reason);
            $('#refAt').val(data.ref_at);
            $('#refby2').val(data.ref_by);
            $('#contact').val(data.contact_person);
            $('#ref_recom').val(data.recommen);
            $('#refDateback').val(data.ref_back_date);
            $('#refbyback').val(data.ref_back_by);
            $('#returnDate').val(data.ref_slip_return);
            $('#btn-save').val("update");
            $('#linkEditorModal').modal('show');
            
        })
    });

        $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
         var formData = {
            patient_id: $('#patient_id').val(),
            ref_date:  $('#refDate').val(),
            ref_at: $('#refAt').val(),
            ref_reason:  $('#reason').val(),
            ref_by:  $('#refby').val(),
            recommen:  $('#ref_recom').val(),
            contact_person:  $('#contact').val(),
            ref_back_date:  $('#refDateback').val(),
            ref_back_by:  $('#refbyback').val(),
            ref_slip_return:  $('#returnDate').val(),

        };
       var state = $('#btn-save').val();
      console.log(formData);

       var type = "POST";
        var id = $('#id').val();
        var ajaxurl = '{{URL::to("/refers")}}';
        if (state == "update") {
            type = "PUT";
            ajaxurl = '{{URL::to("/refers")}}'+ '/' + id;
            console.log(ajaxurl);
        }
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            success: function (data) {
                var link = '<tr id="refer' + data.id + '"><td>' + data.ref_date + '</td><td>' + data.ref_at + '</td><td>' + data.ref_reason + '</td><td>' + data.ref_by + '</td>';
                link += '<td><button class="btn btn-info open-modal" value="' + data.id + '">Edit</button>&nbsp;';
                if (state == "add") {
                    $('#links-list').append(link);
                } else {
                    $("#refer" + id).replaceWith(link);
                }
    
                $('#modalFormData').trigger("reset");
                $('#linkEditorModal').modal('hide')
        },
           error: function (data) {
                console.log('Error:', data);
            }

      });
      });

  })

  function getDate(){
    var today = new Date();

document.getElementById("date").value = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2) + '-' + ('0' + today.getDate()).slice(-2);


}
  </script>
@endsection