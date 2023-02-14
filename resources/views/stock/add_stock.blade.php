@extends('support.source')

@section('title')
Tambah Stok | Toko Sahabat
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
                        <h4 class="mb-sm-0">Tambah Stok</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stok</a></li>
                                <li class="breadcrumb-item active">Tambah Stok</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-10">
                    <div class="card">
                        <div class="card-body">

                            <form action="{{ route('add.stock') }}" method="POST" id="add-stock-form">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" name="item_name" type="text" placeholder="" id="example-text-input">
                                        @error('item_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
                                    <div class="form-group col-sm-10">
                                        <select name="category_id" id="category_id" class="form-select">
                                            <option selected="" disabled>Pilih kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="total_stock" class="col-sm-2 col-form-label">Jumlah Barang</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" name="total_stock" type="number" value="0" id="total_stock" min="1">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="price" class="col-sm-2 col-form-label">Harga</label>
                                    <div class="form-group col-sm-10">
                                        <input class="form-control" name="price" type="number" value="0" id="price" min="1000">
                                    </div>
                                </div>
                                <!-- end row -->
                                <div class="row mb-3">
                                    <label for="unit_id" class="col-sm-2 col-form-label">Satuan</label>
                                    <div class="form-group col-sm-10">
                                        <select name="unit_id" id="unit_id" class="form-select">
                                            <option selected="" disabled>Pilih satuan</option>
                                            @foreach ($units as $unit)
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->
                                <a href="{{ route('item.stock.list.page') }}" class="btn btn-danger btn-sm">Batal</a>
                                <input class="btn btn-success btn-sm" type="submit" value="Tambah Stok">
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
        $('#add-stock-form').validate({
            rules: {
                item_name: {
                    required: true,
                },
                category_id: {
                    required: true,
                },
                total_stock: {
                    required: true,
                },
                price: {
                    required: true,
                },
                unit_id: {
                    required: true,
                },
            },
            messages: {
                item_name: {
                    required: 'Please input item name!',
                },
                category_id: {
                    required: 'Please input category!',
                },
                total_stock: {
                    required: 'Please input total stock!',
                },
                price: {
                    required: 'Please input price!',
                },
                unit_id: {
                    required: 'Please input unit!',
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
