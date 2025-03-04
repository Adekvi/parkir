<div class="modal fade text-left" id="kendaraan" tabindex="-1" aria-labelledby="myModalLabel160">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="myModalLabel160">Tambah Shift</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('admin/shift-tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="namaShift" class="form-label">Nama Shift</label>
                                <input type="text" class="form-control" name="namaShift" id="namaShift"
                                    placeholder="Masukkan Nama Shift" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label for="mulai" class="form-label">Jam Mulai</label>
                            <div class="mb-3">
                                <input type="text" name="mulai" id="mulai" class="form-control"
                                    placeholder="Jam Mulai" required>
                            </div>
                        </div>

                        <div class="col-lg-2 text-center">
                            <span class="fw-bold">Sampai</span>
                        </div>

                        <div class="col-lg-5">
                            <label for="akhir" class="form-label">Jam Akhir</label>
                            <div class="mb-3">
                                <input type="text" class="form-control" name="akhir" id="akhir"
                                    placeholder="Jam Akhir" required>
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
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
