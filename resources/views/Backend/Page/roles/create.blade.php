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
                    <li class="text-muted"><a href="{{ url('roles') }}" class="text-muted">Role's</a></li>
                    <li class="active"><a href="{{ url('users') }}">All-Role</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
@section('Content-Area')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0">
            <h4>Create Role</h4>
        </div>
        <div class="card-body">
            <form class="needs-validation" novalidate="">
                <div class="card-item border">
                    <div class="row p-3">
                        <div class="col-md-12 mb-4">
                            <label class="form-label" for="validationCustom01">Add Role</label>
                            <input class="form-control" id="validationCustom01" type="text" required="" data-bs-original-title="" title="" placeholder="Role Name">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
