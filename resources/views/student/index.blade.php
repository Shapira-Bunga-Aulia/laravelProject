@extends('layouts.template')

@section('content')
    <div class="container">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif

        <form action="" method="GET" class="d-flex justify-content-end">

            <input type="text" name="search_student" placeholder="Cari Nama Siswa..."
            class="form-control">
            <button type="submit" class="btn btn-primary ms-2">Cari</button>
        </form>
        <br>
        <table class="table table-bordered table-stripped">
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

                @if (count($students) < 1)
                    <tr>
                        <td colspan="6" class="text-center">Data Siswa Kosong</td>
                    </tr>
                @else
                    @foreach ($students as $index => $item)
                        <tr>
                            <td>{{ ($students->currentPage()-1) *
                                ($students->perPage()) + ($index+1) }}</td>
                                <td>{{ $item['name']}}</td>
                                <td>{{ $item['type']}}</td>
                                <td>{{ $item['nis']}}</td>

                            <td style="cursor: pointer" class="{{ $item['rombel'] <= 3 ? 'bg-danger text-white' : '' }}" 
                            onclick="showModalRombel('{{ $item->id }}', '{{ $item->name}}', '{{ $item->rombel }}')">{{ $item['rombel'] }}</td>

                            <td class="d-flex">
                                <!-- {{-- , $item['id'] pada route akan mengisi path dinamis {id} --}} -->
                                <a href="{{ route('student.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                                <button class="btn btn-danger" onclick="showModalDelete('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>

        <div class="d-flex justify-content-end my-3">
            <!-- links menampilkan button pagination -->
            {{ $students->links() }}
        </div>

        <!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="">
        @csrf
        <!-- mengganti method POST menjadi delete agar sesuai dengan route web php delete -->
        @method('DELETE')
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Nama Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- nama obat yang diklik disimpan di id name medicine -->
       Apakah anda yakin ingin menghapus nama <b id="name-student"></b>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
</form>
  </div>
</div>
    </div>
        <!-- Modal Edit Rombel -->
    <div class="modal fade" id="modalEditRombel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="">
        @csrf
        @method('PATCH')
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Rombel Siswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5 id="title_form_edit"></h5>
        <div class="form-group">
            <label for="rombel" class="form-label">Rombel Sebelumnya : </label>
            <input type="text" name="rombel" id="rombel" class="form-control">
            <!-- menampung error yg terjadi pada proses form modal -->
             @if (Session::get('failed'))
             <small class="text-danger">{{ Session::get('failed') }}</small>
             @endif
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Edit</button>
      </div>
</form>
  </div>
</div>
    </div>
@endsection

@push('script')
<!-- CDN JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    function showModalDelete(id, name) {
        $("#name-student").text(name);
        $("#modalDelete").modal('show');
        let url = "{{ route('student.delete', ':id') }}";
        url = url.replace(':id', id);
        $("form").attr('action', url);
    }

    function showModalRombel(id, name, rombel) {
        $("#title_form_edit").text(name);
        $("#rombel").val(rombel);
        $("#modalEditRombel").modal('show');
        let url = "{{ route('student.update.rombel', ':id') }}";
        url = url.replace(':id', id);
        $("form").attr('action', url);
    }

    // ketika ada error pada form modal, panggil modal agar tetap muncul beserta keterangan errornya, serta data sebelumnya dari with pada controller
    @if ( Session::get('failed'))
        let id = "{{ Session::get('id') }}";
        let name = "{{ Session::get('name') }}";
        let rombel = "{{ Session::get('rombel') }}";
        showModalRombel(id, name, rombel);
    @endif
</script>
@endpush
