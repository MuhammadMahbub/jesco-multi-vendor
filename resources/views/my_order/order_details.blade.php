@extends('layouts.app')
@section('breadcrumb')
    <h4 class="page-title">Order Details </h4>
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Order Details</li>
    </ol>
@endsection

@section('content')
    <div class="mb-3">

        {{-- <a href="{{ route('product.index') }}" class="btn btn-dark">List Product</a> --}}
    </div>
    <div class="row">
        <div class="col-6">
            <table class="table table-bordered">
                <tbody>
                    <h1>Order Details</h1>
                    <tr>
                        <th>User Name</th>
                        <td>{{ $order_summeries->relationwithuser->name }}</td>
                    </tr>
                    <tr>
                        <th>Coupon Name</th>
                        <td>
                            {{ $order_summeries->coupon_name ? $order_summeries->coupon_name : 'N/A' }}
                        </td>
                    </tr>
                    <tr>
                        <th>Payment Option</th>
                        <td>{{ $order_summeries->payment_option == 0 ? 'COD' : 'Online' }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{{ $order_summeries->payment_status == 0 ? 'Not Paid' : 'Paid' }}</td>
                    </tr>
                    <tr>
                        <th>Cart Total</th>
                        <td>{{ $order_summeries->cart_total }}</td>
                    </tr>
                    <tr>
                        <th>Discount Total</th>
                        <td>{{ $order_summeries->discount_total }}</td>
                    </tr>
                    <tr>
                        <th>Su Total</th>
                        <td>{{ $order_summeries->sub_total }}</td>
                    </tr>
                    <tr>
                        <th>Shipping Total</th>
                        <td>{{ $order_summeries->shipping_total }}</td>
                    </tr>
                    <tr>
                        <th>Grand Total</th>
                        <td>{{ $order_summeries->grand_total }}</td>
                    </tr>
                    <tr>
                        <th>Delivery Status</th>
                        <td>
                            @if ($order_summeries->delivered_status == 0)
                                Pending
                            @else
                                Delivered
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-6">
            @foreach ($order_details as $order_detail)
                <div class="mb-2">
                    <div class="card-body">
                        <table class="table table-bordered table-inverse">
                            <tbody>
                                <tr>
                                    <th>Vendor Name</th>
                                    <td>{{ $order_detail->relationwithvendor->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{ $order_detail->relationwithproduct->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Category Name</th>
                                    <td>{{ $order_detail->relationwithproduct->relationtocategory->category_name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td>
                                        <img src="{{ asset('uploads/product_photos') }}/{{ $order_detail->relationwithproduct->product_photo }}"
                                            width="100" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>{{ $order_detail->amount }}</td>
                                </tr>
                            </tbody>

                        </table>
                        @if ($order_summeries->delivered_status == 1)
                            <form action="{{ route('review.rating', $order_detail->id) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Review</label>
                                    <textarea name="review" class="form-control" id="exampleFormControlTextarea1"
                                        rows="3"></textarea>
                                </div>
                                <div class="rate">
                                    <input type="radio" id="star5-{{ $order_detail->id }}" name="rate" value="5" />
                                    <label for="star5-{{ $order_detail->id }}" title="text">5 stars</label>
                                    <input type="radio" id="star4-{{ $order_detail->id }}" name="rate" value="4" />
                                    <label for="star4-{{ $order_detail->id }}" title="text">4 stars</label>
                                    <input type="radio" id="star3-{{ $order_detail->id }}" name="rate" value="3" />
                                    <label for="star3-{{ $order_detail->id }}" title="text">3 stars</label>
                                    <input type="radio" id="star2-{{ $order_detail->id }}" name="rate" value="2" />
                                    <label for="star2-{{ $order_detail->id }}" title="text">2 stars</label>
                                    <input type="radio" id="star1-{{ $order_detail->id }}" name="rate" value="1" />
                                    <label for="star1-{{ $order_detail->id }}" title="text">1 star</label>
                                </div>
                                <button class="btn btn-info">Submit</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach

            <style>
                .rate {
                    float: left;
                    height: 46px;
                    padding: 0 10px;
                }

                .rate:not(:checked)>input {
                    /* position: absolute; */
                    top: 0px;
                    opacity: 0;
                }

                .rate:not(:checked)>label {
                    float: right;
                    width: 1em;
                    overflow: hidden;
                    white-space: nowrap;
                    cursor: pointer;
                    font-size: 30px;
                    color: #ccc;
                }

                .rate:not(:checked)>label:before {
                    content: '★ ';
                }

                .rate>input:checked~label {
                    color: #ffc700;
                }

                .rate:not(:checked)>label:hover,
                .rate:not(:checked)>label:hover~label {
                    color: #deb217;
                }

                .rate>input:checked+label:hover,
                .rate>input:checked+label:hover~label,
                .rate>input:checked~label:hover,
                .rate>input:checked~label:hover~label,
                .rate>label:hover~input:checked~label {
                    color: #c59b08;
                }

            </style>
        </div>
    </div>

@endsection
