@foreach ($jam as $item)
<div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialogmodal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Edit Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('super/jam-edit/' . $item->id ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Tempat Parkir</label>
                                <input type="text" class="form-control" name="tmptParkir" id="tmptParkir" placeholder="Jenis Tempat Parkir" value="{{ $item->tmptParkir }}" required>
                                <p style="font-size: 15px; color: orange">*Lapangan/Gedung/Pinggir Jalan dan Lainnya</p>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mulai">Durasi Parkir</label>
                                <div class="input-group">
                                    <input type="number" name="durasiParkir" id="durasiParkir" class="form-control" value="{{ $item->durasiParkir }}">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                            <b>Jam</b>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="mulai">Tipe Parkir</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value="">--Pilih--</option>
                                    <option value="flat" {{ $item->tipe == 'flat' ? 'selected' : '' }}>Flat</option>
                                    <option value="progresif" {{ $item->tipe == 'progresif' ? 'selected' : '' }}>Progressif</option>
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

    <script>
        document.getElementById('tmptParkir').addEventListener('change', function() {
            var tmptParkir = this.value;
        
            // Mengambil durasi parkir berdasarkan tempat parkir
            fetch(`/kolektor/jam-durasi/${tmptParkir}`)
                .then(response => response.json())
                .then(data => {
                    var durasiParkir = data.durasiParkir;
        
                    // Menampilkan durasi parkir pada input
                    document.getElementById('durasiParkir').value = durasiParkir;
        
                    // Menghitung mundur waktu berdasarkan jam operasional
                    if (durasiParkir > 0) {
                        var jamInput = document.getElementById('jam').value;
                        var jamParts = jamInput.split(":");
        
                        var operasionalTime = new Date();
                        operasionalTime.setHours(parseInt(jamParts[0]), parseInt(jamParts[1]), 0, 0);
        
                        // Menghitung waktu mundur
                        operasionalTime.setHours(operasionalTime.getHours() + durasiParkir);
        
                        // Menampilkan waktu mundur
                        var jamBaru = operasionalTime.getHours().toString().padStart(2, '0') + ":" + operasionalTime.getMinutes().toString().padStart(2, '0');
                        document.getElementById('jam').value = jamBaru;  // Set waktu baru pada input
                    }
                });
        });
    </script>
@endpush