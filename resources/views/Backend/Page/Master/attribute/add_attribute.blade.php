@extends('Backend.Layouts.panel')

@section('Style-Area')
    <style>
        .swal2-popup {
            text-align: center;
        }
    </style>
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
                        <li class="text-muted">Master</li>
                        {{-- <li class="text-muted"><a href="{{url('department')}}" class="text-muted">Department</a></li> --}}
                        <li class="active"><a href="{{ url('attributes') }}">Attributes</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('Content-Area')
    @if (session('success'))
        <div id="alert-message" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p><b> Well done! </b>{{ session('success') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('message'))
        <div id="alerts" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p>{{ session('message') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            Upload Validation Error<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4>Attribute</h4>
                <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal"
                    data-bs-target="#importModal">
                    Import Data
                </button>
            </div>
            <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Data</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('import-attribute') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="select_file">Choose File:</label>
                                    <input type="file" name="select_file" class="form-control" accept=".xls, .xlsx">
                                </div>
                                <a href="{{ route('import.download-format-attribute') }}"
                                    class="btn btn-secondary">Download
                                    Format</a>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="needs-validation" action="{{ route('attribute-store') }}" method="post">
                    @csrf
                    <div class="card-item">
                        <div class="row p-4">
                            <div class="col-md-6 mb-1">
                                <label class="form-label">Asset Type</label>
                                <select class="form-select" id="asset_type_id" name="asset_type_id"
                                    aria-label="Default select example">
                                    <option value="">--Select Asset Type--</option>
                                    @foreach ($assettype as $assettypes)
                                        <option value="{{ $assettypes->id }}">{{ $assettypes->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-1">
                                <label for="form-label">Attribute Name</label>
                                <input class="form-control me-2" id="validationCustom01" type="text" name="name"
                                    required data-bs-original-title="" title="" placeholder="Enter Attribute Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="footer-item">
                        <button class="btn btn-primary mt-3" type="submit" data-bs-original-title=""
                            title="">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0 d-flex">
                <div class="float-left col-sm-6">
                    <h4>Attribute</h4>
                </div>
                <div class="col-sm-6"><a href="{{ route('trash.attributes') }}" class="btn btn-danger float-end">Trash</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Asset Type</th>
                                <th>Attribute Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            {{-- @dd($brandmodel); --}}

                            @foreach ($attributes as $attribute)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attribute->asset_type->name }}</td>
                                    <td>{{ $attribute->name }}</td>

                                    <td class="w-20">
                                        <label class="mb-0 switch">
                                            <input type="checkbox" data-id="{{ $attribute->id }}"
                                                {{ $attribute->status ? 'checked' : '' }}>
                                            <span class="switch-state"></span>
                                        </label>
                                    </td>
                                    {{-- @dd($brandmodel->id); --}}
                                    <td>
                                        <a class="btn btn-primary"
                                            href="{{ url('attributes/' . $attribute->id . '/edit') }}"><i
                                                class="fa fa-pencil"></i> Edit</a>
                                        <button class="btn btn-danger delete-button" type="button"
                                            data-id="{{ $attribute->id }}"><i class="fa fa-trash-o"></i> Trash</button>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Script-Area')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            var alertfunction = $('#alert-message');
            setTimeout(function() {
                alertfunction.alert('close');
            }, 3000);
        });
    </script>

    <script>
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const attributeID = this.getAttribute('data-id');
                const status = this.checked;

                fetch(`/attributes/${attributeID}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    }) // Send the correct status value
                }).then(function(response) {
                    console.log(response);
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    console.log('Status updated successfully');
                }).catch(function(error) {
                    console.error('Error:', error);
                });
            });
        });
    </script>
    <script>
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                const attributeId = this.getAttribute('data-id');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, trash it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('/attributes/' + attributeId, {
                                method: 'delete',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken, // Include the CSRF token in the headers
                                    'Content-Type': 'application/json' // Set the content type
                                }
                            })
                            .then(response => response.json())

                            .then(data => {

                                if ('success' in data && data.success) {
                                    Swal.fire(
                                        'Trash!',
                                        'Your file has been trashed.',
                                        'success'
                                    ).then(() => {
                                        location
                                    .reload(); // Reload the page after the alert is closed
                                    });
                                } else {
                                    Swal.fire(
                                        'Error',
                                        data.message || 'Failed to trash the file.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                Swal.fire(
                                    'Error',
                                    'An error occurred while trashing the file.',
                                    'error'
                                );
                            });
                    }
                });
            });
        });
    </script>
@endsection
