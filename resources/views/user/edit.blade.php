<!-- resources/views/user/edit.blade.php -->

@extends('layouts.template')

@section('content')

    <form action="{{ route('user.update', $user->id) }}" method="POST" class="card p-5">
        @csrf
        @method('PUT')

        @if(Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="email" class="col-sm-2 col-form-label">Email :</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna :</label>
            <div class="col-sm-10">
                <select name="role" id="role" class="form-select" required>
                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="password" class="col-sm-2 col-form-label">Password :</label>
            <div class="col-sm-10">
                <input type="password" name="password" id="password" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan Perubahan</button>
        <a href="{{ route('user.index') }}" class="btn btn-danger mt-3">Kembali</a>
    </form>
@endsection
