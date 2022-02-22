@extends('admin.layouts.master')
@section('breadcrumb')
<ol class="breadcrumb float-sm-left">
    <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard', []) }}">Admin</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection
@section('content')

<section class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-lg-4 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$superAdmins}}</h3>
              <p>Total Super Admin Count</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$weights}}</h3>
                <p>Total Weights Count</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$deliveryRoutes}}</h3>
                <p>Total Delivery Routes Count</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$deliveryTypes}}</h3>
                <p>Total Delivery Types Count</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$pricingRules}}</h3>
                <p>Total Pricing Rules Count</p>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
@endsection
