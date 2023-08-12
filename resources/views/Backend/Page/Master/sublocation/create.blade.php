@extends('Backend.Layouts.panel')

@section('Style-Area')
@endsection

@section('Content-Area')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
            <h4>Add Sub Location</h4>
        </div>
        <div class="card-body">
            <form class="needs-validation" novalidate="" method="POST" action="{{ route('sublocation-store') }}">
                @csrf
                <div class="card-item border">
                    <div class="row p-3">
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="validationCustom01">Location</label>
                            <select class="form-control" id="validationCustom01" name="location_id">
                                @foreach ($locations as $location)
                                <option value="{{$location->id}}">{{$location->id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="validationCustom01">Sub Location</label>
                            <input class="form-control" id="validationCustom01" name="name" type="text" required="" data-bs-original-title="" title="" placeholder="Enter Sub Location" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="footer-item">
                    <button class="btn btn-primary mt-3" type="submit" data-bs-original-title="" title="">ADD</button>
                    <a href="{{ route('sublocation-index') }}" class="btn btn-warning mt-3">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('Script-Area')
@endsection