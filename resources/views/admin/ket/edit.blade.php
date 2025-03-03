@foreach ($ket as $item)
    <div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-dialogmodal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header" style="background: #0ddbb9">
                    <h5 class="modal-title text-white" id="myModalLabel160">Update Keterangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ url('admin/ket-edit/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan"
                                placeholder="Masukkan Keterangan"required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn" style="background: #0ddbb9">Save changes</button>
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
