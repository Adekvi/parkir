@foreach ($parker as $item)
<div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialogmodal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Setor Pembayaran</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('user/parkir-setor/'. $item->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Nama Shift</label>
                                <input type="text" class="form-control" name="namaShift" id="namaShift" placeholder="Masukkan Nama Shift" value="{{ $item->namaShift }}" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label for="mulai">Jam Mulai</label>
                            <div class="form-group">
                                <input type="text" name="mulai" id="mulai" class="form-control" placeholder="Jam Mulai" required value="{{ $item->mulai }}">
                            </div>
                        </div>
                    
                        <div class="col-lg-2 text-center">
                            <span class="fw-bold">Sampai</span>
                        </div>
                    
                        <div class="col-lg-5">
                            <label for="akhir">Jam Akhir</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="akhir" id="akhir" placeholder="Jam akhir" required value="{{ $item->akhir }}">
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
    </div>
</div>
@endforeach