@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Add Banner </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Banner</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">
        <a href="{{ route('banner.index') }}" class="btn btn-dark">Banner List </a>
    </div>
    <div class="row">
        <div class="col-8">
            <form method="POST" action="{{ route('banner.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="banner_heading">Banner Heading</label>
                    <input type="text" class="form-control @error('banner_heading') is-invalid @enderror" id="banner_heading"
                        name="banner_heading" value="{{ old('banner_heading') }}">
                </div>
                <div class="form-group">
                    <label for="banner_offer">Banner offer %</label>
                    <input type="text" class="form-control @error('banner_offer') is-invalid @enderror" id="banner_offer"
                        name="banner_offer" value="{{ old('banner_offer') }}">
                </div>
                <div class="form-group">
                    <label>Banner Photo</label>
                    <input type="file" id="banner_photo" class="form-control" name="banner_photo"
                        value="{{ old('banner_photo') }}">
                </div>
                <div>
                    <img width="200" id="output">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        document.getElementById('banner_photo').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('output').src = src
        }
    </script>
@endsection
