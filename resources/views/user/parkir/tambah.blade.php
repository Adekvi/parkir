<div class="modal fade text-left" id="kendaraan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel160" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title white" id="myModalLabel160">Transaksi</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('user/parkir/tambah') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        @if ($user)
                            <input type="hidden" name="id_shift" value="{{ $user->id_shift }}">
                        @endif
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="tglParkir">Tanggal Parkir</label>
                                <input type="date" name="tglParkir" id="tglParkir" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="nopol">Plat Nomor Kendaraan</label>
                                <input type="text" class="form-control" name="nopol" id="nopol" placeholder="Nomor Polisi" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Jenis Kendaraan</label>
                                <select name="jenisKendaraan" id="jenis_Kendaraan" class="form-control">
                                    <option value="#" disabled selected>--Pilih Kendaraan--</option>
                                    @foreach ($kendaraan as $item)
                                        <option value="{{ $item->id }}">{{ $item->jenisKendaraan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="penerimaan">Penerimaan</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" style="background: rgb(228, 228, 228); font-size: 15px">
                                            <b>Rp</b>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="penerimaan" id="penerimaan" placeholder="Besaran Uang" readonly required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="">Keterangan</label>
                            <select name="keterangan" id="keterangan" class="form-control">
                                <option value="">--Pilih--</option>
                                @foreach ($ket as $item)
                                    <option value="{{ $item->id }}">{{ $item->keterangan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden" name="id_lokasiParkir" id="id_lokasiParkir" value="{{ $user->id_lokasiParkir }}">                   
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
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

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
<!-- Theme style -->
<link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('admin/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('admin/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    // lokasi user
    document.addEventListener("DOMContentLoaded", function () {
        // Cek apakah browser mendukung Geolocation
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                // Simpan latitude dan longitude ke input tersembunyi
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function (error) {
                console.error("Error mendapatkan lokasi: ", error.message);
            });
        } else {
            console.error("Geolocation tidak didukung oleh browser ini.");
        }
    });

    // Tanggal
    window.onload = function() {
        // Mendapatkan tanggal hari ini
        let today = new Date();
        
        // Format tanggal dalam format YYYY-MM-DD
        let dd = String(today.getDate()).padStart(2, '0'); // Menambahkan 0 jika tanggal kurang dari 10
        let mm = String(today.getMonth() + 1).padStart(2, '0'); // Menambahkan 0 jika bulan kurang dari 10
        let yyyy = today.getFullYear();
        
        // Menyusun tanggal dalam format YYYY-MM-DD
        let date = yyyy + '-' + mm + '-' + dd;
        
        // Mengatur nilai default input date dengan tanggal hari ini
        document.getElementById("tglParkir").value = date;
    }

    // jenis Kendaraan
    $(document).ready(function () {
        $('#jenis_Kendaraan').change(function () {
            const id = $(this).val(); // Ambil ID jenis kendaraan yang dipilih
            if (id) {
                $.ajax({
                    url: `/get-harga/${id}`, // Endpoint yang dituju
                    type: 'GET',
                    success: function (response) {
                        if (response.harga) {
                            $('#penerimaan').val(response.harga); // Set harga ke input 'penerimaan'
                        } else {
                            $('#penerimaan').val(''); // Kosongkan jika tidak ada harga
                        }
                    },
                    error: function () {
                        alert('Gagal mengambil data harga');
                    }
                });
            } else {
                $('#penerimaan').val(''); // Kosongkan jika tidak ada pilihan
            }
        });
    });

</script>
@endpush
