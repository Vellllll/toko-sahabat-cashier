@extends('support.source')

@section('title')
Tambah Satuan | Toko Sahabat
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
                        <h4 class="mb-sm-0">Tambah Satuan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Satuan</a></li>
                                <li class="breadcrumb-item active">Tambah Satuan</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('add.unit') }}" method="POST" id="add-unit-form">
                                @csrf

                                <div class="row mb-3">
                                    <label for="unit_name" class="col-sm-4 col-form-label">Nama Satuan</label>
                                    <div class="form-group col-sm-8">
                                        <input class="form-control" name="unit_name" type="text" placeholder="" id="unit_name">
                                        @error('unit_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <a href="{{ route('unit.list.page') }}" class="btn btn-danger btn-sm mt-2">Batal</a>
                                <input class="btn btn-success btn-sm mt-2" type="submit" value="Tambah">
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
        $('#add-unit-form').validate({
            rules: {
                unit_name: {
                    required: true,
                },
            },
            messages: {
                unit_name: {
                    required: 'Please input unit name!',
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
