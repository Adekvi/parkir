@foreach ($rego as $item)
    <div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myModalLabel160">Update Tarif</h5>
                    <button type="button" class="btn-close btn-dark" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/harga-edit/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <!-- Lokasi Parkir -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Lokasi Parkir</label>
                                    <select name="id_lokasiParkir" id="id_lokasiParkir_{{ $item->id }}"
                                        class="form-control lokasiParkir" data-id="{{ $item->id }}">
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
                            <!-- Nama Jalan -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama Jalan</label>
                                    <input type="text" name="namaJalan" id="namaJalan_{{ $item->id }}"
                                        class="form-control" readonly>
                                </div>
                            </div>
                            <!-- Jenis Kendaraan -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Jenis Kendaraan</label>
                                    <input type="text" name="jenisKendaraan" id="jenisKendaraan"
                                        value="{{ $item->jenisKendaraan }}" class="form-control"
                                        placeholder="Masukkan Jenis Kendaraan">
                                </div>
                            </div>
                            <!-- Harga -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="harga">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light fw-bold px-3">
                                            Rp.
                                        </span>
                                        <input type="number" class="form-control text-end" name="harga"
                                            id="harga" value="{{ $item->harga }}" required
                                            style="max-width: 200px;">
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
@endforeach


@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Saat modal edit dibuka, tampilkan namaJalan sesuai lokasi parkir yang dipilih
            $('.modal').on('shown.bs.modal', function() {
                let modal = $(this);
                let id = modal.find('.lokasiParkir').val();
                let modalId = modal.find('.lokasiParkir').data('id');
                let namaJalanInput = $('#namaJalan_' + modalId);

                if (id) {
                    $.ajax({
                        url: `/get-namaJalan/${id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.namaJalan) {
                                namaJalanInput.val(response.namaJalan);
                            } else {
                                namaJalanInput.val('');
                            }
                        },
                        error: function(xhr) {
                            console.error("Error AJAX:", xhr.responseText);
                            namaJalanInput.val('');
                        }
                    });
                }
            });

            // Saat lokasi parkir diubah, update nama jalan
            $(document).on('change', '.lokasiParkir', function() {
                let id = $(this).val();
                let modalId = $(this).data('id');
                let namaJalanInput = $('#namaJalan_' + modalId);

                if (id) {
                    $.ajax({
                        url: `/get-namaJalan/${id}`,
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.namaJalan) {
                                namaJalanInput.val(response.namaJalan);
                            } else {
                                namaJalanInput.val('');
                            }
                        },
                        error: function(xhr) {
                            console.error("Error AJAX:", xhr.responseText);
                            namaJalanInput.val('');
                        }
                    });
                } else {
                    namaJalanInput.val('');
                }
            });
        });
    </script>
@endpush
