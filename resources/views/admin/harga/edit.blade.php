@foreach ($rego as $item)
    <div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #0ddbb9">
                    <h5 class="modal-title text-white" id="myModalLabel160">Update Shift</h5>
                    <button type="button" class="btn-close btn-light" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/harga-edit/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Jenis Kendaraan</label>
                                    <input type="text" name="jenisKendaraan" id="jenisKendaraan"
                                        value="{{ $item->jenisKendaraan }}" class="form-control"
                                        placeholder="Masukkan Jenis Kendaraan">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Lokasi Parkir</label>
                                    <select name="id_lokasiParkir" id="id_lokasiParkir" class="form-control">
                                        <option value="">--Pilih--</option>
                                        @foreach ($lokasi as $lok)
                                            <option value="{{ $lok->id }}"
                                                {{ $item->id_lokasiParkir == $lok->id ? 'selected' : '' }}>
                                                {{ $lok->tmptParkir }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-lg-6">
                           <div class="form-group">
                                <label for="">Kode Jalan</label>
                                <input type="text" name="kodeJln" id="kodeJln" class="form-control" placeholder="Kode Jalan" readonly>
                           </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Jalan</label>
                                <input type="text" name="namaJalan" id="namaJalan" class="form-control" placeholder="Nama Jalan" readonly>
                            </div>
                        </div> --}}
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                style="background: rgb(228, 228, 228); font-size: 15px">
                                                <b>Rp.</b>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" name="harga" id="harga"
                                            value="{{ $item->harga }}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background: #0ddbb9">Save changes</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endforeach

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            // Mengisi data namaJalan dan kodeJln saat memilih id_lokasiParkir
            $('#id_lokasiParkir').change(function() {
                const id = $(this).val(); // Ambil ID lokasi yang dipilih
                if (id) {
                    $.ajax({
                        url: `/get-namaJalan/${id}`,
                        type: 'GET',
                        success: function(response) {
                            $('#namaJalan').val(response.namaJalan);
                            $('#kodeJln').val(response.kodeJln);
                        },
                        error: function() {
                            alert('Gagal mengambil data jalan');
                        }
                    });
                } else {
                    $('#namaJalan').val(''); // Kosongkan jika tidak ada pilihan
                    $('#kodeJln').val(''); // Kosongkan jika tidak ada pilihan
                }
            });

            // Jika modal dibuka, kita cek apakah sudah ada id_lokasiParkir yang dipilih.
            $('.edit-modal').on('shown.bs.modal', function() {
                const selectedLokasi = $('#id_lokasiParkir').val(); // Ambil nilai yang sudah dipilih
                if (selectedLokasi) {
                    // Trigger AJAX untuk mendapatkan data jalan sesuai dengan id_lokasiParkir
                    $.ajax({
                        url: `/get-namaJalan/${selectedLokasi}`,
                        type: 'GET',
                        success: function(response) {
                            $('#namaJalan').val(response.namaJalan);
                            $('#kodeJln').val(response.kodeJln);
                        },
                        error: function() {
                            alert('Gagal mengambil data jalan');
                        }
                    });
                }
            });
        });
    </script>
@endpush
