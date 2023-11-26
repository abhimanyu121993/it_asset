<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .card-item {
            height: 142px;
            width: 153px;
        }

        .icofontt {
            float: right;
        }

        .first-heading {
            color: #5C61F2;
            font-size: 30px;
            font-weight: 700;


            border-bottom: 1px solid #5555551A;
        }

        .heading-item {
            color: black;
        }

        .widget-joins .d-flex .flex-grow-1 {
            text-align: left !important;
        }

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }

        .left-header .input-group {
            padding: 12px 15px !important;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f6f8fc;

        }

        .rounded-circle {
            position: relative;
            left: -43px;
        }

        .ican-item-1 {
            background: #4FAAD51A;
            height: 32px;
            width: 40px;
            padding: 8px;
            color: #4FAAD5 !important;
            border-radius: 6px;
            font-weight: 700;
            font-size: 19px;
        }

        .home-item {
            border-bottom: 3px solid #55555533;
        }

        .home-card-item {
            border-right: 3px solid #55555533;
        }

        .home-item-1 {
            border-top: 3px solid #55555533;

        }

        .number-item {
            color: #4FAAD5 !important;
            font-size: 20px;
        }

        input[readonly] {
            background-color: white !important;
        }

        textarea[readonly] {
            background-color: white !important;
        }

        .action-button {
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .action-button:hover {
            background-color: #f0f0f0 !important;
            color: #333;
        }
        /* Add this to your CSS file */
td.narrow-width {
    width: 400px; /* Adjust the width as needed */
}

    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
            <div class="card-body">
            <h4 class="text-center"><b>ASSET TRANSFER FORM </b></h4>
            </div>
            <div class="card-body">
                <b>  When completed and signed by the Manager and Asset Controller of initial/receiver department. Please forword this form to the finance department.</b> 
            </div>
        </div>
        </div>
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4>TRANSFER INFORMATION :</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="p-2">
                                <h6>Transaction Code: {{$transfer->transfers_transaction_code??'N/A'}}</h6>
                                </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-2">
                                <h6>Date and Time : {{$transfer->created_at??'N/A'}}</h6>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row p-3">
                        <h5>Employee Details :</h5>
                        <div class="col-md-4">
                            <div class="p-1">
                                From :<input class="form-control mt-3" value="{{$find->first_name??'N/A'}} {{$find->last_name??'N/A'}}  ({{$transfer->employee_id??'N/A'}})" readonly>
                            </div>
                            {{-- <div class="p-1">
                                EMP Name:<input class="form-control mt-3" value="{{$find->first_name??'N/A'}} {{$find->last_name??'N/A'}}" readonly>
                            </div> --}}
                        </div>
                        <div class="col-md-4">
                            <div class="p-1">
                                Handover To:<input class="form-control mt-3" value="{{$find2->first_name??'N/A'}} {{$find2->last_name??'N/A'}} ({{$transfer->handover_employee_id??'N/A'}})" readonly>
                            </div>
                            {{-- <div class="p-1">
                                Manager Name:
                                <input class="form-control mt-3" value="{{$user->first_name??'N/A'}} {{$user->last_name??'N/A'}}" readonly>
                            </div> --}}
                        </div>
                        <div class="col-md-4">
                            <div class="p-1">
                                <h5>Description:</h5>
                                <textarea readonly disabled cols="30" rows="3" autofocus class="form-control mt-3">{{$transfer->description??''}}</textarea>
                            </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row p-3">
                        <h5>Location Details :</h5>
                        <div class="col-md-6">
                            <div class="p-1">
                                From :<input class="form-control mt-3" value="{{$find->location->name??'N/A'}} ({{$find->slocation->name??'N/A'}})" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-1">
                                To :<input class="form-control mt-3" value="{{$find2->location->name??'N/A'}} ({{$find2->slocation->name??'N/A'}})" readonly>
                            </div>
                    </div>
                </div>
            </div>   
            <div class="card">
                <div class="card-body">
                    <h4>Approved By :</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="p-2">
                                <h5>Initial:</h5>
                                <b>Manager Info:</b>
                                <input class="form-control mt-3" readonly>
                                <br>
                                <b>Asset Controller Info:</b>
                                <input class="form-control mt-3" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-2">
                                <h5>Receiver :</h5>
                                <b>Manager Info:</b>
                                <input class="form-control mt-3" value="{{$user->first_name??'N/A'}} {{$user->last_name??'N/A'}}   ({{$user->employee_id??''}})" readonly>
                                <br>
                                <b>Asset Controller Info:</b>
                                <input class="form-control mt-3" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="card">
                <div class="card-body">
                    <div class="row p-3">
                        <div class="col-md-5">
                            <div class="p-2">
                            <h5>Transaction Code:</h5>
                            <input class="form-control mt-3" value="{{$transfer->transfers_transaction_code??'N/A'}}" readonly>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <h5>Description:</h5>
                           
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="card appointment-detail">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <div class="setting-list">
                            <ul class="list-unstyled setting-option">
                                <li>
                                    <div class="setting-light"><i class="icon-layout-grid2"></i></div>
                                </li>
                                <li><i class="view-html fa fa-code font-white"></i></li>
                                <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                <li><i class="icofont icofont-minus minimize-card font-white"></i></li>
                                <li><i class="icofont icofont-refresh reload-card font-white"></i></li>
                                <li><i class="icofont icofont-error close-card font-white"> </i></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4>Assets Details:</h4>
                    <div class="table-responsive theme-scrollbar">
                        <table class="table table-bordered">
                            <thead>
                                <th>Asset Code </th>
                                <th>Serial Number</th>
                                <th>Asset Type</th>
                                <th>Asset</th>
                                <th>Product Info</th>
                                <th>Warranty</th>
                                <th>Supplier</th>
                            </thead>
                            <tbody>
                                @foreach ($productdata as $stock)
                                    <tr>
                                        <td>{{$stock->product_number??''}}</td>
                                        <td>{{$stock->serial_number??''}}</td>
                                        <td>{{$stock->asset_type->name??''}}</td>
                                        <td>{{$stock->assetmain->name??'N/A'}}</td>
                                        <td class="narrow-width">{{$stock->configuration ?? ''}}</td>
                                        <td>{{$stock->product_warranty??''}}</td>
                                        <td>{{$stock->getsupplier->name??''}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>Signatures:</h4>
                    <div class="table-responsive theme-scrollbar">
                        <table class="table table-bordered">
                            <thead>
                                <th>Description</th>
                                <th>IT Department(For IT Assets)</th>
                                <th>Initial Department</th>
                                <th>Receiver Department</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> <b>Name </b> </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Title </b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Signature </b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Date </b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><b>Department Head Signature </b></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>FOR FINANCIAL SERVICE USE ONLY :</h4>
                    <br>
                    <div class="row">
                        <div class="col-12">
                        <pre><b>Date Recevied:</b>___________________<b>Date entered in Banner:</b>_______________________________________________________________
Initials:______________________________________________________________________________________________________________
Comments_______________________________________________________________________________________________________________
_______________________________________________________________________________________________________________________
_______________________________________________________________________________________________________________________
_______________________________________________________________________________________________________________________
_______________________________________________________________________________________________________________________</pre>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        window.print();
    };
</script>
</body>
</html>

