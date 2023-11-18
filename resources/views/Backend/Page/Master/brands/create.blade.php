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
                        <li class="active"><a href="{{ url('brands/create') }}">Brands</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Content-Area')
    @if (session('success'))
        <div id="alrt-message" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p>{{ session('success') }}</b>
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
    @if (session('message'))
        <div id="alerts" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
                class="icon-thumb-up alert-center"></i>
            <p>{{ session('message') }}</p>
            <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4>Brand</h4>
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
                            <form action="{{ route('import.store.brand') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="select_file">Choose File:</label>
                                    <input type="file" name="select_file" class="form-control"
                                        accept=".xls, .xlsx">
                                </div>
                                <a href="{{ route('import.download-format-brand') }}" class="btn btn-secondary">Download
                                    Format</a>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="needs-validation" novalidate method="POST" action="{{ url('/brands') }}">
                    @csrf
                    <div class="card-item">
                        <div class="row p-3">
                            <div class="col-md-12 mb-4">
                                <label class="form-label" for="validationCustom01">Add Brand</label>
                                <input class="form-control" id="validationCustom01" type="text"
                                    value="{{ old('name') }}" name="name" required="" data-bs-original-title=""
                                    title="" placeholder="Enter Brand Name">
                                @error('name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
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
                    <h4>List Brand</h4>
                </div>
                <div class="col-sm-6"><a href="{{ route('trash.brand') }}" class="btn btn-primary float-end">Trash</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive theme-scrollbar">
                    <table class="display" id="basic-1">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $brand->name }}</td>
                                    <td class="w-20">
                                        <label class="mb-0 switch">
                                            <input type="checkbox" data-id="{{ $brand->id }}"
                                                {{ $brand->status ? 'checked' : '' }}>
                                            <span class="switch-state"></span>
                                        </label>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ url('/brands/' . $brand->id . '/edit') }}"><i
                                                class="fa fa-pencil"></i>&nbsp; Edit</a>
                                        <button class="btn btn-danger delete-button" type="button"
                                            data-id="{{ $brand->id }}"><i class="fa fa-trash-o"></i>&nbsp;
                                            Trash</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            var alertfunction = $('#alrt-message');
            setTimeout(function() {
                alertfunction.alert('close');
            }, 3000);
        });
    </script>
    <script>
        // Add an event listener to the checkboxes for updating the brand status
        document.querySelectorAll('input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const brandId = this.getAttribute('data-id');
                const status = this.checked;

                // Send an AJAX request to update the status
                fetch(`/brands/${brandId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        status: status
                    }) // Send the correct status value
                }).then(function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    // Optionally, you can handle the response here
                    console.log('Status updated successfully');
                }).catch(function(error) {
                    // Handle errors if any
                    console.error('Error:', error);
                });
            });
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
    <script>
        document.querySelectorAll('.delete-button').forEach(function(button) {
            button.addEventListener('click', function() {
                const brandId = this.getAttribute('data-id');
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
                        fetch('/brands/' + brandId, {
                                method: 'delete',
                                headers: {
                                    'X-CSRF-TOKEN': csrfToken,
                                    'Content-Type': 'application/json'
                                }
                            })
                            .then(response => response.json())

                            .then(data => {

                                if ('success' in data && data.success) {
                                    Swal.fire(
                                        'Trashed!',
                                        'Your file has been trashed.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
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
