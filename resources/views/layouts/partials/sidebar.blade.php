<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link bg-maroon">
        <img src="{{ asset('img/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('APP_NAME') }}</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @if (Auth::user()->level == 'pimpinan')
                    <a href="#">{{ Auth::user()->pimpinan->nama }}</a>
                @elseif (Auth::user()->level == 'pegawai')
                    <a href="#">{{ Auth::user()->pegawai->nama }}</a>
                @else
                    <a href="#">Admin</a>
                @endif
            </div>
        </div>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ Route::is('dashboard.index') || Request::is('dashboard/*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @if (Auth::user()->level === 'admin')
                    <li
                        class="nav-item {{ Route::is('pimpinan.index') || Route::is('pegawai.index') || Request::is('pegawai/*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('pimpinan.index') }}"
                                    class="nav-link {{ Route::is('pimpinan.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pimpinan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('pegawai.index') }}"
                                    class="nav-link {{ Route::is('pegawai.index') || Request::is('pegawai/*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pegawai</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (Auth::user()->level == 'admin' || Auth::user()->level == 'pegawai')
                    <li class="nav-item">
                        <a href="{{ route('tubel.index') }}"
                            class="nav-link {{ Request::is('tubel/*') || Route::is('tubel.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-pen"></i>
                            <p>
                                Tubel
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('rekomendasi.index') }}"
                        class="nav-link {{ Request::is('rekomendasi/*') || Route::is('rekomendasi.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-star"></i>
                        <p>
                            Rekomendasi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('laporan.tubel') }}"
                        class="nav-link {{ Request::is('laporan/tubel/*') || Route::is('laporan.tubel') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>
            </ul>
        </nav>

    </div>

</aside>
