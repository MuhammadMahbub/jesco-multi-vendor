@extends('layouts.app_front')

@section('content')
    <div class="row container">
        <div class="col-10 m-auto">
            <a href="{{ route('shop') }}" class="mb-3 btn btn-dark p-3">All Products</a>
            <table class="table m-lg-auto">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Old Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">New Price</th>
                        <th scope="col">Vendor Name</th>
                        <th scope="col">Product Photo</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($alldeals as $deal)
                        @if ($deal->validity > Carbon\Carbon::now())
                            <tr>
                                <th scope="row">{{ $loop->index + 1 }}</th>
                                <td>{{ $deal->relationtoproduct->product_name }}</td>
                                <td>${{ $deal->relationtoproduct->product_price }}</td>
                                <td>{{ $deal->relationtoproduct->product_discount }}%</td>
                                <td>${{ $deal->relationtoproduct->product_price -($deal->relationtoproduct->product_price * $deal->relationtoproduct->product_discount) / 100 }}
                                </td>
                                <td>{{ $deal->relationtoproduct->relationtouser->name }}</td>
                                <td>
                                    <img src="{{ asset('uploads/product_photos') }}/{{ $deal->relationtoproduct->product_photo }}"
                                        alt="" width="100">
                                </td>
                                <td>
                                    @if (Auth::check())
                                        <button class="btn btn-dark p-3"><a class="text-white"
                                                href="{{ route('product.details', $deal->relationtoproduct->product_slug) }}">Buy
                                                Now</a></button>
                                    @else<button class="btn btn-dark p-3"><a class="text-white"
                                                href="{{ route('login', $deal->relationtoproduct->product_slug) }}">Buy
                                                Now</a></button>
                                    @endif
                                </td>
                            </tr>
                        @else
                            <div class="alert alert-dark">No Record</div>
                        @endif
                    @empty
                        <div class="alert alert-dark">No Record</div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
