@extends('support.source')

@section('title')
Daftar Transaksi | Toko Sahabat
@endsection

@section('main-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daftar Transaksi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                                <li class="breadcrumb-item active">Daftar Transaksi</li>
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
                                    <th>Total Bayar</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp

                                <tbody>
                                    @if (count($transactions) == 0)
                                        <tr>
                                            <td colspan="9">Tidak ada transaksi!</td>
                                        </tr>
                                    @else
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td width="10%">{{ $transaction->transaction_number }}</td>
                                                <td width="10%">{{ date('d-m-Y', strtotime($transaction->transaction_date)) }}</td>
                                                <td>{{ $transaction->customer_name }}</td>
                                                <td>{{ $transaction['paymentMethod']['payment_method'] }}</td>
                                                <td class="text-end"><strong>Rp{{ number_format($transaction->total_price + $transaction->shipping_costs, 0, ',', '.') }}</strong></td>
                                                <td>
                                                    @if ($transaction->status == '1')
                                                        <button class="btn btn-success"><i class="ri-secure-payment-line"></i> LUNAS</button>
                                                    @else
                                                        <button class="btn btn-warning"><i class="ri-cloud-line"></i> BELUM LUNAS</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('transaction.data.page', $transaction->id) }}" class="btn btn-outline-dark"><i class="ri-printer-line"></i> Print</a>
                                                    {{-- <button class="btn btn-info"><i class="ri-printer-line"></i> Print</button> --}}
                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif
                                </tbody>


                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

</div>


@endsection
