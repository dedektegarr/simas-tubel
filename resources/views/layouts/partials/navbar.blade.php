<nav class="main-header navbar navbar-expand navbar-maroon navbar-dark">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <div class="nav-item">
            @if (Auth::user()->level == 'pimpinan')
                <span class="nav-link">Selamat Datang, {{ Auth::user()->pimpinan->nama }}</span>
            @endif
            @if (Auth::user()->level == 'pegawai')
                <span class="nav-link">Selamat Datang, {{ Auth::user()->pegawai->nama }}</span>
            @endif
        </div>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item bg-danger">
                        <i class="fas fa-power-off mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
