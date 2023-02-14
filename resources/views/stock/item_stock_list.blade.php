@extends('support.source')

@section('title')
Daftar Barang | Toko Sahabat
@endsection

@section('main-content')

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Daftar Barang</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Stok</a></li>
                                <li class="breadcrumb-item active">Daftar Barang</li>
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
                                    <th>Jumlah Terjual</th>
                                    <th>Harga</th>
                                    <th>Satuan</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody id="item_list">
                                    @foreach ($stock as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $item->item_name }}</td>
                                            <td>{{ $item->category->category_name }}</td>
                                            <td>{{ $item->stock_left }}</td>
                                            <td>{{ $item->stock_sold }}</td>
                                            <td class="text-end">Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                                            <td>{{ $item->unit->unit_name }}</td>
                                            <td>
                                                <a href="{{ route('edit.item.page', $item->id) }}" class="btn btn-warning btn-sm"><i class="far fa-edit"></i> Ubah Barang</a>
                                                <a href="{{ route('delete.item', $item->id) }}" class="btn btn-danger btn-sm" id="delete"><i class="far fa-trash-alt"></i> Hapus</a>
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

<script>
    $(function(){
        $(document).on('change', '#category_id', function(){
            var category_id = $(this).val();
            $.ajax({
                url:"{{ route('get.item.category') }}",
                type:"GET",
                data:{category_id:category_id},
                success:function(data){
                    var html = '';
                    $.each(data,function(key,v){
                        html += 'v.category.category_name';
                    });
                    $('#category_name').html(html);
                }
            })
        })
    })
</script>


@endsection
