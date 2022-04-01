@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Product </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Product</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('product.index') }}" class="btn btn-dark">List Product</a>
    </div>
    <div class="row">
        <div class="col-6">
            <table class="table table-bordered border-width-3">
                <tr>
                    <th>Category Name</th>
                    <td>{{ App\Models\Category::findOrFail($product->category_id)->category_name }}</td>
                </tr>
                <tr>
                    <th>Product Name</th>
                    <td>{{ $product->product_name }}</td>
                </tr>
                <tr>
                    <th>Product Price</th>
                    <td>${{ $product->product_price }}</td>
                </tr>
                <tr>
                    <th>Product Discount</th>
                    <td>{{ $product->product_discount }}%</td>
                </tr>
                <tr>
                    <th>Discount Price</th>
                    <td>${{ $product->product_price - ($product->product_price * $product->product_discount) / 100 }}</td>
                </tr>
                <tr>
                    <th>Product Code</th>
                    <td>{{ $product->product_code }}</td>
                </tr>
                <tr>
                    <th>Product Short Description</th>
                    <td>{{ $product->product_short_description }}</td>
                </tr>
                <tr>
                    <th>Product Long Description</th>
                    <td>{{ $product->product_long_description }}</td>
                </tr>
                <tr>
                    <th>Product Photo</th>
                    <td><img src="{{ asset('uploads/product_photos/') }}/{{ $product->product_photo }}" width="100"
                            alt=""></td>
                </tr>
                <tr>
                    <th>Product Thumbnails</th>

                    @foreach (App\Models\Product_Thumbnail::where('product_id', $product->id)->get() as $thumbnail)
                        <td>
                            <img src="{{ asset('uploads/product_thumbnails') }}/{{ $thumbnail->product_thumbnail_name }}"
                                alt="" width="100">
                        </td>
                    @endforeach

                </tr>
            </table>
        </div>
    </div>
@endsection
