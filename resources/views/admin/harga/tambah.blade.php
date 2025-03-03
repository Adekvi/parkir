<div class="modal fade text-left" id="kendaraan" tabindex="-1" aria-labelledby="myModalLabel160">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white" style="background: #0ddbb9">
                <h5 class="modal-title" id="myModalLabel160">Tambah Harga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('admin/harga-tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Jenis Kendaraan</label>
                                <input type="text" name="jenisKendaraan" id="jenisKendaraan" class="form-control"
                                    placeholder="Masukkan Jenis Kendaraan">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Lokasi Parkir</label>
                                <select name="id_lokasiParkir" id="id_lokasiParkir" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($lokasi as $item)
                                        <option value="{{ $item->id }}">{{ $item->tmptParkir }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Kode Jalan</label>
                                <input type="text" name="kodeJln" id="kodeJln" class="form-control" readonly
                                    placeholder="Kode Jalan">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Jalan</label>
                                <input type="text" name="namaJalan" id="namaJalan" class="form-control" readonly
                                    placeholder="Nama Jalan">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Harga</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"
                                            style="background: rgb(228, 228, 228); font-size: 12px">
                                            <b>Rp.</b>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="harga" id="harga" required>
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
    </div>
</div>

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // nama jalan dan kode jalan
        $(document).ready(function() {
            $('#id_lokasiParkir').change(function() {
                const id = $(this).val();
                console.log("ID Lokasi Dipilih:", id); // Debugging

                if (id) {
                    $.ajax({
                        url: `/get-namaJalan/${id}`,
                        type: 'GET',
                        dataType: 'json', // Pastikan ini ada
                        success: function(response) {
                            console.log("Response dari server:", response); // Debugging
                            if (response.namaJalan && response.kodeJln) {
                                $('#namaJalan').val(response.namaJalan);
                                $('#kodeJln').val(response.kodeJln);
                            } else {
                                console.warn("Data tidak ditemukan dalam response!");
                                $('#namaJalan').val('');
                                $('#kodeJln').val('');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error AJAX:", xhr.responseText);
                            alert('Gagal mengambil data jalan');
                        }
                    });
                } else {
                    $('#namaJalan').val('');
                    $('#kodeJln').val('');
                }
            });
        });
    </script>
@endpush
