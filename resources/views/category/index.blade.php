@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">category</li>
    </ol><br>
    <h4 class="page-title">List Category </h4>
@endsection

@section('content')
    <a href="{{ route('category.create') }}" class="mb-3 btn btn-dark">Add Category</a>
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">Category Photo</th>
                        <th scope="col">Category Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <th scope="row">1 </th>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <img src="{{ asset('uploads/category_photos') }}/{{ $category->category_photo }}" alt=""
                                    width="100">
                            </td>
                            @if ($category->status == 'show')
                                <td class="text-success font-weight-bold">{{ $category->status }}</td>
                            @else
                                <td class="text-danger font-weight-bold">{{ $category->status }}</td>
                            @endif

                            <td>
                                <a href="{{ route('category.show', $category->id) }}" class="btn btn-info">Show</a>
                                <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success">Edit</a>
                                <form action="{{ route('category.destroy', $category->id) }}" method="post">
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
