@foreach ($juru as $item)
    <div class="modal fade text-left" id="info{{ $item->id }}" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel160" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title white" id="myModalLabel160">Informasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table">
                        <div class="table-responsive">
                            <div class="header">
                                <h5><strong>Lokasi Parkir: </strong> {{ $item->jam->tmptParkir ?? 'Tidak Diketahui' }}
                                </h5>
                            </div>
                            <table class="table table-bordered" style="width: 100%; overflow-y: auto">
                                <thead class="table-primary text-center" style="white-space: nowrap">
                                    <tr>
                                        <th>No.</th>
                                        <th>Hari, Tanggal dan Jam</th>
                                        <th>Nama Petugas</th>
                                        <th>Plat Nomor</th>
                                        <th>Jumlah Motor</th>
                                        <th>Tarif Motor</th>
                                        <th>Jumlah Mobil</th>
                                        <th>Tarif Mobil</th>
                                        <th>Total</th>
                                        <th>Setor</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center" style="white-space: nowrap">
                                    <!-- Menampilkan rincian hanya untuk ID yang sesuai -->
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tanggal)->timezone('Asia/Jakarta')->translatedFormat('l, d-m-Y H:i') }}
                                        </td>
                                        <td>{{ $item->nama_petugas }}</td>
                                        <td>{{ $item->nopol_list }}</td>
                                        <td>{{ $item->jumlahMotor }} Unit</td>
                                        <td>Rp. {{ Rupiah($item->motor) }}</td>
                                        <td>{{ $item->jumlahMobil }} Unit</td>
                                        <td>Rp. {{ Rupiah($item->mobil) }}</td>
                                        <td>Rp. {{ Rupiah($item->total_nominal) }}</td>
                                        <td>Rp. {{ Rupiah($item->total_nominal) }}</td> <!-- Setor = Total Nominal -->
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

{{-- @if ($juru->groupBy('id_lokasiParkir'))
                            @endif --}}

{{-- @foreach ($juru as $jur)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if ($jur->shift)
                                                    {{ \Carbon\Carbon::parse($jur->shift->created_at)->timezone('Asia/Jakarta')->translatedFormat('l, d F Y / H:i:s') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $jur->user->namaLengkap ?? 'Tidak Diketahui' }}</td>
                                            <td>{{ $jur->nopol_list }}</td>
                                            <td>{{ $jur->jumlahMotor }}</td>
                                            <td>{{ Rupiah($jur->nilaiMotor) }}</td>
                                            <td>{{ $jur->jumlahMobil }}</td>
                                            <td>{{ Rupiah($jur->nilaiMobil) }}</td>
                                            <td>{{ Rupiah($jur->total_nominal) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-check-circle"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach --}}

{{-- {{ $item->jam->tmptParkir }}
                                    @foreach ($juru as $log)
                                        @if ($log->jam)
                                            <!-- Pastikan ada relasi 'jam' -->
                                            {{ $log->jam->tmptParkir }}
                                            <!-- Menampilkan nama tempat parkir dari JamLokasi -->
                                        @endif
                                    @endforeach --}}
