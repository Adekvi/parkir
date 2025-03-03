<div class="modal fade text-left" id="bayar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Setor Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('kolektor/setor-tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" class="form-control" name="id_shift" id="id_shift" value="{{ $idShift }}" readonly>
                    <input type="hidden" name="id_lokasiParkir" id="id_lokasiParkir" class="form-control" value="{{ $user->id_lokasiParkir }}">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Tanggal</label>
                                <input type="text" name="tglSetor" id="tglSetor" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Jam</label>
                                <input type="text" name="jamSetor" id="jamSetor" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="">Keterangan</label>
                                <select name="keterangan" id="keterangan" class="form-control">
                                    <option value="">--Pilih--</option>
                                    @foreach ($ket as $item)
                                        <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div id="data-container">
                        @foreach ($setor as $item)
                        <div class="data-row">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">No. Polisi</label>
                                        <input type="text" name="data[{{ $loop->index }}][nopol]" value="{{ $item->nopol_list }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="">Total Kendaraan</label>
                                        <div class="input-group">
                                            <input type="text" name="data[{{ $loop->index }}][totalKendaraan]" class="form-control" value="{{ $item->totalKendaraan }}" readonly>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Unit</b>
                                                </span>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                    
                                {{-- Total Motor --}}
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Jumlah Motor</label>
                                        <div class="input-group">
                                            <input type="text" name="data[{{ $loop->index }}][totalMotor]" class="form-control" value="{{ $item->jumlahMotor }}" readonly>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Unit</b>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                {{-- Nilai Motor --}}
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Nominal Motor</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Rp.</b>
                                                </span>
                                            </div>
                                            <input type="text" name="data[{{ $loop->index }}][nilaiMotor]" class="form-control" value="{{ $item->nilaiMotor }}" readonly>
                                        </div>
                                    </div>
                                </div>
                    
                                {{-- Total Mobil --}}
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Jumlah Mobil</label>
                                        <div class="input-group">
                                            <input type="text" name="data[{{ $loop->index }}][totalMobil]" class="form-control" value="{{ $item->jumlahMobil }}" readonly>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Unit</b>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    
                                {{-- Nilai Mobil --}}
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="">Nominal Mobil</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Rp.</b>
                                                </span>
                                            </div>
                                            <input type="text" name="data[{{ $loop->index }}][nilaiMobil]" class="form-control" value="{{ $item->nilaiMobil }}" readonly>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Total</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Rp</b>
                                                </span>
                                            </div>
                                            <input type="number" name="data[{{ $loop->index }}][total]" id="total-{{ $loop->index }}" class="form-control" value="{{ $item->total_nominal }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Disetor</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Rp</b>
                                                </span>
                                            </div> 
                                            <input type="number" name="data[{{ $loop->index }}][disetor]" id="disetor-{{ $loop->index }}" class="form-control" value="{{ $item->disetor }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="">Hasil</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                                    <b>Rp</b>
                                                </span>
                                            </div> 
                                            <input type="number" name="data[{{ $loop->index }}][hasil]" id="hasil-{{ $loop->index }}" class="form-control" value="{{ $item->hasil }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Semua</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
    // Setor
    document.addEventListener("DOMContentLoaded", function () {
        // Format tanggal dan waktu secara otomatis
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, "0");
        const dd = String(today.getDate()).padStart(2, "0");
        const hours = String(today.getHours()).padStart(2, "0");
        const minutes = String(today.getMinutes()).padStart(2, "0");

        document.getElementById("tglSetor").value = `${yyyy}-${mm}-${dd}`;
        document.getElementById("jamSetor").value = `${hours}:${minutes}`;

        // Hitung otomatis untuk setiap data row
        document.querySelectorAll(".data-row").forEach((row, index) => {
            const totalInput = row.querySelector(`#total-${index}`);
            const disetorInput = row.querySelector(`#disetor-${index}`);
            const hasilInput = row.querySelector(`#hasil-${index}`);

            if (totalInput && disetorInput && hasilInput) {
                const total = parseFloat(totalInput.value) || 0;
                disetorInput.value = (total * 0.3).toFixed(0);  // 30% untuk disetor
                hasilInput.value = (total * 0.7).toFixed(0);  // 70% untuk hasil
            }
        });
    });

    
    // document.addEventListener("DOMContentLoaded", function () {
    //     // Fungsi untuk menghitung disetor dan hasil secara otomatis
    //     function calculate(id) {
    //         // Mendapatkan elemen input berdasarkan ID
    //         const nominalInput = document.getElementById(`nominal-${id}`);
    //         const disetorInput = document.getElementById(`disetor-${id}`);
    //         const hasilInput = document.getElementById(`hasil-${id}`);

    //         // Pastikan elemen ditemukan
    //         if (!nominalInput || !disetorInput || !hasilInput) return;

    //         // Mengambil nilai nominal, pastikan nilai numerik
    //         const nominal = parseFloat(nominalInput.value.replace(/[^0-9.-]+/g, '')) || 0; // Hapus format non-numerik

    //         // Menghitung disetor (30%) dan hasil (70%)
    //         const disetor = (nominal * 0.3).toFixed(0);
    //         const hasil = (nominal * 0.7).toFixed(0);

    //         // Mengatur nilai input secara otomatis tanpa format rupiah
    //         disetorInput.value = disetor;
    //         hasilInput.value = hasil;
    //     }

    //     // Menambahkan perhitungan otomatis untuk setiap nominal
    //     document.querySelectorAll("[id^='nominal-']").forEach((nominalInput) => {
    //         const id = nominalInput.id.split("-")[1]; // Mendapatkan ID unik
    //         calculate(id); // Hitung otomatis saat halaman dimuat
    //     });

    //     // Menambahkan event listener untuk memastikan hanya nilai numerik yang disimpan
    //     document.querySelectorAll("[id^='disetor-']").forEach((disetorInput) => {
    //         disetorInput.addEventListener('input', function () {
    //             this.value = this.value.replace(/[^0-9.-]+/g, ''); // Hapus format non-numerik setiap kali ada perubahan
    //         });
    //     });

    //     document.querySelectorAll("[id^='hasil-']").forEach((hasilInput) => {
    //         hasilInput.addEventListener('input', function () {
    //             this.value = this.value.replace(/[^0-9.-]+/g, ''); // Hapus format non-numerik setiap kali ada perubahan
    //         });
    //     });
    // });

    // tanggal dan jam
    window.onload = function() {
        // Mendapatkan tanggal dan waktu hari ini
        let today = new Date();

        // Format tanggal dalam format YYYY-MM-DD
        let dd = String(today.getDate()).padStart(2, '0'); // Menambahkan 0 jika tanggal kurang dari 10
        let mm = String(today.getMonth() + 1).padStart(2, '0'); // Menambahkan 0 jika bulan kurang dari 10
        let yyyy = today.getFullYear();
        
        // Menyusun tanggal dalam format YYYY-MM-DD
        let date = yyyy + '-' + mm + '-' + dd;

        // Menyusun waktu dalam format HH:MM
        let hours = String(today.getHours()).padStart(2, '0'); // Menambahkan 0 jika jam kurang dari 10
        let minutes = String(today.getMinutes()).padStart(2, '0'); // Menambahkan 0 jika menit kurang dari 10
        let time = hours + ':' + minutes;

        // Mengatur nilai default input tanggal dengan tanggal hari ini
        document.getElementById("tglSetor").value = date;

        // Mengatur nilai default input jam dengan waktu saat ini
        document.getElementById("jamSetor").value = time;
    }

