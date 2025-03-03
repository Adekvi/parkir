@foreach ($kendaraan as $item)
<div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialogmodal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Edit Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('super/data-kendaraan-edit/'. $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Jenis Kendaraan</label>
                                <input type="text" class="form-control" name="jenisKendaraan" value="{{ $item->jenisKendaraan }}" id="jenisKendaraan" placeholder="Jenis Kendaraan" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="mulai">Tarif Kendaraan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                            <b>Rp.</b>
                                        </span>
                                    </div>
                                    <input type="number" name="tarif" id="tarif" class="form-control" value="{{ $item->tarif }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                            <b>/jam</b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="mulai">Lokasi Parkir</label>
                                <select name="id_jamLokasi" id="id_jamLokasi" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($lokasi as $item)
                                        <option value="{{ $item->id }}">{{ $item->tmptParkir }}</option>
                                    @endforeach
                                </select>
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
@endforeach

@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">    
@endpush

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
@endpush