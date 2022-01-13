@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Banner</li>
    </ol><br>
    <h4 class="page-title">List Banner </h4>
@endsection

@section('content')
    <a href="{{ route('banner.create') }}" class="mb-3 btn btn-dark">Add Banner</a>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Banner offer</th>
                        <th scope="col">Banner Heading</th>
                        <th scope="col">Status</th>
                        <th scope="col">Banner Photo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($banners as $banner)
                        <tr>
                            <th scope="row">1 </th>
                            <td>{{ $banner->banner_offer }}%</td>
                            <td>{{ $banner->banner_heading }}</td>
                            <td>{{ $banner->status }}</td>
                            <td>
                                <img src="{{ asset('uploads/banner_photos') }}/{{ $banner->banner_photo }}" alt=""
                                    width="100">
                            </td>
                            <td>
                                <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('banner.destroy', $banner->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-dark">No Record</div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer_script')
    @if (Session::has('success'))
        <script>
            toastr.success("{!! Session::get('success') !!}")
        </script>
    @endif
    @if (Session::has('delete'))
        <script>
            toastr.error("{!! Session::get('delete') !!}")
        </script>
    @endif
@endsection
