@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{Session::get('success')}}</div>
    @endif
    @if(Session::get('delete'))
    <div class="alert alert-warning">{{Session::get('delete')}}</div>
    @endif

    <form action="" method="GET" class="d-flex justify-content-end">
            
            <input type="text" name="search_student" placeholder="Cari Nama Siswa..."
            class="form-control">
            <button type="submit" class="btn btn-primary ms-2">Cari</button>
        </form>
<br>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>NIS</th>
            <th>Rombel</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach($students as $item)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item['name']}}</td>
            <td>{{ $item['type']}}</td>
            <td>{{ $item['nis']}}</td>
            <td>{{ $item['rombel']}}</td>
            <td class="d-flex justify-content-center">
                <a href="{{ route('student.edit', $item['id']) }}" class="btn btn-primary me-3" >Edit</a>
                <!-- <a href="#" class="btn btn-danger">Hapus</a> -->
                 <form action="{{ route('student.delete', $item['id']) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus</button>
                 </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

        <div class="d-flex justify-content-end my-3">
            {{ $students->links() }}
        </div>

@endsection
