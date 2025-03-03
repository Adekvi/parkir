<div class="modal fade text-left" id="kendaraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialogmodal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Daftar Akun</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('daftar/akun') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" name="namaLengkap" id="namaLengkap" class="form-control" placeholder="Masukkan Nama Lengkap">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Username">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" name="password" id="password" class="form-control" required placeholder="Password">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Jenis Kelammin</label>
                                <select  name="jekel" id="jekel" class="form-control">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tempat Lahir</label>
                                <input type="text" name="tempatLahir" id="tempatLahir" class="form-control" placeholder="Masukkan Tempat Lahir">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" name="tglLahir" id="tglLahir" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Role Akun</label>
                                <select name="role" id="role" class="form-control">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="user">User</option>
                                    <option value="kolektor">Kolektor</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Jalan</label>
                                <select name="namaLokasi" id="namaLokasi" class="form-control">
                                    <option value="">-- Pilih Jalan --</option>
                                    @foreach ($dalan as $dal)
                                        <option value="{{ $dal->kodeJln }}">{{ $dal->namaJalan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Lokasi Parkir</label>
                                <select name="id_lokasiParkir" id="id_lokasiParkir" class="form-control">
                                    <option value="">-- Pilih Lokasi --</option>
                                    @foreach ($lokasi as $item)
                                        <option value="{{ $item->id }}">{{ $item->tmptParkir }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Shift</label>
                                <select name="id_shift" id="id_shift" class="form-control">
                                    <option value="">-- Pilih Shift--</option>
                                    @foreach ($shift as $shi)
                                        <option value="{{ $shi->id }}">{{ $shi->namaShift }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0">Aktif</option>
                                    <option value="1">Non-Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Foto KTP</label>
                                <input type="file" name="fotoKtp" id="fotoKtp" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">    
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- <script>
        // nama jalan dan kode jalan
        $(document).ready(function () {
            $('#id_lokasiParkir').change(function () {
                const id = $(this).val(); // Ambil ID jenis kendaraan yang dipilih
                if (id) {
                    $.ajax({
                        url: `/get-namaJalan/${id}`,
                        type: 'GET',
                        success: function (response) {
                            $('#namaJalan').val(response.namaJalan);
                            $('#kodeJln').val(response.kodeJln);
                        },
                        error: function () {
                            alert('Gagal mengambil data harga');
                        }
                    });
                } else {
                    $('#namaJalan').val(''); // Kosongkan jika tidak ada pilihan
                    $('#kodeJln').val(''); // Kosongkan jika tidak ada pilihan
                }
            });
        });
    </script> --}}
@endpush