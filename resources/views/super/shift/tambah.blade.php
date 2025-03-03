<div class="modal fade text-left" id="kendaraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialogmodal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Tambah Shift</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('super/shift-tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="">Nama Shift</label>
                                <input type="text" class="form-control" name="namaShift" id="namaShift" placeholder="Masukkan Nama Shift" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <label for="mulai">Jam Mulai</label>
                            <div class="form-group">
                                <input type="text" name="mulai" id="mulai" class="form-control" placeholder="Jam Mulai" required>
                            </div>
                        </div>
                    
                        <div class="col-lg-2 text-center">
                            <span class="fw-bold">Sampai</span>
                        </div>
                    
                        <div class="col-lg-5">
                            <label for="akhir">Jam Akhir</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="akhir" id="akhir" placeholder="Jam akhir" required>
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', () => {
        flatpickr("#mulai", {
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            defaultHour: 0,
            defaultMinute: 0,
        });
        flatpickr("#akhir", {
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            defaultHour: 0,
            defaultMinute: 0,
        });
    });
</script> --}}
    
@endpush