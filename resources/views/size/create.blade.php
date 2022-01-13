@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Add Size </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Size</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('size.index') }}" class="btn btn-dark">Size List</a>
    </div>
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('size.store') }}">
                @csrf
                <div class="form-group">
                    <label>Category Name</label>
                    <select name="product_id" class="form-control @error('product_id') is-invalid @enderror">
                        <option value>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Size Name</label>
                    <select name="size" class="form-control @error('size') is-invalid @enderror">
                        <option value>Select Category</option>
                        <option value="Small">Small</option>
                        <option value="Medium">Medium</option>
                        <option value="Large">Large</option>
                        <option value="Extra Large">Extra Large</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity">Size Quantity</label>
                    <input type="text" class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                        name="quantity" value="{{ old('quantity') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
{{-- @section('footer_script') --}}
{{-- <script>
        document.getElementById('Size_photo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('output').src = src
        }
    </script>
@endsection --}}
