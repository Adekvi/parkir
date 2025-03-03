@extends('admin.partisi.layout.home')
@section('judul', 'Kasir | Surat Retribusi Tagihan Parkir')
@section('konten')

<section class="content">
    <div class="container-fluid">
        
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <form action="">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="judul">
                                            <div class="header">
                                                <img src="{{ asset('user/img/logo_kotaSamarinda.png') }}" alt="Logo Kota" class="logo">
                                                <div class="text">
                                                    <h3>PEMERINTAH KOTA SAMARINDA</h3>
                                                    <h2>DINAS PERHUBUNGAN</h2>
                                                    <p>Jln. MT. Haryono, Telp. (0541) 748537 - Kode Pos 75124</p>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="divider">
                                        <hr class="divider" style="margin-top: -15px">
            
                                        <div class="yth">
                                            <p>
                                                Kepada Yth.
                                                <div class="row mb-2">
                                                    <div class="col-lg-3">
                                                        <input type="text" name="" id="" class="form-control" value="{{ $inap->namaPendaftar }}">
                                                    </div>
                                                </div>
                                                Di. <br>
                                                    <p style="margin-left: 20px">
                                                        Samarinda
                                                    </p>
                                            </p>
                                        </div>
                                        <div class="surat">
                                            <h2>SURAT TAGIHAN RETRIBUSI PARKIR</h2>
                                        </div>
                                        <div class="isi">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nomor</th>
                                                                <td><span>:</span></td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="nomor" id="nomor" placeholder="500.11.33/710/100.05">
                                                                </td>
                                                                <th>Tanggal Penerbitan</th>
                                                                <td><span>:</span></td>
                                                                <td>
                                                                    <input type="date" class="form-control" name="tanggal_penerbitan" id="tanggal_penerbitan" value="{{ $inap->jatuhTempo }}" onchange="updateFields()">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Masa/Tahun Retribusi</th>
                                                                <td><span>:</span></td>
                                                                <td>
                                                                    <input type="text" class="form-control" name="masa_retribusi" id="masa_retribusi" 
                                                                           value="{{ \Carbon\Carbon::parse($inap->jatuhTempo)->locale('id')->format('F Y') }}" readonly>
                                                                </td>
                                                                <th>Tanggal Jatuh Tempo</th>
                                                                <td><span>:</span></td>
                                                                <td>
                                                                    <input type="date" class="form-control" name="jatuh_tempo" id="jatuh_tempo" value="{{ $tanggalJatuhTempo }}" readonly>
                                                                </td>
                                                            </tr>
                                                        </table>           
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="isi2">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">I. Dasar Peraturan :</label>
                                                        <div class="input-group ml-4">
                                                            <p>1. Peraturan Menteri Perhubungan Nomor 17 Tahun 2021 tentang Penyelenggaraan Analisis Dampak Lalu Lintas</p>
                                                            <p>2. Peraturan Daerah Kota Samarinda Nomor 15 Tahun 2015 tentang Pengelolaan dan Penataan Parkir</p>
                                                            <p>3. Pertauran Daerah Kota Samarinda Nomor 1 Tahun 2024 tentang Pajak Daerah dan Retribusi Daerah</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">II. Telah dilakukan penelitian perhitungan SRP pemanfaatan atas pelaksanaan kewajiban Retribusi Parkir kepada:</label>
                                                        <table class="table">
                                                            <tr>
                                                                <th>Nama Wajib Retribusi</th>
                                                                <td><span>:</span></td>
                                                                <td>
                                                                    <input type="text" name="" id="" class="form-control" placeholder="Nama" value="{{ $inap->namaPendaftar }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Lokasi Parkir</th>
                                                                <td><span>:</span></td>
                                                                <td>
                                                                    <input type="text" name="" id="" class="form-control" placeholder="Lokasi" value="{{ $inap->namaJalan }}">
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Besaran SRP</th>
                                                                <td><span>:</span></td>
                                                                <td>
                                                                    <select name="" id="" class="form-control" disabled>
                                                                        <option value="200000 {{ $inap->id == '200000' ? 'selected' : '' }}">Rp. 200.000</option>
                                                                        <option value="600000 {{ $inap->id == '600000' ? 'selected' : '' }}">Rp. 600.000</option>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="">III. Dari penelitian tersebut diatas, jumlah yang masih harus dibayar berdasarkan okupansi SRP pemanfaatan parkir tepi jalan umum adalah sebagai berikut;</label>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <?php 
                                                                    if (!function_exists('Rupiah')) {
                                                                        function Rupiah($angka)
                                                                        {
                                                                            return "" . number_format($angka, 0, ',', '.');
                                                                        }
                                                                    }
                                                                ?>
                                                                <tr>
                                                                    <th>1. Angsuran Retribusi yang harus dibayar</th>
                                                                    <td><span>:</span></td>
                                                                    <td>
                                                                        <select name="angsuran" id="angsuran" class="form-control" disabled>
                                                                            <option value="200000" {{ $inap->id == '200000' ? 'selected' : '' }}>Rp. 200.000</option>
                                                                            <option value="600000" {{ $inap->id == '600000' ? 'selected' : '' }}>Rp. 600.000</option>
                                                                        </select>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>2. Telah dibayar</th>
                                                                    <td><span>:</span></td>
                                                                    <td>
                                                                        <input type="number" id="dibayar" class="form-control" placeholder="Isi jumlah" value="{{ $telahDibayar }}" oninput="calculate()">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>3. Kurang dibayar (1-2)</th>
                                                                    <td><span>:</span></td>
                                                                    <td>
                                                                        <input type="text" id="kurang" class="form-control" value="{{ Rupiah($kurangDibayar) }}" readonly style="border: none; border-bottom: 1px solid #000;">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>4. Jumlah Retribusi yang harus dibayar</th>
                                                                    <td><span>:</span></td>
                                                                    <td>
                                                                        <input type="text" id="total" class="form-control text-right" value="Rp. {{ Rupiah($inap->pembayaran) }}" readonly style="font-weight: bold;">
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="isi3">
                                            <p>
                                                Terbilang: <span id="terbilang">Rp. {{ Rupiah($inap->pembayaran) }}</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="info-item" style="justify-content: flex-end">
                                    <button type="button" class="btn btn-primary" id="saveButton" style="padding-left: 15px;">Cetak</button>
                                </div>    
                            </form>                       
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('css')
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff;
        box-sizing: border-box;
    }

    .container {
        width: 190mm; /* Menyisakan margin */
        margin: 0 auto;
        padding: 20mm;
        border: 1px solid #ccc;
        box-sizing: border-box;
        height: calc(297mm - 40mm); /* Sesuaikan tinggi container */
    }

    h1 {
        text-align: center;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 8px;
        border: 1px solid #ccc;
        text-align: left;
    }

    .bold {
        font-weight: bold;
    }

    .right {
        text-align: right;
    }

    /* Header judul */
    .judul {
        text-align: center;
    }

    .header {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
    }

    .logo {
        width: 100px;
        height: 100px;
        margin-right: 10px;
    }

    .text h2, .text h3, .text p {
        margin: 0;
        text-align: center;
        justify-content: center;
    }

    .text h2 {
        font-size: 30px;
    }

    .text h3 {
        font-size: 25px;
        font-weight: normal;
        font-weight: bold;
    }

    .text p {
        font-size: 16px;
    }

    .divider {
        border-top: 2px solid #000;
    }

    @media (min-width: 768px) {
        .header {
            flex-direction: row;
            align-items: center;
        }

        .text {
            margin-left: 15px;
            text-align: left;
        }
    }

    .surat {
        padding: 10px;
    }

    .surat h2 {
        margin: 0;
        font-size: 15px;
        text-align: center;
        font-weight: bold;
        justify-content: center;
    }

    .isi {
        padding: 10px;
        border: 1px solid #000;
        border-radius: 5px;
    }

    .isi2 {
        padding: 20px;
        border: 1px solid #000;
        border-radius: 5px;
    }

    .isi3 {
        padding: 5px;
        border: 1px solid #000;
        border-radius: 5px;
    }

    .isi3 p {
        font-size: 14px; /* Ukuran font lebih kecil untuk keterbacaan */
        font-weight: bold; /* Teks tebal */
        text-align: center; /* Teks di tengah */
        line-height: 1.6; /* Jarak antarbaris untuk kenyamanan membaca */
        margin: 10px 0; /* Spasi atas dan bawah */
        word-wrap: break-word; /* Membungkus teks panjang */
    }

    .isi3 span {
        font-weight: normal; /* Menghilangkan teks tebal pada tanda ":" */
        margin-right: 5px; /* Memberi jarak kanan pada ":" */
    }

    @page {
        size: A4; /* Pastikan ukuran cetak adalah A4 */
        margin: 0;
    }
