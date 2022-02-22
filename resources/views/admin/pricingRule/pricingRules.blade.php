@extends('admin.layouts.master')
@section('breadcrumb')
<ol class="breadcrumb float-sm-left">
    <li class="breadcrumb-item active">Pricing Rules</li>
</ol>
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="d-inline-block">List Of Pricing Rules</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="table-responsive">
                    <table id="pricing-rules-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Delivery Route</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Pricing Rule (BDT)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Expiration Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Weight</th>
                                <th scope="col">Delivery Route</th>
                                <th scope="col">Delivery Type</th>
                                <th scope="col">Pricing Rule (BDT)</th>
                                <th scope="col">Status</th>
                                <th scope="col">Expiration Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<script>
    $(document).ready(function () {
        //$("#pricing-rules-table").dataTable();

        $('#pricing-rules-table').dataTable({
            "orderCellsTop": true,
            "fixedHeader": true,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ url('/admin/pricing/rules') }}",
                "type": "POST",
                // "data": data

            },
            columns: [{
                    "data": 'DT_RowIndex',
                    searchable: false
                },
                {
                    data: 'weight_name',
                    name: 'weight_name'
                },
                {
                    data: 'delivery_route_name',
                    name: 'delivery_route_name'
                },
                {
                    data: 'delivery_type_name',
                    name: 'delivery_type_name'
                },
                {
                    data: 'pricing_rule',
                    name: 'pricing_rule'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'expiration_date',
                    name: 'expiration_date'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false
                }
            ]
        });






    });


    /**
     *@name deletePricingRule
     *@description send request for deleting a weight
     *@parameter id
     *@return  alert
     */
    function deletePricingRule(id) {
        swal({
                title: "Are you sure to Delete This Pricing Rule?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger btn-lg",
                cancelButtonClass: "btn-secondary btn-lg",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ url('admin/pricing/rule/delete') }}",
                        method: "POST",
                        data: {
                            id: id
                        },
                        success: function (data, textStatus, xhr) {
                            let responseCode = xhr.status;

                            if (responseCode === 204) {
                                swal("Success!", "Delete Successful", "success");
                                refreshDatatable("pricing-rules-table");
                            }



                        },
                        error: function (jqXHR, exception) {
                            var msg = '';
                            if (jqXHR.status === 0) {
                                msg = 'Not connected.Verify Network.';
                                swal("Error!", msg, "warning");
                            } else if (jqXHR.status == 404) {
                                msg = 'Requested page not found. [404]';
                                swal("Error!", msg, "warning");
                            } else if (jqXHR.status == 413) {
                                msg = 'Request entity too large. [413]';
                                swal("Error!", msg, "warning");
                            } else if (jqXHR.status == 419) {
                                msg = 'CSRF error or Unknown Status [419]';
                                swal("Error!", msg, "warning");
                            } else if (jqXHR.status == 500) {
                                msg = 'Internal Server Error [500].';
                                swal("Error!", msg, "warning");
                            } else if (jqXHR.status == 422) {
                                msg = jqXHR.responseJSON.message + ' [422].';
                                swal("Error!", msg, "warning");
                                btnLoadEnd("btn-doctor-update");

                            } else if (exception === 'parsererror') {
                                msg = 'Requested JSON parse failed.';
                                swal("Error!", msg, "warning");
                            } else if (exception === 'timeout') {
                                msg = 'Time out error.';
                                swal("Error!", msg, "warning");
                            } else if (exception === 'abort') {
                                msg = 'Ajax request aborted.';
                                swal("Error!", msg, "warning");
                            } else {
                                msg = 'Uncaught Error.\n' + jqXHR.responseText;
                                swal("Error!", msg, "warning");
                            }

                        }
                    });


                } else {
                    swal("Cancelled", "Your canceled this operation", "warning");
                }
            });
    }

</script>
@endsection
