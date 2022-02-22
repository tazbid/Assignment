@extends('admin.layouts.master')
@section('breadcrumb')
<ol class="breadcrumb float-sm-left">
    <li class="breadcrumb-item"><a href="{{ url('/admin/pricing/rules', []) }}">All Pricing Rule List</a></li>
    <li class="breadcrumb-item active">Create New Pricing Rule</li>
</ol>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header" style="background: #F67E7D">
                    <h5 class="text-white">Add New Pricing Rule</h5>
                </div>
                <div class="card-body">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-10 col-md-10">
                            <form id="weightInsertForm">
                                <div class="form-row">
                                    <div class="col-md-4 mb-3">
                                        <label for="name">Weight Name</label>
                                        <select id="weight_id" class="form-control select2" style=""
                                            name="weight_id" required>
                                            <option value="" selected disabled>--SELECT--</option>
                                            @foreach ($weights as $weight)
                                            <option value="{{$weight->id}}">{{$weight->weight_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="name">Delivery Route</label>
                                        <select id="delivery_route_id" class="form-control select2" style=""
                                            name="delivery_route_id" required>
                                            <option value="" selected disabled>--SELECT--</option>
                                            @foreach ($deliveryRoutes as $deliveryRoute)
                                            <option value="{{$deliveryRoute->id}}">{{$deliveryRoute->delivery_route_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="name">Delivery Type</label>
                                        <select id="delivery_type_id" class="form-control select2" style=""
                                            name="delivery_type_id" required>
                                            <option value="" selected disabled>--SELECT--</option>
                                            @foreach ($deliveryTypes as $deliveryType)
                                            <option value="{{$deliveryType->id}}">{{$deliveryType->delivery_type_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="name"> Pricing Rule (BDT)</label>
                                        <input type="number" class="form-control" id="pricing_rule" name="pricing_rule"
                                            placeholder="Pricing Rule" required>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="name"> Expiration Date</label>
                                        <input type="date" class="form-control" id="expiration_date" name="expiration_date" required>
                                    </div>
                                    <div class="col-md-6 mb-3" style="padding-top: 10px;">
                                        <button id="btn-user-insert" type="submit" class="btn btn-primary save__btn"
                                            data-loading-text="<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span> Creating New Pricing Rule..."
                                            data-normal-text="Create New Pricing Rule">
                                            <span class="ui-button-text">Create New Pricing Rule</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(() => {
        $('.select2').select2({
            theme: 'bootstrap4'
        })
        /**
         * @name form onsubmit
         * @description override the default form submission and submit the form manually.
         *              also validate with .validate() method from jquery validation
         * @parameter formid
         * @return
         */
        $('#weightInsertForm').submit(function (e) {
            e.preventDefault();
        }).validate({
            highlight: function (element) {
                jQuery(element).closest('.form-control').addClass('is-invalid');
            },
            unhighlight: function (element) {
                jQuery(element).closest('.form-control').removeClass('is-invalid');
                jQuery(element).closest('.form-control').addClass('is-valid');
            },

            errorElement: 'div',
            errorClass: 'invalid-feedback',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group-prepend').length) {
                    $(element).siblings(".invalid-feedback").append(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {


                var formData = new FormData(form);
                $.ajax({
                    url: "{{ url('admin/pricing/rule/insert') }}",
                    method: "POST",
                    data: formData,
                    enctype: 'multipart/form-data',
                    processData: false,
                    cache: false,
                    contentType: false,
                    timeout: 600000,
                    beforeSend: function () {
                        btnLoadStart("btn-user-insert");
                    },
                    complete: function () {
                        btnLoadEnd("btn-user-insert");
                    },
                    success: function (data, textStatus, xhr) {

                        if (xhr.status === 201) {
                            $(form).trigger('reset');
                            btnLoadEnd("btn-user-insert");
                            toastr.success(
                                'Data inserted Successfully.',
                                'Success!', {
                                    timeOut: 8000,
                                    closeButton: true,
                                    progressBar: true,
                                    positionClass: "toast-bottom-right",
                                });
                            redirect("{{url('admin/pricing/rules')}}", 100);
                        }
                    },
                    error: function (jqXHR, exception) {
                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.Verify Network.';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else if (jqXHR.status == 413) {
                            msg = 'Request entity too large. [413]';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else if (jqXHR.status == 419) {
                            msg = 'CSRF error or Unknown Status [419]';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        }else if (jqXHR.status == 409) {
                            msg = 'Pricing Rule already exists!';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else if (jqXHR.status == 422) {
                            console.log(jqXHR.responseJSON.errors);
                            var validator = $(form).validate();
                            var objErrors = {};
                            $.each(jqXHR.responseJSON.errors, function (key, val) {
                                objErrors[key] = val;
                            });
                            validator.showErrors(objErrors);
                            validator.focusInvalid();
                            btnLoadEnd("btn-user-insert");
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR
                                .responseText;
                            swal("Error!", msg, "warning");
                            btnLoadEnd("btn-user-insert");
                        }
                    }
                });
            }
        });
    });

</script>
@endsection
