@extends('Backend.Layouts.panel')
@section('Style-Area')
<style>
   .fixed-ui-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
   }

   .user-profile {
      background: url('Backend/assets/images/It-Assets/Rectangle4378.png');
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      height: 100%;
   }

   .user-card {
      height: 100%;
   }

   .text-assts {
      float: right;
   }
</style>
@endsection
@section('Content-Area')
<div class="col-md-12">
   <div class="card p-4">
      <div class="user-profile">
         <div class="row p-3">
            <div class="col-sm-4">
               <div class="card custom-card user-card">
                  <div class="card-header"><img class="img-fluid img" src="{{ asset($user->cover_photo) }}" style="width: 300px; height: 100px;" alt="Uploaded Image"></div>
                  <div class="card-profile">
                     <img class="rounded-circle" src="{{ asset($user->profile_photo) }}" alt="">
                  </div>
                  <div class="text-center profile-details">
                     <h4>{{ $user->first_name.' '.$user->last_name??'' }}</h4>
                     <h6>{{$user->designation->name??''}}</h6>
                  </div>
                  <ul class="card-social">
                     <!-- <button class="btn btn-light ican-envo">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                     </button>
                     <button class="btn btn-light ican-envo">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                     </button> -->
                     <button class="btn btn-light ican-action">Active</button>
                  </ul>
                  <div class="card-footer row">
                     <div class="col-4 col-sm-4">
                        <p class="text-it">Total Issuance</p>
                        <h3 class="counter">{{$issueproduct??''}}</h3>
                     </div>
                     <div class="col-4 col-sm-4">
                        <p class="text-it">Total Transferd</p>
                        <h3><span class="counter">{{$transfer??''}}</span></h3>
                     </div>
                     <div class="col-4 col-sm-4">
                        <p class="text-it">Total Returned</p>
                        <h3><span class="counter">{{$returns??''}}</span></h3>
                     </div>
                  </div>
                  <hr>
                  <div class="col-sm-12">
                    <thead>
                        <tr>
                            <th><b>Employee Id:</b> {{$user->employee_id??''}}</th><br>
                            <th><b>Email:</b> {{$user->email ??''}}</th><br>
                            <th><b>Department:</b> {{$user->department->name??''}}</th><br>
                            <th><b>Designation:</b> {{$user->designation->designation??''}}</th><br>
                            <th><b>Phone No:</b> {{$user->mobile_number??''}}</th> <br>
                        </tr>
                    </thead>
                  </div>
               </div>
            </div>
            <div class="col-md-8">
               <div class="card mt-4 pt-3">
                  <div class="row">
                     <div class="col-md-3">
                        <div class="card card-item">
                           <div class="card-body">
                            <span class="badge badge-light-success done-badge">Currently Holding</span>
                              <h3 class="text-center first-heading">{{$totalitasset}}</h3>
                              <h6 class="text-center"> IT Assets</h6>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="card card-item">
                           <div class="card-body">
                            <span class="badge badge-light-success done-badge">Currently Holding</span>

                              <h3 class="text-center first-heading">{{$totalnonitasset}}</h3>
                              <h6 class="text-center">Non IT Assets</h6>


                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="card card-item">
                           <div class="card-body">
                            <span class="badge badge-light-success done-badge">Currently Holding</span>
                              <h3 class="text-center first-heading">{{$totalcomponent}}</h3>
                              <h6 class="text-center">Asset Component</h6>

                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="card card-item">
                           <div class="card-body">
                            <span class="badge badge-light-success done-badge">Currently Holding</span>
                              <h3 class="text-center first-heading">{{$totalsoftware}}</h3>
                              <h6 class="text-center">Software</h6>


                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- <button class="btn btn-light w-30 d-flex align-items-center justify-content-between" style="background-color: white !important;">
               Select
               <label class="mb-0 ml-2 switch">
               <input type="checkbox" checked="">
               <span class="switch-state"></span>
               </label>
               </button> -->
            </div>
         </div>
      </div>
   </div>
   <!-- <div class="card">
      <div class="card-body">
         <h5> Assets <span class="text-assts">20</span></h5>
      </div>
   </div> -->
   <!-- <div class="card mt-3">
      <div class="card-body">
         <div class="card-header pb-0">
         </div>
         <div class="row py-3">
            First Card
            <div class="col-md-3">
               <div class="card card-box">
                  <div class="card-body">
                     <h5 class="card-title card-text p-2">Dell Inspiron 5510</h5>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>Dell</span></p>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>0123456789</span></p>
                     <p class="card-subtitle mb-2 text-muted">Price: <span>62,000/-</span></p>
                  </div>
               </div>
            </div>
            Second Card
            <div class="col-md-3">
               <div class="card card-box">
                  <div class="card-body">
                     <h5 class="card-title card-text p-2">Dell Inspiron 5510</h5>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>Dell</span></p>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>0123456789</span></p>
                     <p class="card-subtitle mb-2 text-muted">Price: <span>62,000/-</span></p>
                  </div>
               </div>
            </div>
            Third Card
            <div class="col-md-3">
               <div class="card card-box">
                  <div class="card-body">
                     <h5 class="card-title card-text p-2">Dell Inspiron 5510</h5>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>Dell</span></p>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>0123456789</span></p>
                     <p class="card-subtitle mb-2 text-muted">Price: <span>62,000/-</span></p>
                  </div>
               </div>
            </div>
            Fourth Card
            <div class="col-md-3">
               <div class="card card-box">
                  <div class="card-body">
                     <h5 class="card-title card-text p-2">Dell Inspiron 5510</h5>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>Dell</span></p>
                     <p class="card-subtitle mb-2 text-muted">Brand: <span>0123456789</span></p>
                     <p class="card-subtitle mb-2 text-muted">Price: <span>62,000/-</span></p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
</div>
@endsection
