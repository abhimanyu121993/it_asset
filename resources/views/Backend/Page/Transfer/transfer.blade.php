@extends('Backend.Layouts.panel')

@section('Style-Area')
    <style>
        #myDiv {
            display: none;
        }

        .change-card {
            transform: none;
            transition: all ease .5s;
        }

        .change-card:hover {
            transition: all ease .5s;
            cursor: pointer;
        }

        .selected {
            background-color: #e6f7ff;
            border: 2px solid #007bff;
        }

        .locked {
            pointer-events: none;
            opacity: 0.7;

        }

        .card-footer {
            background-color: white;
            border-top: none;
            padding: 1rem;

        }

        .card-footer button {
            margin: 0;
        }

        .d-flex.justify-content-between {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-head {
            padding: 1rem;
            margin-bottom: 0;
        }

        .card-body {
            padding-top: 0;
            padding-bottom: 1rem;
        }

        .btna {
            position: relative;
            padding: 10px;
            display: inline-block;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid #ccc;
            background: #fff;
            color: #333;
            border-radius: 10px;
            width: 200px;
            text-align: center;
        }

        .btna label {
            white-space: nowrap;
            /* Prevent text wrapping */
        }

        input[type="radio"].toggle {
            display: none;
        }

        input[type="radio"].toggle+label {
            min-width: 60px;
            white-space: nowrap;
        }

        input[type="radio"].toggle:checked+label {
            border-color: #11014d;
            color: #11014d;
            background: #e6f7ff;

        }

        input[type="radio"].toggle:checked+label::before {
            content: '';
            position: absolute;
            left: -0px;
            top: -0px;
            width: 100%;
            height: 100%;
            background-color: #11014d;
            color: white;
            transition: transform 0.3s;
            border-radius: 10px;
        }

        input[type="radio"].toggle-right:checked+label::before {
            content: 'Maintenance';
            padding: 10px;
            color: white;
            font-weight: bold;
            transform: translateX(0);
            border: none;
        }
        input[type="radio"].toggle-middle:checked+label::before {
            content: 'Return';
            padding: 10px;
            color: white;
            font-weight: bold;
            transform: translateX(0);
            border: none;
        }

        input[type="radio"].toggle-left:checked+label::before {
            content: 'Transfer';
            padding: 10px;
            color: white;
            border: none;
            font-weight: bold;
            transform: translateX(0);
        }

        /* Style for unselected rows */
        /* Style for unselected rows */
        /* Style for unselected rows */
        tr.unselected {
            background-color: #fff;
            transition: background-color 0.3s, border 0.3s;
            border: 2px solid transparent;
        }

        /* Style for selected rows with animation */
        tr.selected {
            background-color: #e6f7ff;
            border: 2px solid #007bff;
            animation: selectAnimation 0.5s ease;
        }

        @keyframes selectAnimation {
            0% {
                background-color: #e6f7ff;
            }

            50% {
                background-color: #ccebff;
            }

            100% {
                background-color: #e6f7ff;
            }
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style>
        /* Custom styles for breadcrumbs */
        .breadcrumbs-dark ol.breadcrumbs {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }
     
        .breadcrumbs-dark ol.breadcrumbs li {
            font-size: 14px;
            /* Adjust font size as needed */
            color: #555;
            /* Adjust text color as needed */
        }
     
        .breadcrumbs-dark ol.breadcrumbs li:not(:last-child):after {
            content: ">";
            margin-left: 10px;
            margin-right: 10px;
            color: #777;
        }
     
        .breadcrumbs-dark ol.breadcrumbs li.text-muted {
            color: #333;
            font-weight: bold;
        }
     
        .breadcrumbs-dark ol.breadcrumbs li.text-muted a {
            color: #333;
            font-weight: bold;
        }
     
        .breadcrumbs-dark ol.breadcrumbs li.active a {
            color: #333;
            font-weight: bold;
        }
     
        .breadcrumbs-dark ol.breadcrumbs li.active a:hover {
            color: blue;
        }
     </style>
     @endsection
     @section('breadcrumbs')
     <div class="breadcrumbs-dark pb-0 pt-2" id="breadcrumbs-wrapper">
        <div class="container">
            <div class="row">
                <div class="col s10 m6 l6">
                    <ol class="breadcrumbs mb-2">
                        <li class="text-muted">Dashboard</li>
                        <li class="text-muted">Transfer/Return</li>
                        {{-- <li class="text-muted"><a href="{{ url('department') }}" class="text-muted">Department</a></li> --}}
                        <li class="active"><a href="{{ url('transfer') }}">Transfer</a></li>
                    </ol>
                </div>
            </div>
        </div>
     </div>
     @endsection

@section('Content-Area')
    @if (session('success'))
        <div class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p>{{ session('success') }}</b>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger inverse alert-dismissible fade show" role="alert">
            <p>{{ session('error') }}</b>
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger outline" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Employee Id</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label" for="employeeId">Employee's ID</label>
                    <input class="form-control" type="search" name="employeeId" id="employeeId">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-sm-12"> --}}
    <div class="col-sm-12">
        <div class="card-item border mt-3 card">
            <div class="card-header pb-0 d-flex text-center switch-button-container">
                <div class="float-left col-sm-3 mt-2">
                    <h4>Choose Type:</h4>
                </div>
                <div class="col-sm-9 mb-4 text-end">
                    <a href="{{ url('transfer') }}" class="btna">
                        <input type="radio" class="toggle toggle-left" name="transfer-return" value="transfer"
                            id="transfer-radio" checked>
                        <label for="transfer-radio">Transfer</label>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('return') }}" class="btna">
                        <input type="radio" class="toggle toggle-middle" name="transfer-return" value="return"
                            id="return-radio">
                        <label for="return-radio">Return</label>
                    </a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('user.apply') }}" class="btna">
                        <input type="radio" class="toggle toggle-right" name="transfer-return" value="maintenance"
                            id="maintenance-radio">
                        <label for="maintenance-radio">Maintenance</label>
                    </a>
                </div>
            </div>
        </div>
        <form class="needs-validation" method="post" action="{{ route('transfer-store') }}" novalidate="">
            @csrf
            <div class="card" id="employee-step">
                <div class="card-header pb-0">
                    <h4>Product Details</h4>
                </div>
                {{-- <input type="hidden" name="selectedCardIds[]" id="selectedCardIds" value=""> --}}
                <div class="card-body">
                    <div class="card-item mt-3">
                        <div class="row py-3" id="assetdetail">
                            <table class="table" id="assetTable">
                                <thead>
                                    <tr>
                                        <th>Asset Code</th>
                                        <th>Serial Number</th>
                                        <th>Product</th>
                                        <th>Asset Type</th>
                                        <th>Asset</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($data)
                                        @foreach ($data as $asset)
                                            <tr data-card-id="{{ $asset->id }}">
                                                <td>{{ $asset->product_number ?? 'N/A' }}</td>
                                                <td>{{ $asset->serial_number ?? 'N/A' }}</td>
                                                <td width="20%;">{{ $asset->product_info ?? 'N/A' }}</td>
                                                <td>{{ $asset->asset_type->name ?? 'N/A' }}</td>
                                                <td>{{ $asset->assetmain->name ?? 'N/A' }}</td>
                                                <td>
                                                    <button class="btn btn-primary add-button" type="button">Add</button>
                                                    <button class="btn btn-danger remove-button" style="display: none;"
                                                        type="button">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3" id="select-asset-step">
                <div class="card-body">
                    <div class="card-head">
                        <h4>Transfer Details</h4>
                    </div>
                    <div class="row mx-4">
                        <div class="col-md-12 mt-2 mb-4">
                            <label class="form-label" for="validationCustom01">Transfer Reason:</label>
                            <select class="form-control" aria-label="Default select example" name="reason"
                                id="transferTypeSelect">
                                <option selected>Select Reason</option>
                                @foreach ($reason as $reasons)
                                    <option value="{{ $reasons->id }}">{{ $reasons->reason }}</option>
                                @endforeach
                            </select>
                            @error('reason')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror

                        </div>
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="employeeId">Handover to Employee's</label>
                            <input class="form-control"name="handoverId" data-bs-original-title="" title=""
                                placeholder="Enter Employee's ID" id="handoveremployeeId" oninput="handover()"
                                onkeydown="return event.key != 'Enter';" required>
                            @error('handoverId')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-item border mt-3 card mx-4" id="handoveremployee" style="display: none;">
                        <div class="row p-3">
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="validationCustom01">Name:</label>
                                <input class="form-control" id="employeename" type="text" data-bs-original-title=""
                                    title="" placeholder="Abhi" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="validationCustom01">Department:</label>
                                <input class="form-control" id="department" type="text" data-bs-original-title=""
                                    title="" placeholder="IT Department" readonly>
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="form-label" for="validationCustom01">Designation:</label>
                                <input class="form-control" id="designation" type="text" data-bs-original-title=""
                                    title="" placeholder="HR" readonly>
                                <input type="hidden" name="employeeId" value="{{ $auth }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3" id="additional-details-step">
                <div class="card-header">
                    <h4>Description</h4>
                </div>
                <div class="row px-5">
                    <div class="col-md-12 mb-4">
                        <label class="form-label" for="validationCustom01">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="" name="description" rows="3"></textarea>
                        @error('description')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="footer-item mt-3 mb-3 d-flex justify-content-end">
                    <button class="btn btn-primary mt-2" type="submit" data-bs-original-title="" title="">Proceed
                        Request</button>
                </div>
            </div>
        </form>
    </div>
    {{-- </div> --}}
