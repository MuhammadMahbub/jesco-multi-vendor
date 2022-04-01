@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Edit Product </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Product</li>
    </ol>
@endsection

{{-- {{ route('product.update', $product->id) }} --}}
@section('content')
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="product_name">Product Name</label>
                    <input type="text" class="form-control" id="product_name" name="product_name"
                        value="{{ $product->product_name }}">
                </div>
                <div class="form-group">
                    <label for="product_price">Product Price</label>
                    <input type="number" class="form-control @error('product_price') is-invalid @enderror" id="product_price"
                        name="product_price" value="{{ $product->product_price }}">
                </div>
                <div class="form-group">
                    <label for="product_discount">Product Discount</label>
                    <input type="number" class="form-control @error('product_discount') is-invalid @enderror"
                        id="product_discount" name="product_discount" value="{{ $product->product_discount }}">
                </div>
                <div class="form-group">
                    <label for="product_code">Product Code</label>
                    <input type="number" class="form-control @error('product_code') is-invalid @enderror" id="product_code"
                        name="product_code" value="{{ $product->product_code }}">
                </div>
                <div class="form-group">
                    <label for="product_quantity">Product Quantity</label>
                    <input type="number" class="form-control @error('product_quantity') is-invalid @enderror"
                        id="product_quantity" name="product_quantity" value="{{ $product->product_quantity }}">
                </div>
                <div class="form-group">
                    <label>Old Product Photo</label>
                    <img src="{{ asset('uploads/product_photos' . '/' . $product->product_photo) }}" width="100">
                </div>
                <div class="form-group">
                    <label>New product Photo</label>
                    <input type="file" class="form-control" name="new_product_photo">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
            <h3>Thumbnails</h3>
            <div class="form-group">
                @foreach (App\Models\Product_Thumbnail::where('product_id', $product->id)->get() as $thumbnail)
                    <img src="{{ asset('uploads/product_thumbnails' . '/' . $thumbnail->product_thumbnail_name) }}"
                        width="100">
                    <form action="{{ route('product_thumb.delete', $thumbnail->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button>DEL</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
@endsection
