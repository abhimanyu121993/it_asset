@extends('Backend.Layouts.panel')

@section('Style-Area')
<style>
    .img {
        width: 100%;
    }

    .square-image {
        width: 100px; /* You can adjust this value to your desired square size */
        height: 100px; /* Keep the same value as width to maintain a square aspect ratio */
    }
</style>
@endsection

@section('Content-Area')
<div class="col-sm-12">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="" role="group" aria-label="Toggle View">
                <button id="toggleListView" class="btn btn-primary">View List</button>
                <button id="toggleCardView" class="btn btn-primary">View Card</button>
            </div>
        </div>
    </div>
    <div class="row" id="userList" style="display: none;">
        <div class="col-md-12">
            <table class="display" id="basic-1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Profile Photo</th>
                        <th>Department</th>
                        <th>Designation</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <img src="{{ asset($user->profile_photo) }}" alt="Profile Photo" style="width: 100px; height: 50px;">
                            </td>
                            <td>{{$user->department->name??''}}</td>
                            <td> {{ $user->designation->designation??'' }} </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger sweet-5" type="submit" style="display: inline-block;" onclick="return  confirm('Are you sure')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
    <div class="row" id="userCard">
       @foreach ($users as $user)
        <div class="col-lg-4 col-md-6 box-col-33">
            <div class="card custom-card">
                <!-- ... Card view content ... -->
                <div class="card-header"><img class="img-fluid img" src="{{ asset($user->cover_photo) }}" style="width: 300px; height: 100px;" alt="Uploaded Image"></div>
                <div class="card-profile"><img class="rounded-circle square-image" src="{{ asset($user->profile_photo) }}" alt=""></div>
                <div class="text-center profile-details"><a href="{{ route('users.user-profile', $user->id) }}" data-bs-original-title="" title="">
                        <h4>{{ $user->first_name }} {{ $user->last_name }}</h4></a>
                    <h6>{{ $user->designation->designation }}</h6>
                </div>
                <ul class="card-social">
                    <button class="btn btn-light ican-envo"><i class="fa fa-envelope" aria-hidden="true"></i></button>
                    <button class="btn btn-light ican-envo"><i class="fa fa-phone" aria-hidden="true"></i></button>
                    <button class="btn btn-light ican-action">Active</button>
                </ul>
                <div class="card-footer row">
                    <div class="col-4 col-sm-4">
                        <p class="text-it">IT Asset</p>
                        <h3 class="counter">09</h3>
                    </div>
                    <div class="col-4 col-sm-4">
                        <p class="text-it">Non IT Asset</p>
                        <h3><span class="counter">09</span></h3>
                    </div>
                    <div class="col-4 col-sm-4">
                        <p class="text-it">Software</p>
                        <h3><span class="counter">09</span></h3>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    </div>
</div>
@endsection

@section('Script-Area')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
         $('#toggleCardView').hide();
        $('#toggleListView').click(function() {
            $('#userCard').hide();
            $('#userList').show();
            $('#toggleCardView').show();
            $(this).hide();
        });

        $('#toggleCardView').click(function() {
            $('#userList').hide();
            $('#userCard').show();
            $('#toggleListView').show();
            $(this).hide();
        });
    });
</script>
@endsection
