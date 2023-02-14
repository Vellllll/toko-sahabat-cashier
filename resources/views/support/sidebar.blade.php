<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-box-open"></i>
                        <span>Stok Barang</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('item.stock.list.page') }}">Daftar Barang</a></li>
                        <li><a href="{{ route('almost.empty.item.page') }}">Stok Hampir Habis</a></li>
                        <li><a href="{{ route('add.stock.page') }}">Tambah Stok</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-network-wired"></i>
                        <span>Kategori</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('category.list.page') }}">Daftar Kategori</a></li>
                        <li><a href="{{ route('add.category.page') }}">Tambah Kategori</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-bookmark-fill"></i>
                        <span>Satuan</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('unit.list.page') }}">Daftar Satuan</a></li>
                        <li><a href="{{ route('add.unit.page') }}">Tambah Satuan</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-wechat-pay-fill"></i>
                        <span>Metode Pembayaran</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('payment.list.page') }}">Daftar Metode Pembayaran</a></li>
                        <li><a href="{{ route('add.payment.page') }}">Tambah Metode Pembayaran</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-truck-fill"></i>
                        <span>Jasa Pengiriman</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('shipper.list.page') }}">Daftar Jasa Pengiriman</a></li>
                        <li><a href="{{ route('add.shipper.page') }}">Tambah Jasa Pengiriman</a></li>
                    </ul>
                </li>

                <li class="menu-title">TRANSAKSI</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Transaksi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('add.transaction.page') }}">Tambah Transaksi</a></li>
                        <li><a href="{{ route('transactions.history.page') }}">Daftar Transaksi</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('approval.transaction.page') }}" class="waves-effect">
                        <i class="ri-cloud-fill"></i>
                        <span>Transaksi Belum Lunas</span>
                    </a>
                </li>





            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
