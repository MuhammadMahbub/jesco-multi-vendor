@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Category </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">category</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('category.index') }}" class="btn btn-dark">Category List </a>
    </div>
    <div class="row">
        <div class="col-6">
            <table class="table table-bordered border-width-3">
                <tr>
                    <th>Category Name</th>
                    <td>{{ $category->category_name }}</td>
                </tr>
                <tr>
                    <th>Category Tagline</th>
                    <td>{{ $category->category_tagline }}</td>
                </tr>
                <tr>
                    <th>Category Photo</th>
                    <td><img src="{{ asset('uploads/category_photos/') }}/{{ $category->category_photo }}" width="250"
                            alt=""></td>
                </tr>
            </table>
        </div>
    </div>
@endsection
