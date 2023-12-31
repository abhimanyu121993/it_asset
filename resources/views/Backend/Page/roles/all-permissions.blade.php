@extends('Backend.Layouts.panel')

@section('Style-Area')
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
                    <li class="text-muted">User-Management</li>
                    {{-- <li class="text-muted"><a href="{{ url('department') }}" class="text-muted">Department</a></li> --}}
                    <li class="active"><a href="{{ url('view-permissions') }}">Add Permission</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Content-Area')
@if (session('success'))
<div id="alert-success" class="alert alert-success inverse alert-dismissible fade show" role="alert"><i class="icon-thumb-up alert-center"></i>
    <p><b> Well done! </b>{{ session('success') }}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif
@if ($errors->any())
<ul class="alert alert-danger inverse alert-dismissible">
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    @endforeach
</ul>
@endif
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
            <h4>Admin Permissions</h4>
            <button class="btn btn-outline-primary permission-btn float-end" type="button" data-original-title="btn btn-outline-danger-2x" title="" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-plus"></i> Add permission
            </button>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog d-flex align-items-center">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Permission</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" action="{{ route('permission.store') }}" method="POST" novalidate="">
                            @csrf
                            <div class="card-item border">
                                <div class="row p-3">
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label" for="roleName">Add Permission</label>
                                        <input class="form-control" id="roleName" name="name" type="text" required="" placeholder="Permission Name">
                                    </div>
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label" for="roleModule">Add Permission Module</label>
                                        <input class="form-control" id="roleModule" name="module" type="text" required="" placeholder="Permission Module Name">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive theme-scrollbar">
                <table class="display" id="basic-1">
                    <thead>
                        <tr class="text-center">
                            <th>SL</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permission as $role)
                        <tr class="text-center">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="w-20">
                                <label class="mb-0 switch">
                                    <input type="checkbox" checked=""><span class="switch-state"></span>
                                </label>
                            </td>
                            <td>
                                {{-- <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary" data-bs-original-title="" title="">Edit</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" data-bs-original-title="" title="">Delete</button>
                                </form> --}}
                                <div class="btn-group">
                                    <a href="{{ route('permission.edit', $role->id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <button class="btn btn-danger delete-button" data-id="{{ $role->id }}" type="button"><i class="fa fa-trash-o"></i> Delete</button>
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
@endsection

@section('Script-Area')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.js"></script>
<script>
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
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    fetch('permissions/' + Id, {

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
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire(
                                    'Error',
                                    'Failed to delete the file.',
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error',
                                'An error occurred while deleting the file.',
                                'error'
                            );
                        });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        var $data = $('#alert-success');
        setTimeout(function() {
            $data.alert('close');
        }, 3000);
    });
</script>
@endsection