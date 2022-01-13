@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item active">Home</li>
        <li class="breadcrumb-item">Profile</li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <h3>Name Change:</h3>
                                <form action="{{ route('name_change') }}" method="POST">
                                    @csrf
                                    <input type="text" name="name" value="{{ Auth::user()->name }}">
                                    <button class="btn btn-info">Change</button>
                                </form>
                            </div>
                            <div class="col-6">
                                <h3 class="mt-5">Password Change:</h3>
                                @if ($errors->any())
                                    <div class="text-danger">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif
                                <form action="{{ route('change_password') }}" method="POST">
                                    @csrf
                                    <label for="old_password">Old Password</label>
                                    <input type="password" id="old_password" name="old_password"><br><br>
                                    <label for="new_password">New Password</label>
                                    <input type="password" id="new_password" name="new_password"><br><br>
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" id="confirm_password" name="confirm_password"><br><br>
                                    <button class="btn btn-info">Change</button>
                                </form>
                            </div>
                            <div class="col-6">

                                @if (session('success'))
                                    <div class="alert alert-dark">{{ session('success') }}</div>
                                @endif
                                <h3>Photo Change:</h3>
                                @error('new_profile_photo')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <img src="{{ asset('uploads/profile_photos') . '/' . Auth::user()->profile_photo }}"
                                    alt="" width="100">
                                <form action="{{ route('profile_photo_change') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="file" name="new_profile_photo" value=""><br>
                                    <button class="btn btn-info">Change Photo</button>
                                </form>

                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
