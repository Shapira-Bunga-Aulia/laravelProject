@extends('layouts.template')

@section('content')

    @if(Session::get('success'))
        <div class="alert alert-success"> {{Session::get('success')}}</div>
    @endif
    @if(Session::get('delete'))
        <div class="alert alert-warning">{{Session::get('delete')}}</div>
    @endif

        <a href="{{ route('user.create', '$user->id') }}" class="btn btn-primary me-3">Tambah Pengguna</a>
      
<table class="table table-striped table-bordered table-hover">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $index => $user)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td class="d-flex justify-content-center">               
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary me-3" >Edit</a>
              
                 <!-- <form action="{{ route('user.destroy', $user->id) }}" style="display:inlane" method="POST">
                    @csrf
                    @method('DELETE')
                    <button onclick="showModalDelete()" type="submit" class="btn btn-danger">Hapus</button>
                 </form> -->

                 <div class="container">
                        <div onclick="showModalDelete({{$user['id']}})" class="btn btn-danger" >Hapus</div>
                </div>

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-end my-3">
            {{ $users->links() }}
        </div>

        <!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" method="POST" action="">
        @csrf
        <!-- mengganti method POST menjadi delete agar sesuai dengan route web php delete -->
        @method('DELETE')
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Akun</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- nama obat yang diklik disimpan di id name medicine -->
       Apakah anda yakin ingin menghapus data pengguna <b id="name-akun"></b>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
</form>
  </div>
</div>
    </div>
@endsection
@push('script')
<script>
    function showModalDelete(id,name){
        $("#name-akun").text(name);
        $("#modalDelete").modal('show');
        let url ="{{ route('user.destroy', ':id') }}";
        url = url.replace(':id', id);
        $('form').attr('action', url);
    }
</script>
<script>
  if (typeof jQuery == 'undefined') {
    console.log('jQuery is not loaded');
  } else {
    console.log('jQuery is loaded');
  }
</script>
@endpush