</style>
@endpush

@push('js')
<script>

    // tanggal retribusi
    function updateFields() {
        var tanggalPenerbitan = document.getElementById('tanggal_penerbitan').value;

        // Pastikan tanggal penerbitan valid
        if (tanggalPenerbitan) {
            var date = new Date(tanggalPenerbitan);

            // Ambil bulan dan tahun dari tanggal penerbitan
            var bulan = date.toLocaleString('default', { month: 'long' }); // Mengambil nama bulan
            var tahun = date.getFullYear(); // Mengambil tahun

            // Mengupdate field Masa/Tahun Retribusi
            document.getElementById('masa_retribusi').value = bulan + ' ' + tahun;

            // Mengupdate Tanggal Jatuh Tempo (tanggal penerbitan + 31 hari)
            var jatuhTempoDate = new Date(date);
            jatuhTempoDate.setDate(jatuhTempoDate.getDate() + 31); // Menambahkan 31 hari
            document.getElementById('jatuh_tempo').value = jatuhTempoDate.toISOString().split('T')[0]; // Format ke YYYY-MM-DD
        }
    }

    // Panggil fungsi untuk pertama kali saat halaman dimuat
    window.onload = function() {
        updateFields();  // Menjalankan fungsi untuk mengisi masa retribusi dan jatuh tempo saat halaman pertama kali dimuat
    };

    // Panggil fungsi untuk pertama kali saat halaman dimuat
    window.onload = updateFields;

    // angsuran
    // Fungsi untuk menghitung kurang dibayar dan menampilkan total
    function calculate() {
        // Mengambil nilai angsuran dan nilai yang telah dibayar
        var angsuran = parseInt(document.getElementById('angsuran').value);
        var dibayar = parseInt(document.getElementById('dibayar').value) || 0;

        // Menghitung kurang dibayar (angsuran - telah dibayar)
        var kurangDibayar = angsuran - dibayar;

        // Menampilkan hasil kurang dibayar
        document.getElementById('kurang').value = "Rp. " + kurangDibayar.toLocaleString();

        // Menampilkan total angsuran yang harus dibayar
        document.getElementById('total').value = "Rp. " + angsuran.toLocaleString();

        // Mengonversi total menjadi terbilang dan menampilkan dalam elemen terbilang
        document.getElementById('terbilang').innerText = terbilang(angsuran);
    }

    // Fungsi untuk mengonversi angka ke terbilang
    function terbilang(number) {
        const angka = [
            '', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan', 
            'Sepuluh', 'Sebelas'
        ];
        let hasil = '';

        if (number < 12) {
            hasil = angka[number];
        } else if (number < 20) {
            hasil = terbilang(number - 10) + ' Belas';
        } else if (number < 100) {
            hasil = terbilang(Math.floor(number / 10)) + ' Puluh ' + terbilang(number % 10);
        } else if (number < 200) {
            hasil = 'Seratus ' + terbilang(number - 100);
        } else if (number < 1000) {
            hasil = terbilang(Math.floor(number / 100)) + ' Ratus ' + terbilang(number % 100);
        } else if (number < 1000000) {
            hasil = terbilang(Math.floor(number / 1000)) + ' Ribu ' + terbilang(number % 1000);
        } else if (number < 1000000000) {
            hasil = terbilang(Math.floor(number / 1000000)) + ' Juta ' + terbilang(number % 1000000);
        }
        
        return hasil;
    }
    
    // Panggil fungsi calculate saat halaman dimuat
    window.onload = calculate;

    // cetak
    document.getElementById('saveButton').addEventListener('click', function () {
        const id = this.getAttribute('data-id'); // Ambil ID dari atribut data-id
        const dibayar = document.getElementById('dibayar').value; // Ambil nilai dibayar
        const url = `/kasir/cetak-inap/${id}`; // URL untuk mencetak

        // Simpan data ke server sebelum mencetak
        fetch(`/kasir/tagih/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ dibayar }), // Kirim data dibayar ke server
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    // Buka halaman cetak jika data berhasil disimpan
                    const printWindow = window.open(url, '_blank');
                    printWindow.onload = function () {
                        printWindow.print();
                    };
                } else {
                    alert('Gagal menyimpan data!');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });

</script>
@endpush