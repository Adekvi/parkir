@foreach ($jam as $item)
    <div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="myModalLabel160">Edit Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <form action="{{ url('admin/lokasi-edit/' . $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Nama Jalan</label>
                                    <select name="kodeJln" id="kodeJln" class="form-control">
                                        <option value="">-- Pilih Nama Jalan --</option>
                                        @foreach ($jalan as $jal)
                                            <option value="{{ $jal->id }}"
                                                {{ $pilihJalan == $jal->id ? 'selected' : '' }}>{{ $jal->namaJalan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="">Tempat Parkir</label>
                                    <input type="text" class="form-control" name="tmptParkir" id="tmptParkir"
                                        placeholder="Jenis Tempat Parkir" value="{{ $item->tmptParkir }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mulai">Durasi Parkir</label>
                                    <div class="input-group">
                                        <!-- Input Field dengan flex-grow-1 agar sama besar -->
                                        <input type="number" name="durasiParkir" id="durasiParkir"
                                            class="form-control flex-grow-1" value="{{ $item->durasiParkir ?? '-' }}">

                                        <!-- Label "Jam" tetap sejajar dan sama besar -->
                                        <span class="input-group-text w-25 text-center"
                                            style="background: rgb(228, 228, 228); font-size: 15px">
                                            <b>Jam</b>
                                        </span>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="mulai">Tipe Parkir</label>
                                    <select name="tipe" id="tipe" class="form-control">
                                        <option value="">--Pilih--</option>
                                        <option value="flat" {{ $item->tipe == 'Flat' ? 'selected' : '' }}>Flat
                                        </option>
                                        <option value="progresif" {{ $item->tipe == 'Progresif' ? 'selected' : '' }}>
                                            Progressif</option>
                                    </select>
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
@endforeach

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

@push('js')
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
                        var jamBaru = operasionalTime.getHours().toString().padStart(2, '0') + ":" +
                            operasionalTime.getMinutes().toString().padStart(2, '0');
                        document.getElementById('jam').value = jamBaru; // Set waktu baru pada input
                    }
                });
        });
    </script>
@endpush
