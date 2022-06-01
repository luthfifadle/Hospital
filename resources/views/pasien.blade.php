<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
    @include('navbar')
    <div class="container bg-light mt-3 text-light">
        <div class="row">
            <div class="col-sm-12">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah +</button>
                <div class="btn-group">
                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
                    </button>
                    <ul class="dropdown-menu p-2">
                        <label>Pilih Rumah Sakit</label>
                        <select class="form-control" onchange="searchRs(this.value)">
                            <option selected disabled>-- Rumah Sakit --</option>
                            @foreach ($dataRs as $item)
                                <option value="{{ $item->rs_id }}">
                                    {{ $item->rs_name }}
                                </option>
                            @endforeach
                        </select>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12">
                <table class="table table-light m-1 border">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Rumah Sakit</th>
                        <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="normalValue">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($dataPasien as $key => $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->ps_name }}</td>
                                <td>{{ $item->ps_address }}</td>
                                <td>{{ $item->ps_phone }}</td>
                                <td>{{ $item->rumahSakit->rs_name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#editModal{{ $item->ps_id }}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item->ps_id }}">Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade text-dark" id="editModal{{ $item->ps_id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('pasien.update', $item->ps_id) }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Pasien</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Pasien</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->ps_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ $item->ps_address }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telepon" class="form-label">Telepon</label>
                                                    <input type="tel" class="form-control" id="telepon" name="telepon" value="{{ $item->ps_phone }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rs" class="form-label">Rumah Sakit</label>
                                                    <select class="form-control" id="rs" name="rs" required>
                                                        <option disabled>--- Pilih Rumah Sakit ---</option>
                                                        @foreach ($dataRs as $itemRs)
                                                            @if ($itemRs->rs_id == $item->rs_id)
                                                                <option value="{{ $itemRs->rs_id }}" selected>{{ $itemRs->rs_name }}</option>
                                                            @else
                                                                <option value="{{ $itemRs->rs_id }}">{{ $itemRs->rs_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
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
                            <div class="modal fade text-dark" id="hapusModal{{ $item->ps_id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{ $item->ps_id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Hapus Pasien
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            Data Pasien akan di Hapus, Lanjutkan?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger"  data-bs-dismiss="modal" onclick="deletePs({{ $item->ps_id }})">
                                                Ok
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                    <tbody id="jsonValue" style="display: none">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($dataPasien as $key => $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item->ps_name }}</td>
                                <td>{{ $item->ps_address }}</td>
                                <td>{{ $item->ps_phone }}</td>
                                <td>{{ $item->rumahSakit->rs_name }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#editModal{{ $item->ps_id }}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item->ps_id }}">Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade text-dark" id="editModal{{ $item->ps_id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('pasien.update', $item->ps_id) }}">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Edit Pasien</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="nama" class="form-label">Nama Pasien</label>
                                                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $item->ps_name }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="alamat" class="form-label">Alamat</label>
                                                    <textarea class="form-control" id="alamat" name="alamat" required>{{ $item->ps_address }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="telepon" class="form-label">Telepon</label>
                                                    <input type="tel" class="form-control" id="telepon" name="telepon" value="{{ $item->ps_phone }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rs" class="form-label">Rumah Sakit</label>
                                                    <select class="form-control" id="rs" name="rs" required>
                                                        <option disabled>--- Pilih Rumah Sakit ---</option>
                                                        @foreach ($dataRs as $itemRs)
                                                            @if ($itemRs->rs_id == $item->rs_id)
                                                                <option value="{{ $itemRs->rs_id }}" selected>{{ $itemRs->rs_name }}</option>
                                                            @else
                                                                <option value="{{ $itemRs->rs_id }}">{{ $itemRs->rs_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
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
                            <div class="modal fade text-dark" id="hapusModal{{ $item->ps_id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form>
                                        @csrf
                                        <input type="hidden" value="{{ $item->ps_id }}">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Hapus Pasien
                                            </h5>
                                        </div>
                                        <div class="modal-body">
                                            Data Pasien akan di Hapus, Lanjutkan?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="button" class="btn btn-danger"  data-bs-dismiss="modal" onclick="deletePs({{ $item->ps_id }})">
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
              <form method="POST" action="{{ route('pasien.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Tambah Pasien</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Pasien</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="telepon" class="form-label">Telepon</label>
                            <input type="tel" class="form-control" id="telepon" name="telepon" required>
                        </div>
                        <div class="mb-3">
                            <label for="rs" class="form-label">Rumah Sakit</label>
                            <select class="form-control" id="rs" name="rs" required>
                                <option disabled>--- Pilih Rumah Sakit ---</option>
                                @foreach ($dataRs as $itemRs)
                                    <option value="{{ $itemRs->rs_id }}">{{ $itemRs->rs_name }}</option>
                                @endforeach
                            </select>
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
    <script src="{{ asset('js/pasien.js') }}"></script>
</body>
</html>
