@extends('support.source')

@section('title')
Detail Transaksi | Toko Sahabat
@endsection

@section('main-content')

<style>
    .pending-paid{
        font-size: 1.5em;
    }
    @media print {
        table{
            font-size: 11px;
            max-width: 100%;
        }

        td {
            max-width: 20%;
        }

        .pending-paid{
            font-size: 12px;
        }

        .payment-method {
            font-size: 12px;
        }

        .grand-total {
            font-size: 14px
        }
        .card-title {
            font-size: 14px;
        }
        .toko-sahabat {
            margin-top: 10px;
            text-align: center;
            font-size: 12px
        }
    }
</style>

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Detail Transaksi</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Transaksi</a></li>
                                <li class="breadcrumb-item active">Detail Transaksi</li>
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
                            <div class="toko-sahabat" style="">
                                <h5>TOKO SAHABAT</h5>
                                Jl. Parangklitik Raya No 14 Semarang
                                <p>No telp: 088888889237492</p>
                            </div>
                            <div class="card-title">
                                <h4 class="card-title">{{ $transaction->transaction_number }}</h4>
                                Customer Name : <strong>{{ $transaction->customer_name }}</strong>
                                <p class="card-title-desc">Transaction Date : {{ date('d-m-Y', strtotime($transaction->transaction_date)) }}</p>

                            </div>

                            <div class="table-responsive">
                                <table class="table mb-0">

                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Barang</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-end">Jumlah Harga</th>
                                        </tr>
                                    </thead>

                                    @php
                                        $total = 0;
                                    @endphp

                                    <tbody>
                                        @foreach ($transaction->items as $key => $item)
                                            <tr>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->count }} {{ $item->unit->unit_name }}</td>
                                                <td class="text-end">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td class="text-end">Rp{{ number_format($item->total_price, 0, ',', '.') }}</td>
                                            </tr>

                                            @php
                                                $total += $item->total_price
                                            @endphp
                                        @endforeach
                                        <tr>
                                            <td colspan="3" class="text-center">Total Harga</td>
                                            <td class="text-end">Rp{{ number_format($total, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" class="text-center">Ongkos Kirim</td>
                                            <td class="text-end">Rp{{ number_format($transaction->shipping_costs, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr class="table-light">
                                            <td colspan="3" class="text-center">Total Bayar</td>
                                            <td class="text-end"><h4 class="grand-total">Rp{{ number_format($total + $transaction->shipping_costs, 0, ',', '.') }}</h4></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="payment-method">Metode Pembayaran : <strong> {{ $transaction->paymentMethod->payment_method }} </strong></p>
                            @if ($transaction->status == '0')
                                <p class="pending-paid">Status : <span class="pending-paid">BELUM LUNAS</span></p>
                            @elseif ($transaction->status == '1')
                                <p class="pending-paid">Status : <span class="pending-paid">LUNAS</span></p>
                            @endif
                            <p class="text-center" id="terima-kasih" style="display:none; font-size:8px">~ TERIMA KASIH ~</p>

                            <div class="d-print-none">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light" id="print"><i class="fa fa-print"></i></a>
                                    <a onclick="makePDF()" class="btn btn-primary waves-effect waves-light ms-2" id="download">Download</a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->


</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

<script>
    $(document).ready(function(){
        $("#print").on("click", function(){
            $("#terima-kasih").show();
        })
    })
</script>

<script>

    window.html2canvas = html2canvas;
    window.jsPDF = window.jspdf.jsPDF;

    function makePDF(){
        html2canvas(document.querySelector(".card-body"),{
            allowTaint:true,
            useCORS: true,
            scale: 1
        }).then(canvas =>{
            var img = canvas.toDataURL("image/png");

            var doc = new jsPDF();
            doc.save("htmltopdf");
        })
    }

</script>


@endsection
