@extends('layouts.template')

@section('content')
<form action="{{ route('student.store')}}" method="POST" class="card p-5">
    @csrf

    @if(Session::get('success'))
    <div class="alert alert-success"> {{ Session::get('success') }} </div>
    @endif
    @if ($errors->any())
    <ul class="alert alert-alert">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Siswa :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Jenis Kelamin :</label>
        <div class="col-sm-10">
            <select class="form-select" id="type" name="type">
                <option selected disable hidden>Pilih</option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="prince" class="col-sm-2 col-form-label">NIS :</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="nis" name="nis">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="prince" class="col-sm-2 col-form-label">Rombel :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="rombel" name="rombel">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Tambah Data</button>
</form>
@endsection