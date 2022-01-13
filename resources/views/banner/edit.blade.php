@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Edit Banner </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">banner</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('banner.update', $banner->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Banner Status: {{ $banner->status }}</label>
                    <select name="status" id="" class="form-control">
                        <option value="show" {{ $banner->status == 'show' ? 'selected' : '' }}>Show</option>
                        <option value="hide" {{ $banner->status == 'hide' ? 'selected' : '' }}>Hide</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="banner_heading">Category Name</label>
                    <input type="text" class="form-control" id="banner_heading" name="banner_heading"
                        value="{{ $banner->banner_heading }}">
                </div>
                <div class="form-group">
                    <label for="banner_offer">Category Name</label>
                    <input type="text" class="form-control" id="banner_offer" name="banner_offer"
                        value="{{ $banner->banner_offer }}">
                </div>
                <div class="form-group">
                    <label>Old Banner Photo</label>
                    <img src="{{ asset('uploads/banner_photos' . '/' . $banner->banner_photo) }}" width="200">
                </div>
                <div class="form-group">
                    <label>New Banner Photo</label>
                    <input type="file" class="form-control" name="new_banner_photo">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
