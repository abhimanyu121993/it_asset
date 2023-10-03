<!-- edit_asset_view.blade.php -->

@extends('Backend.Layouts.panel')

@section('Style-Area')
@endsection

@section('Content-Area')
<div class="col-sm-12">
   <div class="card">
      <div class="card-header pb-0">
         <h4>Edit Asset Type</h4>
      </div>
      <div class="card-body">
         <form action="{{ route('assets-type-update', $asset->id) }}" method="post" class="needs-validation" novalidate="">
            @csrf
            @method('PUT')
            <div class="card-item">
               <div class="row p-3">
                  <div class="col-md-12 mb-4">
                     <label class="form-label" for="validationCustom01">Asset Type Name</label>
                     <input class="form-control" id="validationCustom01" name="name" type="text" required="" data-bs-original-title="" title="" placeholder="Enter Asset Type Name" value="{{ $asset->name }}">
                  </div>
               </div>
            </div>
            <div class="footer-item">
               <button class="btn btn-primary mt-3" type="submit" data-bs-original-title="" title="">Update</button>
               <a href="{{ route('assets-type-index') }}" class="btn btn-warning mt-3">Cancel</a>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('Script-Area')
@endsection