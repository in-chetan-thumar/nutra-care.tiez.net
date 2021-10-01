@extends('admin.layouts.app')
@section('content')
    <div class="container">
        @include('admin.common.alert-messages')
        <div class="row">
            <div class="col-md-12">
                <div>
                    <div class="dashbordreoirt">
                        <p><i class="fas fa-tachometer-alt"></i>Dashboard</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-comments"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"  class="counter">{{ $total_product }}</span>
                        </div>
                        <div class="desc">Products</div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#">
                    <div class="visual">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span data-counter="counterup"  class="counter">{{ $total_category }}</span>
                        </div>
                        <div class="desc">Categories</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection
