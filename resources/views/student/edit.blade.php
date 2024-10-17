@extends('layouts.template')

@section('content')

<form action="{{ route('student.update', $student['id']) }}" method="POST" class="card p-5">
    @csrf
    @method('PATCH')

    @if ($errors->any())
    <ul class="alert alert-danger p-3">
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
    @endif

    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Nama Siswa :</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" value="{{$student['name']}}">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="type" class="col-sm-2 col-form-label">Jenis Kelamin :</label>
        <div class="col-sm-10">
            <select class="form-select" name="type" id="type">
                <option selected disable hidden>Pilih</option>
                <option value="pria" {{ isset($student['type']) && $student['type'] == 'pria' ? 'selected' : '' }}>Pria</option>
                <option value="wanita"  {{ isset($student['type']) && $student['type'] == 'wanita' ? 'selected' : '' }}>Wanita</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="price" class="col-sm-2 col-form-label">NIS :</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" id="nis" name="nis" value="{{ $student['nis']}}">
        </div>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Ubah Data</button>
</form>
@endSection