</script>
@endpush

{{-- @foreach ($setor as $item)
<div class="modal fade text-left" id="bayar{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Setor Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('kolektor/pembayaran-tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row align-items-center">
                        
                        <input type="hidden" class="form-control" name="id_shift" id="id_shift" value="{{ $item->shift->id }}" readonly>

                        <input type="hidden" name="nopol_list" id="nopol_list" value="{{ $item->nopol_list }}">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="tglSetor">Tanggal Setor</label>
                                <input type="text" class="form-control" name="tglSetor" id="tglSetor" placeholder="Tanggal Setor">
                            </div>                            
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="jamSetor">Jam Setor</label>
                                <input type="text" class="form-control" name="jamSetor" id="jamSetor" placeholder="Jam Setor"> 
                            </div>                           
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nominal">Total Nominal</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: rgb(228, 228, 228)">
                                            <b>Rp.</b>
                                        </span>
                                    </div>
                                    <input type="number" name="nominal" id="nominal-{{ $item->id }}" class="form-control" readonly value="{{ $item->total_nominal }}" required>
                                </div>
                                <p style="font-size: 14px; font-style: italic; color: orange">*Total Nominal dipotong 30% untuk disetor</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="disetor">Total Disetor</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                            <b>Rp.</b>
                                        </span>
                                    </div>
                                    <input type="number" name="disetor" id="disetor-{{ $item->id }}" class="form-control" readonly required value="{{ old('disetor', $item->disetor) }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="hasil">Hasil</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: rgb(228, 228, 228)">
                                            <b>Rp.</b>
                                        </span>
                                    </div>
                                    <input type="number" name="hasil" id="hasil-{{ $item->id }}" class="form-control" readonly required value="{{ old('hasil', $item->hasil) }}">
                                </div>
                            </div>
                        </div>                                                 
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}