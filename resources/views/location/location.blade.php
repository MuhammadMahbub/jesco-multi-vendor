@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Vendor</li>
    </ol><br>
    <h4 class="page-title">Vendor List </h4>
@endsection

@section('content')
    <form action="{{ route('location.update') }}" method="POST">
        @csrf
        <div class="row">
            <a class="btn btn-dark" href="{{ route('index') }}">Home</a>
            <div class="col-12">
                <label>Country</label>
                <select class="form-control" name="countries[]" id="country_dropdown" multiple="multiple">
                    <option value>Select a country</option>
                    @foreach ($countries as $country)
                        <option {{ $country->status == 'active' ? 'selected' : '' }} value="{{ $country->id }}">
                            {{ $country->name }}</option>
                    @endforeach
                </select>
                <button type="submit" class="mt-3 btn btn-info">Update Location</button>
            </div>
        </div>
    </form>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
            $('#country_dropdown').select2();
        });
    </script>
@endsection