@endsection

@section('Script-Area')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        const transferButton = document.querySelector('#transfer-radio');
        const returnButton = document.querySelector('#return-radio');
        const miantenance = document.querySelector('#maintenance-radio');
        transferButton.addEventListener('click', function() {
            window.location.href = "{{ url('transfer') }}";
        });
        returnButton.addEventListener('click', function() {
            window.location.href = "{{ route('return') }}";
        });
        miantenance.addEventListener('click', function() {
            window.location.href = "{{ route('user.apply') }}";
        });
        $(document).ready(function() {
            const steps = ["employee-step", "select-asset-step", "additional-details-step"];
            let currentStep = 0;

            $(".next-step").click(function() {
                $("#" + steps[currentStep]).hide();
                currentStep++;
                $("#" + steps[currentStep]).show();
            });

            $(".prev-step").click(function() {
                $("#" + steps[currentStep]).hide();
                currentStep--;
                $("#" + steps[currentStep]).show();
            });
        });
        const form = document.querySelector(".f1");

        function handover() {
            var inputField = document.getElementById('handoveremployeeId');
            var div = document.getElementById('handoveremployee');

            if (inputField.value.trim() !== '') {
                div.style.display = 'block';
            } else {
                div.style.display = 'none';
            }
        }
        $(document).ready(function() {
            $("#assetTable").on("click", ".add-button", function() {
                var cardId = $(this).closest('tr').data('card-id');
                $('#assetdetail').append('<input type="hidden" name="selectedAssets[]" value="' + cardId +
                    '">');
                $(this).hide();
                $(this).siblings(".remove-button").show();
                $(this).closest('tr').addClass('selected');
            });

            // Remove button click event
            $("#assetTable").on("click", ".remove-button", function() {
                var cardId = $(this).closest('tr').data('card-id');
                var inputElement = $('#assetdetail input[name="selectedAssets[]"][value="' + cardId + '"]');
                if (inputElement.length > 0) {
                    var currentValue = inputElement.val();
                    var updatedValue = currentValue.replace(cardId, '');
                    inputElement.val(updatedValue);
                }
                $(this).hide();
                $(this).siblings(".add-button").show();
                $(this).closest('tr').removeClass('selected');
            });
        });

        $(document).ready(function() {
            $("#handoveremployeeId").on("input", function() {
                var employeeId = $(this).val();
                $.ajax({
                    url: "/server_script",
                    method: "GET",
                    data: {
                        employeeId: employeeId
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        $("#employeename").val(data.first_name);
                        if (data.department) {
                            $("#department").val(data.department.name);
                        } else {
                            $('#department').val("");
                        }
                        if (data.designation) {
                            $("#designation").val(data.designation.designation);
                        } else {
                            $("#designation").val("");
                        }
                    }
                });
            });
        });
    </script>
@endsection
