@extends('Backend.Layouts.panel')

@section('Style-Area')
    <style>
        .custom-btn {
            font-size: 11px;
            padding: 5px 10px;
            line-height: 1.5;
            pointer-events: none;
        }

        .ellipsis {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
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
                        <li class="text-muted">Stock</li>
                        {{-- <li class="text-muted"><a href="{{ url('department') }}" class="text-muted">Department</a></li> --}}
                        <li class="active"><a href="{{ url('all-stock') }}">All-Stocks</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Content-Area')
    @if (session('success'))
        <div id="stocks" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header pb-0 d-flex">
                <div class="float-left col-sm-6">
                    <h4>All Stocks</h4>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('stocks.trash') }}" class="btn btn-danger float-end"
                        style="margin-left: 5px;">Trash</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                        <table class="display" id="basic-1">
                            <thead>
                                <tr class="text-center">
                                    <th>SL</th>
                                    <th>Asset Code</th>
                                    <th>Serial Number</th>
                                    <th>Product</th>
                                    <th>Asset Type</th>
                                    <th>Asset</th>
                                    <th>Brand</th>
                                    <th>Brand Model</th>
                                    <th>Configuration</th>
                                    <th>Supplier</th>
                                    <th>Age</th>
                                    <th>Price</th>
                                    <th>Active</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stock as $stock)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $stock->product_number ?? 'N/A' }} </td>
                                        <td>{{ $stock->serial_number ?? 'N/A' }}</td>
                                        <td>{{ $stock->product_info ?? 'N/A' }}</td>
                                        <td>{{ $stock->asset_type->name ?? 'N/A' }}</td>
                                        <td>{{ $stock->assetmain->name ?? 'N/A' }}</td>
                                        <td>{{ $stock->brand->name ?? 'N/A' }}</td>
                                        <td>{{ $stock->brandmodel->name ?? 'N/A' }}</td>
                                        <td class="ellipsis">{{ $stock->configuration ?? 'N/A' }} </td>
                                        <td>{{ $stock->getsupplier->name ?? 'N/A' }} </td>
                                        <td>{{ $stock->ageInYears }} years and {{ $stock->ageInMonths }} months</td>
                                        <td>{{ $stock->price ?? 'N/A' }} </td>
                                        <td class="w-20">
                                            <label class="mb-0 switch">
                                                <input type="checkbox" data-id="{{ $stock->id }}"
                                                    {{ $stock->status ? 'checked' : '' }}><span
                                                    class="switch-state"></span>
                                            </label>
                                        </td>
                                        <td> <span
                                                class=" custom-btn {{ $stock->statuses->status ?? '' }}">{{ $stock->statuses->name ?? 'N/A' }}</span>
                                        </td>
                                        <td>
                                            <img src="{{ $stock->image ? $stock->image : '/Backend/assets/images/It-Assets/default-image.jpg' }}"
                                                alt="Stock Image" width="50">
                                        </td>
                                        <td>
                                            <div class="button-group d-flex justify-content-between align-items-center">
                                                <a style="display: flex; align-item:center;" class="btn btn-primary"
                                                    href="{{ url('/edit-stock/' . $stock->id) }}"><i class="fa fa-pencil"
                                                        style="margin-top: 4px;"></i>&nbsp;Edit</a>&nbsp;
                                                <button style="display: flex;align-item:center;"
                                                    class="btn btn-danger delete-button" data-id="{{ $stock->id }}"
                                                    type="button"><i class="fa fa-trash-o"
                                                        style="margin-top: 4px;"></i>&nbsp;Trash</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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
            var stocks = $('#stocks');
            setTimeout(function() {
                stocks.alert('close');
            }, 3000);
        });
    </script>
    <script>
        $(document).ready(function() {

            $('input[type="checkbox"]').on('change', function() {
                const stockId = $(this).data('id');
                const status = $(this).prop('checked');
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: `/stock-status/${stockId}`,
                    type: 'PUT',
                    data: {
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        console.log('Status updated successfully');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });
        });

        document.querySelectorAll('.delete-button').forEach(function(button) {

            button.addEventListener('click', function() {
                const Id = this.getAttribute('data-id');
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
                        fetch('delete-stock/' + Id, {

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
                                        'Failed to trash the file.',
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
