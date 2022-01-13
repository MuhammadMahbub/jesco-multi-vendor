@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Email</li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Customers</h3>
        </div>
        <div class="card-body">
            @if (Auth::user()->role == 2)

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Check</th>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Customer Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form action="{{ route('multi_email_offer') }}" method="POST">
                            @csrf
                            @foreach ($customers as $customer)
                                <tr>
                                    <td><input type="checkbox" name="check[]" class="form-control"
                                            value="{{ $customer->id }}"></td>
                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td><a href="{{ route('single_email_offer', $customer->id) }}"
                                            class="btn btn-success">SEND</a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-info">Send All</button>
                                </td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            @else
                <div class="alert alert-warning"> You R Not Allowed</div>
            @endif
        </div>
    </div>
@endsection
