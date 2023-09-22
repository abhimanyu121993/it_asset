@extends('Backend.Layouts.panel')
@section('Style-Area')
<style>
    #dynamicFields {
        margin-top: 20px;
    }

    .dynamic-field {
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 10px;
        background-color: #f5f5f5;
        border-radius: 5px;
        display: flex;
    }

    .dynamic-field label {
        font-weight: bold;
    }

    .dynamic-field input {
        width: 50%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
        margin-right: 10px;
    }

    .dynamic-field select {
        width: 50%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 3px;
    }

    .remove-field {
        cursor: pointer;
        color: #d9534f;
        font-weight: bold;
        transform: translateY(12px);
    }

    .add-field {
        cursor: pointer;
        color: #5bc0de;
        font-weight: bold;
    }

    .add-field {
        cursor: pointer;
        color: #5bc0de;
        font-weight: bold;
    }
</style>
@endsection
@section('Content-Area')
@if (session('success'))
<div id="alert-delete" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="icon-thumb-up alert-center"></i>
    <p><b> Well done! </b>{{ session('success') }}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="col-sm-12">
    <form class="needs-validation" enctype="multipart/form-data" method="POST" action="{{ isset($stockedit) ? route('update.stock', $stockedit->id) : route('store.stock') }}">
        @csrf
        <div class="card">
            <div class="card-header pb-0">
                <h4>{{ isset($stockedit) ? 'Update Stock' : 'Add Stock' }}</h4>
            </div>
            <div class="card-body">
                <div class="card-item border mb-3 p-2">
                    <div class="row mb-2 p-2">
                        <div class="col-md-6">
                            <label class="form-label" for="validationCustom01">Asset Category</label>
                            <select class="form-select" id="assettype" name="asset_type" aria-label="Default select example">
                                <option>--Select Asset Category--</option>
                                @foreach ($asset_type as $asset_type)
                                <option value="{{ $asset_type->id }}" {{ isset($stockedit) && $stockedit->asset_type_id == $asset_type->id ? 'selected' : '' }}>
                                    {{ $asset_type->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="validationCustom01">Asset</label>
                            <select class="form-select" id="asset" name="asset" aria-label="Default select example">
                                <option value="">--Select Asset--</option>
                            </select>
                        </div>

                    </div>
                    <div class="row p-3" id="showbrand">
                        <div class="col-md-6 mb-4">
                            <label class="form-label" for="validationCustom01">Brand</label>
                            <select class="form-select" id="brand" name="brand" aria-label="Default select example">
                                <option value="">--Select Brand --</option>
                                @foreach ($brand as $brand)
                                <option value="{{$brand->id}}" {{ isset($stockedit) && $stockedit->brand_id == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="validationCustom01">Brand Model</label>
                            <select id="brand_model" class="form-select" name="brand_model" aria-label="Default select example">
                                <option value="">--Select Model--</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
                <h4>Product Details</h4>
            </div>
            <div class="card-body">
                <div class="card-item border">
                    <div class="row p-3">
                        <div class="col-md-4">
                            <label class="form-label" for="validationCustom01">Product Info</label>
                            <input class="form-control" value="{{isset($stockedit)?$stockedit->product_info:''}}" id="validationCustom01" type="text" name="product_info" data-bs-original-title="" title="" placeholder="Enter Product Info">
                            @error('product_info')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-4" id="serialnumber">
                            <label class="form-label" for="validationCustom01">Serial number</label>
                            <input class="form-control" id="validationCustom01" value="{{isset($stockedit)?$stockedit->serial_number:''}}" name="serial_number" type="text" data-bs-original-title="" title="" placeholder="Enter Serial Number">
                        </div>
                        <div class="col-md-4 mb-4" id="licenseNumberField">
                            <label class="form-label" for="validationCustom01">License Number</label>
                            <input class="form-control" id="validationCustom01" type="text" name="liscence_number" data-bs-original-title="" value="{{isset($stockedit)?$stockedit->liscence_number:''}}" title="" placeholder="Enter License Number">
                        </div>
                        <div class="col-md-4 mb-4" id="quantityField">
                            <label class="form-label" for="validationCustom01">Quantity</label>
                            <input class="form-control" id="validationCustom01" type="text" name="quantity" data-bs-original-title="" title="" placeholder="Enter Quantity">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="float: left;">Asset Code :</label>
                            <a href="#" id="generateNumber" style="float: left;">Generate Number</a>
                            <input class="form-control" type="text" id="generateNumberInput" name="generate_number" placeholder="Generate Number" readonly>
                            {{-- <img id="" src="{{ asset('Backend/assets/images/IT-Assets/Vector_qr.png')}}" alt="QR Code"> --}}
                        </div>
                        <div class="col-md-4 mb-4">
                            <label for="multiSelect">Select Attribute:</label>
                            <select class="form-control js-example-placeholder-multiple" name="attribute" id="attribute" multiple>
                                <!-- dd($attribute); -->
                                <option value="">--Select Attribute--</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-4">
                     <label class="form-label" for="validationCustom01">Location</label>
                     <select class="form-select" id="location" name="location" aria-label="Default select example">
                        <option>--Select Location--</option>
                        @foreach ($location as $location)
                        <option value="{{$location->id}}" {{ isset($stockedit) && $stockedit->location_id == $location->id ? 'selected' : '' }}>{{$location->name}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label class="form-label" for="validationCustom01">Sub Location</label>
                        <select id="slocation" class="form-select" name="sublocation" aria-label="Default select example">
                            <option value="">--Select Sub Location--</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-4">
                        <label class="form-label" for="validationCustom01">Host Name</label>
                        <input class="form-control" id="validationCustom01" name="host_name" type="text" data-bs-original-title="" title="" placeholder="Enter Host Name">
                    </div>
                    <div class="col-md-4 mb-4">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <div id="dynamicFields" class="col-md-12"></div>
                </div>
            </div>
            <div class="card-item border">
                <div class="row p-3" id="configuration">
                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="validationCustom01"> Configuration</label>
                        <textarea class="form-control" name="configuration" value="{{ isset($stockedit) ? $stockedit->configuration : '' }}" id="exampleFormControlTextarea1" placeholder="configuration" rows="3"></textarea>
                    </div>
                </div>
                <div class="row p-3">
                    <div class="col-md-12 mb-4" id="specificationField">
                        <label class="form-label" for="validationCustom01">Specification</label>
                        <textarea class="form-control" name="specification" id="exampleFormControlTextarea1" placeholder="Specification" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="card-item border">
                <div class="row p-3">
                    {{-- <div class="col-md-4">
                        <label class="form-label" for="validationCustom01">Vendor</label>
                        <input class="form-control" id="validationCustom01" name="vendor" type="text" data-bs-original-title="" value="{{ isset($stockedit) ? $stockedit->vendor : '' }}" title="" placeholder="Enter Vendor">
                </div> --}}
                <div class="col-md-4 mb-4">
                    <label class="form-label" for="validationCustom01">Suppliers</label>
                    <select class="form-select" id="supplier" name="supplier" aria-label="Default select example">
                        <option value="">--Select Supplier --</option>
                        @foreach ($supplier as $supplier)
                        <option value="{{ $supplier->id }}" {{ isset($stockedit) && $stockedit->supplier_id == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-4">
                    <label class="form-label" for="validationCustom01">Price</label>
                    <input class="form-control" id="validationCustom01" value="{{ isset($stockedit) ? $stockedit->price : '' }}" type="text" name="price" data-bs-original-title="" title="" placeholder="Enter Price">
                    @error('price')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 mb-4" id="warranty">
                    <label class="form-label" for="warrantyDateInput">Warranty</label>
                    <div class="input-group">
                        <input class="datepicker-here form-control digits" id="warrantyDateInput" name="product_warranty" type="text" data-language="en">
                        <span class="input-group-text" id="warrantyCalendarIcon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>

                <div class="col-md-4 mb-4" id="expiryField">
                    <label class="col-form-label" for="expiryDateInput">Expiry</label>
                    <div class="input-group">
                        <input class="datepicker-here form-control" id="expiryDateInput" name="expiry" type="text" data-language="en">
                        <span class="input-group-text" id="expiryCalendarIcon">
                            <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <label class="col-form-label" for="expiryDateInput">Status</label>
                    <select class="form-select" id="status" name="status" aria-label="Default select example">
                        <option value="">--Select Status--</option>
                        @foreach ($status as $status)
                        <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="footer-item">
            <button class="btn btn-primary mt-3" type="submit">{{ isset($stockedit) ? 'UPDATE' : 'ADD' }}</button>
            <a href="{{url('all-stock')}}" class="btn btn-warning mt-3" type="button" data-bs-original-title="" title="">Cancel</a>
        </div>
</div>
</div>
</form>
</div>
@endsection
@section('Script-Area')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var alert = $('#alert-delete');
        setTimeout(function() {
            alert.alert('close');
        }, 3000);
    });
</script>
<script>
    $(document).ready(function() {
        $("#generateNumber").click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/generate/number",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#generateNumberInput").val(data.number);
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#attribute').on('change', function() {
            // alert('hi');
            $('#dynamicFields').empty();

            $('#attribute option:selected').each(function() {
                var optionValue = $(this).val();
                var optionText = $(this).text();

                var dynamicField = `
                   <div class="dynamic-field">
                       <input type="" readonly value="${optionText}">
                       <input type="text" name="attribute_value" placeholder="Enter input">
                   </div>
               `;
                $('#dynamicFields').append(dynamicField);
            });
        });
    });
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('#brand').change(function() {
            var brandId = jQuery(this).val();
            jQuery('#brand_model').empty();

            if (brandId) {
                jQuery.ajax({
                    url: '/get-brand-models/' + brandId,
                    type: 'POST',
                    data: 'brandId' + brandId + '&_token={{ csrf_token() }}',
                    success: function(data) {
                        jQuery('#brand_model').append(
                            '<option value="">--Select Model--</option>');
                        jQuery.each(data.models, function(key, value) {
                            jQuery('#brand_model').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    });

    //location
    jQuery(document).ready(function() {
        jQuery('#location').change(function() {
            let locationId = jQuery(this).val();
            jQuery('#slocation').empty();

            if (locationId) {
                jQuery.ajax({
                    url: '/get-slocation/' + locationId,
                    type: 'POST',
                    data: 'locationId' + locationId + '&_token={{ csrf_token() }}',
                    success: function(data) {
                        jQuery('#slocation').append(
                            '<option value="">--Select Sub-location--</option>');
                        jQuery.each(data.locations, function(key, value) {
                            jQuery('#slocation').append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    });

    jQuery(document).ready(function() {
        jQuery('#assettype').change(function() {
            let assettypeId = jQuery(this).val();
            jQuery('#asset').empty();

            if (assettypeId) {
                jQuery.ajax({
                    url: '/get-asset-type/' + assettypeId,
                    type: 'POST',
                    data: 'assettypeId' + assettypeId + '&_token={{csrf_token()}}',
                    _cache: new Date().getTime(),
                    success: function(data) {
                        jQuery('#asset').append('<option value="">--Select Asset--</option>');
                        jQuery.each(data.assets, function(key, value) {
                            jQuery('#asset').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                        jQuery('#attribute').append('<option value="">--Select Attribute--</option>');
                        jQuery.each(data.attribute, function(key, value) {
                            jQuery('#attribute').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Hide all dynamic fields initially
        $('#quantityField, #specificationField, #licenseNumberField, #expiryField').hide();

        // Handle changes in the asset type dropdown
        $('#assettype').change(function() {
            var selectedAssetTypeId = $(this).val();

            // Make an AJAX call to fetch data from the server
            $.ajax({
                url: '/get-asset-details/' + selectedAssetTypeId, // Replace with your actual route
                method: 'POST',
                data: 'selectedAssetTypeId' + selectedAssetTypeId + '&_token={{csrf_token()}}',
                success: function(data) {
                    // alert(data);
                    // Hide all dynamic fields
                    $('#quantityField, #specificationField, #licenseNumberField, #expiryField').hide();

                    // Show/hide fields based on the fetched data
                    if (data.assetType === 'IT Asset Component') {
                        // Show quantity and specification fields
                        $('#quantityField, #specificationField, #showbrand,#warranty').show();
                        $('#serialnumber, #configuration').hide();
                    } else if (data.assetType === 'Non IT Asset') {
                        // alert('hi');
                        // Show quantity and specification fields
                        $('#quantityField, #specificationField, #showbrand, #warranty').show();
                        $('#serialnumber, #configuration').hide();
                    } else if (data.assetType === 'Software') {
                        // Show license number and expiry fields
                        $('#licenseNumberField, #expiryField, #configuration').show();
                        $('#serialnumber,#showbrand,#warranty').hide();
                    } else {
                        // Default: Show serial number field only
                        $('#serialnumber, #showbrand,#configuration,#warranty').show();
                        $('#serial_number_label').text('Serial Number');
                    }
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#warrantyDateInput, #warrantyCalendarIcon, #expiryDateInput, #expiryCalendarIcon').datepicker();
    });
</script>
@endsection
