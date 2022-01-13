@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Add Product </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Vendor</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('product.index') }}" class="btn btn-dark">Product List</a>
    </div>
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Category Name</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                        <option value>Select Category</option>
                        @foreach ($category as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name"
                        name="product_name" value="{{ old('product_name') }}">
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" class="form-control @error('product_price') is-invalid @enderror"
                        id="product_price" name="product_price" value="{{ old('product_price') }}">
                </div>
                <div class="form-group">
                    <label for="product_short_description">Short Description</label>
                    <textarea type="text" class="form-control" id="product_short_description"
                        name="product_short_description">{{ old('product_short_description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="product_long_description">Long Description</label>
                    <textarea type="longText" class="form-control" id="product_long_description"
                        name="product_long_description">{{ old('product_long_description') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="product_code">Product Quantity</label>
                    <input type="number" class="form-control @error('product_quantity') is-invalid @enderror"
                        id="product_quantity" name="product_quantity" value="{{ old('product_quantity') }}">
                </div>
                <div class="form-group">
                    <label for="product_code">Product Code</label>
                    <input type="number" class="form-control @error('product_code') is-invalid @enderror" id="product_code"
                        name="product_code" value="{{ old('product_code') }}">
                </div>
                <div class="form-group">
                    <label>Product photo</label>
                    <input type="file" class="form-control @error('product_photo') is-invalid @enderror"
                        name="product_photo" value="{{ old('product_photo') }}">
                </div>
                <div class="form-group">
                    <label>Product Thumbnails</label>
                    <input type="file" class="form-control @error('product_thumbnail') is-invalid @enderror"
                        name="product_thumbnail[]" value="{{ old('product_thumbnail') }}" multiple>
                </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
            </form>
        </div>
    </div>
@endsection
