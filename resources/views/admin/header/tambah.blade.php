<div class="modal fade text-left" id="kendaraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="myModalLabel160">Tambah Header Karcis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{ url('admin/header-tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Header 1</label>
                                <input type="text" class="form-control" name="header1" id="header1"
                                    placeholder="Masukkan Header">
                            </div>
                            <div class="form-group">
                                <label for="">Header 3</label>
                                <input type="text" class="form-control" name="header3" id="header3"
                                    placeholder="Masukkan Header">
                            </div>
                            <div class="form-group">
                                <label for="">Footer 1</label>
                                <input type="text" class="form-control" name="footer1" id="footer1"
                                    placeholder="Masukkan Footer">
                            </div>
                            <div class="form-group">
                                <label for="">Footer 3</label>
                                <input type="text" class="form-control" name="footer3" id="footer3"
                                    placeholder="Masukkan Footer">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Header 2</label>
                                <input type="text" class="form-control" name="header2" id="header2"
                                    placeholder="Masukkan Header">
                            </div>
                            <div class="form-group">
                                <label for="">Header 4</label>
                                <input type="text" class="form-control" name="header4" id="header4"
                                    placeholder="Masukkan Header">
                            </div>
                            <div class="form-group">
                                <label for="">Footer 2</label>
                                <input type="text" class="form-control" name="footer2" id="footer2"
                                    placeholder="Masukkan Footer">
                            </div>
                            <div class="form-group">
                                <label for="">Footer 4</label>
                                <input type="text" class="form-control" name="footer4" id="footer4"
                                    placeholder="Masukkan Footer">
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
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
@endpush
