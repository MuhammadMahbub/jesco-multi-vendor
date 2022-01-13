@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Vendor</li>
    </ol><br>
    <h4 class="page-title">Vendor List </h4>
@endsection

@section('content')
    <a href="{{ route('vendor.create') }}" class="mb-3 btn btn-dark">Add Vendor</a>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Vendor Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($vendors as $vendor)
                        <tr>
                            <th scope="row">1 </th>
                            <td>{{ App\Models\User::where('id', $vendor->user_id)->first()->name }}</td>
                            <td>
                                <a href="{{ route('vendor.show', $vendor->id) }}" class="btn btn-info">Show</a>
                                {{-- <a href="{{ route('vendor.edit', $vendor->id) }}" class="btn btn-success">Edit</a> --}}
                                <form action="{{ route('vendor.destroy', $vendor->id) }}" method="post">
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
