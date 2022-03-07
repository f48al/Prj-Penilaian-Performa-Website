@php $profile = Auth::user()->profile @endphp

<div class="d-flex flex-column flex-shrink-0 p-3 bg-theme-alt sidebar-border">
    <div class="d-flex justify-content-between" style="height: 5em">
        <div class="p-0 flex-shrink-1" style="width:40%!important;">
            <img class="rounded-circle w-100 h-100" src="{{ asset($profile->photo) }}" alt="profil_img">
        </div>
        <div class="p-0" style="font-size: 13px">
            <p>
                <span class="fw-bold text-primary">{{ Auth::user()->name ?? 'Nama tidak ada' }}</span>
                <br>
                <span class="fw-light">NPK: {{ $profile->NPK }}</span>
            </p>
        </div>
    </div>
    <a class="btn btn-sm btn-danger align-self-center my-2 w-50" role="button" href="{{ route('logout') }}">
        <b>Logout</b>
    </a>
    <div class="row mb-3" style="font-size: 13px">
        <div class="col">
            <p>
                <span class="fw-bolder text-primary">Posisi:</span>
                {{ $profile->namaJabatan ?? 'Posisi tidak ada' }}
            </p>
        </div>
    </div>
    <div class="row" style="font-size: 13px">
        <div class="col">
            <p>
                <span class="fw-bolder text-primary">Unit Kerja: </span>
                {{ $profile->unitKerja ?? 'Unit kerja tidak ada' }}
            </p>
        </div>
    </div>
</div>
