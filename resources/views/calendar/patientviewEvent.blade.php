<div class="tab-pane fade" id="v-pills-visit" role="tabpanel" aria-labelledby="v-pills-visit-tab">
                 <!-- <fieldset style="margin-bottom: 30px;margin-left: 0px;">-->
              
                        <button id="btn-visit" name="btn-visit" class="btn btn-dark btn-block" style="height: 50px; width:200px;float: right;margin-top: 0px;margin-left: 120px">Patient Visit</button>
                        <br>

                        <div class="row" style="margin-left: 10px;margin-bottom: 50px; margin-top: 70px">
                          @foreach($evts as $evts)
                         
                        <div class="col-xl-2 col-sm-3 mb-5" style="height: 5rem;margin-top: 2px">
                        <div class="card border-dark mb-3 text-black o-hidden h-100">
                          <div class="card-body">
                           <a href="#"><p style="font-size: 12px;margin-top: 2px">{{$evts->events->start}}</p></a>
                          <div class="mr-5"></div>
                          </div>
                        </div>
                      </div>
                      @endforeach
                      </div> 
</div>