<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Karcis Parkir</title>
  <link rel="stylesheet" href="styles.css">
</head>

<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .karcis {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1, header h2, header h3 {
            margin: 0;
        }

        .tanggal-jam {
            font-size: 0.9rem;
            color: #555;
        }

        .area-info {
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .tabel-kendaraan {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .tabel-kendaraan th, .tabel-kendaraan td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 5px;
        }

        .tabel-kendaraan th {
            background-color: #f2f2f2;
        }

        .total-uang {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: right;
        }

        footer {
            font-size: 0.9rem;
        }

        .petugas {
            display: flex;
            justify-content: space-between;
        }

        .petugas div {
            text-align: center;
        }

</style>

<body>
  <div class="karcis">
    <header>
      <h1>Setoran Parkir Harian</h1>
      <h2>Retribusi Parkir Kendaraan</h2>
      <h3>Kemitraan Dinas Perhubungan</h3>
      <h3>Kota Samarinda</h3>
      <p class="tanggal-jam">Tanggal dan Jam: <span id="tanggal-jam"></span></p>
    </header>

    <section class="area-info">
      <p><strong>Area:</strong> Jalan</p>
      <p><strong>Lokasi:</strong> Tempat</p>
      <p><strong>Shift:</strong> </p>
    </section>

    <table class="tabel-kendaraan">
      <thead>
        <tr>
          <th>Kendaraan</th>
          <th>Unit</th>
          <th>Rp.</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Sepeda Motor (R2)</td>
          <td>Jumlah Motor</td>
          <td>Total Harga Motor</td>
        </tr>
        <tr>
          <td>Mobil (R1)</td>
          <td>Jumlah Mobil</td>
          <td>Total Harga Mobil</td>
        </tr>
      </tbody>
    </table>

    <div class="total-uang">
      <strong>Total Uang:</strong> 
    </div>

    <footer>
      <p><strong>Ket:</strong></p>
      <div class="petugas">
        <div>
          <p>Petugas</p>
          <p>Nama</p>
        </div>
        <div>
          <p>Kolektor</p>
          <p>Nama</p>
        </div>
      </div>
    </footer>
  </div>

  <script>
    // Script to dynamically update the date and time
    const now = new Date();
    document.getElementById('tanggal-jam').textContent = now.toLocaleString();
  </script>
</body>
</html>
