<?php

namespace App\Http\Controllers\Kolektor;

use App\Http\Controllers\Controller;
use App\Models\Jalan;
use App\Models\JamLokasi;
use App\Models\Parker;
use Illuminate\Http\Request;

class KolektorController extends Controller
{
    public function index()
    {
        return view('kolektor.index');
    }

    // hosting
    public function index_for_android($kodeJln, $idWilayah)
    {
        $data = Parker::where('id_lokasiParkir', $idWilayah)
            ->where('kodeJln', $kodeJln)
            ->where('status', 'Sudah disetor')
            ->with(['lokasi_parkir', 'user', 'shift'])
            ->get();

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function setoran_group_by_wilayah()
    {
        // $data = Parker::where('id_lokasiParkir', $idWilayah)->where('status', 'Belum disetor')->with(['user', 'lokasiParkir'])->get();

        $jalanData = Jalan::with(['lokasi_parkir'])->get();


        // Menghitung total lokasi tiap jalan
        $jalanData->each(function ($jalan) {
            $jalan->totalLokasi = JamLokasi::where('kodeJln', $jalan->kodeJln)->count();
        });

        $jalanData->each(function ($jalan) {
            $jalan->totalPenerimaan = Parker::where('kodeJln', $jalan->kodeJln)->where('status', 'Belum disetor')->sum('penerimaan');
        });

        $jalanData->each(function ($jalan) {
            $jalan->lokasi_parkir->map(function ($lokasi) use ($jalan) {
                // Menghitung total penerimaan berdasarkan kodeJln dan id_lokasiParkir
                $lokasi->totalPenerimaan = Parker::where('kodeJln', $jalan->kodeJln)
                    ->where('status', 'Belum disetor')
                    ->where('id_lokasiParkir', $lokasi->id)
                    ->sum('penerimaan');
                return $lokasi; // Mengembalikan objek lokasi setelah ditambah properti totalPenerimaan
            });
        });


        // Ambil data jalan
        // $jalanData = Jalan::with(['parkir.lokasi_parkir' => function ($query) {
        //     $query->select('id', 'tmptParkir'); // Ambil data yang diperlukan dari LokasiParkir
        // }])->with(['parkir' => function ($query) {
        //     $query->select('kodeJln', 'id_lokasiParkir', DB::raw('SUM(penerimaan) as total'))
        //         ->where('status', 'Belum disetor')
        //         ->groupBy('kodeJln', 'id_lokasiParkir');
        // }])->get();

        return $jalanData;
        // // Format hasil
        // $hasil = $jalanData->map(function ($jalan) {
        //     return [
        //         'kodeJln' => $jalan->kodeJln,
        //         'namaJalan' => $jalan->namaJalan,
        //         'lokasi_parkir' => $jalan->parkir->map(function ($parkir) {
        //             return [
        //                 'id_lokasiParkir' => $parkir->id_lokasiParkir,
        //                 'tmptParkir' => $parkir->lokasiParkir->tmptParkir ?? null, // Ambil tmptParkir dari relasi
        //                 'total' => $parkir->total,
        //             ];
        //         }),
        //     ];
        // });


        // $groupedData = Parker::select('id_lokasiParkir', DB::raw('SUM(penerimaan) as total'))
        //     ->groupBy('id_lokasiParkir')
        //     ->where('status', 'Belum disetor')
        //     ->with('lokasi_parkir', 'user', 'shift', )
        //     ->get();

        //     // Ambil semua kodeJln dari tabel 'jalans'
        // $kodeJlnList = DB::table('jalans')->pluck('kodeJln');

        // // Query utama dengan whereIn
        // $groupedData = Parker::select('id_lokasiParkir', DB::raw('SUM(penerimaan) as total'))
        //     ->whereHas('lokasi_parkir', function ($query) use ($kodeJlnList) {
        //         $query->whereIn('kodeJln', $kodeJlnList);
        //     })
        //     ->where('status', 'Belum disetor')
        //     ->with(['lokasi_parkir' => function ($query) use ($kodeJlnList) {
        //         $query->whereIn('kodeJln', $kodeJlnList);
        //     }])
        //     ->groupBy('id_lokasiParkir')
        //     ->get();

        return response()->json(['status' => 'success', 'data' => $hasil], 200);
    }

    public function detail_setoran_parkir($kodeJln, $idWilayah)
    {
        // $groupedData = Parker::select('id_lokasiParkir', DB::raw('COUNT(*) as total_count'), DB::raw('SUM(penerimaan) as total'))
        //     ->where('id_lokasiParkir', $idWilayah)
        //     ->where('status', 'Telah disetor')
        //     ->groupBy('id_lokasiParkir') // Add GROUP BY clause
        //     ->with(['lokasi_parkir', 'user', 'shift']) // Ensure proper relationships
        //     ->get();

        $groupedData = RekapParkir::where('id_lokasiParkir', $idWilayah)
            ->where('kodeJln', $kodeJln)
            ->where('status', 'kolektor')
            ->with(['lokasi_parkir', 'user', 'shift'])
            ->get();

        return response()->json(['status', 'data' => $groupedData], 200);
    }

    public function setoran_group_by_wilayah_done()
    {
        // $data = Parker::where('id_lokasiParkir', $idWilayah)->where('status', 'Belum disetor')->with(['user', 'lokasiParkir'])->get();

        // $groupedData = Parker::select('id_lokasiParkir', DB::raw('SUM(penerimaan) as total_jumlah'))
        //     ->groupBy('id_lokasiParkir')
        //     ->where('status', 'Telah disetor')
        //     ->with('lokasi_parkir', 'user', 'shift', )
        //     ->get();

        $groupedData = RekapParkir::where('status', 'kolektor')
            ->with('lokasi_parkir', 'user', 'shift')
            ->get();

        return response()->json(['status' => 'success', 'data' => $groupedData], 200);
    }

    public function detail_all_location($kodeJln, $idWilayah)
    {
        $dataParkir = Parker::where('id_lokasiParkir', $idWilayah)
            ->where('kodeJln', $kodeJln)
            ->with('user', 'lokasi_parkir', 'shift', 'jalan')
            ->where('status', 'Belum disetor')
            ->get();

        $dataUser = User::where('id_lokasiParkir', $idWilayah)
            ->where('namaLokasi', $kodeJln)
            ->where('role', 'user')
            ->with(['shift', 'userLokasi'])
            ->get();

        return response()->json(['status' => 'success', 'dataUser' => $dataUser, 'dataParkir' => $dataParkir], 200);
    }

    public function persetujuan($idWilayah)
    {
        $data = Parker::where('id_lokasiParkir', $idWilayah)
            ->where('status', 'Belum disetor')
            ->with(['lokasi_parkir', 'user', 'shift', 'jalan'])
            ->get();

        // $data = RekapParkir::where('id_lokasiParkir', $idWilayah)
        //     ->where('status', 'petugas')

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function setoran_by_id_wilayah_persetujuan($idWilayah)
    {
        $groupedData = Parker::select(
            'id_lokasiParkir',
            DB::raw('SUM(penerimaan) as total'), // Total penerimaan
            DB::raw('SUM(CASE WHEN jenisKendaraan = "Motor" THEN 1 ELSE 0 END) as total_motor'), // Total kendaraan motor
            DB::raw('SUM(CASE WHEN jenisKendaraan = "Mobil" THEN 1 ELSE 0 END) as total_mobil'), // Total kendaraan mobil
            DB::raw('SUM(CASE WHEN jenisKendaraan = "Motor" THEN penerimaan ELSE 0 END) as nilai_motor'), // Total penerimaan motor
            DB::raw('SUM(CASE WHEN jenisKendaraan = "Mobil" THEN penerimaan ELSE 0 END) as nilai_mobil')  // Total penerimaan mobil
        )
            ->where('id_lokasiParkir', $idWilayah)
            ->where('status', 'Belum disetor')
            ->groupBy('id_lokasiParkir') // Group by lokasi parkir
            ->with(['lokasi_parkir', 'user', 'shift']) // Pastikan relasi yang sesuai
            ->get();

        return response()->json(['status' => 'success', 'data' => $groupedData], 200);
    }

    public function search_lokasi_toolless(Request $request)
    {
        // Ambil query dari parameter pencarian
        $query = $request->query('query', '');

        // Jika query kosong, jangan lanjutkan pencarian dan kembalikan hasil default
        if (empty($query)) {
            return response()->json(['message' => 'Query tidak boleh kosong'], 400);
        }

        // Panggil stored procedure menggunakan raw query
        $lokasi = DB::select('CALL SearchLokasiByQuery(?)', [$query]);

        // Ekstrak hanya kolom 'tmptParkir' dari hasil query
        $lokasiList = array_column(json_decode(json_encode($lokasi), true), 'tmptParkir');

        // Return hasil dalam format JSON
        return response()->json($lokasiList);
    }

    public function search_lokasi_setoran(Request $request)
    {
        // Ambil query dari parameter pencarian
        $query = $request->query('query', '');

        // Jika query kosong, jangan lanjutkan pencarian dan kembalikan hasil default
        if (empty($query)) {
            return response()->json(['message' => 'Query tidak boleh kosong'], 400);
        }

        // Lakukan pencarian dengan query LIKE
        $lokasi = JamLokasi::where('tmptParkir', 'LIKE', '%' . $query . '%')->get();

        // Ekstrak id dan tmptParkir dari hasil query
        $lokasiList = $lokasi->map(function ($lokasi) {
            return [
                'id' => $lokasi->id,
                'tmptParkir' => $lokasi->tmptParkir
            ];
        });

        // Return hasil dalam format JSON
        return response()->json($lokasiList);
    }

    public function search_petugas_toolless(Request $request)
    {
        // Ambil query dari parameter pencarian
        $query = $request->query('query', '');

        // Panggil stored procedure menggunakan raw query
        $petugas = DB::select('CALL SearchPetugasByQuery(?)', [$query]);

        // Debug untuk memastikan hasil query
        // \Log::info('Stored Procedure Result:', (array) $petugas);

        // Ekstrak hanya kolom 'username' dari hasil query
        $usernames = array_column(json_decode(json_encode($petugas), true), 'username');

        // Konversi hasil ke dalam format JSON
        return response()->json($usernames);
    }

    public function search_petugas_setoran(Request $request)
    {
        // Ambil query dari parameter pencarian
        $query = $request->query('query', '');

        // Jika query kosong, jangan lanjutkan pencarian dan kembalikan hasil default
        if (empty($query)) {
            return response()->json(['message' => 'Query tidak boleh kosong'], 400);
        }

        // Lakukan pencarian dengan query LIKE
        $petugas = User::where('username', 'LIKE', '%' . $query . '%')->get();

        // Ekstrak id dan tmptParkir dari hasil query
        $petugasList = $petugas->map(function ($petugas) {
            $lokasi = JamLokasi::where('id', $petugas->id_lokasiParkir)->first();
            $shift = Shift::where('id', $petugas->id_shift)->first();
            $jalan = Jalan::where('kodeJln', $petugas->namaLokasi)->first();
            return [
                'id' => $petugas->id,
                'username' => $petugas->username,
                'id_lokasiParkir' => $lokasi ? $lokasi->id : null,
                'nama_lokasiParkir' => $lokasi ? $lokasi->tmptParkir : null,
                'id_jalan' => $jalan->kodeJln,
                'nama_jalan' => $jalan->namaJalan,
                'id_shift' => $shift ? $shift->id : null,
                'nama_shift' => $shift ? $shift->namaShift : null,
            ];
        });

        // Return hasil dalam format JSON
        return response()->json($petugasList);
    }

    public function search_petugas_setoran_toolless(Request $request)
    {
        // Ambil query dari parameter pencarian
        $query = $request->query('query', '');

        // Jika query kosong, jangan lanjutkan pencarian dan kembalikan hasil default
        if (empty($query)) {
            return response()->json(['message' => 'Query tidak boleh kosong'], 400);
        }

        // Lakukan pencarian dengan query LIKE
        $petugas = User::where('username', 'LIKE', '%' . $query . '%')->get();

        // Ekstrak id dan tmptParkir dari hasil query
        $petugasList = $petugas->map(function ($petugas) {
            $lokasi = JamLokasi::where('id', $petugas->id_lokasiParkir)->first();
            $shift = Shift::where('id', $petugas->id_shift)->first();
            $area = Jalan::where('kodeJln', $petugas->namaLokasi)->first();
            return [
                'id' => $petugas->id,
                'username' => $petugas->username,
                'id_area' => $area->kodeJln,
                'area' => $area->namaJalan,
                'id_lokasiParkir' => $lokasi ? $lokasi->id : null,
                'nama_lokasiParkir' => $lokasi ? $lokasi->tmptParkir : null,
                'id_shift' => $shift ? $shift->id : null,
                'nama_shift' => $shift ? $shift->namaShift : null,
            ];
        });

        // Return hasil dalam format JSON
        return response()->json($petugasList);
    }

    public function save_data_toolless(Request $request)
    {
        $request->validate([
            'area' => 'required|string',
            'lokasi' => 'required|string',
            'jumlah_motor' => 'required|integer',
            'jumlah_mobil' => 'required|integer',
            'nilai_motor' => 'required|integer',
            'nilai_mobil' => 'required|integer',
            'total' => 'required|integer',
            'keterangan' => 'nullable|string',
        ]);

        $get_shift = Shift::count();

        if ($request->shift > $get_shift) {
            return response()->json(['message' => 'Data gagal disimpan'], 404);
        }

        // Cek apakah lokasi sudah ada di table JamLokasi
        $lokasi = JamLokasi::where('tmptParkir', $request->lokasi)->where('kodeJln', $request->area)->first();

        // Jika lokasi belum ada, tambahkan lokasi baru
        if (!$lokasi) {
            $lokasi = JamLokasi::create([
                'kodeJln' => $request->area,
                'tmptParkir' => ucwords($request->lokasi),
                'tipe' => 'flat',
            ]);
        }

        $penghargaan = Penghargaan::where('jenisKendaraan', $request->jenisKendaraan)
            ->where('harga', $request->harga)
            ->where('id_lokasiParkir', $lokasi->id)
            ->first();

        // // Jika data belum ada, simpan data baru
        // if (!$penghargaan) {
        //     $penghargaan = Penghargaan::create([
        //         'jenisKendaraan' => ucwords($request->jenisKendaraan),
        //         'harga' => ucwords($request->harga),
        //     ]);
        // }

        // Jika data belum ada, simpan data baru
        if (!$penghargaan) {
            $penghargaan = Penghargaan::create([
                'jenisKendaraan' => "Motor",
                'id_lokasiParkir' => $lokasi->id,
                'harga' => 2000,
            ]);
            $penghargaan = Penghargaan::create([
                'jenisKendaraan' => "Mobil",
                'id_lokasiParkir' => $lokasi->id,
                'harga' => 5000,
            ]);
        }

        // cek apakah username dengan nama tersebut sudah ada di table user atau tidak, jika tidak
        $cekDuplicate = User::where('username', $request->petugas)->first();

        if (!$cekDuplicate) {
            $usernamePetugas = strtolower(str_replace(' ', '', $request->petugas));
            // Simpan data ke database
            $user = User::create([
                'role' => 'petugas-liar',
                'namaLengkap' => $request->petugas,
                'username' => $usernamePetugas,
                'password' => Hash::make($usernamePetugas),
                'id_lokasiParkir' => $lokasi->id, // Menyimpan ID lokasi yang telah ada atau baru dibuat
                'namaLokasi' => $request->area,
                'id_shift' => $request->shift,
            ]);
        } else {
            // Jika username sudah ada, Anda bisa memberikan respon atau error
            // return response()->json(['error' => 'Username sudah digunakan'], 400);
            $user = User::where('username', $request->petugas)->first();
        }

        // $user = User::latest()->first();

        RekapParkir::create([
            'id_user' => $user->id,
            'id_shift' => $request->shift,
            'tglSetor' => date('Y-m-d H:i'),
            'id_lokasiParkir' => $lokasi->id,
            'jumlahMotor' => $request->jumlah_motor,
            'jumlahMobil' => $request->jumlah_mobil,
            'nilaiMotor' => $request->nilai_motor,
            'nilaiMobil' => $request->nilai_mobil,
            'total' => $request->total,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json(['message' => 'Data berhasil disimpan'], 200);
    }

    public function get_keterangan()
    {
        $data = Ket::all();

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function get_data_pelanggan()
    {
        // Ambil bulan dan tahun saat ini
        $bulanSekarang = now()->month;
        $tahunSekarang = now()->year;

        // Ambil data dengan jatuhTempo yang bulan dan tahun-nya kurang dari atau sama dengan bulan & tahun saat ini
        $data = DataPelanggan::where(function ($query) use ($bulanSekarang, $tahunSekarang) {
            $query->whereYear('jatuhTempo', '<', $tahunSekarang) // Tahun sebelumnya
                ->orWhere(function ($query) use ($bulanSekarang, $tahunSekarang) {
                    $query->whereYear('jatuhTempo', '=', $tahunSekarang)
                        ->whereMonth('jatuhTempo', '<=', $bulanSekarang); // Bulan sama atau sebelumnya
                });
        })->get();

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function get_data_pelanggan_sudah_setor()
    {
        // Ambil bulan dan tahun saat ini
        $bulanSekarang = now()->month;
        $tahunSekarang = now()->year;

        // Ambil data dengan jatuhTempo yang bulan dan tahun-nya lebih dari bulan & tahun saat ini
        $data = DataPelanggan::where(function ($query) use ($bulanSekarang, $tahunSekarang) {
            $query->whereYear('jatuhTempo', '>', $tahunSekarang) // Tahun di masa depan
                ->orWhere(function ($query) use ($bulanSekarang, $tahunSekarang) {
                    $query->whereYear('jatuhTempo', '=', $tahunSekarang)
                        ->whereMonth('jatuhTempo', '>', $bulanSekarang); // Bulan lebih besar dari bulan ini
                });
        })->get();

        return response()->json(['status' => 'success', 'data' => $data], 200);
    }

    public function setor_inap($id)
    {
        // Cari data pelanggan berdasarkan ID
        $dataPelanggan = DataPelanggan::find($id);

        if (!$dataPelanggan) {
            return response()->json(['status' => 'error', 'message' => 'Data tidak ditemukan'], 404);
        }

        // Tambah 31 hari ke jatuh tempo
        $dataPelanggan->jatuhTempo = Carbon::parse($dataPelanggan->jatuhTempo)->addDays(31);
        $dataPelanggan->save();

        return response()->json(['status' => 'success', 'message' => 'Jatuh tempo berhasil diperbarui']);
    }
}
