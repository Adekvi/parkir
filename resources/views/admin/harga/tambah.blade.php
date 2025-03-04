<div class="modal fade text-left" id="kendaraan" tabindex="-1" aria-labelledby="myModalLabel160">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header text-white bg-primary">
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
                                <label for="">Nama Jalan</label>
                                <input type="text" name="kodeJln" id="namaJalan" placeholder="Nama Jalan"
                                    class="form-control" disabled>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light fw-bold px-3">
                                        Rp.
                                    </span>
                                    <input type="number" class="form-control text-end" name="harga" id="harga"
                                        required style="max-width: 200px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#id_lokasiParkir').change(function() {
                const id = $(this).val();

                if (id) {
                    $.ajax({
                        url: `/get-namaJalan/${id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.namaJalan) {
                                $('#namaJalan').val(response.namaJalan);
                            } else {
                                $('#namaJalan').val('');
                            }
                        },
                        error: function(xhr) {
                            console.error("Error AJAX:", xhr.responseText);
                            $('#namaJalan').val('');
                        }
                    });
                } else {
                    $('#namaJalan').val('');
                }
            });
        });
    </script>
@endpush
