@extends('Backend.Layouts.panel')

@section('Style-Area')
@endsection

@section('Content-Area')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4>Edit BrandModel</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('brand-model.update',$brand->id) }}" method="POST">
                    @isset($brand)
                    @method('PATCH')
                    @endisset
                    @csrf
                    <div class="card-item border">
                        <div class="row p-4">
                            <div class="col-md-12 mb-1 d-flex align-items-center">
                                <select class="form-select" id="brand_id" name="brand_id" required>
                                    <option value="" disabled selected>Select a Brand</option>
                                    @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <input class="form-control" @error('name') is-invalid @enderror id="name" type="text"
                                    name="name" value="{{$brand->name}}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="footer-item">
                        <button class="btn btn-primary mt-3" type="submit">Update</button>
                        <a class="btn btn-warning mt-3" href="{{ route('create-brand') }}">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('Script-Area')
@endsection
