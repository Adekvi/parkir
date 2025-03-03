<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Retribusi Tagihan Parkir</title>
</head>

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
        padding: 5mm;
        border: 1px solid #ccc;
        box-sizing: border-box;
        height: calc(297mm - 40mm); /* Sesuaikan tinggi container */
    }

    h1 {
        text-align: center;
        margin-bottom: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th, td {
        padding: 5px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 12px;
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
        flex-wrap: wrap; /* Agar tetap rapi saat layar lebih kecil */
        padding: 5px 0;
    }

    .logo {
        width: 100px;
        height: 100px;
        margin-right: 15px;
    }

    .text {
        text-align: center; /* Align text to the right */
    }

    .text h2, .text h3, .text p {
        margin: 0;
        text-align: center;
    }

    .text h2 {
        font-size: 30px;
    }

    .text h3 {
        font-size: 25px;
        font-weight: normal;
    }

    .text p {
        font-size: 14px;
    }

    .divider {
        border-top: 2px solid #000;
    }

    @media (min-width: 768px) {
        .header {
            flex-direction: row;
        }

        .text {
            text-align: left;
        }
    }

    .surat {
        padding: 5px;
        margin-top: -10px;
    }

    .surat h2 {
        margin: 0;
        font-size: 14px;
        text-align: center;
        font-weight: bold;
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
        font-size: 12px;
        font-weight: bold;
        text-align: center;
        line-height: 1.6;
        margin: 10px 0;
        word-wrap: break-word;
    }

    .isi3 span {
        font-weight: normal;
        margin-right: 5px;
    }

    label, p {
        font-size: 12px;
    }

    @page {
        size: A4;
        margin: 0;
    }

    .no-print {
        display: none;
    }
</style>

<body>
    <div class="container">
        <div class="judul">
            <div class="header">
                <div class="left">
                    <img src="{{ asset('user/img/logo_kotaSamarinda.png') }}" alt="Logo Kota" class="logo">
                </div>
                <div class="right">
                    <div class="text">
                        <h3>PEMERINTAH KOTA SAMARINDA</h3>
                        <h2>DINAS PERHUBUNGAN</h2>
                        <p>Jln. MT. Haryono, Telp. (0541) 748537 - Kode Pos 75124</p>
                    </div>
                </div>
            </div>
        </div>
        <hr class="divider">
        <hr class="divider" style="margin-top: -15px">

        <div class="yth">
            <div class="form-group">
                <p>Kepada Yth.</p>
                <input type="text" name="" id="" class="form-control">
                <p>Di. </p>
                <p style="margin-left: 20px">
                    Samarinda
                </p>
            </div>
        </div>
        <div class="surat">
            <h2>SURAT TAGIHAN RETRIBUSI PARKIR</h2>
        </div>
        <div class="isi">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table text-center" style="white-space: nowrap; width: auto">
                            <tr>
                                <th>Nomor</th>
                                <td><span>:</span></td>
                                <td><input type="text" class="form-control" name="" id="" placeholder="500.11.33/710/100.05">
                                </td>
                                <th>Tanggal Penerbitan</th>
                                <td><span>:</span></td>
                                <td><input type="date" class="form-control" name="" id="" placeholder="1 Juli 2024"></td>
                            </tr>
                            <tr>
                                <th>Masa/Tahun Retribusi</th>
                                <td><span>:</span></td>
                                <td><input type="date" class="form-control" name="" id="" placeholder="Juli 2024"></td>
                                <th>Tanggal Jatuh Tempo</th>
                                <td><span>:</span></td>
                                <td><input type="date" class="form-control" name="" id="" placeholder="30 Juli 2024"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="isi2">
            <div class="row">
                <div class="col-lg-12">
                    <label for="">I. Dasar Peraturan :</label>
                    <div class="input-group" style="margin-left: 15px;">
                        <p>1. Peraturan Menteri Perhubungan Nomor 17 Tahun 2021 tentang Penyelenggaraan Analisis Dampak Lalu Lintas</p>
                        <p>2. Peraturan Daerah Kota Samarinda Nomor 15 Tahun 2015 tentang Pengelolaan dan Penataan Parkir</p>
                        <p>3. Pertauran Daerah Kota Samarinda Nomor 1 Tahun 2024 tentang Pajak Daerah dan Retribusi Daerah</p>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label for="">II. Telah dilakukan penelitian perhitungan SRP pemanfaatan atas pelaksanaan kewajiban Retribusi Parkir kepada:</label>
                    <table class="table" style="white-space: nowrap; width: auto; display: flex; justify-content: center; align-content: center; margin-top: 10px">
                        <tr>
                            <th>Nama Wajib Retribusi</th>
                            <td><span>:</span></td>
                            <td>
                                <input type="text" name="" id="" class="form-control" placeholder="Nama">
                            </td>
                        </tr>
                        <tr>
                            <th>Lokasi Parkir</th>
                            <td><span>:</span></td>
                            <td>
                                <input type="text" name="" id="" class="form-control" placeholder="Lokasi">
                            </td>
                        </tr>
                        <tr>
                            <th>Besaran SRP</th>
                            <td><span>:</span></td>
                            <td>
                                <select name="" id="" class="form-control">
                                    <option value="">Rp. 200.000</option>
                                    <option value="">Rp. 600.000</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label for="">III. Dari penelitian tersebut diatas, jumlah yang masih harus dibayar berdasarkan okupansi SRP pemanfaatan parkir tepi jalan umum adalah sebagai berikut;</label>
                    </div>
                    <div class="table-responsive" style="margin-bottom: -15px">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>1. Angsuran Retribusi yang harus dibayar</th>
                                    <td><span>:</span></td>
                                    <td>
                                        <input type="number" id="angsuran" class="form-control" placeholder="Isi jumlah">
                                    </td>
                                </tr>
                                <tr>
                                    <th>2. Telah dibayar</th>
                                    <td><span>:</span></td>
                                    <td>
                                        <input type="number" id="dibayar" class="form-control" placeholder="Isi jumlah">
                                    </td>
                                </tr>
                                <tr>
                                    <th>3. Kurang dibayar (1-2)</th>
                                    <td><span>:</span></td>
                                    <td>
                                        <input type="text" id="kurang" name="kurang" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr>
                                    <th>4. Jumlah Retribusi yang harus dibayar</th>
                                    <td><span>:</span></td>
                                    <td>
                                        <input type="text" id="total" name="" class="form-control" readonly>
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
                Terbilang 
                <span>:</span>
            </p>
        </div> 
        <div class="footer">
            <div class="row">
                <div class="col-lg-12" style="margin-left: 50px; margin-top: 15px">
                    <label for="">*Catatan:</label>
                </div>
                <div class="form-group">
                    <div class="left">
                        <p>1. Untuk pembayaran Retribusi Parkir Menggunakan Non Tunai (QRIS)</p>
                        <p>2. Bukti Pembayaran Qris dikirim melalui WA Admin Parkir (WA 0812-5564-7588)</p>
                    </div>
                    <div class="right">
                        <p style="margin-right: 7%">Kepala Dinas</p>
                        <br>
                        <br>
                        <br>
                        <p>
                            <strong style="text-decoration: underline;">HMT MANALU, S.Si.T., M.Sc</strong>
                            <br>
                            NIP. 19770328 2000112 1 001
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>