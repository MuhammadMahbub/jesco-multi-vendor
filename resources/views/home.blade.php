@extends('layouts.app')
@section('breadcrumb')
    <ol class="breadcrumb float-sm-left">
        <li class="breadcrumb-item"><a href="{{ route('index') }}" class="btn btn-dark">Home</a></li>
    </ol>
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <h4 class="mb-4 header-title">Account Overview</h4>

                    <div class="row">
                        <div class="col-sm-6 col-lg-6 col-xl-3">
                            <div class="mb-0 card-box widget-chart-two">
                                <div class="float-right">
                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                        data-fgColor="#0acf97" value="{{ $total_users }}" data-skin="tron"
                                        data-angleOffset="180" data-readOnly=true data-thickness=".1" />
                                </div>
                                <div class="widget-chart-two-content">
                                    <p class="mt-2 mb-0 text-muted">Toyal Users</p>
                                    <h3 class="">{{ $total_users }}</h3>
                                </div>

                            </div>
                        </div>

                        <div class=" col-sm-6 col-lg-6 col-xl-3">
                            <div class="mb-0 card-box widget-chart-two">
                                <div class="float-right">
                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                        data-fgColor="#f9bc0b" value="92" data-skin="tron" data-angleOffset="180"
                                        data-readOnly=true data-thickness=".1" />
                                </div>
                                <div class="widget-chart-two-content">
                                    <p class="mt-2 mb-0 text-muted">Sales Analytics</p>
                                    <h3 class="">$97,511</h3>
                                </div>

                            </div>
                        </div>

                        <div class=" col-sm-6 col-lg-6 col-xl-3">
                            <div class="mb-0 card-box widget-chart-two">
                                <div class="float-right">
                                    <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round
                                        data-fgColor="#f1556c" value="14" data-skin="tron" data-angleOffset="180"
                                        data-readOnly=true data-thickness=".1" />
                                </div>
                                <div class="widget-chart-two-content">
                                    <p class="mt-2 mb-0 text-muted">Statistics</p>
                                    <h3 class="">$954</h3>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                </div>
            </div>
        </div>
        <!-- end row -->


        <div class=" row">

            <div class="col-lg-4">
                <div class="card-box">
                    <h4 class="m-t-0 header-title">
                        Total Wallet Balance
                    </h4>


                    <div id="donut-chart">
                        <div id="donut-chart-container" class="mt-5 flot-chart" style="height: 340px;">
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <!-- end row -->



    </div> <!-- container -->

@endsection

@section('footer_script')
    @include('layouts.init_js')
@endsection
