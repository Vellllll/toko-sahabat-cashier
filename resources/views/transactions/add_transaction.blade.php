@extends('support.source')

@section('title')
Tambah Transaksi | Toko Sahabat
@endsection

@section('main-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Tambah Transaksi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                                <li class="breadcrumb-item active">Tambah Transaksi</li>
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
                            <h4 class="card-title">Keranjang Belanja</h4>

                            <form action="{{ route('make.transaction') }}" method="POST" id="transaction_form">
                                @csrf
                                <div class="row mt-3">
                                    {{-- <span id="transaction_number" class="mb-2"></span> --}}


                                    <div class="col-2">
                                        <label class="form-label" for="transaction_number">Nomor Transaksi :</label>
                                        @if (count($transaction) == 0)
                                            <input readonly type="number" class="form-control form-control-sm mb-3" value="1" name="transaction_number" id="transaction_number">
                                        @else
                                            <input readonly type="number" class="form-control form-control-sm mb-3" value="{{ $latest_transaction->id + 1 }}" name="transaction_number" id="transaction_number">
                                        @endif
                                    </div>
                                    {{-- <div class="col-4" id="current_date" style="margin-left:auto; margin-right:0; text-align:right"></div> --}}

                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped mb-0">

                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama Barang</th>
                                                <th>Jumlah Barang</th>
                                                <th style="text-align: right">Harga/Satuan</th>
                                                <th style="text-align: right">Jumlah Harga</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @php
                                            $i = 1;
                                        @endphp
                                        <tbody>
                                            @if (count($checkouts) == 0)
                                            <tr>
                                                <td colspan="6" style="text-align: center">Keranjang belanja kosong!</td>
                                            </tr>
                                            @else
                                                @php
                                                    $total_price = 0;
                                                @endphp
                                                @foreach($checkouts as $checkout)
                                                <input type="hidden" name="checkout_id" value="{{ $checkout->id }}">
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $checkout->item_name }}</td>
                                                    <td>{{ $checkout->count . ' ' . $checkout->unit->unit_name }}</td>
                                                    <td style="text-align: right">Rp {{ number_format($checkout->price, 0, ',', '.') }}</td>
                                                    <td style="text-align: right">Rp {{ number_format($checkout->total_price, 0, ',', '.') }}</td>
                                                    <td>
                                                        <a type="button" href="{{ route('delete.transaction.item', $checkout->id) }}" class="btn btn-sm btn-danger">Hapus!</a>
                                                    </td>
                                                </tr>
                                                @php
                                                    $total_price = $total_price + $checkout->total_price;
                                                @endphp
                                                @endforeach
                                                <tr>
                                                    <td style="text-align: center" colspan="4">Total Bayar:</td>
                                                    <td style="text-align: right;">
                                                        <input type="hidden" name="total_price" value="{{ $total_price }}">
                                                        <strong>Rp {{ number_format($total_price, 0, ',', '.') }}</strong>
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    @php
                                        $payments = App\Models\Payment::all();
                                        $shippers = App\Models\Shipper::orderBy('shipper', 'desc')->get();
                                    @endphp
                                    <div class="row col-12 mb-3 mt-3">
                                        <div class="col-3">
                                            <label for="shipping_cost">Ongkos Kirim :</label>
                                            <input name="shipping_cost" id="shipping_cost" type="number" class="form-control" value="0" min="0">
                                            @error('shipping_cost')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-3">
                                            <label for="shipper form-group">Jasa Pengiriman :</label>
                                            <select name="shipper" class="form-select" id="shipper">
                                                <option value="0" selected>Pilih jasa pengiriman</option>
                                                @foreach ($shippers as $shipper)
                                                    <option value="{{ $shipper->id }}">{{ $shipper->shipper }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3 form-group">
                                            <label for="payment">Metode Pembayaran :</label>
                                            <select name="payment" class="form-select" aria-label="Default select example">
                                                <option value="" selected disabled>Pilih metode pembayaran</option>
                                                @foreach ($payments as $payment)
                                                    <option value="{{ $payment->id }}">{{ $payment->payment_method }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3 col-12">
                                        <div class="col-4 form-group">
                                            <label for="customer_name">Nama Pembeli :</label>
                                            <select class="form-select select2" name="customer_name" id="customer_name">
                                                <option value="" selected disabled>Pilih pembeli</option>
                                                <option value="0">Pembeli baru</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->customer_name }}">{{ $customer->customer_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>

                                        <div class="col-2">
                                            <label for="transaction_date" class="form-label">Tanggal :</label>
                                            <input class="form-control" type="date" name="transaction_date" value="{{ $date }}">
                                        </div>
                                    </div>

                                    {{-- Hidden New Customer Input --}}
                                    <div class="row mb-3 col-12" id="new_customer" style="display: none">
                                        <div class="col-4 form-group">
                                            <label for="new_customer">Pembeli Baru</label>
                                            <input class="form-control" type="text" name="new_customer" id="new_customer" >
                                        </div>
                                    </div>

                                </div>
                                <input type="submit" class="btn btn-primary col-12" value="Buat Nota">
                            </form>

                        </div>
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Daftar Barang</h4>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Stok</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Jumlah Pembelian</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($stock as $key => $item)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->item_name }}</td>
                                            <td>{{ $item->category->category_name }}</td>
                                            <td>{{ $item->stock_left }}</td>
                                            <td class="text-end">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->unit->unit_name }}</td>
                                            <form action="{{ route('add.transaction.item') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}">
                                                <td>
                                                    <div class="col-7">
                                                        <input class="form-control" type="number" value="0" name="item_count" id="item_count" min="1" max="{{ $item->stock_left }}">
                                                        @error('item_count')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="submit" value="Tambah" class="btn btn-info" id="add_item">
                                                </td>
                                            </form>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->


            </div>


</div>

<script>
    date = new Date();
    year = date.getFullYear();
    month = date.getMonth() + 1;
    day = date.getDate();
    document.getElementById("current_date").innerHTML = "Transaction Date: " + day + "/" + month + "/" + year;
    document.getElementById("transaction_number").innerHTML = "TRSK" + day + "-" + month + "-" + year;
</script>

<script>
    $(document).ready(function(){

        $(document).on('change', '#customer_name', function(){
            var customer_value = $(this).val();
            console.log(customer_value);
            if(customer_value == '0'){
                $('#new_customer').show();
            } else {
                $('#new_customer').hide();
            }
        })
    })
</script>

<script>
    $(document).ready(function(){
        $('#transaction_form').validate({
            rules: {
                new_customer: {
                    required: true,
                },
                payment: {
                    required: true,
                },
                customer_name: {
                    required: true,
                },
            },
            messages: {
                new_customer: {
                    required: 'Please input the new customer!',
                },
                payment: {
                    required: 'Please select the payment method!',
                },
                customer_name: {
                    required: 'Please select the customer!',
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
