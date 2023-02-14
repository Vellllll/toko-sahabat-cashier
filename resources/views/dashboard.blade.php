@extends('support.source')

@section('title')
Dashboard | Toko Sahabat
@endsection


@section('main-content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Toko Sahabat</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            @php
                $transactions = App\Models\Transaction::all();
                $latest_transactions = App\Models\Transaction::latest()->limit(10)->get();
                $total_income = 0;
                foreach($transactions as $transaction){
                    $total_income += $transaction->total_price;
                }
            @endphp

            <div class="row">
                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Jumlah Transaksi</p>
                                    <h4 class="mb-2">{{ count($transactions) }}</h4>
                                    {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>9.23%</span>from previous period</p> --}}
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-primary rounded-3">
                                        <i class="ri-shopping-cart-2-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->

                @php
                    $check_outs = App\Models\CheckOut::all();
                    $total_checkouts = 0;
                    foreach($check_outs as $checkout){
                        $total_checkouts += $checkout->count;
                    }
                @endphp

                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Barang Terjual</p>
                                    <h4 class="mb-2">{{ $total_checkouts }}</h4>
                                    {{-- <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>1.09%</span>from previous period</p> --}}
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-warning rounded-3">
                                        <i class="ri-shopping-bag-3-line font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-4 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <p class="text-truncate font-size-14 mb-2">Total Pemasukan</p>
                                    <h4 class="mb-2">Rp{{ number_format($total_income, 0, ',', '.') }}</h4>
                                    {{-- <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>16.2%</span>from previous period</p> --}}
                                </div>
                                <div class="avatar-sm">
                                    <span class="avatar-title bg-light text-success rounded-3">
                                        <i class="mdi mdi-currency-usd font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div><!-- end row -->

            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="{{ route('transactions.history.page') }}" class="dropdown-item">Daftar Transaksi</a>
                                </div>
                            </div>

                            <h4 class="card-title mb-4">Transaksi Terbaru</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nomor Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Nama Pembeli</th>
                                            <th>Metode Payment</th>
                                            <th>Total Bayar</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($latest_transactions as $key => $transaction)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $transaction->transaction_number }}</td>
                                                <td>{{ $transaction->transaction_date }}</td>
                                                <td>{{ $transaction->customer_name }}</td>
                                                <td>{{ $transaction->paymentMethod->payment_method }}</td>
                                                <td class="text-end">Rp{{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->

                @php
                    $items = App\Models\Item::all();
                @endphp
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-end">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- item-->
                                    <a href="{{ route('almost.empty.item.page') }}" class="dropdown-item">Stok Barang Hampir Habis</a>
                                </div>
                            </div>

                            <h4 class="card-title mb-4">Stok Barang Hampir Habis</h4>

                            <div class="table-responsive">
                                <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Sisa Stok</th>
                                            <th>Harga</th>
                                        </tr>
                                    </thead><!-- end thead -->
                                    <tbody>
                                        @foreach ($items as $key => $item)
                                            @if ($item->stock_left < 10)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->category->category_name }}</td>
                                                    <td>{{ $item->stock_left }} {{ $item->unit->unit_name }}</td>
                                                    <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table> <!-- end table -->
                            </div>
                        </div><!-- end card -->
                    </div><!-- end card -->
                </div>
                <!-- end col -->
                {{-- <div class="col-xl-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="float-end">
                                <select class="form-select shadow-none form-select-sm">
                                    <option selected>Apr</option>
                                    <option value="1">Mar</option>
                                    <option value="2">Feb</option>
                                    <option value="3">Jan</option>
                                </select>
                            </div>
                            <h4 class="card-title mb-4">Monthly Earnings</h4>

                            <div class="row">
                                <div class="col-4">
                                    <div class="text-center mt-4">
                                        <h5>3475</h5>
                                        <p class="mb-2 text-truncate">Market Place</p>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div class="text-center mt-4">
                                        <h5>458</h5>
                                        <p class="mb-2 text-truncate">Last Week</p>
                                    </div>
                                </div>
                                <!-- end col -->
                                <div class="col-4">
                                    <div class="text-center mt-4">
                                        <h5>9062</h5>
                                        <p class="mb-2 text-truncate">Last Month</p>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->

                            <div class="mt-4">
                                <div id="donut-chart" class="apex-charts"></div>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div><!-- end col --> --}}
            </div>
            <!-- end row -->
        </div>

    </div>
    <!-- End Page-content -->

</div>
@endsection
