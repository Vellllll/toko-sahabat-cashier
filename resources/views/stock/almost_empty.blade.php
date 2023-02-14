@extends('support.source')

@section('title')
Stok Hampir Habis | Toko Sahabat
@endsection

@section('main-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Stok Hampir Habis</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stok</a></li>
                                <li class="breadcrumb-item active">Stok Hampir Habis</li>
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
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Sisa Stok</th>
                                    <th>Harga</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody>
                                    @foreach ($stock as $item)
                                        @php
                                            $stock_left = $item->stock_left;
                                        @endphp
                                        @if ($stock_left < 6)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->item_name }}</td>
                                                <td>{{ $item->category->category_name }}</td>
                                                <td>{{ $item->stock_left }} {{ $item->unit->unit_name }}</td>
                                                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('edit.item.page', $item->id) }}" class="btn btn-warning"><i class="far fa-edit"></i> Ubah Barang</a>
                                                    <a href="{{ route('delete.item', $item->id) }}" class="btn btn-danger" id="delete"><i class="fa fa-trash-alt"></i> Hapus Barang</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

</div>


@endsection
