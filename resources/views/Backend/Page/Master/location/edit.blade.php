<!-- edit_location_view.blade.php -->

@extends('Backend.Layouts.panel')

@section('Style-Area')
@endsection

@section('Content-Area')
<div class="col-sm-12">
   <div class="card">
      <div class="card-header pb-0">
         <h4>Edit Location</h4>
      </div>
      <div class="card-body">
         <form action="{{ route('location-update', $location->id) }}" method="post" class="needs-validation" novalidate="">
            @csrf
            @method('PUT')
            <div class="card-item border">
               <div class="row p-3">
                  <div class="col-md-12 mb-4">
                     <label class="form-label" for="validationCustom01">Location</label>
                     <input class="form-control" id="validationCustom01" name="name" type="text" required="" data-bs-original-title="" title="" placeholder="Enter Location" value="{{ $location->name }}">
                     @error('name')
                     <span class="text-danger">{{$message}}</span>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="footer-item">
               <button class="btn btn-primary mt-3" type="submit" data-bs-original-title="" title="">Update</button>
               <a href="{{ route('location-index') }}" class="btn btn-warning mt-3">Back</a>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('Script-Area')
@endsection