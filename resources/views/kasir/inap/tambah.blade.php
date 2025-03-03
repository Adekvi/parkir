<div class="modal fade text-left" id="kendaraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Tambah Data Pelanggan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('kasir/inap/tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Pelanggan</label>
                                <input type="text" class="form-control" name="namaPendaftar" id="namaPendaftar" placeholder="Masukkan Nama Pelanggan">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Tanggal Jatuh Tempo</label>
                                <input type="date" class="form-control" name="jatuhTempo" id="jatuhTempo">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama Jalan</label>
                                <select name="namaJalan" id="namaJalan" class="form-control">
                                    <option value="">-- Pilih Jalan --</option>
                                    @foreach ($jalan as $item)
                                        <option value="{{ $item->kodeJln }}">{{ $item->namaJalan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Nama STNK</label>
                                <input type="text" class="form-control" name="namaSTNK" id="namaSTNK" placeholder="Masukkan Nama STNK">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Plat Kendaraan</label>
                                <input type="text" class="form-control" name="platKendaraan" id="platKendaraan" placeholder="Masukkan Plat Kendaraan">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Pembayaran</label>
                                <select class="form-control" name="pembayaran" id="pembayaran">
                                    <option value="">-- Pilih --</option>
                                    <option value="200000">Rp. 200.000</option>
                                    <option value="600000">Rp. 600.000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Handphone</label>
                                <input type="text" class="form-control" name="handphone" id="handphone" placeholder="Masukkan No. Handhphone">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>    
@endpush