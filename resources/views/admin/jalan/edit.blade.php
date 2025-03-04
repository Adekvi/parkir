@foreach ($jalan as $item)
    <div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myModalLabel160">Update Nama Jalan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ url('admin/jalan-edit/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Kode Jalan</label>
                                    <input type="text" class="form-control" name="kodeJln" id="kodeJln"
                                        value="{{ $item->kodeJln }}" readonly required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama Jalan</label>
                                    <input type="text" class="form-control" name="namaJalan" id="namaJalan"
                                        value="{{ $item->namaJalan }}" required>
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

{{-- @push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css"> 
<style>
    .flatpickr-time-input {
        width: 80px; /* Sesuaikan ukuran */
        padding: 5px; /* Tambahkan padding jika diperlukan */
        text-align: center; /* Agar teks waktu lebih rapi */
    }
</style>   
@endpush --}}

{{-- @push('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        flatpickr("#mulai", {
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            defaultHour: 0,
            defaultMinute: 0,
            animate: true,
            allowInput: true,
            className: "flatpickr-time-input", // Tambahkan kelas khusus
        });
        flatpickr("#akhir", {
            enableTime: true,
            noCalendar: true,
            time_24hr: true,
            dateFormat: "H:i",
            defaultHour: 0,
            defaultMinute: 0,
            animate: true,
            allowInput: true,
            className: "flatpickr-time-input", // Tambahkan kelas khusus
        });
    });

</script>
@endpush --}}
