@extends('support.source')

@section('title')
Ubah Pembayaran | Toko Sahabat
@endsection

@section('main-content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Ubah Pembayaran</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pembayaran</a></li>
                                <li class="breadcrumb-item active">Ubah Pembayaran</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('edit.payment',$payment->id) }}" method="POST" id="add-payment-form">
                                @csrf

                                <div class="row mb-3">
                                    <label for="payment_method" class="col-sm-2 col-form-label">Metode Pembayaran</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" name="payment_method" type="text" placeholder="" value="{{ $payment->payment_method }}" id="payment_name">
                                        @error('payment_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <a href="{{ route('payment.list.page') }}" class="btn btn-danger btn-sm mt-2">Batal</a>
                                <input class="btn btn-success btn-sm mt-2" type="submit" value="Ubah Pembayaran">
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->


        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>

<script>
    $(document).ready(function(){
        $('#add-payment-form').validate({
            rules: {
                payment_method: {
                    required: true,
                },
            },
            messages: {
                payment_method: {
                    required: 'Please input payment method!',
                },
            },
            errorElement: 'span',
            errorPlacement: function(error,element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        })
    })
</script>

@endsection
