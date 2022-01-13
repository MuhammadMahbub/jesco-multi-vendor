
@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Add Coupon </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Coupon</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('coupon.index') }}" class="btn btn-dark">Coupon List</a>
    </div>
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="coupon_name">Coupon Name</label>
                    <input type="text" class="form-control @error('coupon_name') is-invalid @enderror" id="coupon_name"
                        name="coupon_name" value="{{ old('coupon_name') }}">
                </div>
                @error('coupon_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="discount">Coupon Discount</label>
                    <input type="text" class="form-control @error('discount') is-invalid @enderror" id="discount"
                        name="discount" value="{{ old('discount') }}">
                </div>
                @error('discount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="validity">coupon Validity</label>
                    <input type="date" class="form-control @error('validity') is-invalid @enderror" id="validity"
                        name="validity" value="{{ old('validity') }}">
                </div>
                @error('validity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="limit">Coupon Limit</label>
                    <input type="text" class="form-control @error('limit') is-invalid @enderror" id="limit" name="limit"
                        value="{{ old('limit') }}">
                </div>
                @error('limit')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
@section('footer_script')
    {{-- <script>
        document.getElementById('coupon_photo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('output').src = src
        }
    </script>
@endsection --}}
