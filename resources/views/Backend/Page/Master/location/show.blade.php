@extends('Backend.Layouts.panel')

@section('Style-Area')
@endsection

@section('Content-Area')
<div class="col-sm-12">
   <div class="card">
      <div class="card-header pb-0">
         <h4>Location Details</h4>
      </div>
      <div class="card-body">
         <div class="card-item border">
            <div class="row p-3">
               <div class="col-md-12 mb-4">
                  <label class="form-label">Location</label>
                  <p>{{ $locatin->name }}</p>
               </div>
            </div>
         </div>
         <div class="footer-item">
            <a href="{{ route('sublocation-index') }}" class="btn btn-primary mt-3">Back</a>
         </div>
      </div>
   </div>
</div>
@endsection

@section('Script-Area')
@endsection