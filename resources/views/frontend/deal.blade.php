@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Add Deal </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Deal</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('deal.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Product Name</label>
                    <select name="product_id" class="form-control">
                        <option value>Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="validity">Deal Validity</label>
                    <input type="date" class="form-control" id="validity" name="validity" value="{{ old('validity') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
