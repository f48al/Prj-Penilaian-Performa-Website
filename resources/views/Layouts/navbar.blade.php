<div class="container-fluid px-0">
    <header class="d-flex justify-content-around bg-primary p-3">
        <a @class([
            'link-light'    => Request::segment(1) != 'home',
            'link-warning'  => Request::segment(1) == 'home',
        ]) href="{{ route('home') }}"><b>Home</b></a>

        @php
            $penyusunan = null;
            if(Request::segment(1) == 'addKPI') $penyusunan = 'addKPI';
            if(Request::segment(1) == 'penyusunanKPI') $penyusunan = 'penyusunanKPI';
            if(Request::segment(1) == 'revPenyusunan') $penyusunan = 'revPenyusunan';
        @endphp
        <div class="dropdown">
            <a class="dropdown-toggle {{ $penyusunan ? 'link-warning' : 'link-light' }}"
                href="#" role="link" id="nav-penyusunan" data-bs-toggle="dropdown" aria-expanded="false">
                <b>Penyusunan</b>
            </a>

            <ul class="dropdown-menu" aria-labelledby="nav-penyusunan-link">
                <li><a class="dropdown-item {{ $penyusunan == 'addKPI' ? 'active' : '' }}" href="{{ route('add-kpi.index') }}">Tambah KPI</a></li>
                <li><a class="dropdown-item {{ $penyusunan == 'penyusunanKPI' ? 'active' : '' }}" href="{{ route('penyusunan-kpi.index') }}">Penyusunan KPI</a></li>
                <li><a class="dropdown-item {{ $penyusunan == 'revPenyusunan' ? 'active' : '' }}" href="{{ route('review-penyusunan.index') }}">Review Penyusunan</a></li>
            </ul>
        </div>

        @php
            $penilaian = null;
            if(Request::segment(1) == 'penilaianPribadi') $penilaian = 'penilaianPribadi';
            if(Request::segment(1) == 'penilaianBawahan') $penilaian = 'penilaianBawahan';
            if(Request::segment(1) == 'revPenilaian') $penilaian = 'revPenilaian';
        @endphp
        <div class="dropdown">
            <a class="dropdown-toggle {{ $penilaian ? 'link-warning' : 'link-light' }}"
                href="#" role="link" id="nav-penilaian" data-bs-toggle="dropdown" aria-expanded="false">
                <b>Penilaian</b>
            </a>

            <ul class="dropdown-menu" aria-labelledby="nav-penilaian-link">
                <li><a class="dropdown-item {{ $penilaian == 'penilaianPribadi' ? 'active' : '' }}" href="{{ route('penilaian-pribadi.index') }}">Penilaian Pribadi</a></li>
                <li><a class="dropdown-item {{ $penilaian == 'penilaianBawahan' ? 'active' : '' }}" href="{{ route('penilaian-bawahan.index') }}">Penilaian KPI</a></li>
                <li><a class="dropdown-item {{ $penilaian == 'revPenilaian' ? 'active' : '' }}" href="{{ route('review-penilaian.index') }}">Review Penilaian</a></li>
            </ul>
        </div>
        <a @class([
            'link-light'    => Request::url() != url('/inbox'),
            'link-warning'  => Request::url() == url('/inbox'),
        ]) href="{{ route('inbox.index') }}"><b>Inbox</b></a>
    </header>
</div>
