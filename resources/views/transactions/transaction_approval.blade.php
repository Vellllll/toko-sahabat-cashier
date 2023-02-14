@extends('support.source')

@section('title')
Cetok Lunas | Toko Sahabat
@endsection

@section('main-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Cetok Lunas</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                                <li class="breadcrumb-item active">Cetok Lunas</li>
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

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor Transaksi</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Nama Pembeli</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Total (tanpa ongkir)</th>
                                    <th>Ongkos Kirim</th>
                                    <th>Jasa Pengiriman</th>
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                        @foreach ($pending_transactions as $key => $transaction)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td width="10%">{{ $transaction->transaction_number }}</td>
                                                <td width="10%">{{ date('d-m-Y', strtotime($transaction->transaction_date)) }}</td>
                                                <td>{{ $transaction->customer_name }}</td>
                                                <td width="10%">{{ $transaction['paymentMethod']['payment_method'] }}</td>
                                                <td class="text-end">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                                <td class="text-end">Rp{{ number_format($transaction->shipping_costs, 0, ',', '.') }}</td>
                                                {{-- <td>{{ $transaction->shipperName->shipper }}</td> --}}
                                                @if (!isset($transaction->shipperName->shipper))
                                                    <td>-</td>
                                                @else
                                                    <td>{{ $transaction->shipperName->shipper }}</td>
                                                @endif
                                                <td class="text-end"><strong>Rp{{ number_format($transaction->total_price + $transaction->shipping_costs, 0, ',', '.') }}</strong></td>
                                                <td>
                                                    <button class="btn btn-warning">PENDING</button>
                                                </td>
                                                <td>
                                                    <a href="{{ route('edit.transaction.page', $transaction->id) }}" class="btn btn-info"><i class="far fa-edit"></i> Ubah</a>
                                                    <a href="{{ route('approve.transaction', $transaction->id) }}" class="btn btn-success" id="approve"><i class="fas fa-check-circle"></i> Lunas</a>
                                                </td>
                                            </tr>
                                        @endforeach

                                </tbody>


                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

</div>


@endsection
