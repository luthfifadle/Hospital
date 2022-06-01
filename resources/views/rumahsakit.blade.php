<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
    @include('navbar')
    <div class="container bg-light mt-3 text-light">
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah +</button>
            </div>
            <div class="col-sm-12">
                <table class="table table-light m-1 border">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($dataRs as $key => $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->rs_name }}</td>
                                <td>{{ $item->rs_address }}</td>
                                <td>{{ $item->rs_mail }}</td>
                                <td>{{ $item->rs_phone }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#editModal{{ $item->rs_id }}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item->rs_id }}">Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade text-dark" id="editModal{{ $item->rs_id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('rumah-sakit.update', $item->rs_id) }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Rumah Sakit</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Rumah Sakit</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->rs_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ $item->rs_address }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" value="{{ $item->rs_mail }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telepon" class="form-label">Telepon</label>
                                                    <input type="tel" class="form-control" id="telepon" name="telepon" value="{{ $item->rs_phone }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                            @method('PUT')
                                        </form>
                                </div>
                                </div>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade text-dark" id="hapusModal{{ $item->rs_id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{ $item->rs_id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Hapus Rumah Sakit
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            Data Rumah Sakit akan di Hapus, Lanjutkan?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger"  data-bs-dismiss="modal" onclick="deleteRs({{ $item->rs_id }})">
                                                Ok
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
              <form method="POST" action="{{ route('rumah-sakit.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Rumah Sakit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Rumah Sakit</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="telepon" name="telepon" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
          </div>
        </div>
    </div>
    <script src="{{ asset('js/rs.js') }}"></script>
</body>
</html>
