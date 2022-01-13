@extends('layouts.app_front')

@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Contact</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Contact Us</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->

    <!-- Contact Area Start -->
    @php
    $pro = App\Models\User::where('role', 2)->get();
    @endphp
    <div class="contact-area pt-100px pb-100px">
        <div class="container">
            <div class="contact-wrapper">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="contact-info">
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend/assets') }}/images/icons/4.png" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title">Phone:</h5>
                                    <p>@foreach ($pro as $item)<a href="tel:0123456789">{{ $item->phone }}</a> @endforeach</p>
                                </div>
                            </div>
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend/assets') }}/images/icons/5.png" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title">Email:</h5>
                                    <p>
                                        @foreach ($pro as $item)
                                            <a href="mailto:demo@example.com">{{ $item->email }}</a>
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                            <div class="single-contact">
                                <div class="icon-box">
                                    <img src="{{ asset('frontend/assets') }}/images/icons/6.png" alt="">
                                </div>
                                <div class="info-box">
                                    <h5 class="title">Address:</h5>
                                    <p>Address</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="contact-form">
                            <div class="contact-title mb-30">
                                <h2 class="title" data-aos="fade-up" data-aos-delay="200">Leave a Message</h2>
                                <p>There are many variations of passages of Lorem Ipsum available but the
                                    suffered alteration in some form.</p>
                            </div>
                            <form class="contact-form-style" action="{{ route('contact.message') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input name="name" placeholder="Name*" type="text" />
                                    </div>
                                    <div class="col-lg-6">
                                        <input name="email" placeholder="Email*" type="email" />
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea name="message" placeholder="Your Message*"></textarea>
                                    </div>
                                    <button class="btn btn-primary mt-4" type="submit">Post Comment <i
                                            class="fa fa-arrow-right"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Area End -->

    <!-- map Area Start -->

    <div class="contact-map">
        <div id="mapid">
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe id="gmap_canvas"
                        src="https://maps.google.com/maps?q=121%20King%20St%2C%20Melbourne%20VIC%203000%2C%20Australia&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                        frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                </div>
            </div>
        </div>
    </div>
    <!-- map Area End -->

@endsection
