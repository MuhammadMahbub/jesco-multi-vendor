@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Add Vendor </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Vendor</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('vendor.index') }}" class="btn btn-dark">Vendor List</a>
    </div>
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('vendor.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="vendor_name">Vendor Name</label>
                    <input type="text" class="form-control" id="vendor_name" name="vendor_name">
                </div>
                <div class="form-group">
                    <label for="vendor_email">Vendor Email</label>
                    <input type="email" class="form-control" id="vendor_email" name="vendor_email">
                </div>
                <div class="form-group">
                    <label for="vendor_phone_number">Vendor Phone</label>
                    <input type="text" class="form-control" id="vendor_phone_number" name="vendor_phone_number">
                </div>
                <div class="form-group">
                    <label for="vendor_address">Vendor Address</label>
                    <input type="text" class="form-control" id="vendor_address" name="vendor_address">
                </div>
                <button type="submit" class="btn btn-primary">Add Vendor</button>
            </form>
        </div>
    </div>
@endsection
