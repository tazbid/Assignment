@extends('admin.layouts.master')
@section('breadcrumb')
<ol class="breadcrumb float-sm-left">
    <li class="breadcrumb-item"><a href="{{ url('/admin/pricing/rules', []) }}">All Pricing Rule List</a></li>
    <li class="breadcrumb-item active">Pricing Rule Details</li>
</ol>
@endsection
@section('content')

<!-- About Me Box -->
<div class="card card-primary" style="margin-left: 200px;margin-right:200px" id="billing-info-div">
    <div class="card-header">
        <h3 class="card-title">About Pricing Rule</h3>
    </div>
    {{-- @dd($doctor) --}}
    <div class="card-body">

        <strong><i class="fas fa-signature"></i> Weight Name</strong>
        <p class="text-muted"> {{$weightDetails->weight_name}} </p>
        <hr>
        <strong><i class="fas fa-signature"></i> Delivery Route</strong>
        <p class="text-muted"> {{$deliveryRouteDetails->delivery_route_name}} </p>
        <hr>
        <strong><i class="fas fa-signature"></i> Delivery Type</strong>
        <p class="text-muted"> {{$deliveryTypeDetails->delivery_type_name}} </p>
        <hr>
        <strong><i class="fas fa-signature"></i> Pricing Rule</strong>
        <p class="text-muted">BDT {{$pricingRule->pricing_rule}}</p>
        <hr>
        <strong><i class="fas fa-signature"></i> Expiration Date</strong>
        <p class="text-muted"> {{$pricingRule->expiration_date}} </p>
        <hr>
    </div>
</div>
</div>
@endsection
