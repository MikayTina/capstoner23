  <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                 <!-- <fieldset style="margin-bottom: 30px;margin-left: 0px;">-->
              
                      <button id="btn-add" name="btn-add" class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px">Refer Patient</button>
                        <br>
                        <br>
                      
                        <div class="card-body" style="margin-left: 10px">
                          <div class="table-responsive">
                              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>Date</th>
                                    <th>Refer At</th>
                                    <th>Reason of Referal</th>
                                    <th>Refered by</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="links-list" name="links-list">
                                    @foreach ($refers as $refer)
                                    <tr id="refer{{$refer->id}}">
                                    <td>{{$refer->ref_date}}</td>
                                    <td>{{$refer->ref_at}}</td>
                                    <td>{{$refer->ref_reason}}</td>
                                    <td>{{$refer->ref_by}}</td>
                              <td>
                                @if($refer->accepted_by)
                                <button class="btn btn-info" value="{{$refer->id}}">View
                                  </button>
                                  <button class="btn btn-light print-link" id="btn-print" name ="btn-print" value="{{$refer->id}}">Print
                                  </button>

                                @else
                                  <button class="btn btn-info open-modal" value="{{$refer->id}}">Edit
                                  </button>
                                  <button class="btn btn-secondary delete-link" id="btn-accept" name ="btn-accept" value="{{$refer->id}}">Accept
                                  </button>
                                  <button class="btn btn-light print-link" id="btn-ptint" name ="btn-print" value="{{$refer->id}}">Print
                                  </button>
                                @endif 
                              </td>
                          </tr>
                          @endforeach
                                </tbody>
                              </table>
                            </div>
                          </div>
  </div>

                      <!--modal for Refer Button-->
  <div class="modal fade" id="linkEditorModal" aria-hidden="true" >
          <div class="modal-dialog">
                  <div class="modal-content"  style="width:980px;">
                              <div class="modal-header">
                                  <h4 class="modal-title" id="linkEditorModalLabel">Referal Slip (Two Way Referal System)</h4>
                              </div>
                              <div class="modal-body">
                                   <form id="modalFormData" name="modalFormData" class="form-horizontal" novalidate="">
                                     <table style="width:100%">
                                      <tr>
                                      <td style="width:25%">Last Name:</th>
                                      <td style="width:25%">{{$pats->lname}}</td>
                                      <td style="width:25%" colspan="2" rowspan="2">Address: &emsp;{{$pats->address->street}} {{$pats->address->barangay}} {{$pats->address->city}}</td>
                                      </tr>
        
                                      <tr>
                                      <td style="width:25%">First Name:</td><td style="width:25%"> {{$pats->fname}}</td>
                                        </tr>
        
                                       <tr>
                                        <td style="width:25%">Case New( ) old ( )</td>
                                        <td style="width:25%">Middle initial:  &emsp; {{$pats->mname}}</td>
                                        <td style="width:25%">Contact Number:</td>
                                        <td style="width:25%">{{$pats->contact}}</td>
                                      </tr>
        
                                      <tr>
                                      <td style="width:25%">Age:</td>
                                      <td style="width:25%">{{$pats->age}}</td>
                                      <td style="width:25%">Gender:</td>
                                      <td style="width:25%">{{$pats->gender}}</td>
                                      </tr>
        
                                        <tr>
                                        <td style="width:25%">Birthdate:</td>
                                        <td style="width:25%">{{$pats->birthdate}}</td>
                                        <td style="width:25%">Date of referral:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" value="<?php echo $today; ?>" id="refDate" name="refDate"></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%" height="70px">Refered at:</td>
                                        <td style="width:25%"><input type="text" style="height:70px; width: 230px;"  id="refAt" name="refAt"  /></td>
                                        <td style="width:25%">Reason for Referral:</td>
                                        <td style="width:25%"><input style="height:70px; width: 230px;" type="text" id="reason" name="reason" /></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%">Contact Person:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="text" id="contact" name="contact"></td>
                                        <td style="width:25%">Refered by: </td>
                                        <td style="width:25%"><input  style="width: 230px;" type="text" id="refby" name="refby" value="{{Auth::user()->id}}" hidden="hidden"><input  style="width: 230px;" type="text" id="refby2" name="refby2" value="{{Auth::user()->fname}} {{Auth::user()->lname}}" disabled="disabled"></td>
                                        </tr>
                                        
                                        <tr>
                                        <td height="70px" colspan="4"><label> Recommendation/Attachments: </label> &emsp;<input style="height:70px; width: 670px;" type="text" id="ref_recom" name="ref_recom"/></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%">Refered back on(date)</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" id="refDateback" name="refDateback" ></td>
                                        <td style="width:25%">Refered back by:</td>
                                        <td style="width:25%"><input style="width: 230px;" type="text" id="refbyback" name="refbyback" /></td>
                                        </tr>
                                        
                                        <tr>
                                        <td style="width:25%" height="70px">Accepted by:</td>
                                        <td style="width:25%"></td>
                                        <td style="width:25%">Referal slip return on</td>
                                        <td style="width:25%"><input style="width: 230px;" type="date" id="returnDate" name="returnDate" ></td>
                                        </tr>
                                        
                                        
                                      </table>
                                    </form>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" id="btn-save" name ="btn-save" value="add">Save changes
                                  </button>
                                  <input type="hidden" id="id" name="id" value="0">
                                  <input type="hidden" id="patient_id" name="patient_id" value="{{$pats->id}}">

                              </div>
                  </div>
          </div>
  </div>