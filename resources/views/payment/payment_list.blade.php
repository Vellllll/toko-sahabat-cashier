@extends('support.source')

@section('title')
Metode Pembayaran | Toko Sahabat
@endsection

@section('main-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daftar Metode Pembayaran</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pembayaran</a></li>
                                <li class="breadcrumb-item active">Daftar Metode Pembayaran</li>
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
                                    <th>Metode Pembayaran</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach ($payments as $key => $payment)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td class="col-8">{{ $payment->payment_method }}</td>
                                            <td>
                                                <a href="{{ route('edit.payment.page', $payment->id) }}" class="btn btn-warning"><i class="far fa-edit"></i> Ubah</a>
                                                <a href="{{ route('delete.payment', $payment->id) }}" class="btn btn-danger" id="delete"><i class="far fa-trash-alt"></i> Hapus</a>
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
