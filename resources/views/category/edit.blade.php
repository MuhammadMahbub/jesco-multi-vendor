@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Edit Category </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">category</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('category.update', $category->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="category_name">Category Status {{ $category->status }}</label>
                    <select name="status" id="" class="form-control">
                        <option value="show" {{ $category->status == 'show' ? 'selected' : '' }}>
                            Show</option>
                        <option value="hide" {{ $category->status == 'hide' ? 'selected' : '' }}>Hide</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control" id="category_name" name="category_name"
                        value="{{ $category->category_name }}">
                </div>
                <div class="form-group">
                    <label for="category_tagline">Category Tagline</label>
                    <input type="text" class="form-control" id="category_tagline" name="category_tagline"
                        value="{{ $category->category_tagline }}">
                </div>
                <div class="form-group">
                    <label>Old Category Photo</label>
                    <img src="{{ asset('uploads/category_photos' . '/' . $category->category_photo) }}" width="200">
                </div>
                <div class="form-group">
                    <label>New Category Photo</label>
                    <input type="file" class="form-control" name="new_category_photo">
                </div>

                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>
@endsection
